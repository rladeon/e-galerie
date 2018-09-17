{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	  <div class="error-text-wrapper">
			<div class="error-title" data-content="401">
				Erreur: 401
			</div>

			<div class="error-subtitle">
				utilisateur non authentifié
			</div>

			
			<div class="flex">
				<a href="{{ root }}" class="bttn" >Retour à l'accueil</a>
			</div>
	</div>
</div>

{% endblock %}