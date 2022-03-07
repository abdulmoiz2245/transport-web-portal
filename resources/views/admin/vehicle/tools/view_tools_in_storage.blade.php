<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'admin.inventory.tools.tools_in_storage') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""><b>Tool Description :</b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['tools']->tools_description }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                   <h5 class=""> <b>Quantity : </b></h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['tools']->quantity }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""><b>Po Number of Purchase :</b></h5>
                </div>
                <div class="col-6">
                    <p>{{ $data['tools']->po_number }}</p>
                </div>
            </div>
        </div>
    </div>
</div>