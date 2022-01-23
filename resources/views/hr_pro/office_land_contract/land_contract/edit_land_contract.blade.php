<div class="container">

    <div class="mb-5"> 
        <a href="{{ route( 'user.hr_pro.land_contracts') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <form action="{{ route('user.hr_pro.update_land_contracts') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['land_contract']->id }}" class="d-none">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['land_contract']->status_message }}</textarea>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>CONTRACT NUMBER</label>
                        @if($data['land_edit'] != null && $data['land_contract']->contract_number != $data['land_edit']->contract_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['land_edit']->land_contract}} </div> 
                        @endif
                    </div>

                    <input type="text" name="contract_number" class="form-control form-control-rounded"  placeholder="Enter CONTRACT NUMBER" value="{{ $data['land_contract']->contract_number }}">
                </div>
           </div>
           <div class="ccol-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Plot Details</label>
                        @if($data['land_edit'] != null && $data['land_contract']->plot_details != $data['land_edit']->plot_details )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['land_edit']->plot_details}} </div> 
                        @endif
                    </div>
                    <input name="plot_details" class="form-control" type="text" value="{{ $data['land_contract']->plot_details }}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                   
                    <div class="d-flex">
                        <label>Landloard Name</label>
                        @if($data['land_edit'] != null && $data['land_contract']->landloard_name != $data['land_edit']->landloard_name )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['land_edit']->landloard_name}} </div> 
                        @endif
                    </div>
                    <input type="text" name="landloard_name" class="form-control form-control-rounded"  placeholder="Enter Landloard Name" value="{{ $data['land_contract']->landloard_name }}" >
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Contract Expiary Date</label>
                        @if($data['land_edit'] != null && $data['land_contract']->contract_expiary_date != $data['land_edit']->contract_expiary_date )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['land_edit']->contract_expiary_date}} </div> 
                        @endif
                    </div>
                    <input name="contract_expiary_date" class="form-control" type="date" value="{{ $data['land_contract']->contract_expiary_date }}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group"> 
                    <div class="d-flex">
                        <label>Ijari Number</label>
                        @if($data['land_edit'] != null && $data['land_contract']->ijari_number != $data['land_edit']->ijari_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['land_edit']->ijari_number}} </div> 
                        @endif
                    </div>
                    <input type="text" name="ijari_number" class="form-control form-control-rounded"  placeholder="Enter Ijari Number"value="{{ $data['land_contract']->ijari_number }}" >
                </div>
            </div>
            <div class="col-md-6 col-12">
                @if($data['land_contract']->lease_rent != NULL)
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex">
                            <label>Replace Lease/Rent Copy</label>
                            @if($data['land_edit'] != null && $data['land_contract']->lease_rent != $data['land_edit']->lease_rent )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old file : 
                                    <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['land_edit']->lease_rent}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div> 
                            @endif
                        </div>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Replace Lease/Rent Copy</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="lease_rent">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['land_contract']->lease_rent}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Lease/Rent Copy</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Lease/Rent Copy</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="lease_rent">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            @endif
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
           @if($data['land_contract']->ijari_certificate != NULL)
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex">
                            <label>Replace Ijari Certificate</label>
                            @if($data['land_edit'] != null && $data['land_contract']->ijari_certificate != $data['land_edit']->ijari_certificate )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old file : 
                                    <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['land_edit']->ijari_certificate}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div> 
                            @endif
                        </div>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Replace Ijari Certificate</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="ijari_certificate">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['land_contract']->ijari_certificate}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Ijari Certificate</label>                 
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Ijari Certificate</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="ijari_certificate">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
           </div>
           <div class="col-6">
                <div class="form-group"> 
                    <div class="d-flex">
                        <label>Amount</label>
                        @if($data['land_edit'] != null && $data['land_contract']->amount != $data['land_edit']->amount )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['land_edit']->amount}} </div> 
                        @endif
                    </div>
                    <input name="amount" class="form-control" type="text" value="{{ $data['land_contract']->amount}}">

                </div>
           </div>
       </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>