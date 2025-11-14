@extends('frontend.layout')
@section('title')
    Home
@endsection
@section('content')
    <main class="home">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            NEW PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($newProducts as $newProductsVal)
                        @if ($newProductsVal->qty > 0)
                            @php
                                $status = 'Promotion';
                            @endphp
                        @else
                            @php
                                $status = 'Out Of Stock';
                            @endphp
                        @endif

                        @if ($newProductsVal->sale_price > 0)
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
                                    <a href="/product/{{ $newProductsVal->slug }}">
                                        <img src="/uploads/{{ $newProductsVal->thumbnail }}" class="object-fit-cove" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $regularPriceStatus }}">US {{ $newProductsVal->regular_price }}</div>
                                        <div class="regular-price {{ $salePriceStatus }}"><strike> US {{ $newProductsVal->regular_price }}</strike></div>
                                        <div class="sale-price {{$salePriceStatus}}">US {{ $newProductsVal->sale_price }}</div>
                                    </div>
                                    <h5 class="title">{{ $newProductsVal->name }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            PROMOTION PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($promotion as $promoProductVal)

                        @if ($promoProductVal->qty > 0)
                            @php
                                $status = 'Promotion';
                            @endphp
                        @else
                            @php
                                $status = 'Out Of Stock';
                            @endphp
                        @endif

                        @if ($promoProductVal->sale_price > 0)
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
                                    <a href="/product/{{ $promoProductVal->slug }}">
                                        <img src="/uploads/{{ $promoProductVal->thumbnail }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $regularPriceStatus }}">US {{ $promoProductVal->regular_price }}</div>
                                        <div class="regular-price {{ $salePriceStatus }}"><strike> US {{ $promoProductVal->regular_price }}</strike></div>
                                        <div class="sale-price {{$salePriceStatus}}">US {{ $promoProductVal->sale_price }}</div>
                                    </div>
                                    <h5 class="title">{{ $promoProductVal->name }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>  

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="main-title">
                            POPULAR PRODUCTS
                        </h3>
                    </div>
                </div>
                <div class="row">
                    @foreach ($popularProducts as $popularProductVal)

                        @if ($popularProductVal->qty > 0)
                            @php
                                $status = 'Promotion';
                            @endphp
                        @else
                            @php
                                $status = 'Out Of Stock';
                            @endphp
                        @endif

                        @if ($popularProductVal->sale_price > 0)
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
                                    <a href="/product/{{ $popularProductVal->slug }}">
                                        <img src="/uploads/{{ $popularProductVal->thumbnail }}" alt="">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="price-list">
                                        <div class="price {{ $regularPriceStatus }}">US {{ $popularProductVal->regular_price }}</div>
                                        <div class="regular-price {{ $salePriceStatus }}"><strike> US {{ $popularProductVal->regular_price }}</strike></div>
                                        <div class="sale-price {{$salePriceStatus}}">US {{ $popularProductVal->sale_price }}</div>
                                    </div>
                                    <h5 class="title">{{ $popularProductVal->name }}</h5>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                    {{-- <div class="col-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $totalPage; $i++)
                                    <li>
                                        <a class="page-link" href="/shop?page={{ $i }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </section>

    </main>  
@endsection
