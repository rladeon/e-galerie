{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<h1> {{title}} </h1>	
		
		{# Loop through several photos #}
		{% for key,entry in content %}
			<div class="col-md-4 peaceplace">
				<div class="artdate">{{entry.date}}</div>
					{% for index,value in media %}
						{% if value.id_content == key %}
								<a href="{{root}}press/show/page/{{entry.slug}}">
								<img src="{{root}}{{value.path_mid}}" class="frontimage "/>
								</a>
						{% endif %}
					{% endfor %}
					
					<p>{{entry.title}}</p>
							
			</div>
						
		{% endfor %}
	
</div>
{% endblock %}