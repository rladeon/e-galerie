{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
     <h1 > {{book.titre}} </h1>
    <div class="row">
		<div class="col-md-6">
			
				<div><p>{{book.author}} - paru le {{book.date}}</p></div>				
					
					<div id="big-image" >
					
						{% for index,value in media %}
							{% if value.id_book == book.id and value.default_img == 1 %}
								<img src="{{root}}{{value.path_mid}}" />
							{% endif %}
						{% endfor %}
					</div>
				
				<div id="small-images">
				{% for index,value in media %}
						{% if value.id_book == book.id %}
							
						<a href="{{root}}{{value.path_large}}" class="js-smartPhoto">
							<img src="{{root}}{{value.path_thumb}}" />
						</a>								
						{% endif %}
					{% endfor %}
				
				</div>
			
		</div>
		<div class="col-md-5">
			
			  <p>{{book.description}}</p>
			</div>
		
	</div>
	<div class="row text-center">
		<div class="col-md-4">
			<h2>Détails</h2>
			<p><b>Nombre de pages:</b> {{book.pages_number}}</p>
			<p><b>Collection:</b> {{book.collection}}</p>
			<p><b>Format:</b> {{book.format}}</p>
		</div>
		<div class="col-md-4">
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