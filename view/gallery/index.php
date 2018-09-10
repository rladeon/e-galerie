{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<h1> Galerie photo </h1>
	<div id="mygallery" >
		
		{# Loop through several photos #}
		{% for key,entry in gallery %}
			<a href="{{root}}{{entry.path_large}}" class="js-smartPhoto">
				<img alt="{{entry.title}}" src="{{root}}{{entry.path_thumb}}"/>
			</a>			
		{% endfor %}
	</div>
</div>

{% endblock %}