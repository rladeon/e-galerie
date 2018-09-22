{% extends 'frontend/template.php' %}
{% block content %}
	<div class="container">
		<div class="row">
			
			{% if article != null %}
				<h1>{{article.title}}</h1>
				
				<div class="col-md-6">
					{% for index,value in media %}
						{% if value.id_content == article.id %}
							<div><b>auteur:</b> {{article.author}} &nbsp;&nbsp;&nbsp; <!--<i class="fa fa-eye"></i>{% if article.vue >1%} <b>vues</b>: {{article.views}} {% elseif  1 >= article.vue and article.views >=0  %} <b>vue:</b> {{article.views}}{%else%} <b>vue:</b> 0{%endif%}  --></div>							
							<img src="{{root}}{{value.path_large}}" width="100%"/>
														
						{% endif %}
					{% endfor %}
				</div>
				<div class="col-md-5">
				{{article.message}}
				</div>
			{% endif %}
		</div>
		<div class="row text-center">
		
			<h2>Partager</h2>
			<ul class="list-inline social-buttons">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                        </ul>
		</div>
		
	</div>
	</div>				
{% endblock %}
