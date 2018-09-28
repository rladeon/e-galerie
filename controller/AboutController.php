<?php

namespace Controller;


class AboutController extends Controller
{
    public function index()
    {
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Présentation"=>"about/index"),$net->home_url);
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "présentation",
		  "breadcrumb" => $breadcrumb,
		  "root" => $this->root,
		  
        ]);
	}
}
?>