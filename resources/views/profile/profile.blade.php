@extends('layouts.public_app')
@section('content')
<style>
  .form-horizontal .control-label{
      text-align: left;
  }
</style>
<script type="text/javascript">
  function DualTime(){

    if ($("#dual_time_show:hidden")){

        $("#dual_time_show").show();
    }
    else if($("#dual_time_show:visible")){

        $("#dual_time_show").hide(); 
    }
  }
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
             <a href="#remove_keywords" class="list-group-item text-center" role="tab" data-toggle="tab" style="color: #a59898;">
                <i class="fa fa-arrow-right fa-fw"></i> <span>View/Remove Keywords</span>
            </a>
          </li>          
          <li>
             <a href="#uploads_video" class="list-group-item" aria-controls="uploads_video" role="tab" data-toggle="tab" aria-expanded="false">
              <i class="fa fa-photo fa-fw"></i> <span>Uploads Video/Logo/Pictures</span>
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
<script type="text/javascript">
	$(document).ready(function(){
    $('.continue').click(function(){
      $('.nav-tabs > .active').next('li').find('a').trigger('click');
    });
    $('.back').click(function(){
      $('.nav-tabs > .active').prev('li').find('a').trigger('click');
    });
	});
</script>

<div class="col-sm-9">
    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="location">
        <div class="col-sm-10 edit_profile">
  <div class="box">

    <div class="col-sm-12"> 

        <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

            <fieldset>

              <div class="controls">

                <div class="form-group required">

                  <label for="Name" class="col-sm-4 control-label">Business Name: </label>

                  <div class="col-sm-6">

                      <input class="form-control" name="customer_name" id="customer_name" type="text" value="{{$profile->name}}">

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Email" class="col-sm-4 control-label">Building: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

              </div>

              <div class="controls">

                <div class="form-group required">

                  <label for="Address" class="col-sm-4 control-label">Street: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">Landmark:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">Area:</label>

                  <div class="col-sm-6">

                   <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>
                
                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">City:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>                

                <div class="form-group">

                  <label for="Country" class="col-sm-4 control-label">Pin Code:</label>

                  <div class="col-sm-6">

                    <select onchange="getStatesCustomer(this.value);" disabled="" name="country_id" class="form-control">
                      <option selected="selected" value="18">Bangladesh</option>
                    </select>

                  </div>

                </div>

                <div class="form-group">

                  <label for="State" class="col-sm-4 control-label">State/Region: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

                <div class="form-group">

                  <label for="City" class="col-sm-4 control-label">Country:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>


              </div>

            <div class="buttons">

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
    <a class=""></a>
</div>
      

<div role="tabpanel" class="tab-pane" id="contact">
  <div class="col-sm-10 edit_profile">
  <div class="box">

    <div class="col-sm-12"> 

        <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

            <fieldset>

              <div class="controls">

                <div class="form-group required">

                  <label for="Name" class="col-sm-4 control-label">Contact Person: </label>

                  <div class="col-sm-6">

                      <input class="form-control" name="customer_name" id="customer_name" type="text" value="{{$profile->name}}">

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Email" class="col-sm-4 control-label">Landline No: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

              </div>

              <div class="controls">

                <div class="form-group required">

                  <label for="Address" class="col-sm-4 control-label">Mobile No: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">Fax No:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">Fax No 2:</label>

                  <div class="col-sm-6">

                   <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>
                
                <div class="form-group required">

                  <label for="Country" class="col-sm-4 control-label">Toll Free No:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>                

                <div class="form-group">

                  <label for="Country" class="col-sm-4 control-label">Toll Free No 2:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

                <div class="form-group">

                  <label for="State" class="col-sm-4 control-label">Email ID </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

                <div class="form-group">

                  <label for="City" class="col-sm-4 control-label">Website:</label>

                  <div class="col-sm-6">

                    <input class="form-control" name="email" id="email" value="{{$profile->email}}">

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
    <a class=""></a>
</div>      

<div role="tabpanel" class="tab-pane" id="other">
  <div class="col-sm-10 edit_profile">
  <div class="box">
    <h3>Hours of Operation</h3>
    <div class="col-sm-12"> 

        <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">
          <div class="controls">
            <div class="form-group required">
              <input type="radio" value="1" name="other" class="other"> Display hours of operation
              <input type="radio" value="2" name="other" class="other"> Do not display hours of operation
            </div>
          </div>
            <fieldset>

              <div class="controls">

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Monday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Tuesday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Wednesday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                  <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Thursday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Friday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>
                
                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Saturday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>               

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Sunday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <a href="javascript:;" id="dual_time" onclick="DualTime()">
                  <h5 style="color: #de4b39;">Click Here For Dual Timings</h5>
                </a>
                
                <div id="dual_time_show">

                  <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Monday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Tuesday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Wednesday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                  <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Thursday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Friday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>
                
                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Saturday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
                </div>               

                <div class="form-group">

                    <label for="Name" class="col-sm-2 control-label">Sunday: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>

                    <label for="Name" class="col-sm-1 control-label">To: </label>

                    <div class="col-sm-3">
                      <select id="time[0][1]" name="time[0][1]" class="form-control">
                        <option value="00:00"> Open 24 Hrs </option><option value="00:00"> 00:00 </option><option value="00:30"> 00:30 </option><option value="01:00"> 01:00 </option><option value="01:30"> 01:30 </option><option value="02:00"> 02:00 </option><option value="02:30"> 02:30 </option><option value="03:00"> 03:00 </option><option value="03:30"> 03:30 </option><option value="04:00"> 04:00 </option><option value="04:30"> 04:30 </option><option value="05:00"> 05:00 </option><option value="05:30"> 05:30 </option><option value="06:00"> 06:00 </option><option value="06:30"> 06:30 </option><option value="07:00"> 07:00 </option><option value="07:30"> 07:30 </option><option value="08:00"> 08:00 </option><option value="08:30"> 08:30 </option><option value="09:00"> 09:00 </option><option value="09:30"> 09:30 </option><option value="10:00"> 10:00 </option><option value="10:30"> 10:30 </option><option value="11:00"> 11:00 </option><option value="11:30"> 11:30 </option><option value="12:00"> 12:00 </option><option value="12:30"> 12:30 </option><option value="13:00"> 13:00 </option><option value="13:30"> 13:30 </option><option value="14:00"> 14:00 </option><option value="14:30"> 14:30 </option><option value="15:00"> 15:00 </option><option value="15:30"> 15:30 </option><option value="16:00"> 16:00 </option><option value="16:30"> 16:30 </option><option value="17:00"> 17:00 </option><option value="17:30"> 17:30 </option><option value="18:00"> 18:00 </option><option value="18:30"> 18:30 </option><option value="19:00"> 19:00 </option><option value="19:30"> 19:30 </option><option value="20:00"> 20:00 </option><option value="20:30"> 20:30 </option><option value="21:00"> 21:00 </option><option value="21:30"> 21:30 </option><option value="22:00"> 22:00 </option><option value="22:30"> 22:30 </option><option value="23:00"> 23:00 </option><option value="23:30"> 23:30 </option><option value="Closed"> Closed </option></select>
                    </div>
                    <div class="col-sm-3">
                      <input type="checkbox" value="2" name="other" class="other"> <label for="Name" class="control-label">Closed</label>
                    </div>
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
    <a class=""></a>
</div>

<div role="tabpanel" class="tab-pane" id="contact1">
    <div class="page-header account_title">
      <h1>Password</h1>
    </div>
    <div class="box">

      <div class="col-sm-12"> 

        <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

              <fieldset>

                <div class="controls">

                  <div class="form-group required">

                    <label for="Password" class="col-sm-3 control-label">New password: </label>

                    <div class="col-sm-9">

                      <input class="form-control" autocomplete="off" name="c_password" id="password1" type="password" value="">

                      
                    </div>

                  </div>

                  <div class="form-group required">

                    <label for="Password Confirm" class="col-sm-3 control-label">New password confirm: </label>

                    <div class="col-sm-9">

                      <input class="form-control" autocomplete="off" name="c_password_confirm" id="password2" type="password" value="">

                      
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

    <div role="tabpanel" class="tab-pane" id="review">
      <h3 class="">Review &amp; Place Order</h3>
      <p>Review &amp; Payment Tab</p>
      <a class="btn btn-primary back">Prev</a>
      <a class="btn btn-primary continue">Submit</a>
    </div>
</div>


            <div id="push"></div>


    </div>

</div>
</div>
</div>
@endsection