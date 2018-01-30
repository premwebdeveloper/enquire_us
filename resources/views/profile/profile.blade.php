@extends('layouts.public_app')
@section('content')
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
             <a href="#add_keywords" class="list-group-item text-center" aria-controls="add_keywords" role="tab" data-toggle="tab" aria-expanded="false">
                <i class="fa fa-arrow-right fa-fw"></i> <span>Add Keywords</span>
            </a>
          </li>          
          <li>
             <a href="#remove_keywords" class="list-group-item text-center" aria-controls="remove_keywords" role="tab" data-toggle="tab" aria-expanded="false">
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
          <div class="page-header account_title">

            <h1>Edit Profile</h1>

          </div>

  <div class="box">

    <div class="col-sm-12"> 

      
            <form action="javascript:;" method="post" accept-charset="utf-8" id="form-profile" class="form-horizontal" enctype="multipart/form-data">

            <fieldset>

              <h4>User Information</h4>

              <hr>

              <div class="controls">

                <div class="form-group required">

                  <label for="Name" class="col-sm-2 control-label">Name: </label>

                  <div class="col-sm-6">

                      <input class="form-control" name="customer_name" id="customer_name" type="text" value="{{$profile->name}}">

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Email" class="col-sm-2 control-label">Email: </label>

                  <div class="col-sm-6">

                    <input class="form-control" readonly="" name="email" id="email" value="{{$profile->email}}">

                  </div>

                </div>

              </div>

              <h4>Address</h4>

              <hr>

              <div class="controls">

                <div class="form-group required">

                  <label for="Address" class="col-sm-2 control-label">Address: </label>

                  <div class="col-sm-6">

                    <textarea name="address" class="form-control" rows="5">Central Spine</textarea>

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Country" class="col-sm-2 control-label">Country:</label>

                  <div class="col-sm-6">

                    <select onchange="getStatesCustomer(this.value);" disabled="" name="country_id" class="form-control">
                      <option selected="selected" value="18">Bangladesh</option>
                    </select>

                  </div>

                </div>

                <div class="form-group required">

                  <label for="State" class="col-sm-2 control-label">State/Region: </label>

                  <div class="col-sm-6">

                    <select onchange="getCitiesCustomer(this.value);" class="form-control" name="c_state_id"><option value="">--- Please Select ---</option><option value="322" selected="selected">Dhaka</option><option value="320">Barisal</option><option value="321">Chittagong</option><option value="323">Khulna</option><option value="324">Rajshahi</option><option value="325">Sylhet</option></select>

                    
                  </div>

                </div>

                <div class="form-group">

                  <label for="City" class="col-sm-2 control-label">City:</label>

                  <div class="col-sm-6">

                    <select name="c_city_id" class="form-control" id="city_id"><option value="">--- Please Select ---</option><option value="72" selected="selected">Agargaon</option><option value="7">Badda</option><option value="35">Baily Road</option><option value="40">Banani </option><option value="8">Bandar(Kadamrasul)</option><option value="9">Bangshal</option><option value="34">Bashundhara City</option><option value="33">Bashundhara R/A </option><option value="2">Dhanmondi</option><option value="12">Gazipur</option><option value="14">Gulshan 1</option><option value="13">Gulshan-2</option><option value="39">Jamuna Future Park</option><option value="16">Jatrabari</option><option value="19">Kalabagan</option><option value="74">Karwan Bazar</option><option value="21">Keraniganj</option><option value="22">Khilgaon</option><option value="23">Khilkhet</option><option value="24">Lalbagh</option><option value="36">Lalmatia</option><option value="4">Mirpur</option><option value="75">Mohakhali</option><option value="6">Mohammadpur</option><option value="25">Motijheel</option><option value="68">Narayanganj</option><option value="26">New Market</option><option value="28">Ramna</option><option value="30">Savar</option><option value="31">Tejgaon</option><option value="32">Uttara</option></select>

                  </div>

                </div>

                <div class="form-group">

                  <label for="Post Code" class="col-sm-2 control-label">Post Code: </label>

                  <div class="col-sm-6">

                    <input class="form-control" name="post_code" id="post_code" type="text" value="0">

                    
                  </div>

                </div>

                <div class="form-group required">

                  <label for="Mobile" class="col-sm-2 control-label">Mobile: </label>

                <div class="col-sm-6">
                  <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1">+88</span>
                          <input class="form-control mobile" maxlength="11" name="mobile" id="mobile" type="text" value="{{$profile->phone}}">
                  </div>
                </div>

                </div>

              </div>

             <h4>Newsletter</h4>

              <hr>

              <div class="controls">
                <div class="form-group required">

                  <label for="Address" class="col-sm-2 control-label">Newsletter: </label>

                  <div class="col-sm-6">

                    <select name="newsletter" class="form-control">
                      <option selected="selected" value="1">Enable</option>
                        <option value="0">Disable</option>
                    </select>

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