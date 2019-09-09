<?php
use yii\bootstrap\ActiveForm;
?>
<!-- ============================================================= HEADER : END ============================================================= -->		<!-- ========================================= CONTENT ========================================= -->

<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">

            <div class="billing-address" style="display: none;">
                <h2 class="border h1">新建联系人</h2>
                <?php ActiveForm::begin([
                    'action' => ['address/add'],
                ]);
                ?>
                <div class="row field-row">
                    <div class="col-xs-12 col-sm-6">
                        <label>姓*</label>
                        <input class="le-input" name="firstname" >
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>名*</label>
                        <input class="le-input" name="lastname" >
                    </div>
                </div><!-- /.field-row -->

                <div class="row field-row">
                    <div class="col-xs-12">
                        <label>公司名称</label>
                        <input class="le-input" name="company" >
                    </div>
                </div><!-- /.field-row -->

                <div class="row field-row">
                    <div class="col-xs-12 col-sm-6">
                        <label>地址*</label>
                        <input class="le-input" data-placeholder="例如：北京市朝阳区" name="address1" >
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>&nbsp;</label>
                        <input class="le-input" data-placeholder="例如：酒仙桥北路" name="address2" >
                    </div>
                </div><!-- /.field-row -->

                <div class="row field-row">
                    <div class="col-xs-12 col-sm-4">
                        <label>邮编</label>
                        <input class="le-input" name="postcode" >
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>电子邮箱地址*</label>
                        <input class="le-input" name="email" >
                    </div>

                    <div class="col-xs-12 col-sm-4">
                        <label>联系电话*</label>
                        <input class="le-input" name="telephone" >
                    </div>
                </div><!-- /.field-row -->

                <!--<div class="row field-row">
                    <div id="create-account" class="col-xs-12">
                        <input  class="le-checkbox big" type="checkbox"  />
                        <a class="simple-link bold" href="#">新建联系人？</a>
                    </div>
                </div>--><!-- /.field-row -->

                <div class="place-order-button">
                    <button class="le-button small">新建</button>
                </div><!-- /.place-order-button -->
                <?php ActiveForm::end(); ?>
            </div><!-- /.billing-address -->

            <?php ActiveForm::begin([
                'action' => ['order/confirm'],
                'options'=> ['id' => 'orderconfirm'],
            ]); ?>
            <section id="shipping-address">
                <?php
                if (Yii::$app->session->hasFlash('info')){
                    echo Yii::$app->session->getFlash('info');
                }
                ?>
                <h2 class="border h1">收获地址</h2>
                <a href="#" id="createlink">新建联系人</a>
                <?php foreach($addresses as $key => $address): ?>
                    <div class="row field-row" style="margin-top:10px">
                        <div class="col-xs-12">
                            <input class="le-radio big address" type="radio" name="addressid" value="<?php echo $address['addressid'] ?>" <?php if ($key == 0) {echo 'checked = "checked"';} ?> />
                            <a class="simple-link bold" href="#"><?php echo $address['firstname'].$address['lastname']." ".$address['company']." ".$address['address']. " " . $address['postcode']. " ". $address['email']." ".$address['telephone'] ?></a>
                        </div>
                        <a style="margin-left:45px" href="<?php echo yii\helpers\Url::to(['address/del', 'addressid' => $address['addressid']]) ?>">删除</a>
                    </div><!-- /.field-row -->
                <?php endforeach; ?>
            </section><!-- /#shipping-address -->
            <section id="your-order">
                <h2 class="border h1">订单详情</h2>
                <?php $total = 0; ?>
                <?php foreach ($details as $k => $detail): ?>
                <div class="row no-margin order-item">
                    <div class="col-xs-12 col-sm-1 no-margin">
                        <a href="#" class="qty"><?=$detail['productnum'] ?> x</a>
                    </div>

                    <div class="col-xs-3 col-sm-3 ">
                        <img src="<?=$detail['product']['cover'] ?>-coversmall" alt="">
                    </div>
                    <div class="col-xs-9 col-sm-6 ">
                        <div class="title"><a href="#"><?=$detail['product']['title'] ?> </a></div>
                        <div class="brand"><?=$detail['product']['title'] ?></div>
                    </div>

                    <div class="col-xs-12 col-sm-2 no-margin">
                        <div class="price">&yen;<?=$detail['price']*$detail['productnum'] ?></div>
                    </div>
                </div><!-- /.order-item -->
                <?php $total += $detail['price']*$detail['productnum'] ?>
                <?php endforeach; ?>
            </section><!-- /#your-order -->

            <div id="total-area" class="row no-margin">
                <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                    <div id="subtotal-holder">
                        <ul class="tabled-data inverse-bold no-border">
                            <li>
                                <label>商品总价</label>
                                <div class="value ">&yen;<?=$total ?></div>
                            </li>
                            <li>
                                <label>选择快递</label>
                                <div class="value">
                                    <div class="radio-group">
                                        <?php foreach($express as $k=>$e): ?>
                                            <?php $checked = ""; if($k == 1) $checked = "checked" ?>
                                            <input class="le-radio express" type="radio" name="expressid" value="<?php echo $k ?>" data="<?php echo $expressPrice[$k] ?>" <?php echo $checked ?>> <div class="radio-label bold"><?php echo $e ?><span class="bold"> ￥ <?php echo $expressPrice[$k] ?></span></div><br>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </li>
                        </ul><!-- /.tabled-data -->

                        <ul id="total-field" class="tabled-data inverse-bold ">
                            <li>
                                <label>订单总额</label>
                                <div class="value">&yen;<?=$total + 15 ?></div>
                            </li>
                        </ul><!-- /.tabled-data -->

                    </div><!-- /#subtotal-holder -->
                </div><!-- /.col -->
            </div><!-- /#total-area -->

            <div id="payment-method-options">
                <div class="payment-method-option">
                    <input class="le-radio" type="radio" name="paymethod" value="alipay" checked>
                    <div class="radio-label bold ">支付宝支付</div>
                </div><!-- /.payment-method-option -->
            </div><!-- /#payment-method-options -->

            <div class="place-order-button">
                <button class="le-button big">确认订单</button>
            </div><!-- /.place-order-button -->
            <input type="hidden" value="<?php echo (int)\Yii::$app->request->get("orderid"); ?>" name="orderid">
            <?php ActiveForm::end(); ?>
        </div><!-- /.col -->
    </div><!-- /.container -->
</section><!-- /#checkout-page -->
<!-- ========================================= CONTENT : END ========================================= -->
<!-- ============================================================= FOOTER ============================================================= -->
