{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
	<a href="{{root}}admin/medialist"  class="btn btn-primary">Liste des images</a>
		
	<p>Mise à jour de l'image</p>
	<p>{{message}}</p>
	<form role="form" method="post" id="updateimage_form" action="{{root}}media/updateimage" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label">Nouvelle image*</label>
			<input type="file" class="form-control" name="path" id="path" value=""/>
		</div>
												
		<input type="hidden" name="upload" value="upload" />
		<input type="hidden" name="id" value="{{media.id}}" />
		<button type="submit" class="bttn"  id="btnUpdateImage" >Envoyer →</button>
	</form>

</div>

{% endblock %}
