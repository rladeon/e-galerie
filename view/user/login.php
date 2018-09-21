{% extends 'frontend/template.php' %}
{% block content %}
<div class="container-fluid">
	<div id="page-login" class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="text-right">
				<a href="{{root}}user/account" class="txt-default">Créer un compte?</a>
			</div>
			<div class="box">
				<div class="box-content">
					<div class="text-center">
						<h3 class="page-header">Se connecter</h3>
					</div>
					<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
</div>
<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
  
</div>
					<form role="form" method="post" id="login_form"   >
						<div class="form-group">
							<label class="control-label">identifiant</label>
							<input type="text" class="form-control" name="username" id="username"/>
						</div>
						<div class="form-group">
							<label class="control-label">Mot de passe</label>
							<input type="password" class="form-control" name="password" id="password"/>
						</div>
						<button type="submit" class="bttn"  id="btnContactUs">Envoyer →</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
{% endblock %}