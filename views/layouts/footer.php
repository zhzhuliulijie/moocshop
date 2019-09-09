<footer id="footer" class="color-bg">

    <div class="container">
        <div class="row no-margin widgets-row">
            <div class="col-xs-12  col-sm-4 no-margin-left">
                <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>特色商品</h2>
                    <div class="body">
                        <ul>
                            <?php foreach ((array)$this->params['tui'] as $item): ?>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-9 no-margin">
                                            <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                            <div class="price">
                                                <?php if ($item['issale']): ?>
                                                    <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                                    <div class="price-current">&yen;<?=$item['saleprice'] ?></div>
                                                <?php else: ?>
                                                    <div class="price-current">&yen;<?=$item['price'] ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-3 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="<?=$item['cover'] ?>"
                                                     data-echo="<?=$item['cover'] ?>-covermiddle"/>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.body -->
                </div> <!-- /.widget -->
                <!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>热销商品</h2>
                    <div class="body">
                        <ul>
                            <?php foreach ((array)$this->params['sale'] as $item): ?>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-9 no-margin">
                                            <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                            <div class="price">
                                                <?php if ($item['issale']): ?>
                                                    <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                                    <div class="price-current">&yen;<?=$item['saleprice'] ?></div>
                                                <?php else: ?>
                                                    <div class="price-current">&yen;<?=$item['price'] ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-3 no-margin">
                                            <a href="#" class="thumb-holder">
                                                <img alt="" src="<?=$item['cover'] ?>"
                                                     data-echo="<?=$item['cover'] ?>-covermiddle"/>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.body -->
                </div> <!-- /.widget -->
                <!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>热评商品</h2>
                    <div class="body">
                        <ul>
                            <?php foreach ((array)$this->params['hot'] as $item): ?>
                            <li>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9 no-margin">
                                        <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                        <div class="price">
                                            <?php if ($item['issale']): ?>
                                            <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                            <div class="price-current">&yen;<?=$item['saleprice'] ?></div>
                                            <?php else: ?>
                                            <div class="price-current">&yen;<?=$item['price'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-3 no-margin">
                                        <a href="#" class="thumb-holder">
                                            <img alt="" src="<?=$item['cover'] ?>"
                                                 data-echo="<?=$item['cover'] ?>-covermiddle"/>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /.body -->
                </div><!-- /.widget -->
                <!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->
            </div><!-- /.col -->

        </div><!-- /.widgets-row-->
    </div><!-- /.container -->

    <div class="sub-form-row">
        <div class="container">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                <form role="form">
                    <input placeholder="Subscribe to our newsletter">
                    <button class="le-button">Subscribe</button>
                </form>
            </div>
        </div><!-- /.container -->
    </div><!-- /.sub-form-row -->

    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
                <div class="contact-info">
                    <div class="footer-logo">
                        <img alt="logo" src="<?= \yii\helpers\Url::to(['/assets/images/logo.png']) ?>" width="233"
                             height="54"/>
                    </div><!-- /.footer-logo -->

                    <p class="regular-bold"> Feel free to contact us via phone,email or just send us mail.</p>

                    <p>
                        17 Princess Road, London, Greater London NW1 8JR, UK
                        1-888-8MEDIA (1-888-892-9953)
                    </p>

                    <div class="social-icons">
                        <h3>Get in touch</h3>
                        <ul>
                            <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-pinterest"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                            <li><a href="#" class="fa fa-stumbleupon"></a></li>
                            <li><a href="#" class="fa fa-dribbble"></a></li>
                            <li><a href="#" class="fa fa-vk"></a></li>
                        </ul>
                    </div><!-- /.social-icons -->

                </div>
                <!-- ============================================================= CONTACT INFO : END ============================================================= -->
            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->
                <div class="link-widget">
                    <div class="widget">
                        <h3>Find it fast</h3>
                        <ul>
                            <li><a href="category-grid.html">laptops &amp; computers</a></li>
                            <li><a href="category-grid.html">Cameras &amp; Photography</a></li>
                            <li><a href="category-grid.html">Smart Phones &amp; Tablets</a></li>
                            <li><a href="category-grid.html">Video Games &amp; Consoles</a></li>
                            <li><a href="category-grid.html">TV &amp; Audio</a></li>
                            <li><a href="category-grid.html">Gadgets</a></li>
                            <li><a href="category-grid.html">Car Electronic &amp; GPS</a></li>
                            <li><a href="category-grid.html">Accesories</a></li>
                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->

                <div class="link-widget">
                    <div class="widget">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="category-grid.html">Find a Store</a></li>
                            <li><a href="category-grid.html">About Us</a></li>
                            <li><a href="category-grid.html">Contact Us</a></li>
                            <li><a href="category-grid.html">Weekly Deals</a></li>
                            <li><a href="category-grid.html">Gift Cards</a></li>
                            <li><a href="category-grid.html">Recycling Program</a></li>
                            <li><a href="category-grid.html">Community</a></li>
                            <li><a href="category-grid.html">Careers</a></li>

                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->

                <div class="link-widget">
                    <div class="widget">
                        <h3>Information</h3>
                        <ul>
                            <li><a href="category-grid.html">My Account</a></li>
                            <li><a href="category-grid.html">Order Tracking</a></li>
                            <li><a href="category-grid.html">Wish List</a></li>
                            <li><a href="category-grid.html">Customer Service</a></li>
                            <li><a href="category-grid.html">Returns / Exchange</a></li>
                            <li><a href="category-grid.html">FAQs</a></li>
                            <li><a href="category-grid.html">Product Support</a></li>
                            <li><a href="category-grid.html">Extended Service Plans</a></li>
                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->
                <!-- ============================================================= LINKS FOOTER : END ============================================================= -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    &copy; <a href="index.html">Media Center</a> - all rights reserved
                    <a href="https://m.kuaidi100.com/" target="_blank">快递查询</a>
                </div><!-- /.copyright -->
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt=""
                                 src="<?= \yii\helpers\Url::to(['/assets/images/payments/payment-visa.png']) ?>">
                        </li>
                        <li><img alt=""
                                 src="<?= \yii\helpers\Url::to(['/assets/images/payments/payment-master.png']) ?>">
                        </li>
                        <li><img alt=""
                                 src="<?= \yii\helpers\Url::to(['/assets/images/payments/payment-paypal.png']) ?>">
                        </li>
                        <li><img alt=""
                                 src="<?= \yii\helpers\Url::to(['/assets/images/payments/payment-skrill.png']) ?>">
                        </li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
