{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
	<div class="row">
		{{content | raw}}
		
</div>
</div>
{% endblock %}