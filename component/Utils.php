<?php

namespace Component;
define('INACTIVITY_TIMEOUT',3600*2);

class Utils
{
	private $breadcrumb;

    private $separator = ' / ';   
   
	public function inactivity()
	{
		return INACTIVITY_TIMEOUT;
	}
	public function allIPs()
	// Returns the IP address of the client (Used to prevent session cookie hijacking.)
	{
		$ip = $_SERVER["REMOTE_ADDR"];
		// Then we use more HTTP headers to prevent session hijacking from users behind the same proxy.
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip=$ip.'_'.$_SERVER['HTTP_X_FORWARDED_FOR']; }
		if (isset($_SERVER['HTTP_CLIENT_IP'])) { $ip=$ip.'_'.$_SERVER['HTTP_CLIENT_IP']; }
		return $ip;
	}
	public function isloggedin()
	{
		
		// If session does not exist on server side, or IP address has changed, or session has expired, show login screen.
		if (!isset ($_SESSION['uid']) || !$_SESSION['uid'] || $_SESSION['ip']!= $this->allIPs() || time()>=$_SESSION['expires_on'])
		{
			if (session_status() != PHP_SESSION_NONE) 
			{
				session_unset();
			}
			
			return false;
		}
		$_SESSION['expires_on']=time()+INACTIVITY_TIMEOUT;  // User accessed a page : Update his/her session expiration date.
		return true;
	}
	public function isadmin()
	{
		
		// If session does not exist on server side, or IP address has changed, or session has expired, show login screen.
		if (!isset ($_SESSION['uid']) || !$_SESSION['uid'] || $_SESSION['ip']!= $this->allIPs() || time()>=$_SESSION['expires_on'] || empty($_SESSION["user"]["is_admin"]) || $_SESSION["user"]["is_admin"] != true)
		{
			if (session_status() != PHP_SESSION_NONE) 
			{
				session_unset();
			}
			
			return false;
		}
		$_SESSION['expires_on']=time()+INACTIVITY_TIMEOUT;  // User accessed a page : Update his/her session expiration date.
		return true;
	}
	public function build_breadcrumb($array, $domain)
   {
      $breadcrumbs = array_merge(array('Accueil' => ''), $array);

      $count = 0;

      foreach($breadcrumbs as $title => $link) {
         $this->breadcrumb .= '
         <span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="'.$domain. '/'.$link.'" itemprop="url">
               <span itemprop="title">'.$title.'</span>
            </a>
         </span>';

         $count++;

         if($count !== count($breadcrumbs)) {
            $this->breadcrumb .= $this->separator;
         }
      }
      return $this->breadcrumb;
   }
   function validate_phone_number($phone)
	{
		// Allow +, - and . in phone number
		$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
		// Remove "-" from number
		$phone_to_check = str_replace("-", "", $filtered_phone_number);
		// Check the lenght of number
		// This can be customized if you want phone number from a specific country
		if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) 
		{
			return false;
		}
		else 
		{
		   return true;
		}
	}
	public function generateRandomToken($length = 20) 
	{
		$chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charsLength = strlen($chars);

		$randomString = '';

		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $chars[rand(0, $charsLength - 1)];
		}

		return $randomString;
	}
	public function upload_file($uploadDirectory, $type=null)
	{
		$currentDir = getcwd();

		$errors = []; // Store all foreseen and unforseen errors here
		if(empty($type))
		{
			$fileExtensions = ['jpeg','jpg','png','pdf']; // Get all the file extensions
		}
		else
		{
			$fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
		}

		$fileName = $_FILES['path']['name'];
		$fileSize = $_FILES['path']['size']/1024;
		$fileTmpName  = $_FILES['path']['tmp_name'];
		$fileType = $_FILES['path']['type'];
		$fileExtension = strtolower(end(explode('.',$fileName)));
		if(empty($_FILES['path']['name']))
		{
			return array("result" => false, "message" => "Il faut choisir une image.");
		}
		$uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
		if(!is_dir($currentDir . $uploadDirectory))
		{
			if(!mkdir($currentDir . $uploadDirectory, 0755))
			{
				$error = "le dossier: ".$currentDir . $uploadDirectory." n'a pas été créé.";
				return array("result" => false, "message" => $error);
			}
		}		
		 if (isset($_POST['upload']))
		{

			if (! in_array($fileExtension,$fileExtensions)) 
			{
				$errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
			}

			if ($fileSize > 2000000) 
			{
				$errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
			}

			if (empty($errors)) 
			{
				$didUpload = move_uploaded_file($fileTmpName, $uploadPath);

				if ($didUpload) 
				{
					return array("result" => true, 
					"path" => $currentDir . $uploadDirectory,
					"uploadpath" => $uploadPath,
					"filename" => $fileName,
					"fileSize" => $fileSize,
					"fileType" => $fileType,
					"fileExtension" => $fileExtension,
					"message" => "The file " . basename($fileName) . " has been uploaded"
					);
				}
				else
				{
					return array("result" => false, "message" => "An error occurred somewhere. Try again or contact the admin");
				}
			} 
			else
			{
				$val = "";
				foreach ($errors as $error) 
				{
					$val .= $error . "These are the errors" . "\n";
				}
				return array("result" => false, "message" => $val);
			}
		}
	}
	public function remove_extension($filename)
	{
		return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
	}
	public function get_extension($path)
	{
		return pathinfo($path, PATHINFO_EXTENSION);
	}
	public function resize_image($img, $to, $width = 0, $height = 0)
	{
 
	$dimensions = getimagesize($img);
	$ratio      = $dimensions[0] / $dimensions[1];
 
	// Calcul des dimensions si 0 passé en paramètre
	if($width == 0 && $height == 0){
		$width = $dimensions[0];
		$height = $dimensions[1];
	}elseif($height == 0){
		$height = round($width / $ratio);
	}elseif ($width == 0){
		$width = round($height * $ratio);
	}
 
	if($dimensions[0] > ($width / $height) * $dimensions[1]){
		$dimY = $height;
		$dimX = round($height * $dimensions[0] / $dimensions[1]);
		$decalX = ($dimX - $width) / 2;
		$decalY = 0;
	}
	if($dimensions[0] < ($width / $height) * $dimensions[1]){
		$dimX = $width;
		$dimY = round($width * $dimensions[1] / $dimensions[0]);
		$decalY = ($dimY - $height) / 2;
		$decalX = 0;
	}
	if($dimensions[0] == ($width / $height) * $dimensions[1]){
		$dimX = $width;
		$dimY = $height;
		$decalX = 0;
		$decalY = 0;
	}
 
	// Création de l'image avec la librairie GD
	
		$pattern = imagecreatetruecolor($width, $height);
		$type = mime_content_type($img);
		switch (substr($type, 6)) {
			case 'jpeg':
				$image = imagecreatefromjpeg($img);
				break;
			case 'gif':
				$image = imagecreatefromgif($img);
				break;
			case 'png':
				$image = imagecreatefrompng($img);
				break;
		}
		imagecopyresampled($pattern, $image, 0, 0, 0, 0, $dimX, $dimY, $dimensions[0], $dimensions[1]);
		imagedestroy($image);
		imagejpeg($pattern, $to, 100);
 
		return TRUE;
 
       
	
	}
}

?>