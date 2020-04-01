<div class="p-ctn-main">
    <section class="p-ctn-form">
        <h1 class="p-ctn-form__title">ユーザー登録</h1>

        <?php
        if (!empty($error)) :
            ?>
            <ul class="u-area-error-msg">
                <?php
                    foreach ($error as $key => $val) :
                        ?>
                    <li><?= $val ?></li>
                <?php
                    endforeach;
                    ?>
            </ul>
        <?php
        endif;
        ?>
        <?= $signupform ?>
    </section>
</div>