
//alert(document.domain);

var site_url = 'http://savetk.com/';
//var site_url = 'http://localhost/savetk/';


$(document).ready(function() {
	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
	
	docReady();
	
});


function docReady(){
	
	$('input.mobile').keyup(function() {
		$(this).val($(this).val().replace(/[^-\d]/, ''));	
		var len = $(this).val().length;
		if (len == 5) {
		   //$(this).val($(this).val() + "-");
		}
	});
	
	$(".delete").on("click",function(){
		//alert(11);
		var url = $(this).attr('href');
			bootbox.confirm("Are you sure you want to delete?", function(result) {
			if (result) {				
				location.replace(url);
			}
		});	
		return false;	
	});
		
	$(".confirm").on("click",function(){
		var url = $(this).attr('href');
			bootbox.confirm("Are you sure?", function(result) {
			if (result) {				
				location.replace(url);
			}
		});	
		return false;	
	});
	
	 //$(".pull-right .btn").tooltip();
	 $(".btn").tooltip();
	 $(".doc_gallery").tooltip();
	
}



/***----For Coupon----***/
function viewCount(coupon_id)
{
	var dataString = 'coupon_id='+ coupon_id;
	
    $.ajax
	({
		url: site_url+'home/viewcount',
		type: "POST",
		data: dataString,
		dataType: 'json',
		beforeSend: function() {

			//$('.get_code').after('<span class="wait">&nbsp;<img src="<?=base_url()?>asset/image/loading.gif" alt="" /></div>');
		},

		complete: function() {
			$('.wait').remove();
		},
		
		success: function(json)
		{	
			//$('[name=state_id]').html(json['output']);
			/*if(json['reference_link']){
				window.open(json['reference_link'])
			}*/
		},
		
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
		
	});
}

function totalGetCount(coupon_id)
{
	var dataString = 'coupon_id='+ coupon_id;
	//alert(dataString);
    $.ajax
	({
		url: site_url+'home/totalget',
		type: "POST",
		data: dataString,
		dataType: 'json',
		beforeSend: function() {

			//$('.get_code').after('<span class="wait">&nbsp;<img src="<?=base_url()?>asset/image/loading.gif" alt="" /></div>');
		},

		complete: function() {
			$('.wait').remove();
		},
		
		success: function(json)
		{	
			//$('[name=state_id]').html(json['output']);
			if(json['reference_link']){
				//window.open(json['reference_link'])
			}
		},
		
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
		
	});
}

//cutomer to merchant


var couponToWishlist = {
	
	
	'add': function(coupon_id) {
		$.ajax({
			url: site_url+'cwishlist/addCouponToWishlist',
			type: "POST",
			data: 'coupon_id=' + coupon_id,
			dataType: 'json',
		  
			success: function(json)
			{
				$('.alert').remove();
				
				//$('.vendor-favourite').addClass('vendor-favourite-added');
																	
				
				/*if(json['info_login']){
					$('#myLogin').modal();
				}*/
				
				if(json['info_login'])
				{
					//alert(json['info']);
					$('#message').html('<div class="alert alert-warning"><i class="fa fa-info-circle"></i> '+json['info_login']+' <button class="close" data-dismiss="alert" type="button">&times;</button></div>');
				}
				
				if(json['info'])
				{
					//alert(json['info']);
					$('#message').html('<div class="alert alert-warning"><i class="fa fa-info-circle"></i> '+json['info']+' <button class="close" data-dismiss="alert" type="button">&times;</button></div>');
				}
				
				if(json['success'])
				{
					$('#message').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Success: '+json['success']+' <button data-dismiss="alert" class="close" type="button">&times;</button></div>');
					$('#star-icon-'+coupon_id).addClass('active');
					$('#wish-list-total').html('<span class="glyphicon glyphicon-list"></span> Wish List ('+json["total"]+')');
				}
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
				
				//location.reload();
				//window.location.href = "<?=$merchant_info['shop_slug']?>";
			}
		});
		
	},
	
	'remove': function(coupon_id) {
		
		
	}
}

$('#myLogin').on('shown', function() {
    // remove previous timeouts if it's opened more than once.
    clearTimeout(myModalTimeout);

    // hide it after a minute
    myModalTimeout = setTimeout(function() {
        $('#myLogin').modal('hide');
    }, 6e4);
});





