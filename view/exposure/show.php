{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<!--<h1> {{title}} </h1>-->
	<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
		{{archive.resume | raw }}
</div>
{% endblock %}
