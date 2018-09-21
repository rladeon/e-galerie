$(function()
{
    function after_login_submitted(data) 
    {
		if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);
            
            $('.alert-success').hide();
            $('.alert-danger').show();
              
        }
		else
		{
			window.location.replace("/e-galerie/admin/index");
		}
    }

	$('#login_form ').on('submit', function(e)
      {
		  e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		var u = $('#username').val();
		var p = $('#password').val();
		if(u == "")
		{
			$('.alert-danger').html("Il manque l'identifiant");
            
            $('.alert-success').hide();
            $('.alert-danger').show();
		}
		else if(p== "")
		{
			$('.alert-danger').html("Il manque le mot de passe");
            
            $('.alert-success').hide();
            $('.alert-danger').show();
		}
		else
		{
		
			$form = $(this);
        
            $.ajax({
                type: "POST",
                url: '/e-galerie/user/verify/access/admin',
                data: $form.serialize(),
                success: after_login_submitted,
                dataType: 'json' 
            }); 
		}			
        
      });	
});