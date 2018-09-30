$(function()
{
    function after_form_submitted(data) 
    {
		if(data.result == 'form')
		{
			$('#error_message').html(data.errors);
			$('#error_message').show();
			$('#success_message').hide();
			$btn.text('Envoyer');
		}
		else if(data.result == 'captcha')
		{
			$('#error_message').html(data.errors);
			$('#error_message').show();
			$('#success_message').hide();
			$btn.text('Envoyer');
		}
        else if(data.result == 'success')
        {
			$('#success_message').html("<h3>Le message a été envoyé !</h3>");
            $('form#reused_form').hide();
            $('#success_message').show();
            $('#error_message').hide();
			
        }
        else
        {
            $('#error_message').append('<ul></ul>');

            jQuery.each(data.errors,function(key,val)
            {
                $('#error_message ul').append('<li>'+key+':'+val+'</li>');
            });
            $('#success_message').hide();
            $('#error_message').show();

            //reverse the response on the button
            $('button[type="button"]', $form).each(function()
            {
                $btn = $(this);
                label = $btn.prop('orig_label');
                if(label)
                {
                    $btn.prop('type','submit' ); 
                    $btn.text(label);
                    $btn.prop('orig_label','');
                }
            });
            
        }//else
    }

	$('#reused_form').on('click', function(e)
      {
        e.preventDefault();
		$('#success_message').hide();
        $('#error_message').hide();
        $form = $(this);
        //show some response on the button
        $('button[type="submit"]', $form).each(function()
        {
            $btn = $(this);
            $btn.prop('type','button' ); 
            $btn.prop('orig_label',$btn.text());
            $btn.text('Message envoyé');
        });
        

            $.ajax({
                type: "POST",
                url: '/e-galerie/contact/handler',
                data: $form.serialize(),
                success: after_form_submitted,
                dataType: 'json' 
            });        
        
      });	
});
$(function()
{
    function after_login_submitted(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);
            
            $('.alert-success').hide();
            $('.alert-danger').show();
              
        }
		else
		{
			window.location.replace("/e-galerie/user/account");
		}
    }

	$('#login_form').on('submit', function(e)
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
			$(".loader").show();
			$("body").css("background-color", "#f2ebea");
			$("body").css("opacity", 0.8);
		
			$form = $(this);
        
            $.ajax({
                type: "POST",
                url: '/e-galerie/user/verify',
                data: $form.serialize(),
                success: after_login_submitted,
                dataType: 'json' 
            }); 
		}	       
        
      });	
});
$(function(){
	function after_reservation_submitted(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('a#reservation').show();
		if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);
            
            $('.alert-success').hide();
            $('.alert-danger').show();
              
        }
		else
		{
			window.location.replace("/e-galerie/user/reservation");
		}
    }

	$('#reservation').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('a#reservation').hide();
		
			$(".loader").show();
			var id = $("#reservation").data("id");
			$("body").css("background-color", "#f2ebea");
			$("body").css("opacity", 0.8);
		$.ajax({
                type: "POST",
                url: '/e-galerie/exposure/confirmreservation/id/'+id,
                
                success: after_reservation_submitted,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_reservation_submitted(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('a#cancelreservation').show();
		if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);
            
            $('.alert-success').hide();
            $('.alert-danger').show();
              
        }
		else
		{
			window.location.replace("/e-galerie/exposure/index");
		}
    }

	$('#cancelreservation').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('a#cancelreservation').hide();
		
			$(".loader").show();
			var id = $(this).data("id");
			$("body").css("background-color", "#f2ebea");
			$("body").css("opacity", 0.8);
		$.ajax({
                type: "POST",
                url: '/e-galerie/exposure/cancel/id/'+id,
                
                success: after_reservation_submitted,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_cancelreservation(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('a.cancelreservation').show();
		if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);
            
            $('.alert-success').hide();
            $('.alert-danger').show();
              
        }
		else
		{
			window.location.replace("/e-galerie/user/reservation");
		}
    }

	$('.cancelreservation').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('a.cancelreservation').hide();
		
			$(".loader").show();
			var id = $(this).data("id");
			$("body").css("background-color", "#f2ebea");
			$("body").css("opacity", 0.8);
		$.ajax({
                type: "GET",
                url: '/e-galerie/reservation/delete/id/'+id,
                
                success: after_cancelreservation,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_user_refresh(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnUserRefresh').show();
		 if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);            
            $('.alert-success').hide();
            $('.alert-danger').show();              
        }
		else
		{
			$('.alert-success').html(data.message);            
            $('.alert-success').show();
            $('.alert-danger').hide();
		}
    }

	$('#user_refresh').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnUserRefresh').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
        
            $.ajax({
                type: "POST",
                url: '/e-galerie/user/update',
                data: $form.serialize(),
                success: after_user_refresh,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_send_password(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnPasswordForgotten').show();
		 if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);            
            $('.alert-success').hide();
            $('.alert-danger').show();              
        }
		else
		{
			$('.alert-success').html(data.message);            
            $('.alert-success').show();
            $('.alert-danger').hide();
		}
    }

	$('#forget_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnPasswordForgotten').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
        
            $.ajax({
                type: "POST",
                url: '/e-galerie/user/sendpassword',
                data: $form.serialize(),
                success: after_send_password,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_newaccount(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnNewAccount').show();
		 if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);            
            $('.alert-success').hide();
            $('.alert-danger').show();              
        }
		else
		{
			$('.alert-success').html(data.message);            
            $('.alert-success').show();
            $('.alert-danger').hide();
		}
    }

	$('#user_newaccount').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnNewAccount').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
        
            $.ajax({
                type: "POST",
                url: '/e-galerie/user/savenewaccount',
                data: $form.serialize(),
                success: after_newaccount,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_newpassword(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnNewPassword').show();
		 if(data.result == 'error')
        {               
            $('.alert-danger').html(data.errors);            
            $('.alert-success').hide();
            $('.alert-danger').show();              
        }
		else
		{
			$('.alert-success').html(data.message);            
            $('.alert-success').show();
            $('.alert-danger').hide();
		}
    }

	$('#user_passwordupdate').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnNewPassword').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
        
            $.ajax({
                type: "POST",
                url: '/e-galerie/user/passwordupdate',
                data: $form.serialize(),
                success: after_newpassword,
                dataType: 'json' 
            }); 
			
	
	});
});

