<?php

namespace Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class ExposureController extends Controller
{
	public function index()
	{
		$mapper = spot()->mapper('Model\Exposure');
		$book = $mapper->where(['notfullback !=' => false, 'date_start >' => \DateTime::createFromFormat('Y-m-d', date('Y-m-d') )->format("Y-m-d")])
		->order(['date_start'=>"ASC"])
		->first();
		$list = null;
		if($book != false)
		{
			$c = spot()->mapper('Model\Country');
			$fullcountry = $c->where(["alpha2"=>$book->country])->first();
			
			$list = array(
				"id"=> $book->id,
				"title" => $book->title,
				"resume"=> $book->resume,
				"notfullback" => $book->notfullback,
				"date_deb" => $book->date_start->format("d/m/Y"),
				"date_end" => $book->date_end->format("d/m/Y"),
				"nb_place" => $book->nb_place,
				"booked" => $book->booked,
				"connected" => $this->utils->isloggedin(),
				"jours" => $book->date_start->format("d/m/Y"),
				"horaires" => $book->hours,
				"infos"=> $book->description,
				"availability" => $this->availability($book->nb_place, $book->booked),
				"address" => $book->address,
				"zipcode" => $book->zipcode,
				"city" => $book->city,
				"country" => $fullcountry->nom_fr_fr,
				"category" => $book->category,
				"tel1" => $book->tel1,
				"email" => $book->email,
				"date" => $this->translate_date($book),
				
			);
			$mapper = spot()->mapper('Model\Invite');
			// Where can be called directly from the mapper
			$invites = $mapper->where(['id_exposure' => $book->id]);
			$list_invite = null;
			
			foreach( $invites as $key=>$value)
			{
				$list_invite[$value->id] = array(
						
						"path" => $value->path,
						"title" => $value->title,
						"id_exposure" =>$value->id_exposure,
						"id" => $value->id,
						
					);
			}
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
					"default_img" =>$value->default_img,
					"archiver" => $value->archiver,
					
				);
		}
		
		$mapper = spot()->mapper('Model\Archiver');
		// Where can be called directly from the mapper
		$posts = $mapper->all();
		$list_all_archiver = null;
		
		foreach( $posts as $key=>$value)
		{
			$list_all_archiver[$value->year_expo] = array(
					
					"id" => $value->id,
					"id_exposure" => $value->id_exposure,
					"resume" => $value->resume,
					"year_expo" => $value->year_expo,	
				);
		}
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Expositions"=> "exposure/index"),$net->home_url);
		$mapper = spot()->mapper('Model\Exposure');
		
		$outdated = $mapper->all()->where(['date_start <' => \DateTime::createFromFormat('Y-m-d', date('Y-m-d') )->format("Y-m-d")])
		->order(['date_start'=>"ASC"]);
		$list_archiver = null;
		
