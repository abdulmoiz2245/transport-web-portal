<div class="card">
    <div class="card-body">
        <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
            <div>
                <a href="{{ route( 'admin.account.invoice') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
            </div>
            <div class="mt-3 mb-3"> 
                <a href="{{ route( 'admin.account.invoice_history') }}"target="_blank" class="ml-3">
                        <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
                </a> 
            </div>
        </div>
        <div class="table-responsive">
            <table class="display table responsive nowrap  " style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Invoice Number</th>
                        <th>Customer Name</th>
                        <th>Invoice Amount </th>
                        <th>Invoice Date </th>
                        <th>Amount Recived </th>
                        <th>Invoice Status </th>
                        <th>Invoice Added By </th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['invoice'] as $invoice)
                    @if($invoice->row_status == 'deleted')
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>INV-{{ $invoice->invoice_no }}</td>
                        <td>{{ $invoice->customer_name }}</td>
                        <td>{{ $invoice->grand_total }}</td>
                        <td>{{ $invoice->date }}</td>
                        <td>{{ $invoice->recived_amount }}</td>
                        <td>
                            @if($invoice->invoice_status == '1')
                            <span class="badge badge-pill badge-success">Paid</span>
                            @else($invoice->invoice_status == '0')
                            <span class="badge badge-pill badge-danger">Not Paid</span>

                            @endif
                        </td>
                        <td>
                        @if($invoice->user_id == 0)
                                    Admin
                                @else
                                    @if(User::find($invoice->user_id))
                                        {{ User::find($invoice->user_id)->username}}
                                    @else
                                        User Deleted
                                    @endif
                                
                                @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.account.view_invoice') }}" method="post" class="d-inline">
                                @csrf
                                <input type="text" class="form-control d-none" name="id" value ="{{$invoice->id}}" placeholder="Enter id" >
                                <button type="submit" class="border-0 .bg-white">
                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                </button>
                            </form>
                            
                                
                            <!-- <a href="#" id="{{ $invoice->id }}" class="delete-file">
                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                            </a> -->

                            
                        </td>
                        
                    </tr>
                    @endif
                    @endforeach
                </tbody>         
            </table>
        </div>
    </div>
</div>