<?php

namespace Controller;


class AboutController extends Controller
{
    public function index()
    {
		echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "Contact",
		  "breadcrumb" => "",
		  "root" => $this->root,
		  
        ]);
	}
}
?>