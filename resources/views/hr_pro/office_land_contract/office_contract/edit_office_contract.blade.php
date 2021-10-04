<div class="container">
    <form action="{{ route('user.hr_pro.update_office_contracts') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['office_contract']->id }}" class="d-none">
        <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>CONTRACT NUMBER</label>
                    <input type="text" name="contract_number" class="form-control form-control-rounded"  placeholder="Enter CONTRACT NUMBER" value="{{$data['office_contract']->contract_number}}" >
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Plot Details</label>
                    <input name="plot_details" class="form-control" type="text" value="{{$data['office_contract']->plot_details}}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Landloard Name</label>
                    <input type="text" name="landloard_name" class="form-control form-control-rounded"  placeholder="Enter Landloard Name" value="{{$data['office_contract']->landloard_name}}">
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Contract Expiary Date</label>
                    <input name="contract_expiary_date" class="form-control" type="date" value="{{$data['office_contract']->contract_expiary_date}}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Ijari Number</label>
                    <input type="text" name="ijari_number" class="form-control form-control-rounded"  placeholder="Enter Ijari Number" value="{{$data['office_contract']->ijari_number}}">
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    @if($data['office_contract']->lease_rent != NULL)
                    <label>Replace Lease/Rent Copy</label>

                    @else
                    <label>Lease/Rent Copy</label>

                    @endif
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            @if($data['office_contract']->lease_rent != NULL)
                            <span class="input-group-text" >Replace Lease/Rent Copy</span>
                            @else
                            <span class="input-group-text" >Lease/Rent Copy</span>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="lease_rent">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    @if($data['office_contract']->ijari_certificate != NULL)
                    <label>Replace Ijari Certificate</label>
                    @else
                    <label>Ijari Certificate</label>
                    @endif
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            @if($data['office_contract']->ijari_certificate != NULL)
                            <span class="input-group-text" >Replace Ijari Certificate</span>
                            @else
                            <span class="input-group-text" >Ijari Certificate</span>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="ijari_certificate">
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