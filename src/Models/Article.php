<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/7/20
 * Time: 15:59
 */

namespace Jcove\Article\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function getCoverAttribute($value){
        return storage_url($value);
    }
}