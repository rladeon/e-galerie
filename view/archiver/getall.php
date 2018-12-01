{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
<a href="{{root}}archiver/create"  class="btn btn-primary">Ajouter une archive</a>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>
<p>Liste des archives</p>
{% if archivers != null%}
				<table class="table table-striped">
				  <tr>
				  <th>Exposition</th><th>Date</th><th>Actions</th>
				  </tr>
				  {% for value in archivers %}
					<tr>					
					<td>{{value.exposure}} </td>
					
					<td>{{value.date}} </td>									
					<td>
					<a href="{{root}}archiver/update/id/{{value.id}}" class="btn btn-primary">éditer</a><a href="#" data-id="{{value.id}}" class="btn btn-danger delete">supprimer</a>
					</td>
						
					</tr>
					{% endfor %}
				</table>
			{% else %}	
				<p>il n'y a pas d'archive enregistrée dans la base de données.</p>
			{% endif %}
			</div>
{% endblock %}
