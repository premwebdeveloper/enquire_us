<div class="footer">
    <div>
        <strong>Copyright</strong> &copy; 2017 Designed by <a href="http://dexusmedia.com/" target="_blank">Dexus Media</a>
    </div>
</div>

<?php
//  Get all sales person
$sales_users = DB::table('employees')
                ->join('user_roles', 'user_roles.user_id', '=', 'employees.user_id')
                ->where(['user_roles.role_id' => '6', 'employees.status' => 1])
                ->select('employees.*')
                ->get();
?>
<!-- if Assign Keyword than approve user -->
<div id="approve_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Category Assign</h4>
            </div>
            <div class="modal-body">
                <p>You can not approve this user without assign any keyword !</p>
            </div>
        </div>

    </div>
</div>

<!-- Meeting assign to sales by support Modal -->
<div id="assignToSalesModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assign client to sales person for Meeting</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('client_assign_to_sales') }}" method="post">
    
                    {{ csrf_field() }}

                    <input type="hidden" name="meeting_client_uid" id="meeting_client_uid">

                    <div class="row">
                        <div class='col-md-5'>
                            <label for="Date">Date</label>
                            <input type='text' name="date_time" class="form-control form_datetime1" placeholder="yyyy-mm-dd H:I" required="required" />
                        </div> 

                        <div class='col-md-5'>
                            <label for="Date">Sales Person</label>
                            <select name="sales_person" id="sales_person" class="form-control" required="required">
                                <option value="">Select Sales Person</option>
                                @foreach($sales_users as $key => $sales)
                                    <option value="{{ $sales->user_id }}">{{ $sales->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class='col-md-2'>
                            <label for="Date">&nbsp;</label>
                            <input type="submit" name="assign_client_sales" value="Assign" class="btn btn-primary">
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>