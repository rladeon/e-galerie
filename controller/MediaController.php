<?php

namespace Controller;
use Model\Media;

class MediaController extends Controller
{
	public function create()
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			$m = "";
				
			if(!empty($_SESSION["error"]["message"]))
			{
				$m = $_SESSION["error"]["message"];				
			}
			unset($_SESSION['error']);
			
			echo $this->twig->render($this->className.'/create.php',
							[
							  "title" => "Admin",					
							  "root" => $this->root,
							  
							  "message" => $m,
							]); 
		}
		
			
	}
	public function addmedia()
	{
		$this->session->start();
		unset($_SESSION['error']);
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			if(empty($_FILES['path']['name']))
			{
				$_SESSION['error']["message"] = "Il faut choisir une image.";
				header('HTTP/1.0 302');
				header("Location: ".$this->root."media/create"); 
			}
			else
			{
				$mediaMapper = spot()->mapper('Model\Media');
				$mediaMapper->migrate();	  
		 
				$myNewMedia = $mediaMapper->create([
						
					"path_large" => "unset",
					"path_mid" => "unset",
					"path_thumb" => "unset",
					
					"default_img" => false,
					'timestamp' => time(),
			
				]);
				
				$year = date("Y");
				$path = "/public/images/".$year."/".$myNewMedia->id."/";
				
				$ret = $this->utils->upload_file($path,"image");
				$message = $ret["message"];
				
				$mapper = spot()->mapper('Model\Media');
				$mapper->migrate();
				$medias = $mapper->where(["id"=>$myNewMedia->id])->first();
						
				if(!empty($ret["result"]) && $ret["result"] == true)
				{
					$sizes = array("-large."=>1000, "-mid."=>300, "-thumb."=>100); 
					$uploadpath = $ret["uploadpath"];
					$currentDir = getcwd();
								
					foreach($sizes as $key=>$value)
					{
						$this->utils->resize_image($uploadpath, $ret["path"].'/'.$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]), $width = 0, $height = $value);
						$filepath = "public/images/".$year."/".$myNewMedia->id."/".$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]);
									
						if( $value == 1000 )
						{
							$medias->path_large = $filepath;
						}
						else if( $value == 300)
						{
							$medias->path_mid = $filepath;
						}
						else
						{
							$medias->path_thumb = $filepath;
						}
						$medias->extension = $ret["fileExtension"];
						$medias->timestamp = time();
						$mapper->update($medias);
						
					}
					unlink($uploadpath);
					$_SESSION['error']["message"] = "l'image a été enregistrée";
					header('HTTP/1.0 302');
					header("Location: ".$this->root."media/create"); 
				}
				else
				{
					$_SESSION['error']["message"] = $message;
					header('HTTP/1.0 302');
					header("Location: ".$this->root."media/create"); 
				}
			}
			
		}
	}
	public function updatetimestamp()
	{
		$mediaMapper = spot()->mapper('Model\Media');
			
		$entity = $mediaMapper->where(['timestamp !=' => null]);
		$count =0;
		foreach( $entity as $key=>$value)
		{
			$t = time();
			$value->timestamp = $t;
			$mediaMapper->update($value);
			$count++;
		}
		if($count >0)
		{
			echo $count." timestamp has been updated";
		}
		else
		{
			echo "0 timestamp has been updated";
		}
	}
	public function update($param)
	{
		
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Media');
			$mapper->migrate();
			$medias = $mapper->where(["id"=>$param["id"]])->first();
			
			$list = null;
			
			if($medias == false)
			{
				echo $this->twig->render($this->className.'/update.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					 	"error" => true,
						"message" => "l'id de cette image n'existe pas",						
					]);
			}
			else
			{
				$m = "";
				
				if(!empty($_SESSION["error"]["message"]))
				{
					$m = $_SESSION["error"]["message"];				
				}
				unset($_SESSION['error']);
				$list = array(
				"id" => $medias->id,
				"title" => $medias->title,
				"path" => $medias->path_mid,
				);
				echo $this->twig->render($this->className.'/update.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					 	"error" => false,			  
						"media" => $list,
						"message" => $m,
						
					]);
			}
		}
		else
		{
			echo $this->twig->render('/admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
	}
	public function updatemedia($param)
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		else
		{
			$mediaMapper = spot()->mapper('Model\Media');
			$mediaMapper->migrate();
			$media = $mediaMapper->where(["id"=>$param["id"]])->first();
			if( $media == false)
			{
				echo json_encode(array("result"=>'error', 
					"errors"=>"L'id de l'image n'existe pas."));
					die();
			}
			else
			{			
				
				$title  = empty($_POST["title"])?null:$_POST["title"];
				$category = empty($_POST["category"])?null:$_POST["category"];
				$datacateg = empty($_POST["datacateg"])?null:$_POST["datacateg"];
				$gallery = empty($_POST["gallery"])?null:$_POST["gallery"];
				$default_img = empty($_POST["defaultimg"])?null:$_POST["defaultimg"];
				$id_content = empty($_POST["content"])?null:$_POST["content"];
				$id_book = empty($_POST["book"])?null:$_POST["book"];
				$id_exposure = empty($_POST["exposure"])?null:$_POST["exposure"];
				$archiver = empty($_POST["archiver"])?null:$_POST["archiver"];
				
				$media->title = $title;
				$media->category = $category;
				$media->datacateg = $datacateg;
				$media->gallery = $gallery;
				$media->default_img = $default_img;
				$media->id_content = $id_content;
				$media->id_book = $id_book;
				$media->id_exposure = $id_exposure;
				$media->archiver = $archiver;
					
					$myNewMedia = $mediaMapper->update($media);
					
					if($myNewMedia == false)
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"L'image n'a pas été mis à jour.".$id_content));
						die();
					}
					else
					{
						echo json_encode(array("result"=>'success', 
							"message"=>"L'image a été mis à jour."));
							die();
					}

			}				
			
		}
		
	}
	public function updateimage($param)
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Media');
			$mapper->migrate();
			$medias = $mapper->where(["id"=>$param["id"]])->first();
			
			$list = null;
			
			if($medias == false)
			{
				$_SESSION['error']["message"] = "L'id de l'image n'existe pas dans la base de donnée";
					header('HTTP/1.0 302');
					header("Location: ".$this->root."media/update/id/".$param["id"]); 
			}
			else
			{
				$message = "";
				if(!empty($_POST["id"]) && $_POST["id"] == $param["id"])
				{
					$year = date("Y");
					$id = $medias->id;
					$path = "/public/images/".$year."/".$id."/";
					$ret = $this->utils->upload_file($path, "image");
					$message = $ret["message"];
					
					if(!empty($ret["result"]) && $ret["result"] == true)
					{
						$sizes = array("-large."=>1000, "-mid."=>300, "-thumb."=>100); 
						$uploadpath = $ret["uploadpath"];
						$currentDir = getcwd();
						
						foreach($sizes as $key=>$value)
						{
							$this->utils->resize_image($uploadpath, $ret["path"].'/'.$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]), $width = 0, $height = $value);
							//$filepath = "public/images/".$year."/".$id."/".$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]);
							
							if( $value == 1000 )
							{
								unlink($currentDir."/".$medias->path_large);
								$medias->path_large = $filepath;
							}
							else if( $value == 300)
							{
								unlink($currentDir."/".$medias->path_mid);
								$medias->path_mid = $filepath;
							}
							else
							{
								unlink($currentDir."/".$medias->path_thumb);
								$medias->path_thumb = $filepath;
							}
							$this->utils->resize_image($uploadpath, $ret["path"].'/'.$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]), $width = 0, $height = $value);
							$medias->extension = $ret["fileExtension"];
							$medias->timestamp = time();
							$mapper->update($medias);
						
						}
						
						unlink($uploadpath);
						$_SESSION['error']["message"] = $message;
						header('HTTP/1.0 302');
						header("Location: ".$this->root."media/update/id/".$param["id"]); 
					}
				}
				
				$_SESSION['error']["message"] = $message;
				header('HTTP/1.0 302');
				header("Location: ".$this->root."media/update/id/".$param["id"]); 
			}
		}
		else
		{
			echo $this->twig->render('/admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
	}
	public function delete($param)
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		else
		{
			$mediaMapper = spot()->mapper('Model\Media');
			$mediaMapper->migrate();
			$media = $mediaMapper->where(["id"=>$param["id"]])->first();
			$currentDir = getcwd();
			if( $media == false)
			{
				echo json_encode(array("result"=>'error', 
					"errors"=>"L'id de l'image n'existe pas."));
					die();
			}
			else
			{	if(is_file(	$currentDir."/".$media->path_large ))
				{
					unlink($currentDir."/".$media->path_large);
				}
				if(is_file(	$currentDir."/".$media->path_mid ))
				{
					unlink($currentDir."/".$media->path_mid);
				}
				if(is_file(	$currentDir."/".$media->path_thumb ))
				{
					unlink($currentDir."/".$media->path_thumb);
				}
				$year = date("Y");
				$path_ = "/public/images/".$year."/".$param["id"]."/";
				if(is_dir(	$currentDir.$path_ ))
				{
					rmdir($currentDir.$path_);
				}
				$mediaMapper->delete(["id"=>$param["id"]]);
				$media = $mediaMapper->where(["id"=>$param["id"]])->first();
				if($media != false)
				{
					echo json_encode(array("result"=>'error', 
					"errors"=>"L'image n'a pas été supprimée."));
					die();
				}
				else
				{
					echo json_encode(array("result"=>'success', 
					"message"=>"L'image a été supprimée."));
					die();
				}
			}
		}
	}
	
	
}
 ?>