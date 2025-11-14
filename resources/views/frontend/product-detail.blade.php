@extends('frontend.layout')
@section('title')
    Product Detail
@endsection
@section('content')
<main class="product-detail">
    <section class="review">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="thumbnail">
                        {{-- @if (!empty($productDetail) && isset($productDetail[0]) && !empty($productDetail[0]->thumbnail))
                            <img src="/uploads/{{ $productDetail[0]->thumbnail }}" alt="Product Thumbnail">
                        @else
                            <p>No thumbnail available.</p>
                        @endif --}}
                        <img src="/uploads/{{ $productDetail[0]->thumbnail}}" >
                    </div>
                </div>
                <div class="col-7">
                    <div class="detail">
                        <div class="group-size">
                            <span class="title">ID</span>
                            <div class="group" id="id">{{ $productDetail[0]->id }}</div>
                        </div>
                        <div class="price-list">
                            @php
                                if($productDetail[0]->sale_price > 0) {
                                    $statusRegular = 'd-none';
                                    $statusSale    = 'd-block';
                                }
                                else {
                                    $statusRegular = 'd-block';
                                    $statusSale    = 'd-none';
                                }
                            @endphp
                            <div class="regular-price {{ $statusSale }}">
                                <strike> USD {{ $productDetail[0]->regular_price }}</strike>
                            </div>
                            <div class="sale-price {{ $statusSale }}">
                                USD {{ $productDetail[0]->sale_price }}
                              
                            </div>
                            <div class="price {{ $statusRegular }}" >
                                USD {{ $productDetail[0]->regular_price }}
                                
                            </div>
                        </div>
                        {{-- <h5 class="title"></h5> --}}
                        <div class="group-size">
                            <span class="title">Name</span>
                            <div class="group">{{ $productDetail[0]->name }}</div>
                        </div>
                        <div class="group-size">
                            <span class="title" >OrderId</span>
                            <div class="group" id="orderid">{{$mytime}}</div>
                        </div>
                        <div class="group-size">
                            <span class="title">Color Available</span>
                            <div class="group">{{ $productDetail[0]->color }}</div>
                        </div>
                        <div class="group-size">
                            <span class="title">Size Available</span>
                            <div class="group">{{ $productDetail[0]->size }}</div>
                        </div>
                        <div class="group-size">
                            <span class="title">Description</span>
                            <div class="description" id="description">{{ $productDetail[0]->description }}</div>
                        </div>
                    </div>
                    <div class="group-size mt-5">
                        <!-- Button trigger modal -->
                        <button type="button" class="pay" data-bs-toggle="modal" data-bs-target="#exampleModal" id="call-qr">Scan to Pay</button>
                    <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog m-3" style="float: right; width: 100%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Make Your Payment</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-3">
                                            <div class="col-12">
                                                {{-- <h4>Scan To pay</h4> --}}
                                                <div class="container" style="display: flex; justify-content: center;">
                                                    <div class="qr-card image">
                                                        <div class="qr-card-header">
                                                            <img src="/css/frontend/img/khqr.png" alt="">
                                                        </div>
                                                        <div class="qr-card-price">
                                                            <p class="khqr-name">{{ $setting[0]->merchant_name }}</p>
                                                            <span class="currency">
                                                                @php
                                                                    if($productDetail[0]->sale_price > 0) {
                                                                        $statusRegular = 'd-none';
                                                                        $statusSale    = 'd-block';
                                                                    }
                                                                    else {
                                                                        $statusRegular = 'd-block';
                                                                        $statusSale    = 'd-none';
                                                                    }
                                                                @endphp
                                                                <div class="regular-price {{ $statusSale }}">
                                                                    <strong id="saleprice">{{ $productDetail[0]->sale_price }}</strong><span></span> USD
                                                                </div>
                                                                <div class="sale-price{{ $statusRegular }} " hidden>
                                                                    <strong id="regularprice" >{{ $productDetail[0]->regular_price }}</strong> USD
                                                                </div>
                                                                <div class="price {{ $statusRegular }}">
                                                                    <strong id="price">{{ $productDetail[0]->regular_price }}</strong> USD
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="qr-card-body">
                                                            <div id="qr_img" style="width: 210px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Payment-Success--}}
                                    {{-- <div class="container mb-5">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="lower p-2 py-3 text-white d-flex justify-content-between" id="successpay" style="background-color: #F25D92">
                                                        <div class="d-flex flex-column"><h5><span>Payment Successful</span></h5> </div>
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
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        RELATED PRODUCTS
                    </h3>
                </div>
            </div>
            <div class="row">
                @foreach ($relateProduct as $relatedProductVal)
                    @if ($relatedProductVal->qty > 0)
                        @php
                            $status = 'Promotion';
                        @endphp
                    @else
                        @php
                            $status = 'Out Of Stock';
                        @endphp
                    @endif

                    @if ($relatedProductVal->sale_price > 0)
                        @php
                            $promoStatus = 'd-block';
                            $regularPriceStatus = 'd-none';
                            $salePriceStatus    = 'd-block';
                        @endphp
                    @else
                        @php
                            $promoStatus = 'd-none';
                            $regularPriceStatus = 'd-block';
                            $salePriceStatus    = 'd-none';
                        @endphp
                    @endif

                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <div class="status {{ $promoStatus }}">
                                    {{ $status }}
                                </div>
                                <a href="/product/{{ $relatedProductVal->slug }}">
                                    <img src="/uploads/{{ $relatedProductVal->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    <div class="price {{ $regularPriceStatus }}">US {{ $relatedProductVal->regular_price }}</div>
                                    <div class="regular-price {{ $salePriceStatus }}"><strike> US {{ $relatedProductVal->regular_price }}</strike></div>
                                    <div class="sale-price {{$salePriceStatus}}">US {{ $relatedProductVal->sale_price }}</div>
                                </div>
                                <h5 class="title">{{ $relatedProductVal->name }}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#call-qr').on('click', function() {
                $('#exampleModal').modal('show');
                callQr();
               
            });
 
            function callQr() {
                var id = $("#id").text();
                var orderid = $("#orderid").text();
                var saleprice = $('#saleprice').text().trim();
                var regularPrice = $('#regularprice').text().trim();
                var price = $('#price').text().trim();
                var currency = $("#currency").val();
                var description = $("#description").text();
               
                var currentPrice = '';
               
                if (saleprice && saleprice !== '0') {
                    currentPrice = saleprice; 
                } else if (regularPrice && regularPrice !== '0') {
                    currentPrice = regularPrice; 
                } else {
                    currentPrice = 'Price not available'; 
                }
                console.log(currentPrice);
                
                var result = $.ajax({
                    url: "{{ route('callqr') }}",
                    type: 'POST',
                    data: {
                        id: id,
                        transOrderNo: orderid,
                        amt:currentPrice,
                        currency:'USD',
                        remark: description,
                        notifyUrl: "",
                        expireMinutes: 15,
                        _token: '{{ csrf_token() }}' 
                    },
                    
                    success: function(data) {
                        $('#qr_img').html(data);
                        console.log('Success:',amt);
                       
                    },
                
                    // error: function(result) {d
                    //     console.error('Error:',result);
                    // }
                   
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        console.error('Status:', status);
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
</section>