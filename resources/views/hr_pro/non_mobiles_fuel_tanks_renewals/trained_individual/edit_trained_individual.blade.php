<div class="container">
<div class="mb-4">
        <a href="{{ route( 'user.hr_pro.non_mobiles_fuel_tanks_renewals') }}">
            <button class="btn btn-primary">
                Back
            </button>
        </a>

    </div>
    <form action="{{ route('user.hr_pro.update_non_mobile_trained_individual') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['trained_individual']->id }}" class="d-none">
       
        <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Card NUMBER</label>
                    <input type="text" name="card_number" class="form-control form-control-rounded"  placeholder="Enter Card NUMBER"  value="{{$data['trained_individual']->card_number}}">
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input name="employee_name" class="form-control" type="text" placeholder="Enter Employee Name" value="{{$data['trained_individual']->employee_name}}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Expiary Date</label>
                    <input name="expiary_date" class="form-control" type="date" value="{{$data['trained_individual']->expiary_date}}">

                </div>
           </div>
           <div class="col-6">
                
                <div class="form-group">
                    @if($data['trained_individual']->pass_card != NULL)
                    <label>Replace Pass/Card</label>

                    @else
                    <label>Pass/Card</label>

                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            @if($data['trained_individual']->pass_card != NULL)
                            <span class="input-group-text" >Replace Pass/Card</span>
                            @else
                            <span class="input-group-text" >Pass/Card</span>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="pass_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                
                <div class="form-group">
                    @if($data['trained_individual']->front_pic != NULL)
                    <label>Replace Front Pic</label>

                    @else
                    <label>Front Pic</label>

                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            @if($data['trained_individual']->front_pic != NULL)
                            <span class="input-group-text" >Replace Front Pic</span>
                            @else
                            <span class="input-group-text" >Front Pic</span>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="front_pic">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-6">
                
                <div class="form-group">
                    @if($data['trained_individual']->back_pic != NULL)
                    <label>Replace Back Pic</label>

                    @else
                    <label>Back Pic</label>

                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            @if($data['trained_individual']->back_pic != NULL)
                            <span class="input-group-text" >Replace Back Pic</span>
                            @else
                            <span class="input-group-text" >Back Pic</span>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="back_pic">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
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