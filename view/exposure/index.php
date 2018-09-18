{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<h1> {{title}} </h1>
	<h2>Prochaine exposition</h2>
	<div class="row">
	{%if notfullback == true %}
		<div class="col-md-5">
			<div class="artdate">{{date_deb}}-{{date_end}}</div>
				<div>
					<img src="{{root}}{{path_mid}}" class="frontimage "/>
				</div>
		
			</div>
		<div class="col-md-5">
			<div><p>{{jours}}<p></div>
			<div><b>Aux horaires suivant:</b> {{horaires}}</div>
			<div><b>Information:</b> {{infos}}</div>
			<div>
			<b> Place réservée:</b>
				<div class="progress">
					<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: {{availability}}%" aria-valuenow="{{availability}}" aria-valuemin="0" aria-valuemax="100">{{availability}}%</div>
				</div>
			</div>
				{%if connected == false %}
					<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
				{% else %}					
						<div class="flex">
							<a href="{{ root }}exposure/booking" class="bttn" >Réservation</a>
						</div>					
				{% endif %}
		</div>
		{% else %}
			{{error_message}}
	{% endif %}
	</div>
</div>
{% endblock %}