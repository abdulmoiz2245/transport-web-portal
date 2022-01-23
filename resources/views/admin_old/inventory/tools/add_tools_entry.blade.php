<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.tools.tools_entry') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.tools.save_tools_entry') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group" >
            <label> Select Tool | Total Quantity</label>
            <select name="tools_description" id="" class="form-control">
                @foreach($data['tools'] as $tool)
                @if($tool->row_status != 'deleted')
                    <option value="{{ $tool->id }}"> {{ $tool->tools_description}} | {{ $tool->quantity}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label > Assigned Person  Name</label>
            <input type="text" name="assign_person_name" class="form-control" required> 
        </div>
        <div class="form-group">
            <label > Assigned Person  Designation</label>
            <input type="text" name="assign_person_designation" class="form-control" required> 
        </div>
        
        <div class="form-group" >
            <label>Quantity</label>
            <input type="text" name="quantity" class="form-control">
        </div>
        <div class="form-group">
            <label>Upload Receiving of the person tools are given to</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload Receiving</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="reciving">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    

</script>