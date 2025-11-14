@extends('frontend.layout')
@section('title')
  Payment
@endsection
@section('content')
<main class="payment">
    <div class="container">
        {{-- <div class="card"> --}}
            <div class="row m-3">
                <div class="col-5">
                    {{-- <h4>Scan To pay</h4> --}}
                    <div class="container" style="display: flex; justify-content: center;">
                        <div class="qr-card image">
                            <div class="qr-card-header">
                                <img src="/frontend/img/khqr.png" />
                            </div>
                            <div class="qr-card-price">
                                <p class="khqr-name">Rich Kide</p>
                                    <span class="currency"><strong>5</strong> USD</span>
                                </p>
                            </div>
                            <div class="qr-card-body">
                                <img src="/frontend/img/qr.png" style="width: 200px;">
                                {{-- <div id="qr_image" style="width: 210px;"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-7 detail">
                    <h5 class="title">Summary</h5>
                    <div class="detail">
                        @foreach ($product as $pro)
                            <p>Name: {{$pro->name}}</p>
                            <p>Price: {{$pro->sale_price}}</p>
                            <p>Item: </p>
                            <p>Total Amount: </p>
                            <hr class="hr">
                        @endforeach
                    </div>
                    
                    {{-- <div class="card" >
                        <div class="card-header">
                            <h5>Summary</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">item</li>
                            <li class="list-group-item">A second item</li>
                            <li class="list-group-item"></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        {{-- </div> --}}
    </div>
</main>
@endsection
@section('js')
   
</section>