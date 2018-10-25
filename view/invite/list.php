{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
<a href="{{root}}invite/create"  class="btn btn-primary">Ajouter une invitation</a>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>
<p>Liste des invitations</p>
{% if invites != null%}
				<table class="table table-striped">
				  <tr>
				  <th>titre</th><th>chemin</th><th>exposition</th><th>Actions</th>
				  </tr>
				  {% for value in invites %}
					<tr>					
						<td>
							{{value.title }}
						</td>	
						<td>
						{{value.path}}
						</td>
						<td>{{value.exposure}}</td>
						<td>
						<a href="{{root}}invite/updateinvite/id/{{value.id}}" class="btn btn-primary">éditer</a><a href="#" data-id="{{value.id}}" class="btn btn-danger deletemedia">supprimer</a>
						</td>						
					</tr>
					{% endfor %}
				</table>
			{% else %}	
				<p>il n'y a pas d'invitation dans la base de données.</p>
			{% endif %}
			</div>
{% endblock %}
