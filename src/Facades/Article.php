<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/7/20
 * Time: 15:57
 */

namespace Jcove\Article\Facades;


use Illuminate\Support\Facades\Facade;

class Article extends Facade
{
    public static function getFacadeAccessor(){
        return 'article';
    }
}