<script type="text/javascript">
function callQuickView(qurl) { 
	$.get(qurl, function(data) {
	  $.fancybox(data);
	});
}

$(document).ready(function() {
	 //$(".fancybox-n").click();
	 var isshow = localStorage.getItem('status');
	// alert(isshow);
     if (isshow == null || isshow == 'null') {
        localStorage.setItem('status', 1);
        // Show popup here
        $(".fancybox-n").click();
    }
	//localStorage.setItem('status', null);
});

/*$(document).ready(function() {
  $('.test-ajax-link1').magnificPopup({
	  type: 'ajax',
	  closeOnContentClick: false,
	  closeOnBgClick: false

	  // other options
  });
});*/

</script>

<script>
    $(document).ready(function(){
        $('#enquire_us').on('click',function(){
            $('.dropdown-menu').css({
                'display':'block'
            });
        });
    });
</script>
                    
<script type="text/javascript">
  $('input[name=\'top_filter_title\']').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#search-filter').trigger('click');
        }
    });
</script>

<script>
	$(document).ready(function(){
		var user_type = $("[name=type]:checked").val();
		if(user_type=='merchant')
		{
			$('#social_login').hide(); 
		}
		
		$("#hidden").click(function(){
		   $('#social_login').hide();
		});
		$("#visible").click(function(){
			$('#social_login').fadeIn();
		});
	});
</script>