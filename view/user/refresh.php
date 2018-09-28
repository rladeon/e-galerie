{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>

<div >
	<!--<h2>Mise à jour de mes informations</h2>-->
	{% if connected == true %}
	<p>Bienvenue {{name}} {{firstname}}</p>
			<div class="loader" style="display:none"></div>

	<div  class="row">
		<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
		</div>
		<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
 		</div>
		<div class="col-md-8">
			<form role="form" method="post" id="user_refresh">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Pseudo *</label>
							<input type="text" class="form-control" name="pseudo" id="pseudo" value="{{pseudo}}"/>
						</div>
						<div class="form-group">
							<label class="control-label">Nom *</label>
							<input type="text" class="form-control" name="username" id="username" value="{{name}}"/>
						</div>
						<div class="form-group">
							<label class="control-label">Prénom *</label>
							<input type="text" class="form-control" name="firstname" id="firstname" value="{{firstname}}"/>
						</div>
						<div class="form-group">
							<label class="control-label">Adresse e-mail *</label>
							<input type="text" class="form-control" name="email" id="email" value="{{email}}"/>
						</div>
						<input type="hidden" name="userid" id="userid" value="{{id}}">
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<div><label class="control-label">Adresse</label></div>
							<textarea name="address" rows="5" cols="35">
							{{address}}
							</textarea>
						</div>
						<div class="form-group">
							<label class="control-label">Code postal</label>
							<input type="text" class="form-control" name="zipcode" id="zipcode" value="{{zipcode}}"/>
						</div>
						<div class="form-group">
							<label class="control-label">Commune</label>
							<input type="text" class="form-control" name="city" id="city" value="{{city}}"/>
						</div>
						
						
						
					</div>
					<div class="col-md-4">
					<div class="form-group">
							<label class="control-label">Tél principal</label>
							<input type="text" class="form-control" name="tel1" id="tel1" value="{{tel1}}"/>
						</div>
					<div class="form-group">
							<label class="control-label">Tél secondaire</label>
							<input type="text" class="form-control" name="tel2" id="tel2" value="{{tel2}}"/>
						</div>
						<div class="form-group">
							<label class="control-label">Pays</label>
							<select name="country" id="country">
							{% for value in country %}
								{% if landofsalty == value.alpha2 %}
								<option value="{{value.alpha2}}" selected>{{value.nom_fr_fr}}</option>
									{% else %}
								<option value="{{value.alpha2}}">{{value.nom_fr_fr}}</option>
									{% endif %}
								{% endfor %}
							</select>
						</div>
						<div class="form-group">
							<label class="control-label">Genre</label>
							<label class="radio-inline">
							{% if gender == 1 %}
									<input type="radio" name="gender" id="Radios1" value="1" checked>
							{% else %}
								<input type="radio" name="gender" id="Radios1" value="1" >
							{% endif %}
									Femme
								 
								  </label>
								 
								  <label class="radio-inline">
								 {% if gender == 2 %}
									<input type="radio" name="gender" id="Radios2" value="2" checked>
							{% else %}
								<input type="radio" name="gender" id="Radios2" value="2" >
							{% endif %}
									
								 
									Homme
								 
								  </label>
								 
								  
 
						</div>
						
						
					</div>
				</div>
				<button type="submit" class="bttn"  id="btnUserRefresh">Envoyer →</button>
			</form>
		</div>
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