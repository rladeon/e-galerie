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
		'category' => "Paysage",
        'datacateg'     => "paysage",
		'id_exposure' => 1
      ]);
      echo "A new media has been created: " . $myNewMedia->title;
	}
}
?>