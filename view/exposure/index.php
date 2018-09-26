{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<h1> {{title}} </h1>
	
	<div class="row">
	{%if main.notfullback == true %}
		<div class="col-md-4">
			<h2>Prochaine exposition</h2>
				
		<div class="example-2 card">
		{% for index,value in media %}
			{% if value.id_exposure == main.id and value.default_img == 1 %}
				<div class="wrapper" style="background: url({{root}}{{value.path_large}}) center/cover no-repeat">
			{% endif %}
		{% endfor %}
      <div class="header">
        <div class="date">
          <!--<span class="day">12</span>
          <span class="month">Aug</span>
          <span class="year">2016</span>-->
		  {{main.date_deb}}
        </div>
        <ul class="menu-content">
          <li>
				Nombre de place disponible: {{main.nb_place}}
          </li>
          
        </ul>
      </div>
      <div class="data">
        <div class="content">
          <span class="author">Jane Doe</span>
          <h1 class="title"><a href="#">{{main.title}}</a></h1>
          <p class="text">{{main.infos}}</p>
          <!--<a href="#" class="button">Read more</a>-->
        </div>
      </div>
    </div>
  </div>

		</div>
		<div class="col-md-4">
			<div class="loader" style="display:none"></div>
	<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  
</div>
			<div><b>Aux horaires suivant:</b> {{main.horaires}}</div>
			<div><b>Information:</b> {{main.resume}}</div>
			<div><b>Adresse:</b></div>
			<div>{{main.addresse}}</div>
			<div>{{main.zipcode}}</div>
			<div>{{main.city}}</div>
			<div>{{main.country}}</div>

			<div>
			<b> Place réservée:</b>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: {{main.availability}}%" aria-valuenow="{{main.availability}}" aria-valuemin="0" aria-valuemax="100">{{main.availability}}%</div>
				</div>
			</div>
				{%if main.connected == false %}
					<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
				{% elseif alreadybooked == true%}					
				<div class="flex">
						<a href="#" class="bttn" data-id="{{main.id}}" id="cancelreservation">Annuler la réservation</a>
					</div>
				{% else %}					
						<div class="flex">
							<a href="{{ root }}exposure/booking/id/{{main.id}}" class="bttn" >Réservation</a>
						</div>					
				{% endif %}
		</div>
		{% else %}
			{{main.error_message}}
	{% endif %}
	<div class="col-md-4">
		<h2>Archives</h2>
	</div>
	</div>
</div>
{% endblock %}