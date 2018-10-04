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
	    
        "title" => 'article-du-10-08-2018',
					"path_large" =>"public/images/2018/32/article_10.08.2018_France-Antilles-large.png",
					"path_mid" => "public/images/2018/32/article_10.08.2018_France-Antilles-mid.png",
					"path_thumb" =>"public/images/2018/32/article_10.08.2018_France-Antilles-large.png",
		"id_book" => null,
		"default_img" => true,
		'extension'      => 'png',
        'size'     => null,
		'id_content'  => 6,
		/*'category' => "Paysage",
        'datacateg'     => "paysage",*/
		'id_exposure' => null,
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