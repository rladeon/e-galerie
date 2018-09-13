{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<h1> Presse </h1>	
		
		{# Loop through several photos #}
		{% for key,entry in content %}
			<div class="col-md-4 peaceplace">
				<div class="artdate">{{entry.date}}</div>
					{% for index,value in media %}
						{% if value.id_content == key %}
								<img src="{{root}}{{value.path_mid}}" class="frontimage "/>
						{% endif %}
					{% endfor %}
					
					<p>{{entry.message}}</p>
							
			</div>
						
		{% endfor %}
	
</div>
{% endblock %}