<!-- ============================================================= HEADER : END ============================================================= -->
<div id="top-banner-and-menu">
    <div class="container">

        <div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
            <!-- ================================== TOP NAVIGATION ================================== -->
            <div class="side-menu animate-dropdown">
                <div class="head"><i class="fa fa-list"></i> 所有分类</div>
                <nav class="yamm megamenu-horizontal" role="navigation">
                    <ul class="nav">
                        <?php foreach($this->params['menu'] as $top): ?>
                        <li class="dropdown menu-item">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$top['title']?></a>
                            <ul class="dropdown-menu mega-menu">
                                <li class="yamm-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <ul class="list-unstyled">
                                                <?php foreach ($top['children'] as $cate): ?>
                                                <li><a href="<?=\yii\helpers\Url::to(['product/index', 'cateid'=>$cate['cateid']])?>"><?=$cate['title']?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li><!-- /.menu-item -->
                        <?php endforeach; ?>
                    </ul><!-- /.nav -->
                </nav><!-- /.megamenu-horizontal -->
            </div><!-- /.side-menu -->
            <!-- ================================== TOP NAVIGATION : END ================================== -->
        </div><!-- /.sidemenu-holder -->

        <div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
            <!-- ========================================== SECTION – HERO ========================================= -->

            <div id="hero">
                <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                    <?php foreach ($sale as $item): ?>
                    <div class="item" style="background-image: url('<?php echo $item['cover'] ?>-coverbig');">
                        <div class="container-fluid">
                            <div class="caption vertical-center text-left">
                                <div class="big-text fadeInDown-1">
                                    <span class="big"><span class="sign">&yen;</span><?php echo $item['saleprice'] ?></span>
                                </div>

                                <div class="excerpt fadeInDown-2">
                                    <?php echo $item['title'] ?>
                                </div>
                                <div class="small fadeInDown-2">
                                </div>
                                <div class="button-holder fadeInDown-3">
                                    <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>" class="big le-button ">查看商品</a>
                                </div>
                            </div><!-- /.caption -->
                        </div><!-- /.container-fluid -->
                    </div><!-- /.item -->
                    <?php endforeach; ?>
                </div><!-- /.owl-carousel -->
            </div>

            <!-- ========================================= SECTION – HERO : END ========================================= -->
        </div><!-- /.homebanner-holder -->

    </div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!-- ========================================= HOME BANNERS ========================================= -->
<!--<section id="banner-holder" class="wow fadeInUp">-->
<!--    <div class="container">-->
<!--        <div class="col-xs-12 col-lg-6 no-margin banner">-->
<!--            <a href="category-grid-2.html">-->
<!--                <div class="banner-text theblue">-->
<!--                    <h1>新上架</h1>-->
<!--                    <span class="tagline">最新分类</span>-->
<!--                </div>-->
<!--                <img class="banner-image" alt="" src="--><?//=\yii\helpers\Url::to(['/assets/images/banners/banner-narrow-02.jpg']) ?><!--"-->
<!--                     data-echo="--><?//=\yii\helpers\Url::to(['/assets/images/banners/banner-narrow-02.jpg']) ?><!--"/>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-xs-12 col-lg-6 no-margin text-right banner">-->
<!--            <a href="category-grid-2.html">-->
<!--                <div class="banner-text right">-->
<!--                    <h1>时髦</h1>-->
<!--                    <span class="tagline">最新上架</span>-->
<!--                </div>-->
<!--                <img class="banner-image" alt="" src="--><?//=\yii\helpers\Url::to(['/assets/images/banners/banner-narrow-02.jpg']) ?><!--"-->
<!--                     data-echo="--><?//=\yii\helpers\Url::to(['/assets/images/banners/banner-narrow-02.jpg']) ?><!--"/>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>--><!-- /.container -->
<!--</section>--><!-- /#banner-holder -->
<!-- ========================================= HOME BANNERS : END ========================================= -->
<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#featured" data-toggle="tab">特色商品</a></li>
                <li><a href="#new-arrivals" data-toggle="tab">最新上架</a></li>
                <li><a href="#top-sales" data-toggle="tab">热销商品</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="featured">
                    <div class="product-grid-holder">
                        <?php foreach ($all as $item): ?>
                        <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                            <div class="product-item">
                                <div class="ribbon red"><span>sale</span></div>
                                <div class="image">
                                    <img alt="" src="<?=$item['cover'] ?>-covermiddle"
                                         data-echo="<?=$item['cover'] ?>-covermiddle"/>
                                </div>
                                <div class="body">
                                    <div class="label-discount green"><?=floor($item['saleprice']/$item['price']*100) ?>% sale</div>
                                    <div class="title">
                                        <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                    </div>
                                </div>
                                <div class="prices">
                                    <?php if ($item['issale']): ?>
                                    <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                    <div class="price-current pull-right">&yen;<?=$item['saleprice'] ?></div>
                                    <?php else: ?>
                                    <div class="price-prev"></div>
                                    <div class="price-current pull-right">&yen;<?=$item['price'] ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="<?=yii\helpers\Url::to(['cart/add', 'productid'=>$item['productid']]) ?>" class="le-button">加入购物车</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="tab-pane" id="new-arrivals">
                    <div class="product-grid-holder">
                        <?php foreach ($new as $item): ?>
                            <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="image">
                                        <img alt="" src="<?=$item['cover'] ?>-covermiddle"
                                             data-echo="<?=$item['cover'] ?>-covermiddle"/>
                                    </div>
                                    <div class="body">
                                        <div class="label-discount green"><?=floor($item['saleprice']/$item['price']*100) ?>% sale</div>
                                        <div class="title">
                                            <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                        </div>
                                    </div>
                                    <div class="prices">
                                        <?php if ($item['issale']): ?>
                                            <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                            <div class="price-current pull-right">&yen;<?=$item['saleprice'] ?></div>
                                        <?php else: ?>
                                            <div class="price-prev"></div>
                                            <div class="price-current pull-right">&yen;<?=$item['price'] ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="<?=yii\helpers\Url::to(['cart/add', 'productid'=>$item['productid']]) ?>" class="le-button">加入购物车</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="tab-pane" id="top-sales">
                    <div class="product-grid-holder">
                        <?php foreach ($sale as $item): ?>
                            <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
                                <div class="product-item">
                                    <div class="ribbon red"><span>sale</span></div>
                                    <div class="image">
                                        <img alt="" src="<?=$item['cover'] ?>-covermiddle"
                                             data-echo="<?=$item['cover'] ?>-covermiddle"/>
                                    </div>
                                    <div class="body">
                                        <div class="label-discount green"><?=floor($item['saleprice']/$item['price']*100) ?>% sale</div>
                                        <div class="title">
                                            <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                        </div>
                                    </div>
                                    <div class="prices">
                                        <?php if ($item['issale']): ?>
                                            <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                            <div class="price-current pull-right">&yen;<?=$item['saleprice'] ?></div>
                                        <?php else: ?>
                                            <div class="price-prev"></div>
                                            <div class="price-current pull-right">&yen;<?=$item['price'] ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="<?=yii\helpers\Url::to(['cart/add', 'productid'=>$item['productid']]) ?>" class="le-button">加入购物车</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================================= 热门商品 ========================================= -->
