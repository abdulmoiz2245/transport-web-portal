<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.hr_pro.trade_license_partners' ,$data['trade_license_partners']->trade_license_id ) }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.hr_pro.update_trade_license_partners') }}" method="post" id="customer_rate_card" enctype="multipart/form-data">
        @csrf
        <input type="text" name="id" value="{{ $data['trade_license_partners']->id }}" class="d-none">
        <input type="text" name="trade_id" value="{{ $data['trade_license_partners']->trade_license_id }}" class="d-none">

        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['trade_license_partners']->status_message }}</textarea>
                    
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value='pending' <?php if($data['trade_license_partners']->status == 'pending') echo 'selected="selected"' ?> >Pending</option>
                        <option value='approved' <?php if($data['trade_license_partners']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                        <option value='rejected' <?php if($data['trade_license_partners']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12">
                @if( $data['trade_license_partners']->id_copy != '')
                <div class="row">
                    <div class="col-12">
                        <label>Replace Id Card </label>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload Id Card</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="id_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_partners']->id_copy}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Upload Id Card </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Id Card</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="id_copy">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-6 col-12">
                    @if( $data['trade_license_partners']->passport_copy != '')
                    <div class="row">
                        <div class="col-12">
                            <label>Replace Passport </label>
                        </div>
                        <div class="col-11 form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Passport</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="passport_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_partners']->passport_copy}}">
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="form-group">
                        <label>Passport Upload</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload Passport</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="passport_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    @endif
            </div>
            <div class="col-md-6 col-12">
                    @if( $data['trade_license_partners']->visa_copy != '')
                    <div class="row">
                        <div class="col-12">
                            <label>Replace Visa </label>
                        </div>
                        <div class="col-11 form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload visa</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="visa_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_partners']->visa_copy}}">
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="form-group">
                        <label>Upload Visa </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload visa</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="visa_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    @endif
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Other</label>
                    <input name="other" class="form-control" type="text" value="{{ $data['trade_license_partners']->other  }}">
                </div>
            </div>
 
        </div>
        <div class="text-center">
            <input name="submit" type="submit" class="btn" value="Update">
        </div>
    </form>
</div>

<script>
    $( document ).ready(function() {
       
    });
</script>