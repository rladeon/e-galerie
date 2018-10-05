{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
<a href="{{root}}admin/createxposure"  class="btn btn-primary">Ajouter une exposition</a>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>
<p>Liste des expositions</p>
{% if books != null%}
				<table class="table table-striped">
				  <tr>
				  <th>titre</th><th>date de début</th><th>date de fin</th><th>il reste des places?</th><th>Actions</th>
				  </tr>
				  {% for value in books %}
					<tr>
					
					<td>{{value.title}} </td>
					<td>{{value.date_start}} </td>
					<td>{{value.date_end}} </td>
					<td>
						{% if value.notfullback == false %}
							NON
						{% else %}
							OUI
						{% endif %}
					</td>					
					<td>
					<a href="{{root}}admin/updatexposure/id/{{value.id}}" class="btn btn-primary">éditer</a><a href="#" data-id="{{value.id}}" class="btn btn-danger deletexposure">supprimer</a>
					</td>
						
					</tr>
					{% endfor %}
				</table>
			{% else %}	
				<p>il n'y a pas d'exposition enregistrée dans la base de données.</p>
			{% endif %}
			</div>
{% endblock %}
