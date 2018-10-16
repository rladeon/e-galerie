{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<!--<h1> {{title}} </h1>-->
	<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
	{% if main != null %}
		<h2>{{main.title}}</h2>
	{% endif %}
	<div class="row">
	{% if main == null %}
		<div class="col-md-4">
		{{ message }}
		</div>
	{% else %}	
		
		{% if main.category == "invite" %}			
			<div class="col-md-4">	
								
				<div id="small-images">
				{% for index,value in media %}
						{% if value.id_exposure == main.id and value.archiver == 0 %}
							
						<a href="{{root}}{{value.path_large}}" class="js-smartPhoto">
							<img src="{{root}}{{value.path_mid}}" width="100%"/>
						</a>								
						{% endif %}
					{% endfor %}
				
				</div>
			
		</div>
		{% else %}
		<div class="col-md-4">
			<div class="example-2 card">
				{% for index,value in media %}
					{% if value.id_exposure == main.id and value.default_img == 1 and value.archiver == 0 %}
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
							Place disponible: {{(main.nb_place-main.booked)>=0?(main.nb_place-main.booked):0}}/{{main.nb_place}}
					  </li>
					  
					</ul>
				
			  </div>
			  <div class="data">
				<div class="content">
				  
				  <h1 class="title"><a href="#">{{main.title}}</a></h1>
				  <p class="text">{{main.resume | raw}}</p>
				  <!--<a href="#" class="button">Read more</a>-->
				</div>
			  </div>
			</div>
		  </div>

		</div>
	{% endif %}
		<div class="col-md-4">
			<div class="loader" style="display:none"></div>
			<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
			</div>
			<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			</div>
			<h2>Invitation</h2>
			<div>Le {{main.date}}</div>
			<div><b> horaires :</b> {{main.horaires}}</div>
			<div><b>Information:</b> {{main.infos | raw}}</div>
			<div><b>Tél:</b> {{main.tel1}}</div>
			<div><b>E-mail:</b> {{main.email}}</div>
			{% if main.category == "invite" %}
			
				{% for index,value in invite %}
					<a href="{{root}}{{value.path}}" download>Télécharger l'invitation: {{value.title}}</a>
				{% endfor %}
			
			{%  endif %}
			
			{% if main.category == "invite" %}
			
			{% else %}
			<div>			
				<b> Place réservée:</b>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: {{main.availability}}%" aria-valuenow="{{main.availability}}" aria-valuemin="0" aria-valuemax="100">{{main.availability}}%</div>
				</div>
			</div>
			
				
				{% if main.connected == false %}
					<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
				{% elseif alreadybooked == true%}					
				<div class="flex">
						<a href="#" class="bttn" data-id="{{main.id}}" id="cancelreservation">Annuler la réservation</a>
					</div>
				{% elseif main.booked == main.nb_place %}
					
					<p> il ne reste plus de place disponible</p>
				{% else %}					
						<div class="flex">
							<a href="{{ root }}exposure/booking/id/{{main.id}}" class="bttn" >Réservation</a>
						</div>					
				{% endif %}
			{% endif %}
		</div>
	{% endif %}
	{% if main != null %}
		<div class="col-md-4">
		<h2> Adresse </h2>
				<div>{{main.address}}</div>
				<div><b>Code postal:</b> {{main.zipcode}}</div>
				<div><b>Commune:</b> {{main.city}}</div>
				<div><b>Pays:</b> {{main.country}}</div>
		</div>
		{% endif %}
	</div>
	
	{% for year,archivers in getarchiver %}
	
		<div><i class="fa fa-archive" style="font-size:36px"></i><span style="font-size:36px">{{year}}</span></div>
		{% for index,archiver in archivers %}
		<div class="col-md-4">	
					
			<div><a href="{{root}}exposure/show/archiver/{{archiver.slug}}">
				{% for index,value in media %}
					{% if value.id_exposure == archiver.id_exposure and value.archiver == 1 and value.default_img == 1 %}
						<img src="{{root}}{{value.path_mid}}" width="100%"/>
															
					{% endif %}
				{% endfor %}
						<span>{{archiver.title}}</span></a>
					</div>				
		</div>
		{% endfor %}
		
	{% endfor %}
	
</div>
{% endblock %}