<?php

namespace Controller;


class AboutController extends Controller
{
    public function index()
    {
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Présentation"=>"about/index"),$net->home_url);
		$mapper = spot()->mapper('Model\Content');
		$content = $mapper->where(['title' => "présentation"])->first();
		
		if( $content == false )
		{
			$about = null;
		}
		else
		{
			if(empty($content->description))
			{
				$about = null;
			}
			else
			{
				$about = $content->description;
			}
		}	
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "présentation",
		  "breadcrumb" => $breadcrumb,
		  "root" => $this->root,
		  "about" => $about,
		  
        ]);
	}
}
?>