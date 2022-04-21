<?php
namespace App\Helpers;
use Illuminate\Support\Str;
class URL{
    public static function linkCategory($id, $name){
        return route('category/index', [
            'category_id'   => $id, 
            'category_name' => self::slugName($name)
        ]);
    }

    public static function linkArticle($id, $name){
        return route('article/index', [
            'article_id'   => $id, 
            'article_name' => self::slugName($name)
        ]);
    }

    public static function slugName($name, $format = '-'){
        return Str::slug($name, $format);
    }
}

?>