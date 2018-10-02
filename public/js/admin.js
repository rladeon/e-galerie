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