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
					"path_mid" => "public/images/2018/2/banane-mid.jpg",
					"path_thumb" =>"public/images/2018/2/banane-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "Fruit",
					"datacateg" => "fruit"
					
				),
				3=>array(
					"title" => 'cacao',
					"path_large" =>"public/images/2018/3/cacao-large.jpg",
					"path_mid" => "public/images/2018/3/cacao-mid.jpg",
					"path_thumb" =>"public/images/2018/3/cacao-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "Fruit",
					"datacateg" => "fruit"
					
				),
				
				4=>array(
					"title" => 'carambole',
					"path_large" =>"public/images/2018/4/carambole-large.jpg",
					"path_mid" => "public/images/2018/4/carambole-mid.jpg",
					"path_thumb" =>"public/images/2018/4/carambole-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "Fruit",
					"datacateg" => "fruit"
					
				),
				27=>array(
					"title" => 'marine corail',
					"path_large" =>"public/images/2018/27/marine-corail-large.jpg",
					"path_mid" => "public/images/2018/27/marine-corail-mid.jpg",
					"path_thumb" =>"public/images/2018/27/marine-corail-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "Paysage",
					"datacateg" => "paysage"
					
				),
				28=>array(
					"title" => 'marine corail et coquillage',
					"path_large" =>"public/images/2018/28/marine-corail-coquillage-large.jpg",
					"path_mid" => "public/images/2018/28/marine-corail-coquillage-mid.jpg",
					"path_thumb" =>"public/images/2018/28/marine-corail-coquillage-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "Paysage",
					"datacateg" => "paysage"
					
				),
				29=>array(
					"title" => 'marine corail et coquillage',
					"path_large" =>"public/images/2018/29/marine-coquillage-large.jpg",
					"path_mid" => "public/images/2018/29/marine-coquillage-rose-mid.jpg",
					"path_thumb" =>"public/images/2018/29/marine-coquillage-rose-thumb.jpg",
					"size" => null,
					"width" =>null,
					"heigh" =>null,
					"extension" =>"jpg",
					"category" => "Paysage",
					"datacateg" => "paysage"
					
				)
				
				
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