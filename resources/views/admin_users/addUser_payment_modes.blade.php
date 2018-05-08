@extends('layouts.auth_app')

@section('content')

<style type="text/css">
.form-horizontal .control-label
    {
        padding-top: 0px;
        padding: 0px;
        text-align: left;
        font-size: 11px;
    }
.form-horizontal .form-group
    {
        margin-left: 0px;
    }
</style>
<script>
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
    $(document).on('click', '.add_keyword', function(){
        $("#add_keyword").show();
        $("#hide_add_button").hide();
    });
</script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Add User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('users') }}">Users</a>
            </li>
            <li class="active">
                <strong>Add User</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2 text-right">
        &nbsp;
    </div>
</div>

<br />

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add User</h5>
            </div>

                        
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="tabs-container">

                            <ul class="nav nav-tabs">
                                <li class=""><a href="{{ route('addUser_basic_information') }}">Basic Information</a></li>
                                <li class="active"><a href="javascript:;">Payment Modes</a></li>
                                <li class=""><a href="{{ route('addUser_business_timing') }}">Business Timing</a></li>
                                <li class=""><a href="{{ route('addUser_business_keywords') }}">Business Keywords</a></li>
                                <li class=""><a href="{{ route('addUser_logo_images') }}">Images</a></li>
                            </ul>

                            <div class="tab-content">

                               <!-- Payment Modes-->
                                <div id="tab-2" class="tab-pane active">
                                    <div class="panel-body">
                                        <form action="javascript:;" method="post" id="other_information_form" class="form-horizontal">
                                            <fieldset>

                                              <div class="controls">

                                              <h4>Payment Modes Accepted By You</h4>

                                              <div class="form-group required">

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
                                                    <input class="form-control" name="establishment_year" id="establishment_year" type="text" placeholder="1995">
                                                  </div>

                                                  <div class="col-sm-3">
                                                    <input class="form-control" name="annual_turnover" id="annual_turnover" placeholder="Annual Turnover" type="text">
                                                  </div>

                                                  <div class="col-sm-3">
                                                    <select class="form-control" id="number_employees" name="number_employees">
                                                        <option value="">Select Employees</option>
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
                                                    <label class="col-sm-4 control-label">Professional Associations: </label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" name="professional_association" id="professional_association">
                                                    </div>
                                                </div>

                                                <div class="form-group required">
                                                    <label for="Email" class="col-sm-4 control-label">Certifications: </label>
                                                    <div class="col-sm-8">
                                                        <input class="form-control" name="certification" id="certification">
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-right">
                                                    <input type="submit" name="addUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
                                                </div>

                                              </div>
                                            </fieldset>

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection