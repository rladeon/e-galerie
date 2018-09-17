<?php

namespace Controller;

class ErrorController extends Controller
{
	public function error_401()
	{
		echo $this->twig->render($this->className.'/error_401.php',
			["title" => "Error",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
	public function error_403()
	{
		echo $this->twig->render($this->className.'/error_403.php',
			["title" => "Error",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
	public function error_404()
	{
		echo $this->twig->render($this->className.'/error_404.php',
			["title" => "Error",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
	
	public function error_500()
	{
		echo $this->twig->render($this->className.'/error_500.php',
			["title" => "Error",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
	public function error_503()
	{
		echo $this->twig->render($this->className.'/error_503.php',
			["title" => "Error",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
	public function error_504()
	{
		echo $this->twig->render($this->className.'/error_504.php',
			["title" => "Error",
			"breadcrumb" => "",
			"root" => $this->root,
			
			]
		);
	}
}
?>