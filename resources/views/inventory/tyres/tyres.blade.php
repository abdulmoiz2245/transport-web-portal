<?php 
use App\Models\Company_name;
use App\Models\Civil_defense_documents;
use App\Models\User;


?>
<div class="card">
    <div class="card-body">
    <div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'user.inventory') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tyres.new_used_tyres') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tyre.png" class="mb-1" alt="" width="35">
                        <h4 class="mt-2 mb-2"><strong>New/Used Tyres</strong></h4>
                        <p class="lead text-22 m-0">{{ $data['total_tyre']  }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tyres.complain_tyres') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tyre.png"  alt="" width="40">
                        <h4 class="mt-2 mb-2"><strong>Complain Tyres</strong></h4>
                        <p class="lead text-22 m-0">{{$data['complain_tyre']}}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tyres.tyres_entry') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tyre.png"  alt="" width="40">
                        <h4 class="mt-2 mb-2"><strong>Tyres Entry</strong></h4>
                        <p class="lead text-22 m-0">{{$data['tyre_enterd'] }}</p>
                    </div>
                </div>
            </a>
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
                'pdfHtml5'
            ]
        } );
    });

    

    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');  
    console.log($("[type='date']").attr("min",new_date) );
 
</script>