{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<h2>Envoie du mot de passe par e-mail</h2>
			<div class="loader" style="display:none"></div>

	<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
	</div>
	<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  
	</div>
	{% if (session.logged_in == null) or (session.logged_in == false) %}
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
		{% else %}
	<div class="row">
		<div class="col-md-5">
					<form role="form" method="post" id="forget_form"   >
						<div class="form-group">
							<label class="control-label">Adresse e-mail</label>
							<input type="email" class="form-control" name="email" id="email"/>
						</div>
						
						<button type="submit" class="bttn"  id="btnPasswordForgotten">Envoyer →</button>
					</form>
		</div>
					
	</div>
	{% endif %}
</div>
{% endblock %}