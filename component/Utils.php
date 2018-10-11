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
	public function upload_file($uploadDirectory)
	{
		$currentDir = getcwd();

		$errors = []; // Store all foreseen and unforseen errors here

		$fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

		$fileName = $_FILES['path']['name'];
		$fileSize = $_FILES['path']['size']/1024;
		$fileTmpName  = $_FILES['path']['tmp_name'];
		$fileType = $_FILES['path']['type'];
		$fileExtension = strtolower(end(explode('.',$fileName)));

		$uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

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
	
}

?>