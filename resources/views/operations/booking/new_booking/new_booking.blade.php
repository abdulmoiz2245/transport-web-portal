<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href=""  data-toggle="modal" data-target="#normal_booking">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Calendar-4" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Normal Job </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="" data-toggle="modal" data-target="#one_time_booking">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <i class="nav-icon  i-Calendar-4" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>One Time Job (OTJ)</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="normal_booking" tabindex="-1" role="dialog" aria-labelledby="normal_booking" aria-hidden="true">
        <div class="modal-dialog modal-lg"  role="document">
            <form action="{{ route('user.operations.new_normal_booking') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="normal_booking">Normal Job Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label >Customer</label>
                            <select name="customer_id" id="customer_name" class="form-control" required placeholder="">
                                @foreach($data['customer'] as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label >Customer From-To Location</label>
                            <select name="customer_rate_card_id" id ="customer_rate" class="form-control" required placeholder="">
                                
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Open Booking</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="one_time_booking" tabindex="-1" role="dialog" aria-labelledby="one_time_booking" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">One Time Job Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        var customer_rate_card = <?php echo json_encode($data['customer_rate_card']); ?>;
        console.log(customer_rate_card);
       

        $('#customer_name').on('change', function() {
            $("#customer_rate").empty();
            customer_rate_card.forEach(
                (element) => {
                    if(this.value == element.customer_id){
                        var o = new Option("From: "+element.from+" - To: "+element.to, element.id);
                        $("#customer_rate").append(o);
                    }
            });
        });
    });
</script>


