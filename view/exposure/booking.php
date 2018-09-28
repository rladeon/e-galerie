{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
		<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>

{% if error %}
	<P>{{errormessage}}</p>
	{% else %}
	
{% endif %}
	<div class="row">
	<div class="loader" style="display:none"></div>
	<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  
</div>
		<div class="col-md-4">
		<h2>Réservation</h2>
			<div>
				<span style="font-size:30px"> {{user.name}}  {{user.firstname}}</span>
			</div>
			<div>
				<span><b>Téléphone:</b> {{user.tel1}}</span>
			</div>
			<div>
				<span><b>e-mail</b>: {{user.email}}</span>
			</div>
			<div class="flex">
				<!--<a href="{{ root }}exposure/confirmreservation/id/{{main.id}}" class="bttn" id="reservation" >Réserver</a>-->
				<a href="#" class="bttn" id="reservation" data-id="{{exposure.id}}">Réserver</a>
			</div>	
		</div>
		<div class="col-md-5">
		<h2>Exposition</h2>
			<div>
				<span><b>Nom:</b> {{exposure.title}}</span>
			</div>
			<div>
				<span><b>Du {{start}} au {{end}}</b></span>
			</div>
			<div>
				<span><b>Adresse:</b>{{exposure.addresse}}</span>
			</div>
			<div>
				<span><b>Code postal: </b> {{exposure.zipcode}}</span>
			</div>
			<div>
				<span><b>Commune:</b> {{exposure.city}}</span>
			</div>
			<div>
				<span>Contact</span>
			</div>
		</div>
	</div>
</div>
{% endblock %}