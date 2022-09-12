<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Invoice</a></li>
        </ul>
        <div class="card">
            <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
                <div>
                    <a href="{{ route( 'user.account.invoice') }}">
                        <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                    </a>
                    
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                    <div class="d-sm-flex mb-5" data-view="print"><span class="m-auto"></span>
                        <button class="btn btn-primary mb-sm-0 mb-3 print-invoice" onclick="window.print()">Print Invoice</button>
                    </div>
                    <!-- -===== Print Area =======-->
                    <div id="print-area">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="font-weight-bold">Invoice Number</h4>
                                <p>
                                   INV-{{  $data['invoice']->invoice_no }}
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 class="font-weight-bold">Cash/Credit Tax Invoice</h4>
                                <!-- <p>#106</p> -->
                            </div>
                            <div class="col-md-4 text-sm-right">
                                <h4 class="font-weight-bold">Invoice Date</h4>
                                <p>{{  $data['invoice']->date }}</p>
                            </div>
                        </div>
                        <div class="mt-3 mb-4 border-top"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6 class="font-weight-bold">Company Name</h6>
                                <p>
                                    <?php if($data['company_names']->count() > 0){ ?>
                                            <?php $check = 0; ?>
                                        @foreach($data['company_names'] as $company_name)
                                            @if($company_name->id == $data['customer']->company_id)
                                                <?php $check = 1 ?>
                                                {{ $company_name->name}}
                                                <input type="text" name="company_id" class="d-none" value="{{ $company_name->id }}" >

                                            @endif
                                        @endforeach
                                        <?php if($check == 0){ ?>
                                            <span class="badge badge-pill badge-danger p-2 m-1">Nill</span>
                                        <?php } ?>
                                
                                    <?php }else{ ?>
                                            <span class="badge badge-pill badge-danger p-2 m-1">Nill</span>
                                        <?php } ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <h6 class="font-weight-bold">Customer Name </h6>
                                <p> 
                                    {{  $data['invoice']->customer_name }}
                                </p>
                            </div>
                            <div class="col-md-4 text-sm-right">
                                <h6 class="font-weight-bold">TRN</h6>
                                <p><?= $data['customer']->trn ?>
                               
                            </p>
                            </div>
                        </div>
                        <div class="mt-3 mb-4 border-top"></div>

                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-sm-0">
                                <h5 class="font-weight-bold">Invoice From</h5>
                                <p>{{ $data['invoice']->from_date }}

                                </p>
                            </div>
                            <div class="col-md-6 text-sm-right">
                                <h5 class="font-weight-bold">To Date</h5>
                                <p>{{ $data['invoice']->to_date }}</p>

                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="table-responsive">
                                <table class="table table-hover mb-4">
                                    <thead class="bg-gray-300">
                                        <tr>
                                            <th scope="col">Job Id</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Delivery Date</th>
                                            <th scope="col">Vehicle No</th>
                                            <th scope="col">Deten</th>
                                            <th scope="col">Deten Rate</th>

                                            <th scope="col">Toll </th>
                                            <th scope="col">Gate </th>
                                            <th scope="col">Labour </th>
                                            <th scope="col">Border </th>
                                            <th scope="col">Other </th>
                                            <th scope="col">Price</th>

                                            <th scope="col">Amount </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['booking'] as $booking)
                                            <tr id="row-{{ $booking->id }}">
                                                <td>{{ $booking->job_id}}
                                                </td>
                                                <td>{{ $booking->from_location}}
                                                </td>
                                                <td>{{ $booking->to_location}}
                                                </td>
                                                <td>{{ $booking->offloading_date}}

                                                </td>
                                                <td> 
                                                    @foreach($data['vehicle'] as $vehicle)
                                                        @if($vehicle->id == $booking->vehicle_id)
                                                            {{ $vehicle->vehicle_number}}
                                                        @endif
                                                    @endforeach

                                                </td>
                                                <td id="col-deten">
                                                    {{ $booking->detention_type}} | Duration  ( {{ $booking->detention_duration}} )
                                                    
                                                </td>

                                                <td id="col-deten-rate-{{ $booking->rate_card_id }}">
                                                    {{ $booking->detention_rate}}

                                                </td>

                                                <td class="" id="col-toll-charges-{{ $booking->id }}">
                                                    {{ $booking->toll_charges}}
                                                </td>

                                                <td class="" id="col-gate-charges-{{ $booking->id }}">
                                                    {{ $booking->gate_charges}}
                                                    
                                                </td>

                                                <td class="" id="col-labour-charges-{{ $booking->id }}">{{ $booking->labour_charges}}</td>

                                                <td class="" id="col-border-charges-{{ $booking->id }}"> {{ $booking->border_charges}}</td>
                                                
                                                <td class="" id="col-other-charges-{{ $booking->id }}">{{ $booking->other_charges}}</td>

                                                <td id="col-rate-price-{{ $booking->id }}" >
                                                    {{ $booking->job_price}}
                                                </td>
                                                <td id="col-total-amount-{{ $booking->id }}" class="total-price">
                                                    {{ $booking->total_amount}}

                                                </td>

                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="invoice-summary">
                                    <input name="sub_total_amount"  id="sub-total-amount-input" type="float" class="d-none form-control" value="0">
                                    <input name="vat_amount"  id="vat-amount-input" type="float" class="d-none form-control" value="0">
                                    <input name="grand_total"  id="grand-total-amount-input" type="float" class="d-none form-control" value="0">

                                    <p>Sub total: <span class="sub-total-amount">{{ $data['invoice']->sub_total_amount }}</span></p>
                                    <p>Vat (5%): <span  class="vat-amount">{{  $data['invoice']->vat_amount }}</span></p>
                                    <h5 class="font-weight-bold">Grand Total: <span class="grand-total"> {{ $data['invoice']->grand_total }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ==== / Print Area =====-->
                    <!-- <button id="submit-invoice" type="submit" class="btn btn-primary">Save Invoice</button> -->
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
