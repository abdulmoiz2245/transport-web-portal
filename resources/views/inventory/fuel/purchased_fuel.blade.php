<?php 
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
use App\Models\Fuel_transfer;



  
?>
<div class="card">
    <div class="card-body">
    <div class="container">

<div class="d-flex" style="justify-content: space-between;">
    <div>
        <a href="{{ route( 'user.inventory.fuel') }}" class="ml-3">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>

<?php 
    $total_purchase = 0;
    $total_fuel_remaining = 0;
    $total_fuel_consumed = 0;

    foreach($data['purchased_fuel'] as $purchased_fuel){
        $total_purchase = $total_purchase + (int)$purchased_fuel->quantity;
    }

    if(Fuel_transfer::latest('date')->first()){
        $total_fuel_remaining = Fuel_transfer::latest('date')->first()->total_fuel_remaining;
    }else{
        $total_fuel_remaining = $total_purchase;
    }
    if(Fuel_transfer::latest('date')->first()){
        $total_fuel_consumed = Fuel_transfer::latest('date')->first()->total_fuel_consumed;
    }
    
?>

<div class="row mt-4 mb-4">
    <!-- ICON BG-->
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card o-hidden">
            <div class="card-body text-center">
                <h4 class="card-title"> Total Fuel in Storage</h4>   
                <p class="text-primary text-24 line-height-1">{{ $total_fuel_remaining }} liter</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card o-hidden">
            <div class="card-body text-center">
                <h4 class="card-title">Total Fuel Purchased</h4>   
                <p class="text-primary text-24 line-height-1">{{ $total_purchase}} liter</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card o-hidden">
            <div class="card-body text-center">
                <h4 class="card-title"> Total Fuel Consumption</h4>   
                <p class="text-primary text-24 line-height-1">{{$total_fuel_consumed }} liter</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12"> 
             <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="table-responsive">
                        <table  class="display table table  nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PO Number</th>
                                    <th>Fuel Amount</th>
                                    <th>Company Name</th>
                                    <th>TRN Number</th>
                                    <th>Price</th>
                                    <th>Delivery Date</th>
                                    <!-- <th>Action By</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['purchased_fuel'] as $purchased_fuel)
                                <tr>
                                    <td>{{$purchased_fuel->id}}</td>
                                    <td>{{$purchased_fuel->po_number}}</td>
                                    <td>{{$purchased_fuel->quantity}}</td>
                                    <td>{{$purchased_fuel->company_name}}</td>
                                    <td>{{$purchased_fuel->trn}}</td>
                                    <td>{{$purchased_fuel->unit_price}}</td>
                                    <td>{{$purchased_fuel->delivery_date}}</td>

                                    <td>
                                        <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$purchased_fuel->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form>

                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>         
                        </table>
                    </div>
                </div>
            </div>
    </div>
</div>

</div>
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

</script>