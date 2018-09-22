<?php

namespace Controller;
use Model\Content;

class PressController extends Controller
{
    public function index()
    {
		$mapper = spot()->mapper('Model\Content');
		$posts = $mapper->where(['category' => "press" ]);
		$list_presse = null;
		
		foreach( $posts as $key=>$value)
		{
			$list_presse[$value->id] = array(
					
				"title" => $value->title,
				"date" => $value->date_publish->format("d/m/Y"),
				"slug" => $value->slug,
				"category"=> $value->category,
				"published"=>$value->published,
				"message"=> $value->description,
				"views" => $value->view,
				"author" => $value->author,
					
				);
		}//var_dump($list_presse);
		
		$mapper = spot()->mapper('Model\Media');
		// Where can be called directly from the mapper
		$posts = $mapper->all()->where(['id_content !=' => null, 'default_img =' => 1]);
		$list_media = null;
		
		foreach( $posts as $key=>$value)
		{
			$list_media[$value->id] = array(
					
					"path_large" => $value->path_large,
					"path_mid" => $value->path_mid,
					"path_thumb" => $value->path_thumb,
					"id_content" =>$value->id_content,
					"default_img" =>$value->default_img
					
				);
		}
		
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
		$mapper = spot()->mapper('Model\Content');
		$posts = $mapper->first(['slug' => $slug["page"]]);
		
		
		$list_presse = array(
			$posts->id=>array(
				"id"=>$posts->id,
				"title" => $posts->title,
				"date" => $posts->date_publish->format("d/m/Y"),
				"slug" => $posts->slug,
				"category"=> $posts->category,
				"published"=> $posts->published,
				"message"=> $posts->description,
				"views" => $posts->view,
				"author" => $posts->author
		),
		
		);
		$mapper = spot()->mapper('Model\Media');
		// Where can be called directly from the mapper
		$posts = $mapper->all()->where(['id_content !=' => null, 'default_img =' => 1]);
		$list_media = null;
		
		foreach( $posts as $key=>$value)
		{
			$list_media[$value->id] = array(
					
					"path_large" => $value->path_large,
					"path_mid" => $value->path_mid,
					"path_thumb" => $value->path_thumb,
					"id_content" =>$value->id_content,
					"default_img" =>$value->default_img
					
				);
		}
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