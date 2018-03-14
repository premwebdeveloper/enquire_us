@extends('layouts.public_app')
@section('content')

  <style>
    .form-horizontal .control-label{ text-align: left; }
    .tab-content .tab-pane { padding: 0px 0!important; }
    #dual_time_show{ display:none;}
    .tabs-wrap { margin-top: 40px;}
    .tab-content .tab-pane { padding: 20px 0;}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{ background: #eaeaea; }
    .p0{padding: 0px;}
    .red{color:red;}
  </style>

  <script type="text/javascript">
    $(document).ready(function(){

    // Update user location
    $(document).on("click", "#location_submit", function(e){
        e.preventDefault();

        var valid = $("#myForm").validationEngine("validate", {promptPosition : "topLeft"});
        if(valid==true)
        {
            var user_id = $('.user_id').val();
            var business_name = $('#business_name').val();
            var building = $('#building').val();
            var street = $('#street').val();
            var landmark = $('#landmark').val();
            var area = $('#area').val();
            var city = $('#city').val();
            var pin_code = $('#pin_code').val();
            var state = $('#state').val();
            var country = $('#country').val();

            $.ajax({
                method : 'post',
                url : 'update_location_info',
                async : true,
                    data : {"_token": "{{ csrf_token() }}", 'user_id': user_id, 'business_name': business_name, 'building': building, 'street': street, 'landmark': landmark, 'area': area, 'city': city, 'pin_code': pin_code, 'state': state, 'country': country},
                      success:function(response){

                        console.log('response');
                        console.log(response);
                        $(window).scrollTop(0);
                      },
                    error: function(data){
                    console.log(data);
                },
            });

          $('.continue').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
          });

        }
    });

    // Contact Information
    $(document).on("click", "#contact_update", function(e){
        e.preventDefault();

        var valid = $("#contact_info").validationEngine("validate", {promptPosition : "topLeft"});

        if(valid==true)
        {
          var user_id = $('.user_id').val();
          var contact_person = $('#contact_person').val();
          var landline = $('#landline').val();
          var mobile = $('#mobile').val();
          var fax = $('#fax').val();
          var fax2 = $('#fax2').val();
          var toll_free = $('#toll_free').val();
          var toll_free2 = $('#toll_free2').val();
          var email = $('#email').val();
          var website = $('#website').val();

          $.ajax({
            method : 'post',
            url : 'update_contact_info',
            async : true,
                    data : {"_token": "{{ csrf_token() }}", 'user_id': user_id, 'contact_person': contact_person, 'landline': landline, 'mobile': mobile, 'fax': fax, 'fax2': fax2, 'toll_free': toll_free, 'toll_free2': toll_free2, 'email': email, 'website': website},
                      success:function(response){

                        console.log('response');
                        console.log(response);
                        $(window).scrollTop(0);
                      },
              error: function(data){
                  console.log(data);
              },
          });

          $('.continue').click(function(){
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
          });

        }
    });

    // Update other informations
    $(document).on('click', '#updateOtherInformation', function(){
        var data = $('#other_information_form').serialize();

        var user_id = $("#current_user_id").val();
        var establishment_year = $("#establishment_year").val();
        var annual_turnover = $("#annual_turnover").val();
        var number_employees = $("#number_employees").val();
        var professional_association = $("#professional_association").val();
        var certification = $("#certification").val();

        var from_time = [];
        $(".from_time option:selected").each(function () {
            from_time.push($(this).val());
        });

        var to_time = [];
        $(".to_time option:selected").each(function () {
            to_time.push($(this).val());
        });

        var payment_mode = [];
        $('input.payment_mode:checkbox:checked').each(function () {
            payment_mode.push($(this).val());
        });

        $.ajax({
          method : 'post',
          url : 'update_other_info',
          async : true,
          data : {"_token": "{{ csrf_token() }}", 'user_id': user_id, 'establishment_year': establishment_year, 'annual_turnover': annual_turnover, 'number_employees': number_employees, 'professional_association': professional_association, 'certification': certification, 'from_time': from_time, 'to_time': to_time, 'payment_mode': payment_mode},
          success:function(response){

            alert(response.message);

          },
          error: function(data){
              console.log(data);
          }
        });

    });

    // Select State
    $(document).on("change", "#city", function(){
          var city = $('#city').val();
          //alert(city);
          if(city == '')
          {
            $("#pin_code").html('');
            $("#pin_code").html('<option value="">Select Pincode</option>');
            $("#pin_code").attr('disabled', 'disabled');
          }
          else
          {
            $.ajax({
                method: 'post',
                url: 'getPincodeByCityForUser',
                data: {"_token": "{{ csrf_token() }}", 'city' : city},
                async: true,
                success: function(response){

                  console.log(response);

                    var states = '';
                    $.each(response, function(i, item) {
                    states += '<option value="'+item.id+'">'+item.pincode+'</option>';
                })

                $("#pin_code").html('');
                $("#pin_code").html(states);
                $("#pin_code").removeAttr('disabled');
                },
                error: function(data){
                    console.log(data);
                },
            });
        }
    });

    // Copy timing from monday to sunday shift 1
    $(document).on('click', '.timing', function(){
        var id = $(this).attr('id');

        if(id == 'timing1')
        {
          var from_time = $("#from_time_1").val();
          var to_time = $("#to_time_1").val();

          if($("#close_1").is(":checked"))
          {
            $(".closed1").prop('checked', true);
          }
          else
          {
            $(".closed1").prop('checked', false);
          }

          $(".timing_one_from_time [value='"+from_time+"']").prop('selected', true);
          $(".timing_one_to_time [value='"+to_time+"']").prop('selected', true);

        }
        else if(id == 'timing2')
        {
          var from_time = $("#from_time_8").val();
          var to_time = $("#to_time_8").val();

          if($("#close_8").is(":checked"))
          {
            $(".closed2").prop('checked', true);
          }
          else
          {
            $(".closed2").prop('checked', false);
          }

          $(".timing_two_from_time [value='"+from_time+"']").prop('selected', true);
          $(".timing_two_to_time [value='"+to_time+"']").prop('selected', true);
        }

    });

    });
  </script>

  <div id="main" class="site-main">
      <div class="container">

          @if(session('status'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
          @endif

        <div class="row">

        	<div class="col-sm-3">
            		<div class="box">
            			<div class="list-group sidebar-nav">
            			  <ul class="nav nav-tabs" role="tablist">

                      <li role="presentation" class="active" id="dashboard_menu">
                        <a href="#dashboard" class="list-group-item" aria-controls="dashboard" role="tab" data-toggle="tab" aria-expanded="true">
                          <i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span>
                        </a>
                      </li>

                      <li id="location_menu">
                         <a href="#location" class="list-group-item" aria-controls="location" role="tab" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-map-marker fa-fw"></i> <span>Location Information</span>
                        </a>
                      </li>

                      <li id="contact_menu">
                         <a href="#contact" class="list-group-item" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-phone fa-fw"></i> <span>Contact Information</span>
                        </a>
                      </li>

                      <li id="other_menu">
                         <a href="#other" class="list-group-item" aria-controls="other" role="tab" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-cog fa-fw"></i> <span>Other Information</span>
                        </a>
                      </li>

                      <li id="business_menu">
                         <a href="#business" class="list-group-item" aria-controls="business" role="tab" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-cog fa-fw"></i> <span>Business Keywords</span>
                        </a>
                      </li>

                      <li id="keyword_menu">
                         <a href="#add_keywords" class="list-group-item text-center" role="tab" data-toggle="tab" style="color: #a59898;">
                            <i class="fa fa-arrow-right fa-fw"></i> <span>Add Keywords</span>
                        </a>
                      </li>

                      <li id="logo_menu">
                         <a href="#uploads_video" class="list-group-item" aria-controls="uploads_video" role="tab" data-toggle="tab" aria-expanded="false">
                          <i class="fa fa-photo fa-fw"></i> <span>Uploads Logo/Pictures</span>
                        </a>
                      </li>

                    </ul>
            			</div>
            		</div>
        	</div>

            <div class="col-sm-9">
                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane active" id="location">
                        <div class="col-sm-10 edit_profile">
                          <div class="box">

                              <form action="javascript:;" method="post" accept-charset="utf-8" id="myForm" class="form-horizontal" enctype="multipart/form-data">

                                <input type="hidden" name="user_id" class="user_id" value="{{ $location->user_id }}">
                                <fieldset>
                                  <div class="controls">

                                    <div class="form-group">
                                      <label for="Name" class="col-sm-4 control-label">Business Name: </label>
                                      <div class="col-sm-6">
                                          <input class="form-control" name="business_name" id="business_name" type="text" value="{{ $location->business_name }}">
                                       </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Email" class="col-sm-4 control-label">Building: </label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="building" id="building" value="{{ $location->building }}">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="controls">

                                    <div class="form-group">
                                      <label for="Address" class="col-sm-4 control-label">Street: </label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="street" id="street" value="{{ $location->street }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Country" class="col-sm-4 control-label">Landmark:</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="landmark" id="landmark" value="{{ $location->landmark }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Country" class="col-sm-4 control-label">Area:</label>
                                      <div class="col-sm-6">
                                       <input class="form-control" name="area" id="area" value="{{ $location->area }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="City" class="col-sm-4 control-label">Country:</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="country" id="country" value="India" readonly>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="State" class="col-sm-4 control-label">State/Region: </label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="state" id="state" value="Rajasthan" readonly>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Country" class="col-sm-4 control-label">City:</label>
                                      <div class="col-sm-6">
                                        <select class="form-control" name="city" id="city">
                                          @foreach($cities as $city)
                                            <option value="{{$city->name}}"> {{$city->name}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group required">
                                      <label for="Country" class="col-sm-4 control-label">Pin Code:</label>
                                      <div class="col-sm-6">
                                        <select name="pin_code" id="pin_code" class="validate[required] form-control">
                                            <option value="">Select Pincode</option>
                                        </select>
                                      </div>
                                    </div>

                                  </div>

                                  <div class="buttons">
                                    <div class="right">
                                      <label class="checkbox-inline">
                                        <a class="btn btn-primary continue" id="location_submit" data-original-title="" title="">Next</a>
                                      </label>
                                    </div>
                                  </div>

                                </fieldset>
                              </form>
                          </div>
                        </div>
                        <a class=""></a>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="contact">
                        <div class="col-sm-10 edit_profile">
                          <div class="box">
                              <form action="javascript:;" method="post" accept-charset="utf-8" id="contact_info" class="form-horizontal" enctype="multipart/form-data">

                                <input type="hidden" name="user_id" class="user_id" value="{{ $location->user_id }}">

                                <fieldset>
                                  <div class="controls">

                                    <div class="form-group">
                                      <label for="Name" class="col-sm-4 control-label">Contact Person: </label>
                                      <div class="col-sm-6">
                                          <input class="form-control" name="contact_person" id="contact_person" type="text" value="{{ $contact->name }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Email" class="col-sm-4 control-label">Landline No: </label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="landline" id="landline" value="{{ $contact->landline }}">
                                      </div>
                                    </div>

                                  </div>

                                  <div class="controls">

                                    <div class="form-group">
                                      <label for="Address" class="col-sm-4 control-label">Mobile No: </label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="mobile" id="mobile" value="{{ $contact->phone }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Country" class="col-sm-4 control-label">Fax No:</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="fax" id="fax" value="{{ $contact->fax1 }}">
                                      </div>
                                    </div>

                                    <div class="form-group ">
                                      <label for="Country" class="col-sm-4 control-label">Fax No 2:</label>
                                      <div class="col-sm-6">
                                       <input class="form-control" name="fax2" id="fax2" value="{{ $contact->fax2 }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Country" class="col-sm-4 control-label">Toll Free No:</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="toll_free" id="toll_free" value="{{ $contact->toll_free1 }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="Country" class="col-sm-4 control-label">Toll Free No 2:</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="toll_free2" id="toll_free2" value="{{ $contact->toll_free2 }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="State" class="col-sm-4 control-label">Email ID </label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="email" id="userEmail" value="{{ $contact->email }}">
                                      </div>
                                    </div>

                                    <div class="form-group">
                                      <label for="City" class="col-sm-4 control-label">Website:</label>
                                      <div class="col-sm-6">
                                        <input class="form-control" name="website" id="website" value="{{ $contact->website }}">
                                      </div>
                                    </div>

                                  </div>

                                  <div class="buttons">
                                    <div class="left">
                                      <label class="checkbox-inline">
                                        <a class="btn btn-primary back" data-original-title="" title="">Prev</a>
                                      </label>
                                    </div>
                                    <div class="right">
                                      <label class="checkbox-inline">
                                        <a class="btn btn-primary continue" data-original-title="" id="contact_update">Next</a>
                                      </label>
                                    </div>
                                  </div>

                                  </fieldset>
                              </form>
                          </div>
                        </div>
                        <a class=""></a>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="other">
                      <div class="col-sm-10 edit_profile">
                      <div class="box">

                        <h4>Hours of Operation</h4>
                            <form action="javascript:;" method="post" id="other_information_form" class="form-horizontal">
                                <fieldset>
                                  <input type="hidden" name="user_id" class="user_id" id="current_user_id" value="{{ $location->user_id }}">

                                  <p>
                                    <input type="radio" value="1" name="other" class="hour_operation"> Display hours of operation
                                    <input type="radio" value="2" name="other" class="hour_operation" checked> Do not display hours of operation
                                  </p>

                                  <div class="controls">

                                    <?php
                                    $i = 1;
                                    foreach ($other as $key => $time)
                                    {
                                      $timimg_from_time = 'timing_one_from_time';
                                      $timimg_to_time = 'timing_one_to_time';
                                      $timing_closed = "closed1";

                                      if($i > 7)
                                      {
                                        $timimg_from_time = 'timing_two_from_time';
                                        $timimg_to_time = 'timing_two_to_time';
                                        $timing_closed = "closed2";
                                      }

                                      if($key == 7)
                                      {
                                          ?>
                                          <a href="javascript:;" id="dual_time">
                                            <h5 style="color: #de4b39;">Click Here For Dual Timings</h5>
                                          </a>
                                          <div id="dual_time_show">
                                          <?php
                                      }
                                      if($time->working_status == 0)
                                      {
                                        $checked = 'checked="checked"';
                                        $selected = 'selected="selected"';
                                      }
                                      else
                                      {
                                        $checked = '';
                                        $selected = '';
                                      }

                                      $from_time = $time->from_time;

                                      if(!is_null($from_time))
                                      {
                                        $from_time = explode(":", $from_time);
                                        $from_time = $from_time[0].':'.$from_time[1];
                                      }
                                      else
                                      {
                                        $from_time = '00:00';
                                      }

                                      $to_time = $time->to_time;

                                      if(!is_null($to_time))
                                      {
                                        $to_time = explode(":", $to_time);
                                        $to_time = $to_time[0].':'.$to_time[1];
                                      }
                                      else
                                      {
                                        $to_time = '00:00';
                                      }

                                          ?>
                                          <div class="form-group">
                                              <label for="Name" class="col-sm-2 control-label">{{$time->day}} : </label>
                                              <div class="col-sm-3">
                                                <select id="from_time_{{$i}}" name="from_time[]" class="form-control time_0 from_time <?= $timimg_from_time; ?>">
                                                  <option value="{{$from_time}}">{{$from_time}}</option>
                                                  <!-- <option value="00:00"> Open 24 Hrs </option> -->
                                                  <option value="00:00"> 00:00 </option>
                                                  <option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="closed" <?= $selected; ?>> Closed </option>
                                                </select>
                                              </div>
                                              <label for="Name" class="col-sm-1 control-label">To: </label>
                                              <div class="col-sm-3">
                                                <select id="to_time_{{$i}}" name="to_time[]" class="form-control time_0 to_time <?= $timimg_to_time; ?>">
                                                  <option value="{{$to_time}}">{{$to_time}}</option>
                                                  <!-- <option value="00:00"> Open 24 Hrs </option> --><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="closed" <?= $selected; ?>> Closed </option></select>
                                              </div>
                                              <div class="col-sm-3">
                                                <input type="checkbox" value="{{$time->working_status}}" name="other" id="close_{{$i}}" class="closed <?= $timing_closed; ?>" <?= $checked; ?>> <label for="Name" class="control-label">Closed</label>
                                              </div>
                                          </div>
                                          <?php
                                          if($key == 6)
                                          {
                                            ?>
                                            <a href="javascript:;" id="timing1" class="timing">Copy Timings from Monday to Saturday</a>
                                            <?php
                                          }

                                        $i++;
                                    }
                                    ?>
                                    <a href="javascript:;" id="timing2" class="timing">Copy Timings from Monday to Saturday</a>
                                    </div>

                                    <script type="text/javascript">
                                      $(document).ready(function(){
                                        $(".closed[type='checkbox'][value='0']").prop('checked', true);
                                      });
                                    </script>

                                  <hr />

                                  <h4>Payment Modes Accepted By You</h4>

                                  <div class="form-group required">

                                    <?php
                                    $payment_mode = $company->payment_mode;
                                    if(!empty($payment_mode))
                                    {
                                      $payment_mode = explode('|', $payment_mode);

                                      foreach ($payment_mode as $mode) {
                                        ?>
                                        <script type="text/javascript">
                                          $(document).ready(function(){
                                            $(".payment_mode[type='checkbox'][value='<?= $mode; ?>']").prop('checked', true);
                                          });
                                        </script>
                                        <?php
                                      }
                                    }
                                    ?>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="0" class="checkAll">
                                      <span style="color:#de4b39;">Select All</span>
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="1" name="payment_mode[]" class="payment_mode"> Cash
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="2" name="payment_mode[]" class="payment_mode"> Master Card
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="3" name="payment_mode[]" class="payment_mode"> Visa Card
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="4" name="payment_mode[]" class="payment_mode"> Debit Cards
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="5" name="payment_mode[]" class="payment_mode"> Money Orders
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="6" name="payment_mode[]" class="payment_mode"> Cheques
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="7" name="payment_mode[]" class="payment_mode"> Credit Card
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="8" name="payment_mode[]" class="payment_mode"> Travelers Cheque
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="9" name="payment_mode[]" class="payment_mode"> Financing Available
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="10" name="payment_mode[]" class="payment_mode"> American Express Card
                                    </div>

                                    <div class="col-sm-4">
                                      <input type="checkbox" value="11" name="payment_mode[]" class="payment_mode"> Diners Club Card
                                    </div>

                                  </div>

                                  <hr />

                                  <h4>Company Information</h4>

                                    <div class="form-group required">
                                      <label for="Name" class="col-sm-4 control-label">Year Of Establishment: </label>
                                      <div class="col-sm-2">
                                        <input class="form-control" name="establishment_year" id="establishment_year" type="text" placeholder="1995" value="{{ $company->year_establishment }}">
                                      </div>

                                      <div class="col-sm-3">
                                        <input class="form-control" name="annual_turnover" id="annual_turnover" placeholder="Annual Turnover" type="text" value="{{ $company->annual_turnover }}">
                                      </div>

                                      <div class="col-sm-3">
                                        <select class="form-control" id="number_employees" name="number_employees">
                                          <option value="">Select Employees</option>
                                          <option value="Less than 10" <?= $company->no_of_emps == 'Less than 10' ? ' selected="selected"' : '';?>>Less than 10</option>
                                          <option value="10-100" <?= $company->no_of_emps == '10-100' ? ' selected="selected"' : '';?>>10-100</option>
                                          <option value="100-500" <?= $company->no_of_emps == '100-500' ? ' selected="selected"' : '';?>>100-500</option>
                                          <option value="500-1000" <?= $company->no_of_emps == '500-1000' ? ' selected="selected"' : '';?>>500-1000</option>
                                          <option value="1000-2000" <?= $company->no_of_emps == '1000-2000' ? ' selected="selected"' : '';?>>1000-2000</option>
                                          <option value="2000-5000" <?= $company->no_of_emps == '2000-5000' ? ' selected="selected"' : '';?>>2000-5000</option>
                                          <option value="5000-10000" <?= $company->no_of_emps == '5000-10000' ? ' selected="selected"' : '';?>>5000-10000</option>
                                          <option value="More than 10000" <?= $company->no_of_emps == 'More than 10000' ? ' selected="selected"' : '';?>>More than 10000</option>
                                        </select>
                                      </div>

                                    </div>

                                    <div class="form-group required">
                                      <label class="col-sm-4 control-label">Professional Associations: </label>
                                      <div class="col-sm-8">
                                        <input class="form-control" name="professional_association" id="professional_association" value="{{ $company->professional_associations }}">
                                      </div>
                                    </div>

                                    <div class="form-group required">
                                      <label for="Email" class="col-sm-4 control-label">Certifications: </label>
                                      <div class="col-sm-8">
                                        <input class="form-control" name="certification" id="certification" value="{{ $company->certifications }}">
                                      </div>
                                    </div>

                                    <div class="buttons">
                                      <div class="left">
                                        <label class="checkbox-inline">
                                          <a class="btn btn-primary back" data-original-title="" title="">Prev</a>
                                        </label>
                                      </div>
                                      <div class="right">
                                        <label class="checkbox-inline">
                                          <a class="btn btn-primary continue" id="updateOtherInformation">Next</a>
                                        </label>
                                      </div>
                                    </div>

                                  </div>
                                </fieldset>

                            </form>
                          </div>
                        </div>
                        <a class=""></a>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="business">
                      <div class="edit_profile">

                          <h4>Business Keywords</h4>
                          <p>For business keywords that you no longer wish to be listed in simply click on cross next to the keyword and when you are done, Click "Save"</p>

                          <div class="col-sm-12" style="padding: 0px;border-bottom: 1px solid #ddd;">
                            <a href="javascript:;" class="continue" style="color:#3b5998;font-weight: bold;float:right">
                                Add more keywords
                            </a>
                          </div>

                          <hr />

                          <div class="col-md-12 p0" id="savedKeywords"> <?= $keywords; ?> </div>

                          <div class="col-md-12 p0">&nbsp;</div>

                          <div class="box">
                              <div class="buttons">
                                <div class="left">
                                  <label class="checkbox-inline" style="padding-left: 0px;">
                                    <a class="btn btn-primary back" data-original-title="" title="">Prev</a>
                                  </label>
                                </div>
                                <div class="right">
                                  <label class="checkbox-inline">
                                    <a class="btn btn-primary continue" data-original-title="" title="">Next</a>
                                  </label>
                                </div>
                              </div>
                          </div>

                      </div>
                    </div>

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

                    <style type="text/css">
                        .ui-autocomplete {
                            position:absolute;
                            cursor:default;
                            z-index:1001 !important
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            // Search Keywords using jquery auto complete

                            $("#search_keywords").autocomplete({
                                source: function( request, response ) {
                                    $.ajax({
                                        url: "{{ route('searchajax') }}",
                                        dataType: "json",
                                        data: {
                                            term : request.term,
                                        },
                                        success: function(data) {

                                            //console.log(data);

                                            var array = $.map(data, function (item) {
                                               return {
                                                    label: item.category,
                                                    value: item.cat_id,
                                                    data : item
                                               }
                                            });
                                            response(array)
                                        }
                                    });
                                },
                                select: function( event, ui ) {
                                    $('#search_keywords').val(ui.item.data.category);
                                    var category = ui.item.data.category;
                                    var cat_id = ui.item.data.cat_id;
                                    var status = ui.item.data.status;

                                    // Show searched data in "searched_result" section
                                    $.ajax({
                                        method : 'post',
                                        url : 'getRelatedCategoryAndSubCatregories',
                                        async : true,
                                        data : {"_token": "{{ csrf_token() }}", 'cat_id': cat_id, 'category': category, 'status': status},
                                        success:function(response){;

                                            // Searched entry
                                            var html = '<p style="margin:0px;"><input type="checkbox" name="keyword" value="'+cat_id+'-'+status+'" class="status_'+status+'" checked> '+category+' </p>';

                                            $.each(response, function (key, val) {
                                                html += '<p style="margin:0px;"><input type="checkbox" name="keyword" value="'+val.id+'-'+val.status+'" class="status_'+val.status+'"> '+val.category+' </p>';
                                            });

                                            $("#searched_result").html(html);
                                        },
                                        error: function(data){
                                            console.log(data);
                                        },
                                    });

                                    return false;
                                }
                            });

                            // Save keywords
                            $(document).on("click", "#save_keywords", function(){
                                $('input:checkbox [name="keyword"]')

                                var checked_keywords = [];
                                $('input:checkbox:checked[name="keyword"]').each(function(i){
                                  checked_keywords[i] = $(this).val();
                                });

                                $.ajax({
                                    method : 'post',
                                    url : 'save_keywords',
                                    async : true,
                                    data : {"_token": "{{ csrf_token() }}", 'checked_keywords': checked_keywords},
                                    success:function(response){

                                        if(response == 0)
                                        {
                                            alert('This keyword is already added!');
                                        }
                                        else if(response == 2)
                                        {
                                            alert('You can not add this keyword. Please contact to Administrator!');
                                        }
                                        else
                                        {
                                            // Get all Selected kwywords
                                            $.ajax({
                                                url : 'getSavedKeywords',
                                                async : true,
                                                data : {"_token": "{{ csrf_token() }}"},
                                                success:function(response){

                                                    $('input:checkbox[name="keyword"]').prop('checked', false);
                                                    $("#add_keywords").removeClass("active");
                                                    $("#business").addClass("active");

                                                    $("#keyword_menu").removeClass("active");
                                                    $("#business").addClass("active");

                                                    $("#searched_result").html('');
                                                    $("#savedKeywords").html('');
                                                    $("#savedKeywords").html(response);

                                                    $("#search_keywords").val('');
                                                },
                                                error: function(data){
                                                    console.log(data);
                                                },
                                            });
                                        }
                                    },
                                    error: function(data){
                                        console.log(data);
                                    },
                                });

                            });

                            // Delete keyword
                            $(document).on('click', '.deleteKeyword', function(){
                                var id = $(this).attr('id');
                                var temp = id.split('_');
                                var keyword_id = temp[1];
                                var keyword_identity = temp[2];

                                $.ajax({
                                    method : 'post',
                                    url : 'delete_keywords',
                                    async : true,
                                    data : {"_token": "{{ csrf_token() }}", 'keyword_id': keyword_id, 'keyword_identity': keyword_identity},
                                    success:function(response){
                                        if(response == 1)
                                        {
                                            $("#keyword_"+keyword_id+"_"+keyword_identity+"").remove();
                                        }
                                    },
                                    error: function(data){
                                        console.log(data);
                                    },
                                });

                            });
                        });
                    </script>

                    <div role="tabpanel" class="tab-pane" id="add_keywords">
                        <div class="edit_profile">
                            <div class="box">
                                <h4>Type your Business Keywords and click Search</h4>
                                <br>

                                <form action="javascript:;" method="post" class="form-horizontal">
                                    <fieldset>
                                        <div class="controls" style="height: 60px;">
                                            <div class="form-group required">
                                                <div class="col-sm-12">
                                                    <input class="form-control" name="search_keywords" id="search_keywords" type="text">
                                                </div>
                                                <!-- <div class="col-sm-2">
                                                    <button type="submit" name="keywordSearch" class="btn btn-info btn-block">Search</button>
                                                </div> -->
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>

                            <!-- Searched result will show here -->
                            <div id="searched_result"> </div>
                            <div class="col-md-offset-9 col-md-3 text-right" style="padding: 0px;">
                                <button class="btn btn-info btn-block" id="save_keywords">Save</button>
                            </div>
                            <div class="col-md-12">
                                &nbsp;
                            </div>

                            <div class="buttons">
                                <div class="left">
                                    <label class="checkbox-inline" style="padding-left: 0px;">
                                        <a class="btn btn-primary back" data-original-title="" title="">Prev</a>
                                    </label>
                                </div>
                                <div class="right">
                                    <label class="checkbox-inline">
                                        <a class="btn btn-primary continue" data-original-title="" title="">Next</a>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="uploads_video">
                      <div class="col-sm-112 edit_profile">

                        <div class="box">
                            <h4>Upload logo/Photos</h4>
                            <hr />

                            <form action="{{ route('') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                              <fieldset>
                                <div class="controls">

                                    {{ csrf_field() }}

                                  <div class="form-group required">
                                    <label for="Name" class="col-sm-4 control-label">Upload Logo: </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" name="logo" id="logo" type="file">
                                    </div>
                                  </div>

                                  <div class="form-group required">
                                    <label for="Name" class="col-sm-4 control-label">Upload Photos: </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" name="photos[]" id="photos" type="file" multiple>
                                    </div>
                                  </div>

                                </div>
                                <div class="buttons">
                                  <div class="left">
                                    <label class="checkbox-inline" style="padding-left: 0px;">
                                      <a class="btn btn-primary back" data-original-title="" title="">Prev</a>
                                    </label>
                                  </div>
                                  <div class="right">
                                    <label class="checkbox-inline">
                                      <!-- <a class="btn btn-primary continue" data-original-title="" title="">Save & Exit</a> -->
                                      <input type="submit" name="save_exit" class="btn btn-primary continue" value="Save & Exit">
                                    </label>
                                  </div>
                                </div>
                              </fieldset>
                          </form>
                        </div>

                      </div>
                    </div>

                </div>
                <div id="push"></div>
              </div>

          </div>
      </div>
  </div>
@endsection