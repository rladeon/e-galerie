{% extends 'frontend/admin_template.php' %}

{% block content %}
<div class="container">
<a href="{{root}}admin/createbook"  class="btn btn-primary">Ajouter un livre</a>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>
<p>Liste de livre</p>
{% if books != null%}
				<table class="table table-striped">
				  <tr>
				  <th>titre</th><th>Actions</th>
				  </tr>
				  {% for value in books %}
					<tr>
					
					<td>{{value.title}} </td>
					
					
					<td>
					<a href="{{root}}admin/updatebook/id/{{value.id}}" class="btn btn-primary">éditer</a><a href="#" data-id="{{value.id}}" class="btn btn-danger deletebook">supprimer</a>
					</td>
						
					</tr>
					{% endfor %}
				</table>
			{% else %}	
				<p>il n'y a pas de livre enregistrée dans la base de données.</p>
			{% endif %}
			</div>
{% endblock %}
