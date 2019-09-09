<?php
use yii\bootstrap\ActiveForm;
?>
<!-- ============================================================= HEADER : END ============================================================= -->
<section id="cart-page">
    <div class="container">
        <!-- ========================================= CONTENT ========================================= -->
        <?php
        if (Yii::$app->session->hasFlash('info')){
            echo Yii::$app->session->getFlash('info');
        }
        $form = ActiveForm::begin([
            'action' => \yii\helpers\Url::to(['order/add']),
        ]);
        ?>
        <div class="col-xs-12 col-md-9 items-holder no-margin">
            <?php $total = 0; ?>
            <?php foreach ($carts as $k => $cart): ?>
            <?php $total += $cart->price * $cart->productnum; ?>
                <input type="hidden" name="OrderDetail[<?php echo $k?>][productid]" value="<?= $cart['productid'] ?>">
                <input type="hidden" name="OrderDetail[<?php echo $k?>][price]" value="<?= $cart['price'] ?>">
                <input type="hidden" name="OrderDetail[<?php echo $k?>][productnum]" value="<?= $cart['productnum'] ?>">
            <div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="#" class="thumb-holder">
                        <img class="lazy" alt="" src="<?=$cart->product->cover ?>-covermiddle" />
                    </a>
                </div>

                <div class="col-xs-12 col-sm-5 ">
                    <div class="title">
                        <a href="#"><?=$cart->product->title ?></a>
                    </div>
                    <div class="brand"><?=date('Y-m-d H:i:s', $cart->createtime) ?></div>
                </div>

                <div class="col-xs-12 col-sm-3 no-margin">
                    <div class="quantity">
                        <div class="le-quantity">
                            <a class="minus" href="#reduce"></a>
                            <input name="productnum" id="<?=$cart->cartid ?>" readonly="readonly" type="text" value="<?=$cart->productnum ?>" />
                            <a class="plus" href="#add"></a>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="price">&yen;<?=$cart->price ?> </div>
                    <a class="close-btn" href="<?=\yii\helpers\Url::to(['cart/del', 'cartid'=>$cart->cartid]) ?>"></a>
                </div>
            </div><!-- /.cart-item -->
            <?php endforeach; ?>
        </div>
        <!-- ========================================= CONTENT : END ========================================= -->

        <!-- ========================================= SIDEBAR ========================================= -->

        <div class="col-xs-12 col-md-3 no-margin sidebar ">
            <div class="widget cart-summary">
                <h1 class="border">购物车</h1>
                <div class="body">
                    <ul class="tabled-data no-border inverse-bold">
                        <li>
                            <label>购物车总价</label>
                            <div class="value pull-right">&yen;<?=$total ?></div>
                        </li>
                        <li>
                            <label>运费</label>
                            <div class="value pull-right">免运费</div>
                        </li>
                    </ul>
                    <ul id="total-price" class="tabled-data inverse-bold no-border">
                        <li>
                            <label>订单总价</label>
                            <div class="value pull-right">&yen;<?=$total ?></div>
                        </li>
                    </ul>
                    <div class="buttons-holder">
                        <input type="submit" class="le-button big" value="去结算">
                        <a class="simple-link block" href="<?=\yii\helpers\Url::to(['/']) ?>" >继续购物</a>
                    </div>
                </div>
            </div><!-- /.widget -->

            <div id="cupon-widget" class="widget">
                <h1 class="border">使用优惠券</h1>
                <div class="body">
                    <div class="inline-input">
                        <input data-placeholder="请输入优惠券码" type="text" />
                        <button class="le-button" type="submit">使用</button>
                    </div>
                </div>
            </div><!-- /.widget -->
        </div><!-- /.sidebar -->
        <?php
        ActiveForm::end()
        ?>
        <!-- ========================================= SIDEBAR : END ========================================= -->
    </div>
</section>
<!-- ============================================================= FOOTER ============================================================= -->
