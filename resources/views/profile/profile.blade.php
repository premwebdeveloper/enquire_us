@extends('layouts.public_app')
@section('content')
<link href="{{ asset ('resources/frontend_assets/css/validationEngine.jquery.css') }}" rel="stylesheet" />
<script src="{{ asset ('resources/frontend_assets/js/jquery.validationEngine-en.js') }}" type="text/javascript"></script>
<script src="{{ asset ('resources/frontend_assets/js/jquery.validationEngine.js') }}" type="text/javascript"></script>

<style>
  .form-horizontal .control-label{
      text-align: left;
  }
  #dual_time_show{
    display:none;
  }
  .tab-content .tab-pane {
      padding: 0px 0!important;
  }
</style>


<script type="text/javascript">
  $(document).ready(function(){
    
    $("#dual_time").click(function() {
  
        $("#dual_time_show").toggle();
        
      });
    $(".hour_operation").click(function(){
        var hour = $(this).val();
        if(hour == 1){
           $("select[name='time']").removeAttr('disabled', false);
        }
        else{
          $("select[name='time']").attr("disabled", true);
        }
    });
    $("select[name='time']").attr("disabled", true);
    //$('.close_0').
    $("#email").attr("readonly", true);
  });
</script>


<script type="text/javascript">
  $(document).ready(function(){
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
        $('.back').click(function(){
          $('.nav-tabs > .active').prev('li').find('a').trigger('click');
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
        $('.back').click(function(){
          $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
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
          <li role="presentation" class="active">
            <a href="#dashboard" class="list-group-item" aria-controls="dashboard" role="tab" data-toggle="tab" aria-expanded="true">
              <i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span>
            </a>
          </li>
          <li>
             <a href="#location" class="list-group-item" aria-controls="location" role="tab" data-toggle="tab" aria-expanded="false">
              <i class="fa fa-map-marker fa-fw"></i> <span>Location Information</span>
            </a>
          </li>
          <li>
             <a href="#contact" class="list-group-item" aria-controls="contact" role="tab" data-toggle="tab" aria-expanded="false">
              <i class="fa fa-phone fa-fw"></i> <span>Contact Information</span>
            </a>
          </li>          
          <li>
             <a href="#other" class="list-group-item" aria-controls="other" role="tab" data-toggle="tab" aria-expanded="false">
              <i class="fa fa-cog fa-fw"></i> <span>Other Information</span>
            </a>
          </li>          
          <li>
             <a href="#business" class="list-group-item" aria-controls="business" role="tab" data-toggle="tab" aria-expanded="false">
              <i class="fa fa-cog fa-fw"></i> <span>Business Keywords</span>
            </a>
          </li>          
          <li>
             <a href="#add_keywords" class="list-group-item text-center" role="tab" data-toggle="tab" style="color: #a59898;">
                <i class="fa fa-arrow-right fa-fw"></i> <span>Add Keywords</span>
            </a>
          </li>                   
          <li>
             <a href="#uploads_video" class="list-group-item" aria-controls="uploads_video" role="tab" data-toggle="tab" aria-expanded="false">
              <i class="fa fa-photo fa-fw"></i> <span>Uploads Logo/Pictures</span>
            </a>
          </li>
        </ul>
				
			</div>
			
		</div>
		
	</div>
	<style>
   .tabs-wrap {
        margin-top: 40px;
      }
      .tab-content .tab-pane {
        padding: 20px 0;
      } 
      .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
        background: #eaeaea;
      }
  </style>

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

                  <label for="Country" class="col-sm-4 control-label">City:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="city" id="city" value="{{ $location->city }}">

                  </div>

                </div>                

                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">Pin Code:</label>

                  <div class="col-sm-6">

                    <select name="pin_code" id="pin_code" class="validate[required] form-control">
                      @if(!empty($location->pincode))
                        <option value="{{$location->pincode}}">{{$location->pincode}}</option>
                        <option value="">Select</option>
                        <option id="302001" value="302001">302001</option>
                        <option id="302002" value="302002">302002</option>
                        <option id="302003" value="302003">302003</option>
                      @else
                        <option value="">Select</option>
                        <option id="302001" value="302001">302001</option>
                        <option id="302002" value="302002">302002</option>
                        <option id="302003" value="302003">302003</option>
                      @endif
                    </select>

                  </div>

                </div>

                <div class="form-group">

                  <label for="State" class="col-sm-4 control-label">State/Region: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="state" id="state" value="{{ $location->state }}">

                  </div>

                </div>

                <div class="form-group">

                  <label for="City" class="col-sm-4 control-label">Country:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="country" id="country" value="{{ $location->country }}">

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
                
                <div class="form-group ">

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

                    <input class="form-control" name="email" id="email" value="{{ $contact->email }}">

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

        <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

            <fieldset>
              <p>
                <input type="radio" value="1" name="other" class="hour_operation"> Display hours of operation
                <input type="radio" value="2" name="other" class="hour_operation" checked> Do not display hours of operation
              </p>
              <div class="controls">

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Monday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control time_0">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option>
                      </select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control time_0">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="0" name="other" class="close_0"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Tuesday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Wednesday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                  <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Thursday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Friday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>
                
                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Saturday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>               

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Sunday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <a href="javascript:;" id="dual_time">
                  <h5 style="color: #de4b39;">Click Here For Dual Timings</h5>
                </a>
                
                <div id="dual_time_show">

                  <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Monday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Tuesday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Wednesday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                  <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Thursday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Friday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>
                
                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Saturday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>               

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Sunday: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time" name="time" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>
              </div>

           <hr>
           <h4>Payment Modes Accepted By You</h4>
           
              <div class="form-group required">

                <div class="col-sm-4">
                  <input type="checkbox" value="1" name="other" class="other"> <span style="color:#de4b39;">Select All</span>
                </div>

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Cash
                </div>

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Master Card
                </div>

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Visa Card
                </div>

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Debit Cards
                </div>

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Money Orders
                </div>

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Cheques
                </div>
                
                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Credit Card
                </div> 

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Travelers Cheque
                </div>  

                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Financing Available
                </div>  
                              
                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> American Express Card
                </div> 
                                             
                <div class="col-sm-4">
                  <input type="checkbox" value="2" name="other" class="other"> Diners Club Card
                </div>

              </div>

            <hr>
            <h4>Company Information</h4>
  
                <div class="form-group required">

                  <label for="Name" class="col-sm-4 control-label">Year Of Establishment: </label>

                  <div class="col-sm-2">
                    <input class="form-control" name="customer_name" id="customer_name" type="text" placeholder="1995">
                  </div>

                  <div class="col-sm-3">
                    <input class="form-control" name="customer_name" id="customer_name" placeholder="Annual Turnover" type="text">
                  </div>

                  <div class="col-sm-3">
                    <select class="form-control" id="number_employees" name="number_employees">
                      <option value="Not Answered">Select Employees</option>
                      <option value="Less than 10">Less than 10</option>
                      <option value="10-100">10-100</option>
                      <option value="100-500">100-500</option>
                      <option value="500-1000">500-1000</option>
                      <option value="1000-2000">1000-2000</option>
                      <option value="2000-5000">2000-5000</option>
                      <option value="5000-10000">5000-10000</option>
                      <option value="More than 10000">More than 10000</option>
                  </select>
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Email" class="col-sm-4 control-label">Professional Associations: </label>

                  <div class="col-sm-8">

                    <input class="form-control" name="email" id="email" placeholder="">

                  </div>

                </div>

                <div class="form-group required">

                  <label for="Email" class="col-sm-4 control-label">Certifications: </label>

                  <div class="col-sm-8">

                    <input class="form-control" name="email" id="email" placeholder="">

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

                      <a class="btn btn-primary continue" data-original-title="" title="">Next</a>

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
  <div class="col-sm-10 edit_profile">
    <h4>Business Keywords</h4>
    <p>For business keywords that you no longer wish to be listed in simply click on cross next to the keyword and when you are done, Click "Save"</p>
  
      <div class="box">

          <div class="col-sm-12"> 

            <a href="javascript:;" class="continue" style="color:#3b5998;font-weight: bold;float:right">Add more keywords</a>
            <hr>

            <hr>

          </div>
       <div class="buttons">
          <div class="left">

            <label class="checkbox-inline">

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
    <a class=""></a>
</div> 

<div role="tabpanel" class="tab-pane" id="add_keywords">
  <div class="col-sm-10 edit_profile">
    
      <div class="box">

            <h4>Type your Business Keywords and click Search</h4>
            <br>
            <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

              <fieldset>

                <div class="controls">

                  <div class="form-group required">

                    <div class="col-sm-10">

                        <input class="form-control" name="customer_name" id="customer_name" type="text">

                    </div>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-info">Search</button>
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

                      <a class="btn btn-primary continue" data-original-title="" title="">Next</a>

                    </label>

                  </div>

                </div>
              </fieldset>

          </form>
          </div>
    </div>
</div> 

  <div role="tabpanel" class="tab-pane" id="uploads_video">
    <div class="col-sm-10 edit_profile">
    
      <div class="box">

            <h4>Upload logo/Photos</h4>
            <br>
            <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

              <fieldset>

                <div class="controls">

                <div class="form-group required">

                  <label for="Name" class="col-sm-4 control-label">Upload Logo: </label>

                  <div class="col-sm-6">

                      <input class="form-control" name="customer_name" id="customer_name" type="file">
                  
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Name" class="col-sm-4 control-label">Upload Photos: </label>

                  <div class="col-sm-6">

                      <input class="form-control" name="photo[]" id="customer_name" type="file" multiple>
                  
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

                      <a class="btn btn-primary continue" data-original-title="" title="">Save & Exit</a>

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