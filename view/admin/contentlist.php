{% extends 'frontend/admin_template.php' %}

{% block content %}
<div class="container">
<a href="{{root}}admin/createcontent"  class="btn btn-primary">Ajouter un contenu</a>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>
<p>Liste de contenu</p>
{% if books != null%}
				<table class="table table-striped">
				  <tr>
				  <th>titre</th><th>catégorie</th><th>Actions</th>
				  </tr>
				  {% for value in books %}
					<tr>
					
					<td>{{value.title}} </td>
					<td>{{value.category}} </td>
					
					<td>
					<a href="{{root}}admin/updatecontent/id/{{value.id}}" class="btn btn-primary">éditer</a><a href="#" data-id="{{value.id}}" class="btn btn-danger deletecontent">supprimer</a>
					</td>
						
					</tr>
					{% endfor %}
				</table>
			{% else %}	
				<p>il n'y a pas de contenu enregistrée dans la base de données.</p>
			{% endif %}
			</div>
{% endblock %}
