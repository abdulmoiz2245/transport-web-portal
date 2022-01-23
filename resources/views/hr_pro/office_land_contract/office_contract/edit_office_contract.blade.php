<div class="container">
    <div class="mb-5"> 
        <a href="{{ route( 'user.hr_pro.office_contracts') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <form action="{{ route('user.hr_pro.update_office_contracts') }}" method="post" enctype="multipart/form-data">
    @csrf
        <input type="text" name="id" value="{{ $data['office_contract']->id }}" class="d-none">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['office_contract']->status_message }}</textarea>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <div class="d-flex">
                        <label>CONTRACT NUMBER</label>
                        @if($data['office_edit'] != null && $data['office_contract']->contract_number != $data['office_edit']->contract_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['office_edit']->contract_number}} </div> 
                        @endif
                    </div>
                   
                    <input type="text" name="contract_number" class="form-control form-control-rounded"  placeholder="Enter CONTRACT NUMBER" value="{{$data['office_contract']->contract_number}}" >
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Plot Details</label>
                        @if($data['office_edit'] != null && $data['office_contract']->plot_details != $data['office_edit']->plot_details )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['office_edit']->plot_details}} </div> 
                        @endif
                    </div>
                    <input name="plot_details" class="form-control" type="text" value="{{$data['office_contract']->plot_details}}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Landloard Name</label>
                        @if($data['office_edit'] != null && $data['office_contract']->landloard_name != $data['office_edit']->landloard_name )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['office_edit']->landloard_name}} </div> 
                        @endif
                    </div>
                    <input type="text" name="landloard_name" class="form-control form-control-rounded"  placeholder="Enter Landloard Name" value="{{$data['office_contract']->landloard_name}}">
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Contract Expiary Date</label>
                        @if($data['office_edit'] != null && $data['office_contract']->contract_expiary_date != $data['office_edit']->contract_expiary_date )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['office_edit']->contract_expiary_date}} </div> 
                        @endif
                    </div>
                    <input name="contract_expiary_date" class="form-control" type="date" value="{{$data['office_contract']->contract_expiary_date}}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Ijari Number</label>
                        @if($data['office_edit'] != null && $data['office_contract']->ijari_number != $data['office_edit']->ijari_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['office_edit']->ijari_number}} </div> 
                        @endif
                    </div>
                    <input type="text" name="ijari_number" class="form-control form-control-rounded"  placeholder="Enter Ijari Number" value="{{$data['office_contract']->ijari_number}}">
                </div>
           </div>
           <div class="col-6">
                @if($data['office_contract']->lease_rent != NULL)
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex">
                            <label>Replace Lease/Rent Copy</label>
                            @if($data['office_edit'] != null && $data['office_contract']->lease_rent != $data['office_edit']->lease_rent )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old file : 
                                    <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_edit']->lease_rent}}" >
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
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_contract']->lease_rent}}">
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
           <div class="col-6">
                @if($data['office_contract']->ijari_certificate != NULL)
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex">
                            <label>Replace Ijari Certificate</label>
                            @if($data['office_edit'] != null && $data['office_contract']->ijari_certificate != $data['office_edit']->ijari_certificate )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old file : 
                                    <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_edit']->ijari_certificate}}" >
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
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_contract']->ijari_certificate}}">
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
                        @if($data['office_edit'] != null && $data['office_contract']->amount != $data['office_edit']->amount )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['office_edit']->amount}} </div> 
                        @endif
                    </div>
                    <input name="amount" class="form-control" type="text" value="{{$data['office_contract']->amount}}">

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