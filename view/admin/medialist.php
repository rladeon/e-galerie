{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
<a href="{{root}}admin/createmedia"  class="btn btn-primary">Ajouter une image</a>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>
<p>Liste des images</p>
{% if books != null%}
				<table class="table table-striped">
				  <tr>
				  <th>image</th><th>associée à un contenu</th><th>Actions</th>
				  </tr>
				  {% for value in books %}
					<tr>					
						<td>
							<img src="{{root}}{{value.path_thumb }}"/>
						</td>	
						<td>
							{% if value.link !=false %}
								{{value.link}}
							{% else %}
								Non
							{% endif %}
						</td>
						<td>
						<a href="{{root}}admin/updatemedia/id/{{value.id}}" class="btn btn-primary">éditer</a><a href="#" data-id="{{value.id}}" class="btn btn-danger deletemedia">supprimer</a>
						</td>						
					</tr>
					{% endfor %}
				</table>
			{% else %}	
				<p>il n'y a pas d'image dans la base de données.</p>
			{% endif %}
			</div>
{% endblock %}
