{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
<div  class="row">
		<div class="loader" style="display:none"></div>

		<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
		</div>
		<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
 		</div>
		<span>Les champs avec une * doivent être obligatoirement renseigner.</span>
		<div class="col-md-8">
			<form role="form" method="post" id="user_newaccount">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Pseudo *</label>
							<input type="text" class="form-control" name="pseudo" id="pseudo" value=""/>
						</div>
						<div class="form-group">
							<label class="control-label">Nom *</label>
							<input type="text" class="form-control" name="username" id="username" value=""/>
						</div>
						<div class="form-group">
							<label class="control-label">Prénom *</label>
							<input type="text" class="form-control" name="firstname" id="firstname" value=""/>
						</div>
						
					</div>
					<div class="col-md-4">
					<div class="form-group">
							<label class="control-label">Adresse e-mail *</label>
							<input type="text" class="form-control" name="email" id="email" value=""/>
						</div>
						<div class="form-group">
							<div><label class="control-label">Mot de passe *</label></div>
							<input type="password" class="form-control" name="password" id="password" value=""/>

						</div>
						<div class="form-group">
							<label class="control-label">Confirmation du mot de passe *</label>
							<input type="password" class="form-control" name="passwordmirror" id="passwordmirror" value=""/>
						</div>						
						
					</div>
					<div class="col-md-4">
					<div class="form-group">
							<label class="control-label">Tél principal *</label>
							<input type="text" class="form-control" name="tel1" id="tel1" value=""/>
						</div>
					<div class="form-group">
							<label class="control-label">Pays</label>
							<select name="country" id="country" class="form-control">
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
				<button type="submit" class="bttn"  id="btnNewAccount">Envoyer →</button>
			</form>
		</div>
	</div>
</div>
{% endblock %}