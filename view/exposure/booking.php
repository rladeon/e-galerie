{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
<h2>Réservation</h2>
{% if error %}
	<P>{{errormessage}}</p>
	{% else %}
	
{% endif %}
	<div class="row">
		<div class="col-md-4">
			<div>
				<span> {{user.name}} &nbsp;&nbsp; {{user.firstname}}</span>
			</div>
			<div>
				<span>Téléphone: {{user.tel1}}</span>
			</div>
			<div class="flex">
				<a href="{{ root }}exposure/booking/id/{{main.id}}" class="bttn" >Réserver</a>
			</div>	
		</div>
		<div class="col-md-5">
			<div>
				<span>Nom: {{exposure.title}}</span>
			</div>
			<div>
				<span>Du {{start}} au {{end}}</span>
			</div>
			<div>
				<span>Adresse {{exposure.addresse}}</span>
			</div>
			<div>
				<span>Code postal {{exposure.zipcode}}</span>
			</div>
			<div>
				<span>Commune {{exposure.city}}</span>
			</div>
			<div>
				<span>Contact</span>
			</div>
		</div>
	</div>
</div>
{% endblock %}