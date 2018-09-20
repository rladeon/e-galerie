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
	    
        "title" => 'exposition',
					"path_large" =>"public/images/2018/31/exposition-large.jpg",
					"path_mid" => "public/images/2018/31/exposition-mid.jpg",
					"path_thumb" =>"public/images/2018/31/exposition-thumb.jpg",
		"id_book" => null,
		"default_img" => true,
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
}
?>