{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
	<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
	<!--<h2>Contact </h2>-->
	
	<div class="row">
		<div class="col-md-5 ">
			
			<div id="contactform">
			<div id="success_message" class="alert alert-success alert-dismissible" style="display: none" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
</div>
<div id="error_message" class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  
</div>
			<form role="form" method="post" id="reused_form"   >
				<div class="form-group">
					<label for="name">
						Nom:</label>
					<input type="text" class="form-control"
					id="name" name="name"  required maxlength="50">

				</div>
				<div class="form-group">
					<label for="email">
						Email:</label>
					<input type="email" class="form-control"
					id="email" name="email" required maxlength="50">
				</div>
				<div class="form-group">
					<label for="subject">
						Sujet:</label>
					<input type="subject" class="form-control"
					id="subject" name="subject" required maxlength="80">
				</div>
				<div class="form-group">
					<label for="name">
						Message:</label>
					<textarea class="form-control" type="textarea" name="message"
					id="message" placeholder="Your Message Here" required 
					maxlength="6000" rows="7"></textarea>
				</div>
				<div class="row" style="margin-bottom:30px;">
					  <div class="col-sm-5">
					  <!-- Notre boite de vérification pour un serveur localhost
						Site key: 6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI
						Secret key: 6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
					  
					  -->
							  <div class="g-recaptcha" 
							  data-sitekey="6Leg3nwUAAAAAOcFpKcmgWE7h0tcGVFI_p0Uz6kg">
							  </div>
						</div>
				</div>

				<p>
					<button type="submit" class="bttn"  id="btnContactUs">Envoyer →</button>
				</p>
			</form>
			</div>
			
		</div>
		<div class="col-md-6 ">
		<div>
		<i class="fa fa-home" style="font-size:48px;color:#B13C2E"></i><p>&nbsp;Rue De Rivoli, Paris 75001</p> 
		</div>
		<div>
		<i class="fa fa-phone-square" style="font-size:48px;color:#B13C2E"></i><p>&nbsp;Tel: 08 99 23 76 48</p>
		</div>
		<div>
			 <span class="glyphicon glyphicon-time" style="font-size:48px;color:#B13C2E"></span>
			 <p>&nbsp;Horaires d'ouverture du Musée du Louvre :
					tous les jours de 9h à 18h, sauf le mardi et les jours fériés suivants : le 1er janvier, le 1er mai, le 11 novembre et le 25 décembre.
					Fermeture exceptionnelle du musée et des expositions temporaires à 17h les mercredis 24 et 31 décembre.
					Nocturnes jusqu'à 22h les mercredi et vendredi
					Le musée du Louvre est gratuit le premier dimanche de chaque mois.
			</p>
		</div>
				
		</div>
	</div>
</div>
{% endblock %}