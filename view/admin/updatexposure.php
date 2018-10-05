{% extends 'frontend/admin_template.php' %}

{% block content %}
<div class="container">
<a href="{{root}}admin/exposurelist"  class="btn btn-primary">Liste des expositions</a>
<p>Editer une exposition</p>
<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
</div>
		<div class="loader" style="display:none"></div>

	<form role="form" method="post" id="updatexposure_form">
		
		<div class="form-group">
			<label class="control-label">Titre*</label>
			<input type="text" class="form-control" name="title" id="title" value="{{book.title}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Catégorie</label>
			<input type="text" class="form-control" name="category" id="category" value="{{book.category}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Résumé</label>
			<input type="text" class="form-control" name="resume" id="resume" value="{{book.resume}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Horaires*</label>
			<input type="text" class="form-control" name="hours" id="hours" value="{{book.hours}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Nombre de place</label>
			<input type="text" class="form-control" name="nb_place" id="nb_place" value="{{book.nb_place}}"/>
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
		
		<div class="form-group row">
 <div class="col-xs-8">
 <label class="control-label">Date de début*</label>
 <div class="input-group date" id="dp3" data-date-format="dd/mm/yyyy">
 <input class="form-control" type="text" readonly="" id="date_start" name="date_start" value="{{book.date_start}}">
 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
 </div>
 </div>
</div>
<div class="form-group row">
<div class="col-xs-8">
 <label class="control-label">Date de fin*</label>
 <div class="input-group date" id="dp4" data-date-format="dd/mm/yyyy">
 <input class="form-control" type="text" readonly="" id="date_end" name="date_end" value="{{book.date_end}}">
 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
 </div>
 </div>
</div>
		<div class="form-group">
			<label class="control-label">description*</label>
			<textarea class="form-control" name="description" id="description">
			{{book.description}}
			</textarea>
		</div>
		<div class="form-group">
			<label class="control-label">Adresse</label>
			<textarea class="form-control" name="address" id="address">
			{{book.address}}
			</textarea>
		</div>
		<div class="form-group">
			<label class="control-label">Code postal</label>
			<input type="text" class="form-control" name="zipcode" id="zipcode" value="{{book.zipcode}}"/>
		</div>
		<div class="form-group">
			<label class="control-label">Commune</label>
			<input type="text" class="form-control" name="city" id="city" value="{{book.city}}"/>
		</div>
		<div class="form-group">
							<label class="control-label">Pays</label>
							<select name="country" id="country" class="form-control">
							{% for value in country %}
							
								{% if landofsalty == value.alpha2 %}
								<option value="{{value.alpha2}}" selected>{{value.nom_fr_fr}}</option>
									{% else %}
								<option value="{{value.alpha2}}">{{value.nom_fr_fr}}</option>
									{% endif %}
								{% endfor %}
							</select>
						</div>
		<div class="form-group">
			<label class="control-label">Téléphone</label>
			<input type="text" class="form-control" name="tel1" id="tel1" value="{{book.tel1}}"/>
		</div>

		
		<button type="submit" class="bttn"  id="btnUpdateXposure" data-id="{{book.id}}">Envoyer →</button>
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
