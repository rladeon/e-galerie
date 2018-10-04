{% extends 'frontend/template.php' %}

{% block content %}
<div id="demo1">
      <div class="slide">
        <img src="public/images/slides/1.jpg" />
        <!--Slider Description example-->
         <div class="slide-desc">
            <h2>Slider Title 1</h2>
            <p>Demo description here. Demo description here. Demo description here. Demo description here. Demo description here. <a class="more" href="#">more</a></p>
        </div>
     </div>
    <div class="slide">
       <img src="public/images/slides/2.jpg" />
       <div class="slide-desc">
        <h2>Slider Title 2</h2>
        <p>Demo description here. Demo description here. Demo description here. Demo description here. Demo description here. <a class="more" href="#">more</a></p>
      </div>
   </div>
   <div class="slide">
      <img src="public/images/slides/3.jpeg" />
      <!--NO Description Here-->
   </div>
   <div class="slide">
     <img src="public/images/slides/4.jpg" />
     <div class="slide-desc">
      <h2>Slider Title 4</h2>
      <p>Demo description here. Demo description here. Demo description here. Demo description here. Demo description here. <a class="more" href="#">more</a></p>
     </div>
  </div>
 <div class="slide">
    <img src="public/images/slides/5.jpg" />
 </div>
 <div class="slide">
   <img src="public/images/slides/6.jpg" />
    <div class="slide-desc">
    <h2>Slider Title 6</h2>
    <p>Demo description here. Demo description here. Demo description here. Demo description here. Demo description here. <a class="more" href="#">more</a></p>
   </div>
 </div>
</div>
<div class="container">

	  <section id="section" class="main-section first-section">
			<div class="container">
				<p class="bigtxt txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
			</div>
		</section>


		<section id="main" class="main-section cleanbg">
			<div class="container" >
			
				<h1>Qui suis-je?</h1>
				
				<div class="row text-center">
				{% if resume != null %}
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                        <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">A propos de moi</h4>
                    <p>{{resume | raw }}
						
					</p>
					<div class="flex">
						<a href="{{ root }}about/index" class="bttn" >En savoir plus?</a>
					</div>

                </div>
				{% endif %}
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                        <i class="fa fa-mortar-board fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Savoir faire</h4>

                        <ul class="social-buttons">
                            <li>skill1
                            </li>
                            <li>skill2
                            </li>
                        </ul>
                </div>
				<div class="col-md-4">
                        <span class="fa-stack fa-4x">
                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                        <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Réseaux sociaux</h4>
						
                        <ul class=" social-buttons" style="margin-left :45%;">
                            <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>
                </div>
				
			</div>
			</div>
		</section>
		<section id="latest" class="main-section second-section">
			<div class="container">
				<h1>Mes derniers travaux</h1>		

				<div class="row">
					{% for key,entry in gallery %}
						<div class="col-md-4 polaroid">
								<a href="{{root}}{{entry.path_large}}" class="js-smartPhoto" data-caption="{{entry.title}}" data-id="{{entry.title}}" data-group="{{entry.category}}">
								<img src="{{root}}{{entry.path_thumb}}" />
								</a>
								<div class="label">
									<div class="label-text">
										<a class="text-title">{{entry.title}}</a>
										
									</div>
									<div class="label-bg"></div>
								</div>
						
						
						</div>								
					{% endfor %}	
				</div>
			
			</div>
		
		</section>
		<div class="flex" style="float: left; width:100%">
						<a href="{{root}}gallery/index" class="bttn" >Voir tous les tableaux</a>
					</div>
			
		<section id="latest" class="main-section second-section">
			<div class="container">
				<h1>Mon actualité</h1>
				<div class="row text-center">
					<div class="col-md-4 peaceplace">
						<div class="artdate">01/01/1972</div>
						<a href="{{root}}press/show/page/catalogue-numero-1-du-concours-devenez-l-artiste-de-l-annee-2017">
						<img src="{{root}}public/images/2018/17/catalogue-mid.jpg" class="frontimage"/>
						</a>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						
					</div>
				
					
				</div>
				<a href="{{root}}press/index" class="bttn" >Toute l'actualité</a>
			</div>
						
					
		</section>
</div>
	{% endblock %}