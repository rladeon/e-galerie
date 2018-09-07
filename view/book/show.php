{% extends 'frontend/template.php' %}

{% block content %}
<div class="container">
     <h1 > {{titre}} </h1>
    <div class="row">
		<div class="col-sm">
			<div  style="float:left; width:50%">
				<div><p>{{auteur}} - {{date}}</p></div>
				<div><img src="{{root}}public/images/2018/1/couverture-du-livre-thumb.jpg" alt="Livre" /></div>
			</div>
		</div>
		<div class="col-sm">
			<div  style="float:left; width:50%">
			  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus luctus ligula, vitae lacinia eros faucibus ut. Vestibulum eget iaculis ligula. Integer posuere sed nulla nec elementum. Nulla convallis nisl id sagittis convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam id ex et turpis sollicitudin fermentum vitae sit amet urna. Vestibulum faucibus libero non eleifend eleifend. Mauris a lectus ac justo dictum porttitor ac id nisi. Donec dapibus dapibus velit, eget convallis lorem tempor nec. Fusce malesuada justo ac nibh facilisis imperdiet. Vestibulum lectus diam, mollis eget rutrum vitae, aliquet a lorem. Etiam dignissim sem non orci ultricies hendrerit. Nam a augue sed tortor tempor interdum. Etiam eget arcu pretium, molestie massa et, posuere justo.

		Suspendisse tincidunt, nibh id vehicula consequat, libero ligula mollis purus, ac scelerisque neque orci et arcu. Nam maximus maximus odio, nec tincidunt sem auctor aliquet. Fusce felis ligula, pulvinar vel aliquet non, venenatis non ligula. Donec a malesuada nunc, et pharetra nulla. Aenean vulputate varius consectetur. Aenean at ante dui. Proin rhoncus, dolor et semper varius, mi eros varius mauris, quis luctus mauris erat sed erat. Nulla faucibus id risus quis dapibus. In bibendum consequat nisl at efficitur. In at aliquet ipsum, in pharetra lacus.</p>
			</div>
		</div>
	</div>
	<div class="row">
		<h2>Détails</h2>
		<p>Nombre de pages: {{nombre_de_pages}}</p>
		<p>Collection: {{collection}}</p>
		<p>Format: {{format}}</p>
	</div>
</div>
  
	
{% endblock %}