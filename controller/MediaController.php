<?php

namespace Controller;
use Model\Media;

class MediaController extends Controller
{
	public function create()
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
		
		$ret = $this->utils->upload_file($path);
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
			header('HTTP/1.0 302');
			header("Location: ".$this->root."admin/medialist"); 
		}
		else
		{
			header('HTTP/1.0 302');
			header("Location: ".$this->root."admin/medialist");
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
				$media->title = $title;
				$media->category = $category;
				$media->datacateg = $datacateg;
				$media->gallery = $gallery;
				$media->default_img = $default_img;
				$media->id_content = $id_content;
				$media->id_book = $id_book;
				$media->id_exposure = $id_exposure;
					
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
	
	
}
 ?>