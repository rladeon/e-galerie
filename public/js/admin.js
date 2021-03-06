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
$(function(){
	function after_updatebook(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnUpdateBook').show();
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

	$('#updatebook_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnUpdateBook').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			var update_data = $form.serializeArray();
			 var data = CKEDITOR.instances.description.getData();

			update_data.forEach(function (item) 
			{
				if (item.name === 'description') 
				{
					item.value = data;
				}
			});
			var id = $("#btnUpdateBook").data("id");
            $.ajax({
                type: "POST",
                url: '/e-galerie/book/update/id/'+id,
                data: $.param(update_data),
                success: after_updatebook,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_createbook(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnCreateBook').show();
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

	$('#createbook_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnCreateBook').hide();
		
			$(".loader").show();
			 var data = CKEDITOR.instances.description.getData();
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			var update_data = $form.serializeArray();
			
			update_data.forEach(function (item) 
			{
				if (item.name === 'description') 
				{
					item.value = data;
				}
			});

            $.ajax({
                type: "POST",
                url: '/e-galerie/book/create',
                data: $.param(update_data),
                success: after_createbook,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_deletebook(data) 
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
			window.location.replace("/e-galerie/admin/booklist");
		}
    }

	$('.deletebook').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			
			var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/e-galerie/book/delete/id/'+id,
                
                success: after_deletebook,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_createcontent(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnCreateContent').show();
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

	$('#createcontent_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnCreateContent').hide();
		
			$(".loader").show();
			 var data = CKEDITOR.instances.description.getData();
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			var update_data = $form.serializeArray();
			
			update_data.forEach(function (item) 
			{
				if (item.name === 'description') 
				{
					item.value = data;
				}
			});

            $.ajax({
                type: "POST",
                url: '/e-galerie/content/create',
                data: $.param(update_data),
                success: after_createcontent,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_updatecontent(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnUpdateContent').show();
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

	$('#updatecontent_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnUpdateContent').hide();
		
			$(".loader").show();
			 var data = CKEDITOR.instances.description.getData();
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			var update_data = $form.serializeArray();
			
			update_data.forEach(function (item) 
			{
				if (item.name === 'description') 
				{
					item.value = data;
				}
			});
			var id = $("#btnUpdateContent").data("id");

            $.ajax({
                type: "POST",
                url: '/e-galerie/content/update/id/'+id,
                data: $.param(update_data),
                success: after_updatecontent,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_deletecontent(data) 
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
			window.location.replace("/e-galerie/admin/contentlist");
		}
    }

	$('.deletecontent').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			
			var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/e-galerie/content/delete/id/'+id,
                
                success: after_deletecontent,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_createxposure(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnCreateXposure').show();
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

	$('#createxposure_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnCreateXposure').hide();
		
			$(".loader").show();
			 var data = CKEDITOR.instances.description.getData();
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			var update_data = $form.serializeArray();
			
			update_data.forEach(function (item) 
			{
				if (item.name === 'description') 
				{
					item.value = data;
				}
			});

            $.ajax({
                type: "POST",
                url: '/e-galerie/exposure/create',
                data: $.param(update_data),
                success: after_createxposure,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_updatexposure(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnUpdateXposure').show();
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

	$('#updatexposure_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnUpdateXposure').hide();
		
			$(".loader").show();
			 var data = CKEDITOR.instances.description.getData();
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			var update_data = $form.serializeArray();
			
			update_data.forEach(function (item) 
			{
				if (item.name === 'description') 
				{
					item.value = data;
				}
			});
			var id = $("#btnUpdateXposure").data("id");

            $.ajax({
                type: "POST",
                url: '/e-galerie/exposure/update/id/'+id,
                data: $.param(update_data),
                success: after_updatexposure,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_deletexposure(data) 
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
			window.location.replace("/e-galerie/admin/exposurelist");
		}
    }

	$('.deletexposure').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			
			var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/e-galerie/exposure/delete/id/'+id,
                
                success: after_deletexposure,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_updatemedia(data) 
    {
		$(".loader").css("display", "none");
		$("body").css("background-color", "white");
		$('#btnUpdateMedia').show();
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

	$('#updatemedia_form').on('submit', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		$('#btnUpdateMedia').hide();
		
			$(".loader").show();
			
			$("body").css("background-color", "#f2ebea");
			$form = $(this);
			
			var id = $("#btnUpdateMedia").data("id");

            $.ajax({
                type: "POST",
                url: '/e-galerie/media/updatemedia/id/'+id,
                data: $form.serialize(),
                success: after_updatemedia,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_deletemedia(data) 
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
			window.location.replace("/e-galerie/admin/medialist");
		}
    }

	$('a.deletemedia').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		
			$(".loader").show();
						
			$("body").css("background-color", "#f2ebea");
			
			var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: '/e-galerie/media/delete/id/'+id,
                
                success: after_deletemedia,
                dataType: 'json' 
            }); 
			
	
	});
});
$(function(){
	function after_deleteinvite(data) 
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
			window.location.replace("/e-galerie/invite/getall");
		}
    }

	$('a.deleteinvite').on('click', function(e)
      {
		e.preventDefault();
		$('.alert-success').hide();
        $('.alert-danger').hide();
		
			$(".loader").show();			
			
			$("body").css("background-color", "#f2ebea");
			
			var id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: '/e-galerie/invite/delete/id/'+id,
                
                success: after_deleteinvite,
                dataType: 'json' 
            }); 
			
	
	});
});