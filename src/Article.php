<?php
/**
 * Author: XiaoFei Zhai
 * Date: 2018/7/20
 * Time: 11:00
 */

namespace Jcove\Article;


use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Route;

class Article
{
    public function __construct(SessionManager $session, Repository $config)
    {
        $this->session                  =   $session;
        $this->config                   =   $config;
    }

    public function routes(){
        $attributes = [
            'prefix'        => config('article.route.prefix'),
            'namespace'     => 'Jcove\Article\Controllers',
            'middleware'    =>  config('article.route.middleware.normal')
        ];

        Route::group($attributes, function ($router) {
            $router->group([], function ($router) {


                $router->get('/article/category', 'ArticleCategoryController@index')->name(config('article.route.prefix').'.article.category.index');
                $router->get('/article/category/create', 'ArticleCategoryController@create')->name(config('article.route.prefix').'.article.category.create');
                $router->get('/article/category/tree', 'ArticleCategoryController@tree')->name(config('article.route.prefix').'.article.category.tree');
                $router->get('/article/category/{id}/edit', 'ArticleCategoryController@edit')->name(config('article.route.prefix').'.article.category.edit');
                $router->get('/article/category/{id}', 'ArticleCategoryController@show')->name(config('article.route.prefix').'article.category.show');


                $router->get('/article', 'ArticleController@index')->name(config('article.route.prefix').'.article.index');
                $router->get('/article/create', 'ArticleController@create')->name(config('article.route.prefix').'.article.create');
                $router->get('/article/{id}/edit', 'ArticleController@edit')->name(config('article.route.prefix').'.article.edit');
                $router->get('/article/{id}', 'ArticleController@show')->name(config('article.route.prefix').'.article.show');
            });

        });
    }

    public function authRoutes(){
        $attributes = [
            'prefix'        => config('article.route.prefix'),
            'namespace'     => 'Jcove\Article\Controllers',
            'middleware'   =>  config('article.route.middleware','auth:api')
        ];

        Route::group($attributes, function ($router) {
            $router->group([], function ($router) {
                $router->post('/article', 'ArticleController@store');
                $router->put('/article/{id}', 'ArticleController@update');
                $router->delete('/article/{id}', 'ArticleController@delete');

                $router->post('/article/category', 'ArticleCategoryController@store');
                $router->put('/article/category/{id}', 'ArticleCategoryController@update');
                $router->delete('/article/category/{id}', 'ArticleCategoryController@delete');
            });

        });
    }
}