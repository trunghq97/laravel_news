@include('news.partials.article.image',     ['item' => $item, 'type' => 'single' ])
@include('news.partials.article.content',   ['item' => $item, 'lengthContent' => 'full', 'showCategory' => true])