<section id="bestsellers" class="color-bg wow fadeInUp">
    <div class="container">
        <h1 class="section-title">热门商品</h1>

        <div class="product-grid-holder medium">
            <div class="col-xs-12 col-md-12 no-margin">
                <div class="row no-margin">
                    <?php foreach ($hot as $item): ?>
                    <div class="col-xs-12 col-sm-2 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img alt="" src="<?=$item['cover'] ?>-covermiddle"
                                     data-echo="<?=$item['cover'] ?>-covermiddle"/>
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title">
                                    <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                                </div>
                                <div class="brand">beats</div>
                            </div>
                            <div class="prices">
                                <?php if ($item['issale']): ?>
                                    <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                    <div class="price-current pull-right">&yen;<?=$item['saleprice'] ?></div>
                                <?php else: ?>
                                    <div class="price-prev"></div>
                                    <div class="price-current pull-right">&yen;<?=$item['price'] ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="<?=yii\helpers\Url::to(['cart/add', 'productid'=>$item['productid']]) ?>" class="le-button">加入购物车</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.product-item-holder -->
                    <?php endforeach; ?>
                </div><!-- /.row -->
            </div><!-- /.col -->

        </div><!-- /.product-grid-holder -->
    </div><!-- /.container -->
</section><!-- /#bestsellers -->
<!-- ========================================= 热门商品 : END ========================================= -->
<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder hover">

            <div class="title-nav">
                <h2 class="h1">推荐商品</h2>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-recently-viewed"
                       class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-recently-viewed"
                       class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->

            <div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                <?php foreach ($tui as $item): ?>
                <div class="no-margin carousel-item product-item-holder size-small hover">
                    <div class="product-item">
                        <div class="ribbon red"><span>sale</span></div>
                        <div class="image">
                            <img alt="" src="<?=$item['cover'] ?>-covermiddle"
                                 data-echo="<?=$item['cover'] ?>-covermiddle"/>
                        </div>
                        <div class="body">
                            <div class="title">
                                <a href="<?=\yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']]) ?>"><?=$item['title'] ?></a>
                            </div>
                            <div class="brand">Sharp</div>
                        </div>
                        <div class="prices">
                            <?php if ($item['issale']): ?>
                                <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                <div class="price-current pull-right">&yen;<?=$item['saleprice'] ?></div>
                            <?php else: ?>
                                <div class="price-prev"></div>
                                <div class="price-current pull-right">&yen;<?=$item['price'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="hover-area">
                            <div class="add-cart-button">
                                <a href="<?=yii\helpers\Url::to(['cart/add', 'productid'=>$item['productid']]) ?>" class="le-button">加入购物车</a>
                            </div>
                        </div>
                    </div><!-- /.product-item -->
                </div><!-- /.product-item-holder -->
                <?php endforeach; ?>
            </div><!-- /#recently-carousel -->
        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->
<!-- ========================================= TOP BRANDS ========================================= -->
<section id="top-brands" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder">

            <div class="title-nav">
                <h1>热销品牌</h1>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->

            <div id="owl-brands" class="owl-carousel brands-carousel">

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-01.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-02.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-03.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-04.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-01.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-02.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-03.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="<?=\yii\helpers\Url::to(['/assets/images/brands/brand-04.jpg']) ?>"/>
                    </a>
                </div><!-- /.carousel-item -->

            </div><!-- /.brands-caresoul -->

        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#top-brands -->
<!-- ========================================= TOP BRANDS : END ========================================= -->        <!-- ============================================================= FOOTER ============================================================= -->
