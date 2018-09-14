<?php

namespace Controller;


class PressController extends Controller
{
    public function index()
    {
		$list_presse = array(
			1=>array(
			"id"=>1,
				"title" => "catalogue n°1 du concours devenez l'artiste de l'année 2017",
				"date" => "01/01/2017",
				"slug" =>$this->seo->slugify("catalogue numéro 1 du concours devenez l'artiste de l'année 2017"),
				"category"=>"presse",
				"published"=>true,
				"message"=> "Suspendisse lacinia erat risus, ut laoreet nulla commodo vel. Praesent maximus viverra aliquam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer quis augue pretium, ultricies lorem non, interdum quam. Curabitur feugiat non arcu nec pretium. Pellentesque mattis urna pulvinar maximus ultrices. Curabitur interdum, ligula non hendrerit porttitor, metus ligula egestas ipsum, quis pharetra magna enim a metus. Proin eu suscipit turpis, et suscipit nibh. Vestibulum id accumsan magna. Aliquam ante elit, bibendum quis maximus eu, ullamcorper ut nisi. Praesent sagittis tristique ultricies.

Aliquam eget ipsum eu quam porttitor posuere eu et neque. Nulla quis aliquet orci. Pellentesque suscipit risus a nibh consectetur condimentum. Suspendisse in volutpat neque, at ullamcorper enim. Curabitur vitae sapien fringilla, vehicula dui sed, lobortis felis. Suspendisse eleifend augue eros, sit amet mattis nibh posuere quis. Nulla tempor justo est. Mauris quis pellentesque risus. Sed dignissim dignissim lectus ac dignissim. Quisque eu diam viverra, congue magna id, accumsan mi..",
				"views" => 0,
				"author" => ""
		),
		
		);
		//var_dump($this->seo->slugify("catalogue numéro 1 du concours devenez l'artiste de l'année 2017"));
		$list_media = array( 17=>array(
				"path_large" =>"/public/images/2018/17/catalogue-large.jpg",
				"path_mid" =>"/public/images/2018/17/catalogue-mid.jpg",
				"id_content" => 1,
				"default_img" => 1,
		),
			
		);
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "Presse",
		  "breadcrumb" => "",
		  "root" => $this->root,
		  "content" => $list_presse,
		  "media"=> $list_media,
		  
        ]);
	}
	public function show($slug)
	{
		$list_presse = array(
			1=>array(
				"id"=>1,
				"title" => "catalogue n°1 du concours devenez l'artiste de l'année 2017",
				"date" => "01/01/2017",
				"slug" =>$this->seo->slugify("catalogue numéro 1 du concours devenez l'artiste de l'année 2017"),
				"category"=>"presse",
				"published"=>true,
				"message"=> "Suspendisse lacinia erat risus, ut laoreet nulla commodo vel. Praesent maximus viverra aliquam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer quis augue pretium, ultricies lorem non, interdum quam. Curabitur feugiat non arcu nec pretium. Pellentesque mattis urna pulvinar maximus ultrices. Curabitur interdum, ligula non hendrerit porttitor, metus ligula egestas ipsum, quis pharetra magna enim a metus. Proin eu suscipit turpis, et suscipit nibh. Vestibulum id accumsan magna. Aliquam ante elit, bibendum quis maximus eu, ullamcorper ut nisi. Praesent sagittis tristique ultricies.

Aliquam eget ipsum eu quam porttitor posuere eu et neque. Nulla quis aliquet orci. Pellentesque suscipit risus a nibh consectetur condimentum. Suspendisse in volutpat neque, at ullamcorper enim. Curabitur vitae sapien fringilla, vehicula dui sed, lobortis felis. Suspendisse eleifend augue eros, sit amet mattis nibh posuere quis. Nulla tempor justo est. Mauris quis pellentesque risus. Sed dignissim dignissim lectus ac dignissim. Quisque eu diam viverra, congue magna id, accumsan mi.",
				"views" => 0,
				"author" => "John Doe"
		),
		
		);
		$list_media = array( 17=>array(
				"path_large" =>"/public/images/2018/17/catalogue-large.jpg",
				"path_mid" =>"/public/images/2018/17/catalogue-mid.jpg",
				"id_content" => 1,
				"default_img" => 1,
		),
			
		);
		foreach($list_presse as $key =>$value)
		{
			if($slug['page'] == $value["slug"])
			{
				echo $this->twig->render($this->className.'/show.php',
				[
				  "title" => "Article",
				  "breadcrumb" => "",
				  "root" => $this->root,
				  "article" => $value,
				  "media"=> $list_media,
				  
				]);
				break;
			}
			else
			{
				echo $this->twig->render($this->className.'/show.php',
				[
				  "title" => "Article",
				  "breadcrumb" => "",
				  "root" => $this->root,
				  "article" => null,
				  "media"=> $list_media,
				  
				]);
			}
		}
	}
}
?>