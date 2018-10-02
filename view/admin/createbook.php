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

	<form role="form" method="post" id="createbook_form">
		<div class="form-group">
			<label class="control-label">Auteur*</label>
			<input type="text" class="form-control" name="author" id="author"/>
		</div>
		<div class="form-group">
			<label class="control-label">Titre*</label>
			<input type="text" class="form-control" name="title" id="title"/>
		</div>
		<div class="form-group">
			<label class="control-label">Nombre de pages*</label>
			<input type="text" class="form-control" name="pages_number" id="pages_number"/>
		</div>
		<div class="form-group">
			<label class="control-label">collection*</label>
			<input type="text" class="form-control" name="collection" id="collection"/>
		</div>
		
		<div class="form-group">
			<label class="control-label">format*</label>
			<input type="text" class="form-control" name="format" id="format"/>
		</div>
		<div class="form-group row">
 <div class="col-xs-8">
 <label class="control-label">Date de publication*</label>
 <div class="input-group date" id="dp3" data-date-format="dd/mm/yyyy">
 <input class="form-control" type="text" readonly="" id="date_publish" name="date_publish" value="">
 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
 </div>
 </div>
</div>
		<div class="form-group">
			<label class="control-label">description*</label>
			<textarea class="form-control" name="description" id="description">
			</textarea>
		</div>
		<div class="form-group">
			<label class="control-label">Prix</label>
			<input type="text" class="form-control" name="price" id="price"/>
		</div>
		<div class="form-group">
			<label class="control-label">Poids</label>
			<input type="text" class="form-control" name="weight" id="weight"/>
		</div>
		<button type="submit" class="bttn"  id="btnCreateBook">Envoyer →</button>
	</form>
	<script>
	
          CKEDITOR.replace( 'description' );
		  $(function(){
			$(".input-group.date").datepicker(
			{language: 'fr',
			todayHighlight: true,
			 setDate: new Date(),
			});
		  });
    </script>
</div>
{% endblock %}
