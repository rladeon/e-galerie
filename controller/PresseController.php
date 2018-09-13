<?php

namespace Controller;


class PresseController extends Controller
{
    public function index()
    {
		$list_presse = array(
			1=>array(
				"title" => "catalogue n°1 du concours devenez l'artiste de l'année 2017",
				"date" => "01/01/2017",
				"slug" =>$this->seo->slugify("catalogue numéro 1 du concours devenez l'artiste de l'année 2017"),
				"category"=>"presse",
				"published"=>true,
				"message"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit."
		),
		
		);
		$list_media = array( 17=>array(
				"path_large" =>"/public/images/2018/17/catalogue-large.jpg",
				"path_mid" =>"/public/images/2018/17/catalogue-mid.jpg",
				"id_content" => 1,
				"default_img" => 1,
		),
			
		);
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "Contact",
		  "breadcrumb" => "",
		  "root" => $this->root,
		  "content" => $list_presse,
		  "media"=> $list_media,
		  
        ]);
	}
}
?>