<?php

namespace Controller;

class HomeController extends Controller
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
					)
				,
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
		);
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "Accueil",
		  "breadcrumb" => "",
		  "root" => $this->root,
		  "gallery" => $list
        ]);
    }
}
?>