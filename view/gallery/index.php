{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
	<!--<h1> {{title}} </h1>-->
		<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
		{# Loop through several photos #}
		<ul id="filters" class="clearfix">
			<li><span class="filter active" data-filter=".fruit, .paysage">Tout</span></li>
			<li><span class="filter" data-filter=".fruit">Végétaux</span></li>
			<li><span class="filter" data-filter=".paysage">paysage</span></li>
						
		</ul>			
			<div id="portfoliolist" >
			{% for key,entry in gallery %}
				<div class="portfolio {{entry.datacateg}} " data-cat="{{entry.datacateg}}">
					<div class="portfolio-wrapper">			
						<a href="{{root}}{{entry.path_large}}" class="js-smartPhoto" data-caption="{{entry.title}}" data-id="{{entry.title}}" data-group="{{entry.category}}">
						<img src="{{root}}{{entry.path_mid}}" />
						</a>
						<div class="label">
							<div class="label-text">
								<a class="text-title">{{entry.title}}</a>
								
							</div>
							<div class="label-bg"></div>
						</div>
					</div>
				
				</div>								
			{% endfor %}						
		</div>
</div>

{% endblock %}