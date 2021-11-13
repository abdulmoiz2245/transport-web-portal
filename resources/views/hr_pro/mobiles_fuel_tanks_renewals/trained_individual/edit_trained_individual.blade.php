<div class="container">
    <div class="mb-5">
        <a href="{{ route( 'user.hr_pro.mobile_trained_individual') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>

    </div>
    <form action="{{ route('user.hr_pro.update_mobiles_trained_individual') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['trained_individual']->id }}" class="d-none">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['trained_individual']->status_message }}</textarea>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Card NUMBER</label>
                    <input type="text" name="card_number" class="form-control form-control-rounded"  placeholder="Enter Card NUMBER"  value="{{$data['trained_individual']->card_number}}">
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input name="employee_name" class="form-control" type="text" placeholder="Enter Employee Name" value="{{$data['trained_individual']->employee_name}}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Expiary Date</label>
                    <input name="expiary_date" class="form-control" type="date" value="{{$data['trained_individual']->expiary_date}}">

                </div>
           </div>
           <div class="col-md-6 col-12">
                @if($data['trained_individual']->pass_card != NULL)
                <div class="row">
                    <div class="col-12">
                            <label>Replace Pass/Card</label>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Replace Pass/Card</span> 
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="pass_card">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->pass_card}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Pass/Card</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Pass/Card</span>  
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="pass_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
            </div>
       </div>

       <div class="row">
       <div class="col-md-6 col-12">
                @if($data['trained_individual']->front_pic != NULL)
                <div class="row">
                    <div class="col-12">
                        <label>Replace Front Pic</label>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Replace Front Pic</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="front_pic">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->front_pic}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Front Pic</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Front Pic</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="front_pic">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-6 col-12">
                @if($data['trained_individual']->back_pic != NULL)
                <div class="row">
                    <div class="col-12">
                        <label>Replace Back Pic</label>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Replace Back Pic</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="back_pic">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->back_pic}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Back Pic</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Back Pic</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="back_pic">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
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