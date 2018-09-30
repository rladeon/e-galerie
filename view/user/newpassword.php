{% extends 'frontend/template.php' %}
{% block content %}
<div class="container">
<p class="arianelink txtcenter"><i class="fa fa-home"></i>{{breadcrumb | raw}}</p>
	<div  class="row">
	{% if session.logged_in == false %}
		<div class="row">
			<div class="col-md-4">
			<p>Il faut se connecter pour avoir accès à cet espace</p>
			</div>
			<div class="col-md-4">
			<div class="flex">
						<a href="{{ root }}user/login" class="bttn" >Se connecter</a>
					</div>
			</div>
		</div>
		{% elseif error == true %}
		
		{{message}}
		
		{% else %}
		<div class="loader" style="display:none"></div>

		<div class="alert alert-success alert-dismissible" style="display: none" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
		</div>
		<div class="alert alert-danger alert-dismissible" role="alert" style="display: none">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
 		</div>
			<form role="form" method="post" id="user_passwordupdate">
				<div class="row">
					
					<div class="col-md-4">
					
						<div class="form-group">
							<div><label class="control-label">Ancien mot de passe </label></div>
							<input type="password" class="form-control" name="password" id="password" value=""/>

						</div>
						<div class="form-group">
							<label class="control-label">Nouveau mot de passe</label>
							<input type="password" class="form-control" name="newpassword" id="passwordmirror" value=""/>
						</div>						

					</div>
					</div>
					<button type="submit" class="bttn"  id="btnNewPassword">Envoyer →</button>
			</form>
				
				{% endif %}
	</div>
</div>

{% endblock %}