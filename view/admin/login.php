<!DOCTYPE html>
<html>
  <head>
    <title>Admin e-galerie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body style="background-color: #333">
		<div class="container">
			<h1 style="color:white"> Administration d'e-galerie</h1>
			<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
			</div>
<div class="row">
				<div class="col-md-3">
					<form role="form" method="post" id="login_form"   >
						<div class="form-group">
							<label class="control-label">identifiant</label>
							<input type="text" class="form-control" name="username" id="username"/>
						</div>
						<div class="form-group">
							<label class="control-label">Mot de passe</label>
							<input type="password" class="form-control" name="password" id="password"/>
						</div>
						<button type="submit" class="btn btn-primary"  id="btnLogin">Envoyer →</button>&nbsp;&nbsp;<a href="{{root}}" class="btn btn-info"> Retour sur le site</a>
					</form>
				</div>
				
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ root }}public/js/admin.js"></script>
	</body>
</html>