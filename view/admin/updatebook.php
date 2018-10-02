{% extends 'frontend/admin_template.php' %}

{% block content %}
<div class="container">
<a href="{{root}}admin/booklist"  class="btn btn-primary">Liste des livres</a>
<p>Ajouter un livre</p>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>

	<form role="form" method="post" id="updatebook_form">
		<div class="form-group">
			<label class="control-label">Auteur</label>
			<input type="text" class="form-control" name="author" id="author" value="{{book.author}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Titre</label>
			<input type="text" class="form-control" name="title" id="title" value="{{book.title}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Nombre de pages</label>
			<input type="text" class="form-control" name="pages_number" id="pages_number" value="{{book.pages_number}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">collection</label>
			<input type="text" class="form-control" name="collection" id="collection" value="{{book.collection}}"/>
		</div>
		
		<div class="form-group">
			<label class="control-label">format</label>
			<input type="text" class="form-control" name="format" id="format" value="{{book.format}}"/>
		</div>
		
		<div class="form-group">
			<label class="control-label">description</label>
			<textarea class="form-control" name="description" id="description" >
				{{book.description}}
			</textarea>
		</div>
		<div class="form-group">
			<label class="control-label">Prix</label>
			<input type="text" class="form-control" name="price" id="price" value="{{book.price}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Poids</label>
			<input type="text" class="form-control" name="weight" id="weight" value="{{book.weight}}"/>
		</div>
		<button type="submit" class="bttn"  id="btnUpdateBook" data-id="{{book.id}}">Envoyer →</button>
	</form>
	<script>
          CKEDITOR.replace( 'description' );
    </script>
</div>
{% endblock %}
