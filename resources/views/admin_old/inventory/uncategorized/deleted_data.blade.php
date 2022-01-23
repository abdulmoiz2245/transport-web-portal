<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
     <div class="mb-5"> 
        <a href="{{ route( 'admin.inventory.uncategorized') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="table-responsive">
        <table class="display table  nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Date </th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Brand</th>
                    <th>Unit</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['uncategorized'] as $uncategorized)
                @if($uncategorized->row_status == 'deleted')
                <tr> 
                    <td>{{ $uncategorized->id }}</td>
                    <td>{{ $uncategorized->date }}</td>
                    <td>{{ $uncategorized->product_name }}</td>
                    <td>{{ $uncategorized->quantity }}</td>
                    <td>{{ $uncategorized->size }}</td>
                    <td>{{ $uncategorized->brand }}</td>
                    <td>{{ $uncategorized->unit }}</td>

                    <td>
                        <a href="#" id="{{ $uncategorized->id }}"  class="restore-file"  >
                           
                            <button class="btn btn-success">Restore</button>
                        </a>
                    </td>
                    
                </tr>
                @endif
                @endforeach
            </tbody>         
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.table').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                // 'pdfHtml5'
            ]
        } );
    });

    $('.restore-file').click(function () {
        var file_id = this.id;
        swal({
            title: 'Are you sure?',
            text: "You want to Restore this Data .",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.inventory.uncategorized.restore_uncategorized_entry') }}",
                data:{id:file_id, _token :"{{ csrf_token() }}"},
                success:function(data){
                        if (data.status == 1) {
                            swal({
                                title: "Restored!",
                                text: "Data has been Restored.",
                                type: "success"
                            }).then(function () {
                                window.location.href = '';
                            });
                        }else{
                            toastr.error("Some thing went wrong. ");

                        }
                }
                });
            

        })
    });

    
</script>

<script>
function goBack() {
  window.history.back();
}

</script>