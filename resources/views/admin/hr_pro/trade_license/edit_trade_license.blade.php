<?php 
use App\Models\Company_name;

?>
<div class="container">
   
    <div class="row mb-5">
        <div class="col-4">
            <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            <a href="{{ route( 'admin.hr_pro.add_comany_name') }}" class="ml-3">
                <button class="btn btn-primary">Add Company</button>
            </a>
            
        </div>
    </div>
    <form action="{{route('admin.hr_pro.update_trade_license__sponsors__partners')}}" method="post"    enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['trade_license']->id }}" class="d-none">

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label>Admin Notes</label>
                <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['trade_license']->status_message }}</textarea>
                
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value='pending' <?php if($data['trade_license']->status == 'pending') echo 'selected="selected"' ?> >Pending</option>
                    <option value='approved' <?php if($data['trade_license']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                    <option value='rejected' <?php if($data['trade_license']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <h2>Company</h2>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">   
                <div class="d-flex">
                    <label >Select Company</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->company_id != $data['trade_license_edit_history']->company_id )
                        <div class="edit-badge"> Edited </div> 
                        @foreach($data['company_names'] as $company_name)
                            @if($company_name->id == $data['trade_license_edit_history']->company_id)
                                <div class="old-value"> Old Value : {{ $data['company_name']->name}} </div>
                            @endif 
                        @endforeach
                    @endif
                </div>
                <?php if(Company_name::all()->count() > 0){ ?>
                    <select name="company_id" class="form-control "required > 
                        @foreach($data['company_names'] as $company_name)
                        <option value="{{ $company_name->id }}" <?php if($company_name->id == $data['trade_license']->company_id) echo '"selected"' ?> >{{ $company_name->name }}</option>
                        @endforeach
                    </select>
                <?php } else{ ?>
                <h5 class="text-danger">Please Add Company First </h5> 
                <?php } ?>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group"> 
                <div class="d-flex">
                    <label>Trade Name</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->trade_name != $data['trade_license_edit_history']->trade_name )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->trade_name}} </div> 
                    @endif
                </div>
                <input type="text" name="trade_name" class="form-control form-control-rounded"  placeholder="Enter Trade Name" value="{{ $data['trade_license']->trade_name }}" >
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-md-6 col-12">
            <div class="form-group"> 
                <div class="d-flex">
                    <label>License Number</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->license_number != $data['trade_license_edit_history']->license_number )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->license_number}} </div> 
                    @endif
                </div>
                <input type="text" name="license_number" class="form-control form-control-rounded"  placeholder="Enter License number" value="{{ $data['trade_license']->license_number }}">
            </div>
    </div>
    <div class="col-md-6 col-12">
            <div class="form-group">
                <div class="d-flex">
                    <label>Expiary Date</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->expiary_date != $data['trade_license_edit_history']->expiary_date )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->expiary_date}} </div> 
                    @endif
                </div>
                <input name="expiary_date" class="form-control" type="date" value="{{ $data['trade_license']->expiary_date }}">
            </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->trade_license_copy != 'null')
            <div class="row">
                <div class="col-12">  
                    <div class="d-flex">
                        <label>Replace Trade License Copy Upload</label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->trade_license_copy != $data['trade_license_edit_history']->trade_license_copy )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->trade_license_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Trade License</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="trade_license">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->trade_license_copy}}">
                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                    </a>
                </div>
            </div>
            @else
            <div class="form-group">
                <label>Trade License Copy Upload</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload Trade License</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="trade_license">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->member_ship_certificate != 'null')
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <label>Replace Membership Certificate </label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->member_ship_certificate != $data['trade_license_edit_history']->member_ship_certificate )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->member_ship_certificate}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group">                   
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Membership Certificate</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="membership_certificate">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->member_ship_certificate}}">
                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                    </a>
                </div>
            </div>
            @else
            <div class="form-group">
                <label>Membership Certificate Upload</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload Membership Certificate</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="membership_certificate">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->sponsor_page != 'null')
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <label>Replace Sponsor Page</label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->sponsor_page != $data['trade_license_edit_history']->sponsor_page )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->sponsor_page}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Sponsor Page</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_page">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_page}}">
                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                    </a>
                </div>
            </div>
            @else
            <div class="form-group">
                <label>Sponsor Page Upload</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload Sponsor Page</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="sponsor_page">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">  
                <div class="d-flex">
                    <label>Other</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->company_other != $data['trade_license_edit_history']->company_other )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->company_other}} </div> 
                    @endif
                </div>
                <input name="company_other" class="form-control" type="text" value="{{ $data['trade_license']->company_other  }}">
            </div>
        </div>
    </div>

    <hr>
    <h2>Manager</h2>
    <div class="row">
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->manager_id_card != 'null')
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <label>Replace Id Card </label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->manager_id_card != $data['trade_license_edit_history']->manager_id_card )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->manager_id_card}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Id Card</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="manager_id_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_id_card}}">
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
                        <input type="file" class="custom-file-input"   name="manager_id_card">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
                @if( $data['trade_license']->manager_passport != 'null')
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex">
                            <label>Replace Passport </label>
                            @if($data['trade_license_edit_history'] != null && $data['trade_license']->manager_passport != $data['trade_license_edit_history']->manager_passport )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old file : 
                                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->manager_passport}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div> 
                            @endif
                        </div>
                    </div>
                    <div class="col-11 form-group"> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload Passport</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="manager_passport">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_passport}}">
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
                            <input type="file" class="custom-file-input"   name="manager_passport">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
        </div>
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->manager_visa != 'null')
            <div class="row">
                <div class="col-12">
                    
                    <div class="d-flex">
                        <label>Replace Visa </label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->manager_visa != $data['trade_license_edit_history']->manager_visa )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->manager_visa}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload visa</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="manager_visa">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_visa}}">
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
                        <input type="file" class="custom-file-input"   name="manager_visa">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group">
                <div class="d-flex">
                    <label>Other</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->manager_other != $data['trade_license_edit_history']->manager_other )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->manager_other}} </div> 
                    @endif
                </div>
                <input name="manager_other" class="form-control" type="text" value="{{ $data['trade_license']->manager_other  }}">
            </div>
        </div>
    </div>

    <hr>
    <h2>Sponsor</h2>
    <div class="row">
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->sponsor_id_card != 'null')
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <label>Replace Id Card </label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->sponsor_id_card != $data['trade_license_edit_history']->sponsor_id_card )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->sponsor_id_card}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group"> 
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Id Card</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_id_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_id_card}}">
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
                        <input type="file" class="custom-file-input"   name="sponsor_id_card">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->sponsor_passport != 'null')
            <div class="row">
                <div class="col-12"> 
                    <div class="d-flex">
                        <label>Replace Passport </label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->sponsor_passport != $data['trade_license_edit_history']->sponsor_passport )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->sponsor_passport}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Passport</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_passport">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_passport}}">
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
                        <input type="file" class="custom-file-input"   name="sponsor_passport">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->sponsor_visa != 'null')
            <div class="row">
                <div class="col-12">
                    <div class="d-flex">
                        <label>Replace Visa </label>
                        @if($data['trade_license_edit_history'] != null && $data['trade_license']->sponsor_visa != $data['trade_license_edit_history']->sponsor_visa )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old file : 
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license_edit_history']->sponsor_visa}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                            </div> 
                        @endif
                    </div>
                </div>
                <div class="col-11 form-group"> 
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload visa</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_visa">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_visa}}">
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
                        <input type="file" class="custom-file-input"   name="sponsor_visa">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <div class="d-flex">
                    <label>Sponsorship Fee</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->sponsorship_fee != $data['trade_license_edit_history']->sponsorship_fee )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->sponsorship_fee}} </div> 
                    @endif
                </div>
                <input name="sponsorship_fee" class="form-control" type="text" value="{{ $data['trade_license']->sponsorship_fee }}">

            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <div class="d-flex">
                    <label>Other</label>
                    @if($data['trade_license_edit_history'] != null && $data['trade_license']->sponsor_other != $data['trade_license_edit_history']->sponsor_other )
                        <div class="edit-badge"> Edited </div> 
                        <div class="old-value"> Old Value : {{ $data['trade_license_edit_history']->sponsor_other}} </div> 
                    @endif
                </div>
                <input name="sponsor_other" class="form-control" type="text" value="{{ $data['trade_license']->sponsor_other  }}">
            </div>
        </div>
    </div>

    <!-- <hr>
    <h2>Partners</h2>
    <div class="row">
        <div class="col-md-6 col-12">
            @if( $data['trade_license']->partners_id_card != 'null')
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
                            <input type="file" class="custom-file-input"   name="partners_id_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_id_card}}">
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
                        <input type="file" class="custom-file-input"   name="partners_id_card">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
    </div>
    <div class="col-md-6 col-12">
            @if( $data['trade_license']->partners_passport != 'null')
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
                            <input type="file" class="custom-file-input"   name="partners_passport">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_passport}}">
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
                        <input type="file" class="custom-file-input"   name="partners_passport">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
    </div>
    <div class="col-md-6 col-12">
            @if( $data['trade_license']->partners_visa != 'null')
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
                            <input type="file" class="custom-file-input"   name="partners_visa">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0">
                    <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_visa}}">
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
                        <input type="file" class="custom-file-input"   name="partners_visa">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            @endif
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label>Other</label>
            <input name="partners_other" class="form-control" type="text" value="{{ $data['trade_license']->partners_other  }}">
        </div>
    </div>
    </div> -->



    <div class="text-center mt-5">
        <input type="submit" class="btn btn-outline-secondary rounded-pill" value="Update ">
    </div>

    </form>
</div>

<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    $("[type='date']").attr("min",new_date) ;

</script>