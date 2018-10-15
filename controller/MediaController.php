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
	    
        "title" => 'invitation-verso-fr',
					"path_large" =>"public/images/2018/35/invitation-recto-eng-large.jpg",
					"path_mid" => "public/images/2018/35/invitation-recto-eng-mid.jpg",
					"path_thumb" =>"public/images/2018/35/invitation-recto-eng-thumb.jpg",
		"id_book" => null,
		"default_img" => false,
		'extension'      => 'jpg',
        'size'     => null,
		'id_content'  => null,
		/*'category' => "Paysage",
        'datacateg'     => "paysage",*/
		'id_exposure' => 1,
		'timestamp' => time(),
		
      ]);
      echo "A new media has been created: " . $myNewMedia->title;
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
				if( empty($_POST["title"]) )
				{
					$title = $media->title;
				}
				else
				{
					$m = $mediaMapper->where(["title"=>$_POST["title"]])->first();
					if($m == false)
					{
						$media->title = $_POST["title"];
					}
					
					$category = empty($_POST["category"])?null:$_POST["category"];
					$datacateg = empty($_POST["datacateg"])?null:$_POST["datacateg"];
					$gallery = empty($_POST["gallery"])?null:$_POST["gallery"];
					$default_img = empty($_POST["defaultimg"])?null:$_POST["defaultimg"];

					$id_content = empty($_POST["content"])?null:$_POST["content"];
					$id_book = empty($_POST["book"])?null:$_POST["book"];
					$id_exposure = empty($_POST["exposure"])?null:$_POST["exposure"];

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
	public function updateimage()
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			$message = "La session a expirée.";
				
		}
		else
		{
			$year = date("Y");
			$id = $media->id;
			$path = "public/images/".$year."/".$id."/";
			$ret = $this->utils->upload_file($path);
			$message = $ret["message"];
			
		}
	}
}
 ?>