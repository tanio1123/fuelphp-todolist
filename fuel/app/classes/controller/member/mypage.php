<?php

class Controller_Member_Mypage extends Controller_Auth
{
    public function before()
    {
        parent::before();
        Log::debug('Request::active()->controllerの値:', Request::active()->controller);
        log::debug('Request::active()->actionの値', Request::active()->action);
        Log::debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
        Log::debug('「　マイページ');
        Log::debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
    }

    public function action_index()
    {
        //変数としてビューを割り当てる
        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('member/mypage'));
        $view->set('footer', View::forge('template/footer'));


        // レンダリングした HTML をリクエストに返す
        return $view;
    }
}
