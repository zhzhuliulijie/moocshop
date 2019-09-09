<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html class="login-bg">
<head>
    <title>慕课商城 - 后台管理</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- bootstrap -->
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/bootstrap/bootstrap.css']) ?>" rel="stylesheet"/>
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/bootstrap/bootstrap-responsive.css']) ?>" rel="stylesheet"/>
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/bootstrap/bootstrap-overrides.css']) ?>" rel="stylesheet"/>

    <!-- global styles -->
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/layout.css']) ?>" rel="stylesheet"/>
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/elements.css']) ?>" rel="stylesheet"/>
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/icons.css']) ?>" rel="stylesheet"/>

    <!-- libraries -->
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/lib/font-awesome.css']) ?>" rel="stylesheet"/>

    <!-- this page specific styles -->
    <link href="<?=\yii\helpers\Url::to(['/assets/admin/css/compiled/signin.css']) ?>" rel="stylesheet"/>

    <![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>


<div class="row-fluid login-wrapper">
    <a class="brand" href="index.html"></a>
    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => '{input}{error}'
        ],
    ]); ?>
    <div class="span4 box">
        <div class="content-wrap">
            <h6>慕课商城 - 后台管理</h6>
            <?php echo $form->field($model, 'adminuser')->textInput(['class'=>'span12', 'placeholder'=>'管理员账号']); ?>
            <?php echo $form->field($model, 'adminpass')->passwordInput(['class'=>'span12', 'placeholder'=>'管理员密码']); ?>

            <a href="<?php echo \yii\helpers\Url::to(['public/seekpassword']); ?>" class="forgot">忘记密码?</a>
            <?php echo $form->field($model, 'rememberMe')->checkbox([
                'id'=>'remember-me',
                'template'=>'<div class="remember">{input}<label for="remember-me">记住我</label></div>'
            ]); ?>
            <?php  echo Html::submitButton('登录', ['class'=>'btn-glow primary login']); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<!-- scripts -->
<script src="<?=\yii\helpers\Url::to(['/assets/admin/js/jquery-latest.js']) ?>"></script>
<script src="<?=\yii\helpers\Url::to(['/assets/admin/js/bootstrap.min.js']) ?>"></script>
<script src="<?=\yii\helpers\Url::to(['/assets/admin/js/theme.js']) ?>"></script>

</body>
</html>
