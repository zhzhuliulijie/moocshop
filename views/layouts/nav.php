<nav class="top-bar animate-dropdown">
    <div class="container">
        <div class="col-xs-12 col-sm-6 no-margin">
            <ul>
                <li><a href="<?php echo yii\helpers\Url::to(['index/index']) ?>">首页</a></li>
                <?php if (\Yii::$app->session['isLogin'] == 1): ?>
                    <li><a href="<?php echo yii\helpers\Url::to(['cart/index']) ?>">我的购物车</a></li>
                    <li><a href="<?php echo yii\helpers\Url::to(['order/index']) ?>">我的订单</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.col -->

        <div class="col-xs-12 col-sm-6 no-margin">
            <ul class="right">
                <?php if (\Yii::$app->session['isLogin'] == 1): ?>
                    您好 , 欢迎您回来 <?php echo \Yii::$app->session['loginname']; ?> , <a
                        href="<?php echo yii\helpers\Url::to(['member/logout']); ?>">退出</a>
                <?php else: ?>
                    <li><a href="<?php echo yii\helpers\Url::to(['member/auth']); ?>">注册</a></li>
                    <li><a href="<?php echo yii\helpers\Url::to(['member/auth']); ?>">登录</a></li>
                <?php endif; ?>
            </ul>
        </div><!-- /.col -->
    </div><!-- /.container -->
</nav><!-- /.top-bar -->
