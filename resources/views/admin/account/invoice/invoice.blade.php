<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href=""  data-toggle="modal" data-target="#new_invoice">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Generate Invoice</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.all_invoice') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Submitted Invoice</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.paid_purchase') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Revised invoice</p>
                        </div>
                    </div>
                </div>
            </a>
        </div> -->

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.cheque') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Discarde Invoice</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.invoice_approval') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Approval</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="new_invoice" tabindex="-1" role="dialog" aria-labelledby="new_invoice" aria-hidden="true">
            <div class="modal-dialog modal-lg"  role="document">
                <form action="{{ route('admin.account.new_invoice') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >New Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label >Customer</label>
                                <select name="customer_id" id="customer_name" class="form-control" required placeholder="">
                                    @foreach($data['customer'] as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label >Invoice Date From</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label >To Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Open Invoice</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
