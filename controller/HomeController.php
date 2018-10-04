<?php

namespace Controller;
use Model\Media;

class HomeController extends Controller
{
    public function index()
    {
		$mapper = spot()->mapper('Model\Media');
		$posts = $mapper->where(['gallery' => 1])
		->order(['timestamp' => 'DESC'])
		->limit(4);
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
		}
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array(),$net->home_url);
		$mapper = spot()->mapper('Model\Content');
		$content = $mapper->where(['title' => "présentation"])->first();
		
		if( $content == false )
		{
			$resume = null;
		}
		else
		{
			if(empty($content->resume))
			{
				$resume = null;
			}
			else
			{
				$resume = $content->resume;
			}
		}	
		$mapper = spot()->mapper('Model\Content');
		$posts = $mapper->where(['category' => "press" ])
		->order(["date_publish" => "DESC"])
		->limit(3);
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
          "title" => "Accueil",
		  "breadcrumb" =>  $breadcrumb ,
		  "root" => $this->root,
		  "gallery" => $list,
		  "resume" => $resume,
		  "press" => $list_presse,
		  "media" => $list_media,
        ]);
		
		
    }
}
?>