{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	  <div class="error-text-wrapper">
			<div class="error-title" data-content="404">
				Erreur: 404
			</div>

			<div class="error-subtitle">
				Cette page n'existe pas.
			</div>

			
			<div class="flex">
				<a href="{{ root }}" class="bttn" >Retour à l'accueil</a>
			</div>
	</div>
</div>

{% endblock %}