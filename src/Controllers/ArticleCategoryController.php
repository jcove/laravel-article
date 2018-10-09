<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/7/20
 * Time: 16:26
 */

namespace Jcove\Article\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Jcove\Article\Models\ArticleCategory;
use Jcove\Restful\Restful;

class ArticleCategoryController extends Controller
{
    protected $model;
    use Restful;

    public function __construct()
    {
        $this->model                    =   app('Jcove\Article\Models\ArticleCategory');
    }


    protected function validator($data){
        $rule                           =   [];
        if(request()->method()== "PUT"){
            $rule['name']               =   'required|unique:article_categories,id,'.request()->id;
        }else{
            $rule['name']               =   'required|unique:article_categories';
        }
        return Validator::make($data,$rule);
    }
    /**
     * 列表查询条件
     * @return array
     */
    protected function where(){
        $isShow                         =   request()->is_show;
        if(null!=$isShow){
            return ['is_show'=>$isShow];
        }
        return [];
    }

    public function tree(){
        return respond(ArticleCategory::tree());
    }
}