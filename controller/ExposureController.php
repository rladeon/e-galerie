<?php

namespace Controller;

class ExposureController extends Controller
{
	public function index()
	{
		echo $this->twig->render($this->className.'/index.php',
			["title" => "Expositions",
			"breadcrumb" => "",
			"root" => $this->root,
			"notfullback" => true,
			"date_deb" => "06/10/2018",
			"date_end" => "06/10/2018",
			"path_mid" => "public/images/2018/31/exposition-large.jpg",
			"connected" => false,
			"jours" => "Le Samedi 6 Octobre 2018",
			"horaires" => "14h-17h",
			"infos"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			Pellentesque ac erat porttitor, vehicula velit sit amet, scelerisque nisl.",
			"availability" => 25,
			
			]
		);
	}
}
?>