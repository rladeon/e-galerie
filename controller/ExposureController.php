<?php

namespace Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
			"connected" => $this->utils->isloggedin(),
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
			"alreadybooked" => $this->alreadybooked($book->id),
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
	public function confirmreservation($param)
	{
		
		if(empty($_SESSION['logged_in']) || $_SESSION['logged_in'] != true)
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
				
				$mapper->update($book);
				/*****Unlock ici merci bien ****/
			}
			else
			{
				$book->notfullback = 0;
				
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
				
				$mail->addAddress($user->email, $user->name." ".$user->firstname);
				$mail->Subject = utf8_encode("confirmation de réservation");
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
				}
				else 
				{
					echo json_encode(array("result"=>'success'));
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
		if(!empty($_SESSION["user"]["id"]))
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
				echo json_encode(array("result"=>'success'));
				
			}
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La réservation n'a pas été annulée, car il manque l'id de l'utilisateur."));
				die();
		}
	}
}
?>