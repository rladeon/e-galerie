{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
	<h2>Mise à jour de mes informations</h2>
	{% if connected == true %}
	<p>Bienvenue {{name}} {{firstname}}</p>
			<div class="loader" style="display:none"></div>

	<div class="row">
		<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
		</div>
		<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
 		</div>
		<div class="col-md-4">
			<form role="form" method="post" id="user_refresh"   >
				<div class="form-group">
					<label class="control-label">Pseudo</label>
					<input type="text" class="form-control" name="pseudo" id="pseudo" value="{{pseudo}}"/>
				</div>
				<div class="form-group">
					<label class="control-label">Nom</label>
					<input type="text" class="form-control" name="username" id="username" value="{{name}}"/>
				</div>
				<div class="form-group">
					<label class="control-label">Prénom</label>
					<input type="text" class="form-control" name="firstname" id="firstname" value="{{firstname}}"/>
				</div>
				<div class="form-group">
					<label class="control-label">Adresse e-mail</label>
					<input type="text" class="form-control" name="email" id="email" value="{{email}}"/>
				</div>
				<input type="hidden" name="userid" id="userid" value="{{id}}">
				<button type="submit" class="bttn"  id="btnUserRefresh">Envoyer →</button>
			</form>
		</div>
	</div>
	{% elseif error == true %}
		<p> {{message}}</p>
	{% else %}
	<div class="row">
			<div class="col-md-4">
			<p>Il faut se connecter pour avoir accès à cet espace</p>
			</div>
			<div class="col-md-4">
			<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
			</div>
		</div>	
	{% endif %}
</div>
{% endblock %}