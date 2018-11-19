{% extends 'frontend/admin_template.php' %}
{% block content %}
<div class="container">
	<a href="{{root}}admin/medialist"  class="btn btn-primary">Liste des images</a>
	<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="loader" style="display:none"></div>
	<p>Mise à jour des informations de l'image</p>
	
	<form role="form" method="post" id="updatemedia_form">
		
		<div class="form-group">
			<label class="control-label">Titre*</label>
			<input type="text" class="form-control" name="title" id="title" value="{{media.title}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Catégorie</label>
			<input type="text" class="form-control" name="category" id="category" value="{{media.category}}"/>
		</div>	
		<div class="form-group">
			<label class="control-label">data catégorie</label>
			<input type="text" class="form-control" name="datacateg" id="datacateg" value="{{media.datacateg}}"/>
		</div>	
		<div class="form-group">
			<label class="control-label">Content</label>
			<select name="content" id="content" class="form-control">
				<option value="">Choisir un contenu</option>
				{% for value in content %}
					{% if media.idofcontent == value.id %}
						<option value="{{value.id}}" selected>{{value.title}}</option>
					{% else %}
						<option value="{{value.id}}">{{value.title}}</option>
					{% endif %}
				{% endfor %}
			</select>
		</div>
		<div class="form-group">
			<label class="control-label">Exposition</label>
			<select name="exposure" id="exposure" class="form-control">
				<option value="">Choisir une exposition</option>
				{% for value in exposure %}
					{% if media.idofexposure == value.id %}
						<option value="{{value.id}}" selected>{{value.title}}</option>
					{% else %}
						<option value="{{value.id}}">{{value.title}}</option>
					{% endif %}
				{% endfor %}
			</select>
		</div>
		<div class="form-group">
			<label class="control-label">Livre</label>
			<select name="book" id="book" class="form-control">
			<option value="">Choisir un livre</option>
				{% for value in book %}
					{% if media.idofbook == value.id %}
						<option value="{{value.id}}" selected>{{value.title}}</option>
					{% else %}
						<option value="{{value.id}}">{{value.title}}</option>
					{% endif %}
				{% endfor %}
			</select>
		</div>
		<div class="form-group">
			<label class="control-label">Galerie</label>
			<label class="radio-inline">
			{% if media.gallery == 1 %}
				<input type="radio" name="gallery" id="Radios1" value="1" checked>
			{% else %}
				<input type="radio" name="gallery" id="Radios1" value="1" >
			{% endif %}
			Oui
								 
			</label>
			<label class="radio-inline">
			{% if media.gallery == 0 %}
				<input type="radio" name="gallery" id="Radios2" value="0" checked>
			{% else %}
				<input type="radio" name="gallery" id="Radios2" value="0" >
			{% endif %}
			Non
			</label>
		</div>
		<div class="form-group">
			<label class="control-label">Image par défaut</label>
			<label class="radio-inline">
			{% if media.defaultimg == 1 %}
				<input type="radio" name="defaultimg" id="Radios3" value="1" checked>
			{% else %}
				<input type="radio" name="defaultimg" id="Radios3" value="1" >
			{% endif %}
			Oui
								 
			</label>
			<label class="radio-inline">
			{% if media.defaultimg == 0 %}
				<input type="radio" name="defaultimg" id="Radios4" value="0" checked>
			{% else %}
				<input type="radio" name="defaultimg" id="Radios4" value="0" >
			{% endif %}
			Non
								 
			</label>
		</div>	
		<div class="form-group">
			<label class="control-label">Image d'archive</label>
			<label class="radio-inline">
			{% if media.archiver == 1 %}
				<input type="radio" name="archiver" id="Radios4" value="1" checked>
			{% else %}
				<input type="radio" name="archiver" id="Radios4" value="1" >
			{% endif %}
			Oui
								 
			</label>
			<label class="radio-inline">
			{% if media.archiver == 0 %}
				<input type="radio" name="archiver" id="Radios5" value="0" checked>
			{% else %}
				<input type="radio" name="archiver" id="Radios5" value="0" >
			{% endif %}
			Non
								 
			</label>
		</div>	
		<button type="submit" class="bttn"  id="btnUpdateMedia" data-id="{{media.id}}">Envoyer →</button>
	</form>

</div>

{% endblock %}
