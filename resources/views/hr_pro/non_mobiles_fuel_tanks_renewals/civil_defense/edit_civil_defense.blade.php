<div class="container">

    <div class="mb-5">
        <a href="{{ route( 'user.hr_pro.non_mobile_civil_defence') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>

    </div>

    <form action="{{ route('user.hr_pro.update_non_mobile_civil_defence') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{  $data['civil_defense']->status_message  }}</textarea>
                    
                </div>
            </div>
        </div>
        <hr>
        <input type="text" name="id" value="{{ $data['civil_defense']->id }}" class="d-none">
        @if( $data['civil_defense']->document != '')
        <div class="row">
            <div class="col-12">
                <label>Replace CIVIL DEFENSE DOCUMENT</label>
            </div>
            <div class="col-11 form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload CIVIL DEFENSE DOCUMENT</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="document">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-1 p-0">
                <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/non_mobile_fuel_tank_renewals/{{$data['civil_defense']->document}}">
                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                </a>
            </div>
        </div>
        @else
        <div class="form-group">
            <label>CIVIL DEFENSE DOCUMENT Upload</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload CIVIL DEFENSE DOCUMENT</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="document">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label for="admin-status">Expiary Date</label>
            <input type="date" name="expiary_date" class="form-control" value="{{ $data['civil_defense']->expiary_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>