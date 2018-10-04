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
		
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "Accueil",
		  "breadcrumb" =>  $breadcrumb ,
		  "root" => $this->root,
		  "gallery" => $list,
		  "resume" => $resume,
        ]);
    }
}
?>