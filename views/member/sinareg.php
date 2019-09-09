<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<!-- ============================================================= HEADER : END ============================================================= -->        <!-- ========================================= MAIN ========================================= -->
<main id="authentication" class="inner-bottom-md">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <section class="section sign-in inner-right-xs">
                    <h2 class="bordered">
                        <img src="<?= Yii::$app->session['userinfo']['profile_image_url']; ?>" width="40" height="40" align="center" alt="">
                        绑定账号
                    </h2>
                    <p>请您输入一个账户名和密码</p>
                    <?php
                    $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="field-row">{label}{input}</div>{error}'
                        ],
                        'options' => [
                            'class' => 'login-form cf-style-1',
                            'role' => 'form',
                        ],
                    ]);
                    ?>
                    <div class="field-row"><input type="text" value="<?=Yii::$app->session['userinfo']['screen_name']; ?>" class="le-input"></div>
                    <?= $form->field($model, 'username')->textInput(['class' => 'le-input']); ?>
                    <?= $form->field($model, 'userpass')->passwordInput(['class' => 'le-input']); ?>
                    <?= $form->field($model, 'repass')->passwordInput(['class' => 'le-input']); ?>

                    <div class="field-row clearfix">
                    </div>

                    <div class="buttons-holder">
                        <?= Html::submitButton('绑定', ['class' => 'le-button huge']) ?>
                    </div><!-- /.buttons-holder -->
                    <?php ActiveForm::end(); ?><!-- /.cf-style-1 -->

                </section><!-- /.sign-in -->
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</main><!-- /.authentication -->
<!-- ========================================= MAIN : END ========================================= -->        <!-- ============================================================= FOOTER ============================================================= -->
<script>
    $qqbtn = document.getElementById('login_qq');
    $qqbtn.onclick=function () {
        window.location.href = "<?=\yii\helpers\Url::to('qqlogin'); ?>";
    }
</script>
