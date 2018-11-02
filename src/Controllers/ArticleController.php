<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/7/20
 * Time: 15:59
 */

namespace Jcove\Article\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Jcove\Restful\Restful;

class ArticleController extends Controller
{
    use Restful;

    /**
     * ArticleController constructor.
     */
    public function __construct()
    {
        $this->model                                =   app('Jcove\Article\Models\Article');
    }

    protected function validator($data){
        if(request()->method()== "PUT"){
            $rule['title']               =   'required|unique:articles,id,'.request()->id;
        }else{
            $rule['title']               =   'required|unique:articles';
        }
        $rule['content']                =   'required';
        $rule['category_id']            =   'required|numeric|exists:article_categories,id';
        return Validator::make($data,$rule);
    }

    protected function where(){
        $categoryId                     =   request()->category_id;
        if($categoryId){
            return ['category_id'=>$categoryId];
        }
    }

    protected function beforeShow(){
        $this->setTitle($this->model->title);
    }

    protected function prepareSave(){

        $guard                                      =   Auth::guard() ? Auth::guard(): Auth::guard(config('restful.guard'));
        $this->model->author_id         =   $guard->id();
    }
}