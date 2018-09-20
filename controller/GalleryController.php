<?php

namespace Controller;
use Model\Media;

class GalleryController extends Controller
{
	public function index()
	{
		$mapper = spot()->mapper('Model\Media');
		// Where can be called directly from the mapper
		$posts = $mapper->where(['gallery' => 1]);
		$list = null;
		
		foreach( $posts as $key=>$value)
		{
			$list[$value->id] = array(
					"title" => $value->title,
					"path_large" => $value->path_large,
					"path_mid" => $value->path_mid,
					"path_thumb" => $value->path_thumb,
					"category" => $value->category,
					"datacateg" => $value->datacateg
					
				);
		}//var_dump($list);
		
		echo $this->twig->render($this->className.'/index.php',
			["title" => "Galerie",
			"breadcrumb" => "",
			"root" => $this->root,
			"gallery" =>$list
			]
		);
	}
}
?>