@extends('frontend.layout')
@section('title')
    Search
@endsection
@section('content')
<main class="shop">

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="main-title">
                        Product Result
                    </h3>
                </div>
            </div>
           
            <div class="row">
                @foreach ($products as $productItem)
                    @if ($productItem->qty > 0)
                        @php
                            $status = 'Promotion';
                        @endphp
                    @else
                        @php
                            $status = 'Out Of Stock';
                        @endphp
                    @endif

                    @if ($productItem->sale_price > 0)
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
                                <a href="/product/{{ $productItem->slug }}">
                                    <img src="/uploads/{{ $productItem->thumbnail }}" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="price-list">
                                    <div class="price {{ $regularPriceStatus }}">US {{ $productItem->regular_price }}</div>
                                    <div class="regular-price {{ $salePriceStatus }}"><strike> US {{ $productItem->regular_price }}</strike></div>
                                    <div class="sale-price {{$salePriceStatus}}">US {{ $productItem->sale_price }}</div>
                                </div>
                                <h5 class="title">{{ $productItem->name }}</h5>
                            </div>
                        </figure>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h3 class="main-title">
                        News Result
                    </h3>
                </div>
            </div>
            <div class="row">
                @for ($i = 0; $i < 4; $i++)
                    <div class="col-3">
                        <figure>
                            <div class="thumbnail">
                                <a href="">
                                    <img src="https://placehold.co/300x300" alt="">
                                </a>
                            </div>
                            <div class="detail">
                                <h5 class="title">But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born</h5>
                            </div>
                        </figure>
                    </div>
                @endfor
            </div>
        </div> --}}
    </section>

</main>
@endsection