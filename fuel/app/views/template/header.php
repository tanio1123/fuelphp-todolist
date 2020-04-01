<?php
$sucMsg = Session::get_flash('sucMsg');
if (!empty($sucMsg)) :
?>
    <div class="u-alert-msg success js-toggle-msg">
        <?= $sucMsg ?>
    </div>
<?php
    endif;
    $errMsg = Session::get_flash('errMsg');
    if (!empty($errMsg)) :
?>
    <div class="u-alert-msg err js-toggle-msg">
        <?= $errMsg ?>
    </div>
<?php
    endif;
?>
<header class="l-header">
    <div class=" l-container">
        <h2 class="l-container__title">TODOリスト</h2>
        <nav class="l-top-nav">
            <ul class="l-top-nav__ul">
                <?php if (!Auth::check()) : ?>
                    <?php Log::debug('Request::active()->controllerの値:', Request::active()->controller); ?>
                    <?php log::debug('Request::active()->actionの値', Request::active()->action); ?>
                    <?php Log::debug('header:未ログインユーザーです'); ?>
                    <li class="l-top-nav__ul__1i"><a href="<?php echo Uri::create('login/login'); ?>" class="l-top-nav__ul__a">ログイン</a></li>
                    <li class=" l-top-nav__ul__1i"><a href="<?php echo Uri::create('signup/signup'); ?>" class=" l-top-nav__ul__a">新規登録</a></li>
                <?php endif; ?>
                <?php if (Auth::check()) : ?>
                    <?php Log::debug('Request::active()->controllerの値:', Request::active()->controller); ?>
                    <?php log::debug('Request::active()->actionの値', Request::active()->action); ?>
                    <?php Log::debug('header:ログイン済みユーザーです'); ?>
                    <li class="l-top-nav__ul__1i"><a href="<?php echo Uri::create('member/logout'); ?>" class="l-top-nav__ul__a">ログアウト</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>