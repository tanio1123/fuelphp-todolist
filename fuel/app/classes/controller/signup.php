<?php



class Controller_Signup extends Controller
{

    //クラス定数の作成
    const PASS_LENGTH_MIN = 6;
    const PASS_LENGTH_MAX = 20;

    public function action_signup()
    {
        Log::debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');
        Log::debug('「　ユーザー登録ページ　');
        Log::debug('「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「「');



        $error = '';
        $formData = '';


        $form = Fieldset::forge('signupform');
        Log::debug('Fieldestクラス作成');

        $form->add('username', 'ユーザー名', array('type' => 'text', 'placeholder' => 'ユーザー名'))
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);

        $form->add('email', 'Email', array('type' => 'email', 'placeholder' => 'Email'))
            ->add_rule('required')
            ->add_rule('valid_email')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 255);

        $form->add('password', 'Password', array('type' => 'password', 'placeholder' => 'パスワード'))
            ->add_rule('required')
            ->add_rule('min_length', self::PASS_LENGTH_MIN)
            ->add_rule('max_length', self::PASS_LENGTH_MAX);

        $form->add('password_re', 'Password（再入力）', array('type' => 'password', 'placeholder' => 'パスワード（再入力）'))
            // match_fieldをつける場合は必ず他のadd_ruleの前につける
            ->add_rule('match_field', 'password')
            ->add_rule('required')
            ->add_rule('min_length', self::PASS_LENGTH_MIN)
            ->add_rule('max_length', self::PASS_LENGTH_MAX);
        $form->add('submit', '', array('type' => 'submit', 'value' => '登録'));

        Log::debug('Fieldestクラス作成完了');




        if (Input::method() === 'POST') {
            Log::debug('POST送信があります。');

            $val = $form->validation();
            Log::debug('バリデーションインスタンスを取得', var_dump($val));
            if ($val->run()) {
                Log::debug('バリデーションインスタンス実行', var_dump($val));
                $formData = $val->validated();
                Log::debug('フォームデータ取得', var_dump($formData));
                $auth = Auth::instance(); //Authインスタンス生成
                Log::debug('Authインスタンス生成');
                if ($auth->create_user($formData['username'], $formData['password'], $formData['email'])) {
                    // メッセージ格納
                    Session::set_flash('sucMsg', 'ユーザー登録が完了しました！');
                    Log::debug('sucMsg', 'ユーザー登録が完了しました！');
                    // リダイレクト
                    Log::debug('member/mypage', 'にリダイレクト');
                    Response::redirect('member/mypage');
                } else {
                    // メッセージ格納
                    Session::set_flash('errMsg', 'ユーザー登録に失敗しました！時間を置いてお試し下さい！');
                    Log::debug('errMsg', 'ユーザー登録に失敗しました！時間を置いてお試し下さい！');
                }
            } else {
                // エラー格納
                $error = $val->error();
                Log::debug($error);
                // メッセージ格納
                Session::set_flash('errMsg', 'ユーザー登録に失敗しました！時間を置いてお試し下さい！');
                Log::debug('errMsg', 'ユーザー登録に失敗しました！時間を置いてお試し下さい！');
            }
            // フォームにPOSTされた値をセット
            $form->repopulate();
        }

        //変数としてビューを割り当てる
        $view = View::forge('template/index');
        $view->set('head', View::forge('template/head'));
        $view->set('header', View::forge('template/header'));
        $view->set('contents', View::forge('auth/signup'));
        $view->set('footer', View::forge('template/footer'));
        $view->set_global('signupform', $form->build(''), false);
        $view->set_global('error', $error);

        // レンダリングした HTML をリクエストに返す
        return $view;
    }
}
