@extends('news.main')
@section('content')
    <!-- Content Container -->
    <div class="section-category">
        @include('news.block.breadcrumb', ['item' => ['name' => $title]])
        <div class="content_container container_category">
            <div class="featured_title">
                <div class="container">
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-lg-8">
                            @include('news.pages.rss.child-index.list', ['items' => $itemsRss])
                        </div>
                        <div class="col-lg-4">
                            <h3>Giá vàng</h3>
                            <div id="box-gold" data-url="{{ route('rss/get-gold') }}" class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/loading.gif') }}" alt="">
                            </div>
                            <h3>Giá coin</h3>
                            <div id="box-coin" data-url="{{ route('rss/get-coin') }}" class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('images/loading.gif') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection