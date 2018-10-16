{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<!--<h1> {{title}} </h1>-->
	<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
		{{archive.resume | raw }}
	<div id="mygallery">
		{% for index,value in media %}
		<div class="col-md-4">
			<a href="{{root}}{{value.path_large}}" class="js-smartPhoto">
				<img src="{{root}}{{value.path_mid}}" width="100%"/>
			</a>								
		</div>
		{% endfor %}
	</div>
</div>
{% endblock %}
