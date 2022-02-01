

<div class="card">
    <div class="card-body">
    <div class="container">
    <h2 class="mb-5 mt-2"> <span>Permission Access : {{ $data['role_name']->name }}</span>  </h2>

    @foreach($data['modules'] as $module)
    <div id="accordion" class="mb-4">
        @if($module->parent_id == 0)
        <div class="card">
           
            <div class="card-header" id="headingOne">
                <div class="row">
                    <div class="col-3">
                        <h3 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#a{{$module->id}}" aria-expanded="true" aria-controls="collapseOne">
                            {{ $module->name}}
                            </button>
                        </h3>
                    </div>
                    <div class="col-9">
                        <label class="switch switch-success mr-3">
                            <span>View</span>
                            <input type="checkbox" class="operation" data-module="{{ $module->id }}" data-operation="view" <?php 
                                    foreach($data['permission'] as $permission){
                                        if ($module->id == $permission->module_id){ 
                                            if($permission->status == 1){
                            ?> checked="checked" <?php } } }?> >
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            

            </div>
            

            <div id="a{{$module->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    @foreach($data['modules1'] as $sub_module)
                        <?php //var_dump($sub_module->name)   ?>
                    @if($module->id === $sub_module->parent_id)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h5 class="m-0">
                                <strong class="f-16">{{ $sub_module->name }}</strong>
                            </h5>
                        </div>
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-3 pb-3">	
                                    <label class="switch switch-success mr-3">
                                        <span>View</span>
                                        <input type="checkbox" class="operation" data-module="{{ $sub_module->id }}" data-operation="view" <?php 
                                                foreach($data['permission'] as $permission){
                                                    if ($sub_module->id == $permission->module_id){ 
                                                        if($permission->status == 1){
                                        ?> checked="checked" <?php } } }?> >
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        
    </div>
    @endforeach

</div>
    </div>
</div>


<script type="text/javascript">
   
    $(".operation").change(function(e){
  
        e.preventDefault();
        var value = $(this).val();
        var checked = 0;

        if($(this).is(":checked")){
            checked = 1;
            console.log($(this).attr('data-module') );

        }else{
            checked = 0;
            console.log('not checked');
        }

        var module_id = $(this).attr('data-module');
        var operation = $(this).attr('data-operation')
        var role_id = {{ $data['role_name']->id }};
        var _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
           type:'POST',
           url:"{{ route('admin.setting.permission-update') }}",
           data:{module_id:module_id, operation:operation, role_id:role_id ,status:checked , _token :"{{ csrf_token() }}"},
           success:function(data){
                toastr.success("Status Changed Successfully");
           }
        });
  
    });
</script>