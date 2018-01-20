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

<div class="tab-content tabbox" id="myTabContent">
    <div id="profileedit" class="tab-pane fade active in">
        <div class="user-pannel all-forms">
            <div class="container-fluid">
                <div class="row login-box">
                    <div class="col-sm-6">
                      <div class="page-header">
                        <h3>Customer Signup To Enquire Us</h3></div>
                            <form action="{{ route('register') }}" method="post" accept-charset="utf-8" class="form-horizontal">     
                            {{ csrf_field() }}       
                                <fieldset>
                    
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
                                    <label for="Name" class="col-sm-4 control-label">Name: </label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} required">
                                    <label for="Email" class="col-sm-4 control-label">Email: </label>
                                    <div class="col-sm-8">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} required">
                                    <label for="Mobile" class="col-sm-4 control-label">Mobile: </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1">+91</span>
                                           <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="help-block">You can receive sms voucher for selected deals on your mobile phone directly</div>
                                    </div>
                                </div>
                                <div class="controls">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} required">
                                        <label for="Password" class="col-sm-4 control-label">Password: </label>
                                        <div class="col-sm-8">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label for="Password Confirm" class="col-sm-4 control-label">Password Confirm: </label>
                                        <div class="col-sm-8">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-4">
                                        <span>By clicking on Sign Up. I agree to all <a style="text-decoration:underline;" target="_blank" alt="Privacy Policy" href="javascript:;" class="colorbox cboxElement">T&amp;C</a></span>
                                    </div>
                                </div>
                            
                                <div class="buttons">
                                    <div class="right">
                                        <label class="checkbox-inline">
                                            <button type="submit" class="btn success" data-original-title="" title="">SIGN UP</button>
                                        </label>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="col-sm-12">
                            <p class="lines text-center">OR</p>
                            <p class="text-center">Already Signed up? <a href="{{ url('/') }}">Sign In</a></p>
                        </div>
                    </div>
                    <div class="col-sm-1 reg-devider" style="border-right:1px solid #999;min-height:400px"></div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <div class="page-header"><h3>Recommended</h3></div>
                        <a href="javascript:;" class="btn btn-block btn-social btn-facebook btn-lg" data-original-title="" title="">
                          <span class="fa fa-facebook"></span>
                          Sign in with Facebook
                        </a>
                        <a href="javascript:;" class="btn btn-block btn-social btn-google-plus btn-lg" data-original-title="" title="">
                          <span class="fa fa-google-plus"></span>
                          Sign in with Google Plus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
  </div>
@endsection
