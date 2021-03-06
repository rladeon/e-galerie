{% extends 'frontend/admin_template.php' %}

{% block content %}
<div class="container">
<a href="{{root}}admin/contentlist"  class="btn btn-primary">Liste des contenus</a>
<p>Ajouter un contenu</p>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>

	<form role="form" method="post" id="updatecontent_form">
		<div class="form-group">
			<label class="control-label">Auteur</label>
			<input type="text" class="form-control" name="author" id="author" value="{{book.author}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Titre*</label>
			<input type="text" class="form-control" name="title" id="title" value="{{book.title}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Catégorie</label>
			<input type="text" class="form-control" name="category" id="category" value="{{book.category}}"/>
		</div>
		
		<div class="form-group">
			<label class="control-label">publication</label>
				<label class="radio-inline">
				{% if book.published == 0 %}
					<input type="radio" name="published" id="Radios1" value="0" checked>
				{% else %}
					<input type="radio" name="published" id="Radios1" value="0">
				{% endif %}
					Non
				</label>
				<label class="radio-inline">
				{% if book.published == 1 %}
					<input type="radio" name="published" id="Radios2" value="1" checked>
				{% else %}
					<input type="radio" name="published" id="Radios2" value="1" >

				{% endif %}
					Oui
				</label> 
		</div>	
		<div class="form-group">
			<label class="control-label">résumé</label>
			<textarea class="form-control" name="resume" id="resume">
			{{book.resume}}
			</textarea>
		</div>
		<div class="form-group row">
 <div class="col-xs-8">
 <label class="control-label">Date de publication</label>
 <div class="input-group date" id="dp3" data-date-format="dd/mm/yyyy">
 <input class="form-control" type="text" readonly="" id="date_publish" name="date_publish" value="{{book.date}}">
 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
 </div>
 </div>
</div>
		<div class="form-group">
			<label class="control-label">description*</label>
			<textarea class="form-control" name="description" id="description" >
			{{book.description}}
			</textarea>
		</div>
		
		<button type="submit" class="bttn"  id="btnUpdateContent" data-id="{{book.id}}">Envoyer →</button>
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
