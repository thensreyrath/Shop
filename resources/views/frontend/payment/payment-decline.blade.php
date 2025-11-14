@extends('frontend.layout')
@section('title')
  Payment
@endsection
@section('content')
<main class="payment mt-5">
    <div class="container">
        <div class="container mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="lower p-2 py-3 text-white d-flex justify-content-between" id="successpay" style="background-color: #F25D92">
                            <div class="d-flex flex-column"><h5><span>Payment Declined</span></h5> </div>
                        </div>
                        <div class="upper p-4">
                            <div class="delivery">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"><h5><span class="ml-2"><u>Product Name:</u> </span></h5></div>
                                </div>
                            </div>
                            <div class="transaction mt-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">  <span class="ml-2">Payment Type:</span> </div> <span class="font-weight-bold"> PRINCE PAY</span>
                                </div>
                            </div>

                            <div class="transaction mt-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"> <span class="ml-2">Transaction Date:</span> </div> <span class="font-weight-bold"></span>
                                </div>
                            </div>
                            <div class="transaction mt-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"> <span class="ml-2">Transaction ID </span> </div> <span class="font-weight-bold"></span>
                                </div>
                            </div>
                            <div class="transaction mt-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center"> <span class="ml-2">Amount Paid: </span> </div> <span class="font-weight-bold"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('js')
   
</section>