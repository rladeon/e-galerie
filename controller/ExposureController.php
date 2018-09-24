<?php

namespace Controller;

class ExposureController extends Controller
{
	public function index()
	{
		$mapper = spot()->mapper('Model\Exposure');
		$book = $mapper->where(['date_start >' => \DateTime::createFromFormat('Y-m-d', date('Y-m-d') )->format("Y-m-d")])
		->order(['date_start'=>"DESC"])
		->first();
		$list = null;
		if($book != false)
		{
			
			$list = array(
				"id"=> $book->id,
				"title" => $book->title,
				"resume"=> $book->resume,
				   "notfullback" => $book->notfullback,
			"date_deb" => $book->date_start->format("d/m/Y"),
			"date_end" => $book->date_end->format("d/m/Y"),
			"nb_place" => $book->nb_place,
			"connected" => !empty($_SESSION["logged_in"])?$_SESSION["logged_in"]: false,
			"jours" => $book->date_start->format("d/m/Y"),
			"horaires" => $book->hours,
			"infos"=> $book->description,
			"availability" => $this->availability($book->nb_place, $book->booked),
				
			);
		}
		$mapper = spot()->mapper('Model\Media');
		// Where can be called directly from the mapper
		$posts = $mapper->all()->where(['id_exposure !=' => null]);
		$list_media = null;
		
		foreach( $posts as $key=>$value)
		{
			$list_media[$value->id] = array(
					
					"path_large" => $value->path_large,
					"path_mid" => $value->path_mid,
					"path_thumb" => $value->path_thumb,
					"id_exposure" =>$value->id_exposure,
					"default_img" =>$value->default_img
					
				);
		}
		
		echo $this->twig->render($this->className.'/index.php',
			["title" => "Expositions",
			"breadcrumb" => "",
			"root" => $this->root,
			"main"=>$list,
			"media" => $list_media,
			
			]
		);
	}
	public function create()
	{
		$userMapper = spot()->mapper('Model\Exposure');
		$userMapper->migrate();
	  
	 
		$myNewExpo = $userMapper->create([
		'title'      => "St Martin expo",
		'slug'      => $this->seo->slugify("St Martin expo"),
		'category'      => null,
		'date_start'     => \DateTime::createFromFormat('d/m/Y', '06/10/2018'),
		'date_end'     => \DateTime::createFromFormat('d/m/Y', '06/10/2018'),
        'published'     => true,
        'description'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ac erat porttitor, vehicula velit sit amet, scelerisque nisl.",
		'resume'  => "Lorem ipsum dolor sit amet",
		'hours' => "14h-17h",
        'nb_place'     => 8,
		'booked' =>2,
		'notfullback' => true,
		'timestamp' => time(),
		]);
      echo "A new exposure has been created: " . $myNewExpo->title;
	}
	public function availability($nb_place, $booked)
	{
		if(!filter_var($nb_place, FILTER_VALIDATE_INT) || !filter_var($booked, FILTER_VALIDATE_INT))
		{
			$res = 0;
		}
		else if($nb_place < 1)
		{
			$res = 0;
		}			
	
		else if($nb_place >= $booked)
		{
			$res = $booked/$nb_place;
		}
		else
		{
			$res = 0;
		}
		return $res *100;
	}
	public function translate_date($exposure,$start=true)
	{
		$daylist = array("0"=>"Samedi", "1"=>"Dimanche","2"=>"Lundi","3"=>"Mardi",
		"4"=>"Mercredi", "5"=>"Jeudi","6"=>"Vendredi");
		$monthlist = array("1"=>"Janvier", "2"=>"Février","3"=>"Mars","4"=>"Avril",
		"5"=>"Mai", "6"=>"Juin","7"=>"Juillet", "8"=>"Août", "9"=>"Septembre",
		"10"=>"Octobre","11"=>"Novembre","12"=>"Décembre");
		
		if($start)
		{
			$nameday = $daylist[$exposure->date_start->format("w")];
			$day = $exposure->date_start->format("d");
			$month = $monthlist[$exposure->date_start->format("n")];
			$year = $exposure->date_start->format("Y");
		}
		else
		{
			$nameday = $daylist[$exposure->date_end->format("w")];
			$day = $exposure->date_end->format("d");
			$month = $monthlist[$exposure->date_end->format("n")];
			$year = $exposure->date_end->format("Y");
		}
		
		return $nameday." ".$day." ".$month." ".$year;
		
		
	}
	public function booking($param)
	{
		if(empty($_SESSION['logged_in']) || $_SESSION['logged_in'] != true)
		{
			echo $this->twig->render($this->className.'/booking.php',
					["title" => "Réservation",
					"breadcrumb" => "",
					"root" => $this->root,
					"error" => true,
					"errormessage"=> "Votre session a expirée veuillez vous reconnecter.",
					"reconnect" => true,
					
				
					]
				);
		}		
		else if(filter_var($param["id"], FILTER_VALIDATE_INT))
		{	
			$mapper = spot()->mapper('Model\User');
			$user = $mapper->where(['id' =>  $_SESSION["user"]["id"]])->first();
			$mapper = spot()->mapper('Model\Exposure');
			$book = $mapper->where(['id' =>  $param["id"]])->first();
			$mapper = spot()->mapper('Model\Media');
			// Where can be called directly from the mapper
			$posts = $mapper->all()->where(['id_exposure !=' => null]);
			$list_media = null;
		
			foreach( $posts as $key=>$value)
			{
				$list_media[$value->id] = array(
						
						"path_large" => $value->path_large,
						"path_mid" => $value->path_mid,
						"path_thumb" => $value->path_thumb,
						"id_exposure" =>$value->id_exposure,
						"default_img" =>$value->default_img
						
					);
			}
			if($book != false)
			{
				if($user != false)
				{
					echo $this->twig->render($this->className.'/booking.php',
					["title" => "Réservation",
					"breadcrumb" => "",
					"root" => $this->root,
					"exposure"=>$book,
					"media" => $list_media,
					"user" => $user,
					"error" => false,
					"start" => $this->translate_date($book,true),
					"end" => $this->translate_date($book,false)
					]
					);
				}
				else
				{
					echo $this->twig->render($this->className.'/booking.php',
					["title" => "Réservation",
					"breadcrumb" => "",
					"root" => $this->root,
					"error_message"=> "L'id de l'utilsateur n'est pas renseigné.",
					"error" => true,
				
					]
				);
				}
				
			}
			else
			{
				echo $this->twig->render($this->className.'/booking.php',
					["title" => "Réservation",
					"breadcrumb" => "",
					"root" => $this->root,
					"error_message"=> "cette réservation n'existe pas dans le bas de données",
					"error" => true,
				
					]
				);
			}
		}
		else
		{
			echo $this->twig->render("error/error_404.php",
				["title" => "error",
				"breadcrumb" => "",
				"root" => $this->root,
				
				
				]
			);
		}
	}
}
?>