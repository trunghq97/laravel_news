@if (!empty($item['articles']))
    <div class="posts">
        @foreach ($item['articles'] as $article)
            <div class="post_item post_h_large">
                <div class="row">
                    <div class="col-lg-5">
                        @include('news.partials.article.image', ['item' => $article])
                    </div>
                    <div class="col-lg-7">
                        @include('news.partials.article.content', ['item' => $article, 'lengthContent' => 200, 'showCategory' => false])
                    </div>
                </div>
            </div> 
        @endforeach
        <div class="row">
            <div class="home_button mx-auto text-center"><a href="the-loai/the-thao-1.html">Xem thêm</a></div>
        </div>
    </div>
@endif
