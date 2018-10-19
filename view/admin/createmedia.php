{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
	<a href="{{root}}admin/medialist" class="btn btn-primary">Liste des images</a>
	<div class="row">
		<form action="{{root}}media/create" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label">Nouvelle image*</label>
				<input type="file" class="form-control" name="path" id="path" value=""/>
			</div>
													
			<input type="hidden" name="upload" value="upload" />
			<button type="submit" class="bttn"  id="btnAddImage" >Envoyer →</button>
		</form>
	</div>
</div>

{% endblock %}