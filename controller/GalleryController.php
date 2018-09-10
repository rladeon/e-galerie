<?php

namespace Controller;

class GalleryController extends Controller
{
	public function index()
	{
		$list = array(
				2=>array(
					"title" => 'banane',
					"path_large" =>"public/images/2018/2/banane-large.jpg",
					"path_mid" => "public/images/2018/2/banane.jpg",
					"path_thumb" =>"public/images/2018/2/banane-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "carte postale",
					"datacateg" => "cartepostale"
					
				),
				3=>array(
					"title" => 'cacao',
					"path_large" =>"public/images/2018/3/cacao-large.jpg",
					"path_mid" => "public/images/2018/3/cacao.jpg",
					"path_thumb" =>"public/images/2018/3/cacao-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "carte postale",
					"datacateg" => "cartepostale"
					
				),
		);
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