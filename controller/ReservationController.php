<?php

namespace Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Controller\ExposureController;
class ReservationController extends Controller
{
	public function delete($param)
	{
		
		if(!$this->utils->isloggedin())
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"La session a expirée."));
				die();
		}
		
		$reservation = spot()->mapper('Model\Reservation');
			$reservation->migrate();	
			$rzr = $reservation->where([ "id"=> $param["id"] ])->first();
			$id_exposure = $rzr->id_exposure;
			$id_user = $rzr->id_user;
			$reservation->delete([ "id"=> $param["id"] ]);
			$rzr = $reservation->where([ "id"=> $param["id"] ])->first();
			if($rzr)
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"La réservation n'a pas été annulée."));
				die();
				
			}
			else
			{
				$mapper = spot()->mapper('Model\Exposure');
				$expo = $mapper->where([ "id"=> $id_exposure ])->first();
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
				$mail->Subject = "confirmation d'annulation de la réservation";
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
				}
				else 
				{
					echo json_encode(array("result"=>'success'));
				}
			}
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
}
?>