<!DOCTYPE html>
<html>
  <head>
    <title>Admin e-galerie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- styles -->
    
	<link href="{{ root }}public/css/admin.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ root }}public/js/admin.js"></script>
    <script src="//cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.fr.min.js"></script>
  </head>
  <body>
  <div> 
<div class="s-layout">
<!-- Sidebar -->
<div class="s-layout__sidebar">
  <a class="s-sidebar__trigger" href="#0">
     <i class="fa fa-bars"></i>
  </a>

  <nav class="s-sidebar__nav">
     <ul>
        <li>
           <a class="s-sidebar__nav-link" href="{{root}}">
              <i class="fa fa-home"></i><em>Frontend</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link" href="{{root}}admin/booklist">
             <i class="fa fa-book"></i><em>Livres</em>
           </a>
        </li>
		<li>
           <a class="s-sidebar__nav-link" href="{{root}}admin/contentlist">
             <i class="fa fa-file-text"></i><em>Contenu</em>
           </a>
        </li>
		<li>
           <a class="s-sidebar__nav-link" href="{{root}}admin/exposurelist">
             <i class="fa fa-image"></i><em>Exposition</em>
           </a>
        </li>
        <li>
           <a class="s-sidebar__nav-link" href="{{root}}admin/medialist">
              <i class="fa fa-file-picture-o"></i><em>Média</em>
           </a>
        </li>
		<li>
           <a class="s-sidebar__nav-link" href="{{root}}invite/getall">
              <i class="fa fa-ticket"></i><em>Invitation</em>
           </a>
        </li>
		<li>
           <a class="s-sidebar__nav-link" href="{{root}}user/logout">
              <i class="fa fa-power-off"></i><em>Se déconnecter</em>
           </a>
        </li>
     </ul>
  </nav>
</div>

<!-- Content -->
<div class="container">
<main class="s-layout__content">
  
  {% block content %}{% endblock %}
</main>
</div>
		  
	
</div>
    <footer class="sticky-footer">
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2018 <a href="{{root}}">Website</a>
            </div>
            
         </div>
      </footer>
	</body>
</html>