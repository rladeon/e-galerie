<?php

namespace Controller;

class ExposureController extends Controller
{
	public function index()
	{
		echo $this->twig->render($this->className.'/index.php',
			["title" => "Exposition",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
}
?>