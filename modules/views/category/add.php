<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<link rel="stylesheet" href="<?=\yii\helpers\Url::to(['/assets/admin/css/compiled/new-user.css']); ?>" type="text/css" media="screen"/>
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加新管理员</h3>
            </div>

            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php
                        if (Yii::$app->session->hasFlash('info')){
                            echo Yii::$app->session->getFlash('info');
                        }
                        $form = ActiveForm::begin([
                                'options' => ['class' => 'new_user_form inline-input'],
                                'fieldConfig' => [
                                    'template' => '<div class="span12 field-box">{label}{input}{error}</div>'
                                ],
                        ]);
                        ?>

                        <?= $form->field($model, 'parentid')->dropDownList($list, [
                            'class' => 'span9',
                        ]); ?>
                        <?= $form->field($model, 'title')->textInput(['class'=>'span9']); ?>

                        <div class="span11 field-box actions">
                            <?= Html::submitInput($btnText, ['class' => 'btn-glow primary']); ?>
                            <span>或者</span>
                            <?= Html::resetInput('返回列表', ['class' => 'reset', 'id' => 'cancel']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">

                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>
                        请在左侧填写管理员相关信息，包括管理员账号，电子邮箱，以及密码
                    </div>
                    <h6>重要提示：</h6>
                    <p>管理员可以管理后台功能模块</p>
                    <p>请谨慎添加</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end main container -->
<script>
    var cancelBtn = document.getElementById('cancel');
    cancelBtn.onclick = function () {
        window.location.href = "<?=\yii\helpers\Url::current(['category/list']); ?>";
    }
</script>
