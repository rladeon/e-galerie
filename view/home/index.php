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
	  <section id="section" class="main-section first-section">
			<div class="container">
				<p class="bigtxt txtcenter">{{breadcrumb}}</p>
			</div>
		</section>


		<section id="main" class="main-section cleanbg">
			<div class="container" >
				<h1>Qui suis-je?</h1>
				
				<div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-square fa-stack-2x text-primary"></i>
                        <i class="fa fa-comment fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">A propos de moi</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam faucibus luctus ligula, vitae lacinia eros faucibus ut. Vestibulum eget iaculis ligula. Integer posuere sed nulla nec elementum. Nulla convallis nisl id sagittis convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus...
						
					</p>
					<div class="flex">
						<a href="#0" class="bttn" >En savoir plus?</a>
					</div>

                </div>
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
		</section>
		 <section id="latest" class="main-section second-section">
			<div class="container">
				<h1>Mes derniers travaux</h1>
				<ul id="filters" class="clearfix">
			<li><span class="filter active" data-filter=".app, .card, .icon, .logo, .web">All</span></li>
			<li><span class="filter" data-filter=".app">App</span></li>
			<li><span class="filter" data-filter=".card">Card</span></li>
			<li><span class="filter" data-filter=".icon">Icon</span></li>
			<li><span class="filter" data-filter=".logo">Logo</span></li>
			<li><span class="filter" data-filter=".web">Web</span></li>
		</ul>

		<div id="portfoliolist" >
			
			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<a href="{{root}}public/images/2018/2/banane-large.jpg" class="js-smartPhoto" data-caption="bear" data-id="bear" data-group="animal">
					<img src="{{root}}public/images/2018/2/banane.jpg" />
					</a>
					<div class="label">
						<div class="label-text">
							<a class="text-title">Banane</a>
							
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				

			<div class="portfolio app" data-cat="app">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/app/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Visual Infography</a>
							<span class="text-category">APP</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>		
			
			<div class="portfolio web" data-cat="web">
				<div class="portfolio-wrapper">						
					<img src="img/portfolios/web/4.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Sonor's Design</a>
							<span class="text-category">Web design</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				
			
			<div class="portfolio card" data-cat="card">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/card/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Typography Company</a>
							<span class="text-category">Business card</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>	
						
			<div class="portfolio app" data-cat="app">
				<div class="portfolio-wrapper">
					<img src="img/portfolios/app/3.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Weatherette</a>
							<span class="text-category">APP</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>			
			
			<div class="portfolio card" data-cat="card">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/card/4.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">BMF</a>
							<span class="text-category">Business card</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>	
			
			<div class="portfolio card" data-cat="card">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/card/5.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Techlion</a>
							<span class="text-category">Business card</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>	
			
			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/logo/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">KittyPic</a>
							<span class="text-category">Logo</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																																							
			
			<div class="portfolio app" data-cat="app">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/app/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Graph Plotting</a>
							<span class="text-category">APP</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>														
			
			<div class="portfolio card" data-cat="card">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/card/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">QR Quick Response</a>
							<span class="text-category">Business card</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				

			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/logo/6.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Mobi Sock</a>
							<span class="text-category">Logo</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																	

			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/logo/7.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Village Community Church</a>
							<span class="text-category">Logo</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>													
			
			<div class="portfolio icon" data-cat="icon">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/icon/4.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Domino's Pizza</a>
							<span class="text-category">Icon</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>							

			<div class="portfolio web" data-cat="web">
				<div class="portfolio-wrapper">						
					<img src="img/portfolios/web/3.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Backend Admin</a>
							<span class="text-category">Web design</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																								

			<div class="portfolio icon" data-cat="icon">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/icon/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Instagram</a>
							<span class="text-category">Icon</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				
			
			<div class="portfolio web" data-cat="web">
				<div class="portfolio-wrapper">						
					<img src="img/portfolios/web/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Student Guide</a>
							<span class="text-category">Web design</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																	

			<div class="portfolio icon" data-cat="icon">
				<div class="portfolio-wrapper">
					<img src="img/portfolios/icon/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Scoccer</a>
							<span class="text-category">Icon</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																																																																

			<div class="portfolio icon" data-cat="icon">
				<div class="portfolio-wrapper">						
					<img src="img/portfolios/icon/5.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">3D Map</a>
							<span class="text-category">Icon</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>			
			
			<div class="portfolio web" data-cat="web">
				<div class="portfolio-wrapper">						
					<img src="img/portfolios/web/1.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Note</a>
							<span class="text-category">Web design</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>									
			
			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/logo/3.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Native Designers</a>
							<span class="text-category">Logo</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																	

			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/logo/4.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Bookworm</a>
							<span class="text-category">Logo</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																												
			
			<div class="portfolio icon" data-cat="icon">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/icon/3.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Sandwich</a>
							<span class="text-category">Icon</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>																								
			
			<div class="portfolio card" data-cat="card">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/card/3.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Reality</a>
							<span class="text-category">Business card</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>	

			<div class="portfolio logo" data-cat="logo">
				<div class="portfolio-wrapper">			
					<img src="img/portfolios/logo/2.jpg" alt="" />
					<div class="label">
						<div class="label-text">
							<a class="text-title">Speciallisterne</a>
							<span class="text-category">Logo</span>
						</div>
						<div class="label-bg"></div>
					</div>
				</div>
			</div>				
										
			
		</div>
		
		</section><div class="flex" style="float: left; width:100%">
						<a href="#0" class="bttn" >Voir tous les tableaux</a>
					</div>
			</div>
		<section id="latest" class="main-section second-section">
			<div class="container">
				<h1>Mon actualité</h1>
				<div class="row text-center">
					<div class="col-md-4 peaceplace">
						<div class="artdate">01/01/1972</div>
						<img src="{{root}}public/images/actu01.jpg" class="frontimage"/>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						
					</div>
				
					<div class="col-md-4 peaceplace">
						<div class="artdate">01/01/1971</div>
						<img src="{{root}}public/images/actu02.jpg" class="frontimage"/>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				
					<div class="col-md-4 peaceplace">
						<div class="artdate">01/01/1970</div>
						<img src="{{root}}public/images/actu03.jpg" class="frontimage"/>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					</div>
				</div>
				<a href="#0" class="bttn" >Toute l'actualité</a>
			</div>
						
					
		</section>
		
	{% endblock %}