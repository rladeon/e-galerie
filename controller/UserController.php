<?php

namespace Controller;

use Model\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }
	/*public function createadmin()
    {
      
      $userMapper = spot()->mapper('Model\User');
      $userMapper->migrate();
	  
	  $sPwd = '*******************';
	  $hash = password_hash($sPwd , PASSWORD_BCRYPT, array('cost' => 14));
      $myNewUser = $userMapper->create([
	    'pseudo' => 'admin',
        'name'      => "ladeon",
		'firstname' => 'rudi',
        'email'     => '**************',
        'password'  => $sPwd,
		'hash' => $hash,
		'admin' => true
      ]);
      echo "A new user has been created: " . $myNewUser->name;
    }*/

    public function getalluser()
    {
      $userMapper = spot()->mapper('Model\User');
      $userMapper->migrate();
      $userList = $userMapper->all();
      echo "List: <br />";
      foreach ($userList as $user) {
        echo $user->name . "<br />";
      }
      echo "---";
    }
	public function login()
	{
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Connection"=> "user/login"),$net->home_url);
		echo $this->twig->render($this->className.'/login.php',
			["title" => "Login",
			"breadcrumb" => $breadcrumb,
			"root" => $this->root,
			
			
			]
		);
	}
	
	public function update_session_params($user)
	{
		$_SESSION['logged_in'] = true;
		$_SESSION['user'] = array("id"=>$user->id, "is_admin"=>$user->admin, 
			"name"=>$user->name, "firstname"=>$user->firstname);
		$_SESSION['ip'] = $this->utils->allIPs();
		$_SESSION['expires_on']=time()+$this->utils->inactivity(); 
		$_SESSION['uid'] = sha1(uniqid('',true).'_'.mt_rand());
	}
	public function verify($param=null)
	{
		 if(empty($_POST["username"]))
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il faut renseigner l'identifiant."));
				die();
		}
		else if(empty($_POST["password"]))
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il faut renseigner le mot de passe."));
				die();
		}
		else
		{
			$mapper = spot()->mapper('Model\User');
			$user = $mapper->where(['pseudo' => filter_var($_POST["username"], FILTER_SANITIZE_STRING) ])->first();
			
			if($user == false)
			{
				echo json_encode(array("result"=>'error', 
					"errors"=>"L'identifiant: ".$_POST["username"]." n'existe pas dans la base de données."));
					die();
			}
			else if($param != null && $param["access"]== "admin")
			{
				if (password_verify($_POST["password"], $user->hash) )
				{
					if($user->admin != true)
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"Désolé la partie administration est réservé aux utilisateurs ayant le statut admin."));
						die();
					}
					else if($user->admin == true)
					{
						$this->update_session_params($user);
						echo json_encode(array("result"=>'success', 
						"message"=>"OK"));
						die();
					}
					else
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"Erreur inexplicable ;-; "));
						die();
					}
				}
				else
				{
					echo json_encode(array("result"=>'error', 
					"errors"=>"Le mot de passe est incorrect!"));
					die();
				}
			}
			else if (password_verify($_POST["password"], $user->hash))
			{
				$this->update_session_params($user);
				echo json_encode(array("result"=>'success', 
				"message"=>"OK"));
				die();
			} 
			else
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"Le mot de passe est incorrect!"));
				die();
			}
		}
	}
	public function logout()
	{
		session_destroy();
		header('HTTP/1.0 302');
		header("Location: ". $this->root. "user/login"); 
	}
	public function reset_password()
	{
		
	}
	public function account()
	{
		if($this->utils->isloggedin() && !empty($_SESSION["user"]["id"]))
		{
			$mapper = spot()->mapper('Model\User');
			$user = $mapper->where(["id"=>$_SESSION["user"]["id"]])->first();
			if($user)
			{
				$welcome = "Bienvenue ".$user->name.' '.$user->firstname;
			}
			else
			{
				$welcome = "";
			}
		}
		else
		{
			$welcome = "";
		}
		
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Mon compte"=> "user/account"),$net->home_url);
			echo $this->twig->render($this->className.'/account.php',
			["title" => "Compte",
			"breadcrumb" => $breadcrumb,
			"root" => $this->root,
			"welcome" => $welcome,
			
			]
			);
		
	}
	public function reservation()
	{
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Mon compte"=> "user/account","liste réservation"=> "user/reservation"),$net->home_url);
		if($this->utils->isloggedin() && !empty($_SESSION["user"]["id"]))
		{
			$user_id = $_SESSION["user"]["id"];
		
			$reservation = spot()->mapper('Model\Reservation');
			$rzr = $reservation->where([ "id_user"=> $user_id]);
			$exposure = spot()->mapper('Model\Exposure');
			$expo = $exposure->all();
			foreach( $rzr as $key=>$value)
			{
				$list[$value->id_exposure] = array(
						"id"=>$value->id,
						"id_exposure" => $value->id_exposure
						
					);
			}
			$list_expo = null;
			
			foreach( $expo as $key=>$value)
			{
				if(!empty($list[$value->id]))
				{
					$list_expo[$value->id] = array(
						"id_reservation" => $list[$value->id]["id"],
						"title" => $value->title,
						"start" => $value->date_start->format("d/m/Y"),
						"end" => $value->date_end->format("d/m/Y"),
						
					);
				}
			}
		}
		else
		{
			$list_expo = null;
		}	
			echo $this->twig->render($this->className.'/reservation.php',
				["title" => "reservation",
				"breadcrumb" => $breadcrumb,
				"root" => $this->root,			
				"reservation" => $list_expo,
			
			]
			);
		
	}
	public function refresh()
	{
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Mon compte"=> "user/account","Mise à jour de mes informations"=> "user/refresh"),$net->home_url);
		if($this->utils->isloggedin() && !empty($_SESSION["user"]["id"]))
		{
			$user_id = $_SESSION["user"]["id"];
			$user = spot()->mapper('Model\User');
			$user = $user->where([ "id"=> $user_id])->first();
			$c = spot()->mapper('Model\Country');
			$countries = $c->all();
			$country = null;
			foreach($countries as $key => $value)
			{
				$country[$value->id] = array(
				"nom_fr_fr" => utf8_encode($value->nom_fr_fr),
				"id" => $value->id,
				"alpha2" => $value->alpha2,
				);
			}
			
			if($user)
			{
				
				echo $this->twig->render($this->className.'/refresh.php',
					["title" => "refresh",
					"breadcrumb" => $breadcrumb,
					"root" => $this->root,
					"connected" => true,
					"welcome" => $user->name.' '.$user->firstname,
					"name" => $user->name,
					"firstname" => $user->firstname,
					"email" => $user->email,
					"pseudo" => $user->pseudo,
					"id"=> $user->id,
					"error" => false,
					"gender" => $user->gender,
					"tel1"=> $user->tel1,
					"tel2"=> $user->tel2,
					"country" => $country,
					"landofsalty" => $user->country,
					"address" => $user->address,
					"zipcode" => $user->zipcode,
					"city" => $user->city,
					
				]
				);
			}
			else
			{
				echo $this->twig->render($this->className.'/refresh.php',
					["title" => "refresh",
					"breadcrumb" => $breadcrumb,
					"root" => $this->root,	
					"connected" => true,					
					"error" => true,
					"message" =>"L'utilisateur n'existe pas.",
				]
				);				
			}
		}
		else
		{
			echo $this->twig->render($this->className.'/refresh.php',
					["title" => "refresh",
					"breadcrumb" => $breadcrumb,
					"root" => $this->root,	
					"connected" => false,					
				]
				);
		}
	}
	public function update()
	{
		
		$this->session->start();
		if(!$this->utils->isloggedin())
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		else if(empty($_POST["pseudo"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque le pseudo."));
				die();
		}
		else if(empty($_POST["username"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque le nom."));
				die();
		}
		else if(empty($_POST["firstname"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque le prénom."));
				die();
		}
		else if(empty($_POST["email"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque l'adresse e-mail."));
				die();
		}
		else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) 
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Cette adresse e-mail n'est pas valide."));
				die();
		}
		else if(empty($_POST["userid"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque l'id utilisateur."));
				die();
		}
		else if (filter_var($_POST["userid"], FILTER_VALIDATE_INT) === false) 
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"L'id n'est pas un entier."));
				die();
		}
		else		
		{
			
			$pseudo = filter_var($_POST["pseudo"], FILTER_SANITIZE_STRING);
			$userm = spot()->mapper('Model\User');
			$userm->migrate();
			$user = $userm->where([ "pseudo"=> $pseudo])->first();
			$id = filter_var($_POST["userid"], FILTER_SANITIZE_NUMBER_INT);
			if($user == false)
			{
				$user = $userm->where([ "id"=> $id ])->first();
				$user->pseudo = $pseudo;
				$userm->update($user);
			}
			$user = $userm->where([ "email"=> $_POST["email"]])->first();
			if($user == false)
			{
				$user = $userm->where([ "id"=> $id])->first();
				$user->email = $_POST["email"];
				$userm->update($user);
			}
			
			$name = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
			$firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
			$address = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
			$zipcode = filter_var($_POST["zipcode"], FILTER_SANITIZE_STRING);
			$city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
			$tel1 = filter_var($_POST["tel1"], FILTER_SANITIZE_STRING);
			$tel2 = filter_var($_POST["tel2"], FILTER_SANITIZE_STRING);
			$country = filter_var($_POST["country"], FILTER_SANITIZE_STRING);
			$gender = filter_var($_POST["gender"], FILTER_SANITIZE_NUMBER_INT);
			$user = $userm->where([ "id"=> $id ])->first();
			$user->name = $name;
			$user->firstname = $firstname;
			$user->address = $address;
			$user->zipcode = $zipcode;
			$user->city = $city;
			$user->tel1 = $tel1;
			$user->tel2 = $tel2;
			$user->country = $country;
			$user->gender = $gender;
			$userm->update($user);
			
			$_SESSION['user']["name"] = $name;
			$_SESSION['user']["firstname"] = $firstname;
			
			echo json_encode(array("result"=>'success', 
				"message"=>"Les données ont été mises à jour."));
				die();
		}
	}
	public function forget()
	{
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Mon compte"=> "user/account","Mot de passe oublié"=> "user/forget"),$net->home_url);
		if($this->utils->isloggedin() && !empty($_SESSION["user"]["id"]))
		{
			echo $this->twig->render($this->className.'/forget.php',
					["title" => "Mot de passe",
					"breadcrumb" => $breadcrumb,
					"root" => $this->root,	
					"connected" => true,					
				]
				);
		}		
		else
		{
			echo $this->twig->render($this->className.'/forget.php',
					["title" => "Mot de passe",
					"breadcrumb" => $breadcrumb,
					"root" => $this->root,	
					"connected" => false,					
				]
				);
		}
	}
	public function sendpassword()
	{
		$this->session->start();
		if($this->utils->isloggedin() == false)
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		else if(empty($_POST["email"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque l'adresse e-mail."));
				die();
		}
		else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) 
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Cette adresse e-mail n'est pas valide."));
				die();
		}
		else
		{
			$userm = spot()->mapper('Model\User');
			$userm->migrate();
			$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
			$user = $userm->where([ "email"=> $email])->first();
			if($user)
			{
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = $this->mailconfig["Host"];
				$mail->Port = $this->mailconfig["Port"];
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = true;
				$mail->Username = $this->mailconfig["Username"];
				$mail->Password = $this->mailconfig["Password"];
				$mail->setFrom($this->mailconfig["Username"], "support");
				$mail->CharSet = 'UTF-8';
				$mail->addAddress($user->email, $user->name." ".$user->firstname);
				$mail->addBCC($this->mailconfig["Username"]);
				$mail->Subject = "Information";
				$mail->isHTML(true); 
				$message ="<p>Bonjour</p>";
				$message .= "<p>Pour vous connecter vous aviez choisi pour identifiant: ".$user->pseudo."</p>"; 
				$message .="Et le mot de passe suivant: ".$user->password." </p>";
				$mail->Body = '<p>'.$message.'</p>';
				$mail->AltBody = $message;
				
				if (!$mail->send()) 
				{
					echo json_encode(array("result"=>'error', "errors"=>$mail->ErrorInfo));		
					die();					
				}
				else 
				{
					echo json_encode(array("result"=>'success', "message"=> "votre mot de passe a été envoyé à l'adresse: ".$user->email));
					die();
				}
				
				
			}
			else
			{
					echo json_encode(array("result"=>'error', 
				"errors"=>"Cette adresse e-mail n'existe pas dans la base de données."));
				die();
			}
			
			
		}
	}
	
}
?>