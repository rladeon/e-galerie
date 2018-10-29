{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
	<a href="{{root}}invite/getall" class="btn btn-primary">Liste des invitations</a>
	<div class="row">
	<div>{{message}}</div>
		<form action="{{root}}invite/update/id/{{invite.id}}" method="post" enctype="multipart/form-data">
		<div class="form-group">
				<label class="control-label">titre*</label>
			<input type="text" class="form-control" name="title" id="title" value="{{invite.title}}"/>
			</div>
			<div class="form-group">
				<label class="control-label">Nouvelle invitation</label>
				<input type="file" class="form-control" name="path" id="path" value=""/>
			</div>
			<div class="form-group">
			<label class="control-label">Exposition*</label>
			<select name="exposure" id="exposure" class="form-control">
				<option value="">Choisir une exposition</option>
				{% for value in exposure %}
					{% if value.id != invite.expo %}
					<option value="{{value.id}}">{{value.title}}</option>
					{% else %}
					<option value="{{value.id}}" selected>{{value.title}}</option>
					{% endif %}
					
				{% endfor %}
			</select>
		</div>
			<input type="hidden" name="upload" value="upload" />
			<button type="submit" class="bttn"  id="btnUpdateInvite" >Envoyer →</button>
		</form>
	</div>
</div>

{% endblock %}