<div class="container no-padding">

    <div class="col-xs-12 col-md-3 logo-holder">
        <!-- ============================================================= LOGO ============================================================= -->
        <div class="logo">
            <a href="<?php echo yii\helpers\Url::to(['index/index']) ?>">
                <img alt="logo" src="<?= \yii\helpers\Url::to(['assets/images/logo.png']) ?>" width="233" height="54"/>
            </a>
        </div><!-- /.logo -->
        <!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

    <div class="col-xs-12 col-md-6 top-search-holder no-margin">
        <div class="contact-row">
            <div class="phone inline">
                <i class="fa fa-phone"></i> (+800) 123 456 7890
            </div>
            <div class="contact inline">
                <i class="fa fa-envelope"></i> contact@<span class="le-color">oursupport.com</span>
            </div>
        </div><!-- /.contact-row -->
        <!-- ============================================================= SEARCH AREA ============================================================= -->
        <div class="search-area">
            <form>
                <div class="control-group">
                    <input class="search-field" placeholder="搜索商品"/>

                    <ul class="categories-filter animate-dropdown">
                        <li class="dropdown">

                            <a class="dropdown-toggle" data-toggle="dropdown" href="category-grid.html">所有分类</a>

                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="category-grid.html">电子产品</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="category-grid.html">电子产品</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="category-grid.html">电子产品</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="category-grid.html">电子产品</a></li>

                            </ul>
                        </li>
                    </ul>

                    <a style="padding:15px 15px 13px 12px" class="search-button" href="#"></a>

                </div>
            </form>
        </div><!-- /.search-area -->
        <!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

    <div class="col-xs-12 col-md-3 top-cart-row no-margin">
        <div class="top-cart-row-container">
            <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
            <div class="top-cart-holder dropdown animate-dropdown">

                <div class="basket">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <div class="basket-item-count">
                            <span class="count"><?= isset($this->params['cart']) ? count($this->params['cart']['cart']) : '0' ?></span>
                            <img src="<?= \yii\helpers\Url::to(['assets/images/icon-cart.png']) ?>" alt=""/>
                        </div>

                        <div class="total-price-basket">
                            <span class="lbl">您的购物车:</span>
                            <span class="total-price">
                    <span class="sign">￥</span><span
                                    class="value"><?= isset($this->params['cart']) ? $this->params['cart']['total'] : '0.00' ?></span>
                    </span>
                        </div>
                    </a>
                    <?php if (isset($this->params['cart'])): ?>
                        <ul class="dropdown-menu">
                            <?php foreach ((array)$this->params['cart']['cart'] as $cart): ?>
                                <li>
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-4 col-sm-4 no-margin text-center">
                                                <div class="thumb">
                                                    <img alt="" src="<?= $cart['product']['cover'] ?>-coversmall"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 no-margin">
                                                <div class="title"><?= $cart['product']['title'] ?></div>
                                                <div class="price">￥<?= $cart['product']['price'] ?></div>
                                            </div>
                                        </div>
                                        <a class="close-btn"
                                           href="<?= yii\helpers\Url::to(['cart/del', 'cartid' => $cart['cartid']]) ?>"></a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                            <li class="checkout">
                                <div class="basket-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <a href="<?php echo yii\helpers\Url::to(['cart/index']) ?>"
                                               class="le-button inverse">查看购物车</a>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <a href="<?php echo yii\helpers\Url::to(['cart/index']) ?>"
                                               class="le-button">去往收银台</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    <?php endif; ?>
                </div><!-- /.basket -->
            </div><!-- /.top-cart-holder -->
        </div><!-- /.top-cart-row-container -->
        <!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div><!-- /.top-cart-row -->

</div><!-- /.container -->
