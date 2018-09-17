{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	  <div class="error-text-wrapper">
			<div class="error-title" data-content="503">
				Erreur: 503
			</div>

			<div class="error-subtitle">
				Erreur serveur
			</div>

			
			<div class="flex">
				<a href="{{ root }}" class="bttn" >Retour à l'accueil</a>
			</div>
	</div>
</div>

{% endblock %}