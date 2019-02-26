<script type="text/javascript">
    $(document).ready(function(){

        // User enquiry button click open pop up
        $(document).on('click', '.userEnquiryClick', function(){

            $('#enq_client').val($(this).attr('id'));

            // Open pop up on click button
            $('#userEnquiryModal').modal('show');
        });

        // Open enquiry form on click multiple enquiry button
        $(document).on('click', '.multiple_enquiries', function(){

            // Change form action to multiple enquiries
            $('#userEnquiryModal form').attr('action', '{{ route("send_multiple_enquiries") }}');
            
            $('#enq_client').val($(this).attr('id'));

            // Open pop up on click button
            $('#userEnquiryModal').modal('show');
        });

        // Back button
        $('.back').click(function(){
          $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });

        // Working hours time disable by defaul
        //$(".time_0").attr("disabled", true);

        // Email field will not be change
        $("#userEmail").attr("readonly", true);

        // Login box drop down
        $('#enquire_us').on('click',function(){
            $('.dropdown-menu').css({
                'display':'block'
            });
        });

        // Dual time hide and show
        $("#dual_time").click(function() {
            $("#dual_time_show").toggle();
        });

        // Disable and enable working hours
        $(".hour_operation").click(function(){
            var hour = $(this).val();
            if(hour == 1){
               $(".time_0").removeAttr('disabled', false);
            }
            else{
              $(".time_0").attr("disabled", true);
            }
        });

        // Onclick closed button corresponding from time and to time  value closed selected
        $(".closed").on('change', function(){

          var id = $(this).attr('id');
          var temp = id.split('_');

          if($(this).is(":checked"))
          {
            $('select[id="from_time_'+temp[1]+'"] option[value="closed"]').prop("selected", true);
            $('select[id="to_time_'+temp[1]+'"] option[value="closed"]').prop("selected", true);
          }
          else
          {
            $('select[id="from_time_'+temp[1]+'"] option[value="closed"]').prop("selected", false);
            $('select[id="to_time_'+temp[1]+'"] option[value="closed"]').prop("selected", false);
          }

        });

        // Select payment mode
        $(document).on('change', '.checkAll', function(){
          var value = $(this).val();

          if(value == 0)
          {
            if($(this).is(":checked"))
            {
              $(".payment_mode").prop('checked', true);
            }
            else
            {
              $(".payment_mode").prop('checked', false);
            }
          }

        });

        // view all related links
        $(document).ready(function(){
            $("#hide_related_link").on('click',function(){
                $(".hide_related_link").removeClass('hide_related_link');
                $("#hide_related_link").hide();
            });
        });
    });
</script>
