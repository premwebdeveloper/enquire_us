@extends('layouts.auth_app')

@section('content')

            <!-- Auto complete js and css -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

            <style type="text/css">
                .form-horizontal .control-label { padding-top: 0px; padding: 0px; text-align: left; font-size: 11px; }
                .form-horizontal .form-group { margin-left: 0px; }
                .keywords{ margin-bottom: 10px; }
                .ui-autocomplete { position:absolute; cursor:default; z-index:1001 !important }
            </style>

            <script>
            $(document).ready(function(){
                // Add keyword section show
                $(".add_keyword").click(function() {
                    $("#add_keyword").show();
                    $("#hide_add_button").hide();
                });

                // Search Keywords using jquery auto complete
                $("#search_keywords").autocomplete({
                    source: function( request, response ) {

                        // If request term limit is greater than 2 word
                        if(request.term.length < 3) return;

                        $.ajax({
                            url: "{{ route('searchajax') }}",
                            dataType: "json",
                            data: {
                                term : request.term,
                            },
                            success: function(data) {

                                if (data.category !== '' && data.category !== null)
                                {
                                    var array = $.map(data, function (item) {
                                        return {
                                                label: item.category,
                                                value: item.cat_id,
                                                data : item
                                        }
                                    });
                                    response(array)
                                }

                            }
                        });
                    },
                    select: function( event, ui ) {
                        console.log(ui.item);
                        $('#search_keywords').val(ui.item.data.category);
                        var category = ui.item.data.category;
                        var cat_id = ui.item.data.cat_id;
                        var status = ui.item.data.status;

                        // Show searched data in "searched_result" section
                        $.ajax({
                            method : 'post',
                            url : '{{ route("getRelatedCategoryAndSubCatregories") }}',
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
                                //console.log(data);
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

                    var user_id = $("#user_id").val();

                    $.ajax({
                        method : 'post',
                        url : '{{ route("save_keywords_by_admin") }}',
                        async : true,
                        data : {"_token": "{{ csrf_token() }}", 'checked_keywords': checked_keywords, 'user_id': user_id},
                        success:function(response){

                            if(response != 1)
                            {
                                 // Get all Selected kwywords
                                $.ajax({
                                    method : 'post',
                                    url : '{{ route("getSavedKeywords_By_Admin") }}',
                                    async : true,
                                    data : {"_token": "{{ csrf_token() }}", 'user_id': user_id},
                                    success:function(response){

                                        $('input:checkbox[name="keyword"]').prop('checked', false);

                                        $("#searched_result").html('');
                                        $("#savedKeywords").html('');
                                        $("#savedKeywords").html(response);
                                        console.log(response);

                                        
                                            $("#add_keyword").hide();
                                            $("#hide_add_button").show();
                                        
                                        //console.log(search_keywords);
                                    },
                                    error: function(data){
                                        //console.log(data);
                                    },
                                });
                            }
                            else
                            {
                                alert('This keyword is already added!');
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
                    
                    var user_id = "<?= $user_details->user_id;?>";

                    $.ajax({
                        method : 'post',
                        url : '{{ route("delete_keywords_by_admin") }}',
                        async : true,
                        data : {"_token": "{{ csrf_token() }}", 'keyword_id': keyword_id, 'keyword_identity': keyword_identity, 'user_id': user_id},
                        success:function(response){
                            if(response == 1)
                            {
                                $("#keyword_"+keyword_id+"_"+keyword_identity+"").remove();
                            }
                        },
                        error: function(data){
                            //console.log(data);
                        },
                    });
                });
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
                                    @if(session('status'))
                                       <div class="alert alert-success">{{ session('status') }}</div>
                                    @endif
                                    <div class="tabs-container">
                                        @if(!empty($user_details->user_id))
                                            <ul class="nav nav-tabs">
                                                <li class=""><a href="{{ route('addUser_basic_information', ['user_id' => $user_details->user_id]) }}">Basic Information</a></li>
                                                <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                                <li class=""><a href="{{ route('addUser_business_timing', ['user_id' => $user_details->user_id]) }}">Business Timing</a></li>
                                                <li class="active"><a href="{{ route('addUser_business_keywords', ['user_id' => $user_details->user_id]) }}">Business Keywords</a></li>
                                                <li class=""><a href="{{ route('addUser_logo_images', ['user_id' => $user_details->user_id]) }}">Images</a></li>
                                            </ul>
                                        @else
                                            <ul class="nav nav-tabs">
                                                <li class=""><a href="javascript:;">Basic Information</a></li>
                                                <li class=""><a href="{{ route('addUser_payment_modes', ['user_id' => $user_details->user_id]) }}">Payment Modes</a></li>
                                                <li class=""><a href="{{ route('addUser_business_timing', ['user_id' => $user_details->user_id]) }}">Business Timing</a></li>
                                                <li class="active"><a href="javascript:;">Business Keywords</a></li>
                                                <li class=""><a href="javascript:;">Images</a></li>
                                            </ul>
                                        @endif

                                        <div class="tab-content">

                                            <!-- Business Keyword -->
                                            <div id="tab-4" class="tab-pane active">
                                                <div class="panel-body" id="hide_add_button">
                                                    <h4>Business Keywords</h4>
                                                    <p>For business keywords that you no longer wish to be listed in simply click on cross next to the keyword and when you are done, Click "Save"</p>

                                                    <div class="col-sm-12" style="padding: 0px;border-bottom: 1px solid #ddd; ">
                                                        
                                                        <div class="col-md-12 text-right" style="padding: 0px;">
                                                            <a class="add_keyword">
                                                                <b>Add more keywords</b>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- Searched result will show here -->
                                                    <div class="col-sm-12" style="margin-bottom: 20px;padding: 0px;">
                                                        <div id="savedKeywords"> <?= $keywords; ?> </div>
                                                    </div>
                                                </div>
                
                                                <!-- Add keyword section -->
                                                <div class="panel-body" id="add_keyword" style="display:none;">
                                                    <h4>Type your Business Keywords and click Search</h4>
                                                        <form action="javascript:;" method="post" class="form-horizontal">
                                                            <fieldset>
                                                                <div class="controls">
                                                                    <div class="form-group required">
                                                                        <div class="col-sm-12">
                                                                            <input type="hidden" id="user_id" name="check_validation" value="<?= $user_details->user_id;?>">
                                                                            <input class="form-control" name="search_keywords" id="search_keywords" type="text" placeholder="Search Keyword ...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    <div class="col-lg-12" style="margin-bottom: 10px;">
                                                        <div id="searched_result"> </div>
                                                    </div>

                                                    <div class="col-md-3 text-right">
                                                        <button class="btn btn-info btn-block" id="save_keywords">Save</button>
                                                    </div> 
                                                    @if(Auth::user()->id != 1)
                                                        <div class="col-md-4 text-left">
                                                            <h3>If you do not find the keyword then</h3> 
                                                        </div>
                                                        <div class="col-md-3 text-right">
                                                            
                                                            <a class="btn btn-success btn-block" data-toggle="modal" data-target="#categorySuggestionModal">
                                                                <b>Suggest for new category</b>
                                                            </a>
                                                            
                                                        </div>   
                                                    @endif                                          
                                                </div>

                                                <div class="col-md-12 text-right">
                                                    <hr>
                                                    <a href="{{ route('addUser_logo_images', ['user_id' => $user_details->user_id]) }}" class="btn btn-success" style="margin-bottom: 30px;">Next</a>
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

<!-- Category Suggestion Modal -->
<div id="categorySuggestionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Suggestion for new category</h4>
            </div>
            <div class="modal-body">
                
                <form action="{{ route('suggest_new_category') }}" method="POST">

                    {{ csrf_field() }}

                    <?php                                  
                        $route = Request::route()->getName();
                        $temp = explode("/", $_SERVER['REQUEST_URI']);
                        $last_param = end($temp);
                    ?>

                    <input type="hidden" name="redirect_route" value="{{ $route }}">
                    <input type="hidden" name="redirect_param" value="{{ $last_param }}">

                    <div class="row">
                        <div class="col-md-10">
                            <label for="category">Category</label>
                            <input type="text" name="suggest_category" class="form-control" id="suggest_category" placeholder="Category" required="required">
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="suggest" value="Suggest" class="btn btn-primary" id="suggestCategory" style="margin-top: 25px;">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection