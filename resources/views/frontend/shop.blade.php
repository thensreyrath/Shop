@extends('frontend.layout')
@section('title')
    Shop
@endsection
@section('content')
<main class="shop">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        @foreach ($products as $ProductVal)

                            @if ($ProductVal->qty > 0)
                                @php
                                    $status = 'Promotion';
                                @endphp
                            @else
                                @php
                                    $status = 'Out Of Stock';
                                @endphp
                            @endif

                            @if ($ProductVal->sale_price > 0)
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
                                        <a href="/product/{{ $ProductVal->slug }}">
                                            <img src="/uploads/{{ $ProductVal->thumbnail }}" alt="">
                                        </a>
                                    </div>
                                    <div class="detail">
                                        <div class="price-list">
                                            <div class="price {{ $regularPriceStatus }}">US {{ $ProductVal->regular_price }}</div>
                                            <div class="regular-price {{ $salePriceStatus }}"><strike> US {{ $ProductVal->regular_price }}</strike></div>
                                            <div class="sale-price {{$salePriceStatus}}">US {{ $ProductVal->sale_price }}</div>
                                        </div>
                                        <h5 class="title">{{ $ProductVal->name }}</h5>
                                    </div>
                                </figure>
                            </div>
                        @endforeach
                        {{-- //pagination --}}
                        <div class="col-12">
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
                        </div>
                        
                       
                    </div>
                </div>
                <div class="col-3 filter">
                    <h4 class="title">Category</h4>
                    <ul>
                        <li>
                            <a href="/shop">ALL</a>
                        </li>
                        @foreach ($allCategory as $cate)
                            <li>
                                <a href="/shop?cate={{ $cate->slug }}">{{ $cate->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    
                    <h4 class="title mt-4">Price</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?price=max">High</a>
                        <a href="/shop?price=min">Low</a>
                    </div>

                    <h4 class="title mt-4">Promotion</h4>
                    <div class="block-price mt-4">
                        <a href="/shop?promotion=true">Promotion Product</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection