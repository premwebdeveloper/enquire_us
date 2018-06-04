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
    #dual_time_show {
        display: none;
    }
</style>
<script>
    $(document).ready(function(){
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

        $(".time_0").attr("disabled", true);
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
            @if(session('status'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   {{ session('status') }}
                </div>
            @endif
            <div class="ibox float-e-margins">

                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="tabs-container">

                            <ul class="nav nav-tabs">
                                <li class=""><a href="javascript:;">Basic Information</a></li>
                                <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                <li class="active"><a href="javascript:;">Business Timing</a></li>
                                <li class=""><a href="javascript:;">Business Keywords</a></li>
                                <li class=""><a href="javascript:;">Images</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="tab-3" class="tab-pane active">
                                    <div class="panel-body">
                                    <h4>Hours of Operation</h4>
                                <form action="{{ route('addUser_business_timing', ['user_id' => $user_details->user_id]) }}" method="post" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <fieldset>

                                        <input type="hidden" name="check_validation" value="1">

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

                                    </div>
                                    <div class="col-md-12 text-right">
                                        <a href="{{ route('addUser_business_keywords', ['user_id' => $user_details->user_id]) }}" class="btn btn-success" style="margin-bottom: 30px;">Skip</a>
                                        <input type="submit" name="addUser" class="btn btn-success" value="Next" style="margin-bottom: 30px;">
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