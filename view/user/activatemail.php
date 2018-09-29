{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
	<div  class="row">
	{% if activate == false %}
		{{message}}
	{% else %}
	<div class="col-md-4">
			<p>Bienvenue {{message | raw}}</p>
			<p>Vous pouvez accéder à votre espace en cliquant sur le bouton suivant: </p>
			</div>
			<div class="col-md-4">
			<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
			</div>
	{% endif %}
	
	</div>
</div>
{% endblock %}