		foreach( $outdated as $key=>$value)
		{
			if(!empty($list_all_archiver[(int)$value->date_start->format("Y")]))
			{				
				$list_archiver[$value->date_start->format("Y")][] = array(
					
					"title" => $value->title,
					"slug" => $value->slug,
					"id_exposure" => $value->id,					
					
				);
			}
		}
		//var_dump($list_archiver);
		if(empty($list))
		{
			$message = "Il n'y a pas d'exposition de prévu";
			echo $this->twig->render($this->className.'/index.php',
				["title" => "Expositions",
				"breadcrumb" => $breadcrumb,
				"root" => $this->root,
				"main"=>$list,
				"message" => $message,
				"getarchiver" => $list_archiver,
				]
			);
		}
		else
		{
			echo $this->twig->render($this->className.'/index.php',
				["title" => "Expositions",
				"breadcrumb" => $breadcrumb,
				"root" => $this->root,
				"main"=>$list,
				"media" => $list_media,
				"invite" => $list_invite,
				"alreadybooked" => $this->alreadybooked($book->id),
				"getarchiver" => $list_archiver,
				]
			);
		}
	}
	public function create()
	{
		if($this->utils->isadmin())
		{
			$userMapper = spot()->mapper('Model\Exposure');
			$userMapper->migrate();	  
			if(empty($_POST["date_start"]))
			{
				$date_start = null;
			}
			else
			{
				$date_start = \DateTime::createFromFormat('d/m/Y', $_POST["date_start"]);
			}
			if(empty($_POST["date_end"]))
			{
				$date_end = null;
			}
			else
			{
				$date_end = \DateTime::createFromFormat('d/m/Y', $_POST["date_end"]);
			}
			$title = $_POST["title"];
			$hours = $_POST["hours"];
			$category = empty($_POST["category"])?null:$_POST["category"];
			$resume = empty($_POST["resume"])?null:$_POST["resume"];
			$address = empty($_POST["address"])?null:$_POST["address"];
			$zipcode = empty($_POST["zipcode"])?null:$_POST["zipcode"];
			$city = empty($_POST["city"])?null:$_POST["city"];
			$country = empty($_POST["country"])?null:$_POST["country"];
			$published = empty($_POST["published"])?false:$_POST["published"];
			$tel1 = empty($_POST["tel1"])?null:$_POST["tel1"];
			$nb_place = empty($_POST["nb_place"])?0:$_POST["nb_place"];


			$description = $_POST["description"];
			
			$myNewExpo = $userMapper->insert([
			'title'      => $title,
			'slug'      => $this->seo->slugify($title),
			'category'      => $category,
			'date_start'     => $date_start,
			'date_end'     => $date_end,
			'published'     => false,
			'description'  => $description,
			'resume'  => $resume,
			'hours' => $hours,
			'nb_place'     => $nb_place,
			'booked' => 0,
			'notfullback' => true,
			'timestamp' => time(),
			"tel1" => $tel1,
			"address" => $address,
			"zipcode" => $zipcode,
			"city" => $city,
			"country" => $country,
			
			]);
		 
		  if($myNewExpo == false)
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"L'exposition n'a pas été ajouté."));
				die();
			}
			else
			{
				echo json_encode(array("result"=>'success', 
					"message"=>"L'exposition a été ajouté."));
					die();
			}
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Vous n'êtes pas connecté."));
				die();
		}
	}
	public function update($param)
	{
		if($this->utils->isadmin())
		{
			$userMapper = spot()->mapper('Model\Exposure');
			$userMapper->migrate();	  
			if(empty($_POST["date_start"]))
			{
				$date_start = null;
			}
			else
			{
				$date_start = \DateTime::createFromFormat('d/m/Y', $_POST["date_start"]);
			}
			if(empty($_POST["date_end"]))
			{
				$date_end = null;
			}
			else
			{
				$date_end = \DateTime::createFromFormat('d/m/Y', $_POST["date_end"]);
			}
			$title = $_POST["title"];
			$hours = $_POST["hours"];
			$category = empty($_POST["category"])?null:$_POST["category"];
			$resume = empty($_POST["resume"])?null:$_POST["resume"];
			$address = empty($_POST["address"])?null:$_POST["address"];
			$zipcode = empty($_POST["zipcode"])?null:$_POST["zipcode"];
			$city = empty($_POST["city"])?null:$_POST["city"];
			$country = empty($_POST["country"])?null:$_POST["country"];
			$published = empty($_POST["published"])?false:$_POST["published"];
			$tel1 = empty($_POST["tel1"])?null:$_POST["tel1"];
			$nb_place = empty($_POST["nb_place"])?0:$_POST["nb_place"];
			$email = empty($_POST["email"])?null:$_POST["email"];

			$description = $_POST["description"];
			
			$book = spot()->mapper('Model\Exposure');
			$book->migrate();	  
			$b = $book->where(["id"=>$param["id"]])->first();		
			if($b == false)
			{
				 echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de cette exposition n'existe pas dans la base données."));
				die();
			}
			else
			{
				$nb_place = ( $nb_place > 0 ) ?$nb_place:$b->nb_place; 
				$b->title = $title;
				$b->slug = $this->seo->slugify($title);
				$b->category = $category;
				$b->date_start = $date_start;
				$b->date_end = $date_end;
				$b->published = false;
				$b->description = $description;
				$b->resume = $resume;
				$b->hours = $hours;
				$b->nb_place = ($nb_place >= $b->booked)?$nb_place:$b->nb_place;
				$b->email = $email;
				$b->timestamp = time();
				$b->tel1 = $tel1;
				$b->address = $address;
				$b->zipcode = $zipcode;
				$b->city = $city;
				$b->country = $country;
				$b->notfullback = ( $b->nb_place > $b->booked )? true : false;
				$myNewBook = $book->update($b);
				
			}			
		 
			 if($myNewBook == false)
			 {
				 echo json_encode(array("result"=>'error', 
				"errors"=>"L'exposition n'a pas été mis à jour."));
				die();
			 }
			 else
			 {
				echo json_encode(array("result"=>'success', 
					"message"=>"L'exposition a été mise à jour."));
					die();
			 }
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Vous n'êtes pas connecté."));
				die();
		}
	}
	public function delete($param)
	{
		if($this->utils->isadmin())
		{
			$book = spot()->mapper('Model\Exposure');

			$b = $book->where(["id"=>$param["id"]])->first();		
			if($b == false)
			{
				 echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de cette exposition n'existe pas dans la base données."));
				die();
			}
			else
			{
				$myNewBook = $book->delete(["id"=>$param["id"]]);
				if($myNewBook == false)
				 {
					 echo json_encode(array("result"=>'error', 
					"errors"=>"Cette exposition n'a pas été supprimé."));
					die();
				 }
				 else
				 {
					echo json_encode(array("result"=>'success', 
						"message"=>"L'exposition a été supprimé."));
						die();
				 }
			}	
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Vous n'êtes pas connecté."));
				die();			
		}
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
		$daylist = array("0"=>"Dimanche", "1"=>"Lundi","2"=>"Mardi","3"=>"Mercredi",
		"4"=>"Jeudi", "5"=>"Vendredi","6"=>"Samedi");
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
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Expositions"=> "exposure/index", "Réservation"=>"exposure/booking/id/".filter_var($param["id"], FILTER_SANITIZE_NUMBER_INT)),$net->home_url);
		if(empty($_SESSION['logged_in']) || $_SESSION['logged_in'] != true)
		{
			echo $this->twig->render($this->className.'/booking.php',
					["title" => "Réservation",
					"breadcrumb" => $breadcrumb,
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
					"breadcrumb" => $breadcrumb,
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
					"breadcrumb" => $breadcrumb,
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
					"breadcrumb" => $breadcrumb,
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
	public function confirmreservation($param)
	{
		$this->session->start();
		if(!$this->utils->isloggedin())
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		else if(empty($_SESSION['logged_in']) || $_SESSION['logged_in'] != true)
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Votre session a expirée veuillez vous reconnecter."));
				die();
			
		}
		else if(empty($_SESSION["user"]["id"]))
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de l'utilisateur n'est pas renseigné."));
				die();
		}
		else
		{	
			$mapper = spot()->mapper('Model\User');
			$user = $mapper->where(['id' =>  $_SESSION["user"]["id"]])->first();
			/*****Placez un lock ici merci bien ****/
			$mapper = spot()->mapper('Model\Exposure');
			
			$book = $mapper->where(['id' =>  $param["id"]])->first();			
			
			if( $book->nb_place > 0 && ( $book->booked + 1 ) <= $book->nb_place )
			{
				$book->booked = $book->booked + 1;
				if( $book->nb_place == $book->booked)
				{
					$book->notfullback = false;
				}
				$mapper->update($book);
				/*****Unlock ici merci bien ****/
			}
			else
			{
				$book->notfullback = false;
				
				$mapper->update($book);
				/*****Unlock ici merci bien ****/
				echo json_encode(array("result"=>'fullback', 
				"errors"=>"il ne reste plus de place disponible pour cette exposition."));
				die();
			}
			
			if($user !=false)
			{
					
			  $reservation = spot()->mapper('Model\Reservation');
			  $rzr = $reservation->where(['id_exposure' =>  $param["id"], "id_user"=> $user->id])->first();
			  if($rzr == false)
			  {
					$reservation->migrate();
					$myNewReza = $reservation->create([
					'id_exposure' => $param["id"],
					'id_user'      => $user->id,
					
				  ]);
			  }
			  else
			  {
				  echo json_encode(array("result"=>'twice', 
				"errors"=>"Vous avez déjà réservé une place pour l'exposition."));
				die();
			  }
			  $mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = $this->mailconfig["Host"];
				$mail->Port = $this->mailconfig["Port"];
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = true;
				$mail->Username = $this->mailconfig["Username"];
				$mail->Password = $this->mailconfig["Password"];
				$mail->setFrom($this->mailconfig["Username"], "commerciale");
				$mail->CharSet = 'UTF-8';
				$mail->addAddress($user->email, $user->name." ".$user->firstname);
				$mail->addBCC($this->mailconfig["Username"]);
				$mail->Subject = "confirmation de réservation";
				$mail->isHTML(true); 
				$message ="<p>Bonjour</p>";
				$message .= "<p>Nous vous confirmons que votre demande de réservation 
				d'une place pour l'exposition du: ";
				$message .= $this->translate_date($book,$start=true);
				$message .=" a été enregistrée.</p>";
				$mail->Body = '<p>'.$message.'</p>';
				$mail->AltBody = $message;
				
				if (!$mail->send()) 
				{
					echo json_encode(array("result"=>'error', "errors"=>$mail->ErrorInfo));	
					die();					
				}
				else 
				{
					echo json_encode(array("result"=>'success'));
					die();
				}
				
			  
			}
			else
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de l'utilisateur n'existe pas dans la base de données."));
				die();
			}
			
		}
		
	}
	public function alreadybooked($id)
	{
		if(!empty($_SESSION["user"]["id"]))
		{			
			$reservation = spot()->mapper('Model\Reservation');
			$rzr = $reservation->where([ "id_user" => $_SESSION["user"]["id"],
			"id_exposure" => $id])->first();
			if($rzr)
			{
				return true;
			}
		}
		return false;
	}
	public function cancel($param)
	{
		$this->session->start();
		if(!$this->utils->isloggedin())
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		else if(!empty($_SESSION["user"]["id"]))
		{			
			$reservation = spot()->mapper('Model\Reservation');
			$reservation->migrate();	
			$reservation->delete([ "id_user"=> $_SESSION["user"]["id"],
			"id_exposure"=> $param["id"] ]);
			$rzr = $reservation->where([ "id_user"=> $_SESSION["user"]["id"],
			"id_exposure"=> $param["id"] ])->first();
			if($rzr)
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"La réservation n'a pas été annulée."));
				die();
				
			}
			else
			{
				$mapper = spot()->mapper('Model\Exposure');
				$expo = $mapper->where([ "id"=> $param["id"] ])->first();
				if( ( $expo->booked - 1 ) >=0 )
				{
					$expo->booked = $expo->booked - 1;
					if($expo->booked < $expo->nb_place)
					{
						$expo->notfullback = true;
					}
					$mapper->update($expo);
				}
				$mapper = spot()->mapper('Model\User');
				$user = $mapper->where([ "id"=> $_SESSION["user"]["id"] ])->first();
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = $this->mailconfig["Host"];
				$mail->Port = $this->mailconfig["Port"];
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = true;
				$mail->Username = $this->mailconfig["Username"];
				$mail->Password = $this->mailconfig["Password"];
				$mail->setFrom($this->mailconfig["Username"], "commerciale");
				$mail->CharSet = 'UTF-8';
				$mail->addAddress($user->email, $user->name." ".$user->firstname);
				$mail->addBCC($this->mailconfig["Username"]);
				$mail->Subject = "confirmation de l'annulation de la réservation";
				$mail->isHTML(true); 
				$message ="<p>Bonjour</p>";
				$message .= "<p>Nous vous confirmons que votre demande de réservation 
				d'une place pour l'exposition du: ";
				$message .= $this->translate_date($book,$start=true);
				$message .=" a bien été annulée.</p>";
				$mail->Body = '<p>'.$message.'</p>';
				$mail->AltBody = $message;
				
				if (!$mail->send()) 
				{
					echo json_encode(array("result"=>'error', "errors"=>$mail->ErrorInfo));
					die();		
				}
				else 
				{
					echo json_encode(array("result"=>'success'));
					die();
				}
								
			}
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La réservation n'a pas été annulée, car il manque l'id de l'utilisateur."));
				die();
		}
	}
	public function show($param)
	{	
		$slug = filter_var($param["archiver"], FILTER_SANITIZE_STRING);
		$mapper = spot()->mapper('Model\Exposure');
		$expo = $mapper->where(["slug" => $slug])->first();
		
		if($expo == false)
		{
			echo $this->twig->render("error/error_404.php",
				["title" => "error",
				"breadcrumb" => "",
				"root" => $this->root,
				
				]
			);
		
		}
		else
		{
			$mapper = spot()->mapper('Model\Archiver');
			$archive = $mapper->where(["id_exposure" => $expo->id])->first();
			$list = array(
				"resume"=> $archive->resume,
			);
			
			$mapper = spot()->mapper('Model\Media');
			// Where can be called directly from the mapper
			$posts = $mapper->all()->where(['id_exposure' => $expo->id, 'archiver' => 1]);
			$list_media = null;
			
			foreach( $posts as $key=>$value)
			{
				$list_media[$value->id] = array(
						
						"path_large" => $value->path_large,
						"path_mid" => $value->path_mid,
						"path_thumb" => $value->path_thumb,
						"id_exposure" =>$value->id_exposure,
							
					);
			}
		
			$mapper = spot()->mapper('Model\Network');
			$net = $mapper->all()->first();
			$breadcrumb = $this->utils->build_breadcrumb(array("Expositions" => "exposure/index",
			"Archive" => "exposure/show/archiver/".filter_var($param["archiver"], 
			FILTER_SANITIZE_STRING)), $net->home_url);
			echo $this->twig->render($this->className.'/show.php',
						["title" => "Ancienne exposition",
						"breadcrumb" => $breadcrumb,
						"root" => $this->root,
						"archive" => $list,
						"media" => $list_media,
						]
					);
		}
	}
}
?>