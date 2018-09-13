<?php

namespace Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
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
	public function handler()
	{
		// Check for empty fields
		if(empty($_POST['name']))
		{
			echo json_encode(array("result"=>'form', 
				"errors"=>"Il faut renseigner le nom."));
				die();
		}
		else if(empty($_POST['email']))
		{
			echo json_encode(array("result"=>'form', 
				"errors"=>"Il faut renseigner l'e-mail."));
				die();
		}
		else if(empty($_POST['subject']))
		{
			echo json_encode(array("result"=>'form', 
				"errors"=>"Il faut renseigner le sujet."));
				die();
		}
		else if(empty($_POST['message']))
		{
			echo json_encode(array("result"=>'form', 
				"errors"=>"Il faut renseigner le message."));
				die();
		}
		else if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
		{
			echo json_encode(array("result"=>'form', 
				"errors"=>"Il faut renseigner une adresse e-mail valide."));
				die();
		}
		
    	
			// Ma clé privée pour un serveur localhost
			$secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
			// Paramètre renvoyé par le recaptcha
			$response = $_POST['g-recaptcha-response'];
			if(empty($response))
			{
				echo json_encode(array("result"=>'captcha', 
				"errors"=>"Il faut cliquer sur la case je ne suis pas un robot svp"));
				die();
			}
			// On récupère l'IP de l'utilisateur
			$remoteip = $_SERVER['REMOTE_ADDR'];
			
			$api_url = "https://www.google.com/recaptcha/api/siteverify?secret=" 
				. $secret
				. "&response=" . $response
				. "&remoteip=" . $remoteip ;
			
			$decode = json_decode(file_get_contents($api_url), true);
			
			if ($decode['success'] == true) {
				// C'est un humain
			}
			
			else {
				// C'est un robot ou le code de vérification est incorrecte
				echo json_encode(array("result"=>'captcha', 
				"errors"=>"C'est un robot ou le code de vérification est incorrecte"));
				die();
			}
				
		
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 2;
		$mail->Host = 'smtp.orange.fr';
		/*$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->Username = 'email';
		$mail->Password = 'EMAIL_ACCOUNT_PASSWORD';*/
		$mail->setFrom('rladeon@gmail.com', 'Devops');
		
		$mail->addAddress($_POST['email'], $_POST['name']);
		$mail->Subject = $_POST['subject'];
		$mail->isHTML(true); 
		$mail->Body = '<p>'.$_POST['message'].'</p>';
		$mail->AltBody = $_POST['message'];

		/*if (!$mail->send()) {
			echo json_encode(array("result"=>'error', "errors"=>$mail->ErrorInfo));
		} else {
			echo json_encode(array("result"=>'success'));
			
		}*/
		die();
	}
}
?>