<?php

class Controller_Member_Logout extends Controller_Auth
{
    public function before()
    {
        parent::before();
        Log::debug('Request::active()->controllerの値:', Request::active()->controller);
        log::debug('Request::active()->actionの値', Request::active()->action);
        Log::debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
        Log::debug('「　ログアウトページ　');
        Log::debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
    }

    public function action_index()
    {


        $btn = Form::submit('logout_btn', $value = 'ログアウト', array('style' => 'float:none',  'method' => 'POST'));
        Log::debug('submitクラス作成');

        Log::debug('submitクラス作成完了');

        if (Input::method() === 'POST') {


            $auth = Auth::instance();
            $auth->logout();
            Session::destroy();
            // メッセージ格納
            Log::debug('セッション削除');
            Session::set_flash('sucMsg', 'ログアウトが完了しました！');
            Log::debug('ログアウト完了');
            // リダイレクト
            Response::redirect('login/login');
        }


        //変数としてビューを割り当てる
        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('member/logout'));
        $view->set('footer', View::forge('template/footer'));
        $view->set_global('logout_btn', $btn, false);


        // レンダリングした HTML をリクエストに返す
        return $view;
    }
}
