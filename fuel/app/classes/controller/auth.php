<?php



class Controller_Auth extends Controller
{
  public function before()
  {
    parent::before();
    if (!Auth::check() && Request::active()->action != 'login' && 'signup') {
      Log::debug('Request::active()->controllerの値:', Request::active()->controller);
      log::debug('Request::active()->actionの値', Request::active()->action);
      Log::debug('未ログインユーザーです。');
      Log::debug('ログインページに遷移します');
      Response::redirect('login/login');
    }
  }
}
