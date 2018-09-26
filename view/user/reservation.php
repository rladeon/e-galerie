{% extends 'frontend/template.php' %}
{% block content %}

<div class="container">
	<h2>Réservations </h2>
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
			{% if reservation != null%}
				<table class="table table-striped">
				  <tr>
				  <th>titre</th><th>date début</th><th>date fin</th><th>Actions</th>
				  </tr>
					<tr>
					{% for value in reservation %}
					<td>{{value.title}} </td>
					<td>{{value.start}} </td>
					<td>{{value.end}} </td>
					
					<td><a href="{{root}}reservation/canceled/id/{{value.id_reservation}}" class="btn btn-danger">Annuler</a></td>
						{% endfor %}
					</tr>
				</table>
			{% else %}	
				<p>Vous n'avez pas encore effectuer de réservation.</p>
			{% endif %}

	
{% endif %}
</div>
{% endblock %}