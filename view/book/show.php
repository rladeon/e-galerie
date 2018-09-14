{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
     <h1 > {{book.titre}} </h1>
    <div class="row">
		<div class="col-md-6">
			
				<div><p>{{book.author}} - {{book.date}}</p></div>				
					
					<div id="big-image" >
					
						{% for index,value in media %}
							{% if value.id_book == book.id and value.default_img == book.id%}
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
			
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus luctus ligula, vitae lacinia eros faucibus ut. Vestibulum eget iaculis ligula. Integer posuere sed nulla nec elementum. Nulla convallis nisl id sagittis convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam id ex et turpis sollicitudin fermentum vitae sit amet urna. Vestibulum faucibus libero non eleifend eleifend. Mauris a lectus ac justo dictum porttitor ac id nisi. Donec dapibus dapibus velit, eget convallis lorem tempor nec. Fusce malesuada justo ac nibh facilisis imperdiet. Vestibulum lectus diam, mollis eget rutrum vitae, aliquet a lorem. Etiam dignissim sem non orci ultricies hendrerit. Nam a augue sed tortor tempor interdum. Etiam eget arcu pretium, molestie massa et, posuere justo.

		Suspendisse tincidunt, nibh id vehicula consequat, libero ligula mollis purus, ac scelerisque neque orci et arcu. Nam maximus maximus odio, nec tincidunt sem auctor aliquet. Fusce felis ligula, pulvinar vel aliquet non, venenatis non ligula. Donec a malesuada nunc, et pharetra nulla. Aenean vulputate varius consectetur. Aenean at ante dui. Proin rhoncus, dolor et semper varius, mi eros varius mauris, quis luctus mauris erat sed erat. Nulla faucibus id risus quis dapibus. In bibendum consequat nisl at efficitur. In at aliquet ipsum, in pharetra lacus.</p>
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