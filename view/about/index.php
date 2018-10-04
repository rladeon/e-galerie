{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
	<h1>Bienvenue</h1>
	<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
		{{about | raw}}
</div>
{% endblock %}