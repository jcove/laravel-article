<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/7/20
 * Time: 16:25
 */

namespace Jcove\Article\Models;


use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{

    const SHOW                                  =   1;
    const HIDE                                  =   0;

    public static function getChildren($parentId=0){
        return static::where(['is_show'=>ArticleCategory::SHOW,'parent_id'=> $parentId])->orderBy('order' ,'asc')->get();
    }

    public static function tree($parentId = 0){
        $tree                                   =   static ::getChildren($parentId);
        if($tree){
            foreach ($tree as $key => $value){
                $children                       =   static ::tree($value->id);
                $value->children                =   $children;
                $tree->offsetSet($key,$value);
            }
        }
        return $tree;
    }
}