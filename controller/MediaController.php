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
						$title = $_POST["title"];
					}
					else
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"Ce titre a déjà été attribué à cette image."));
						die();				
					}
					
					$media->title = $title;
					$myNewMedia = $mediaMapper->update($media);
					
					if($myNewMedia == false)
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"L'image n'a pas été mis à jour."));
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
}
?>