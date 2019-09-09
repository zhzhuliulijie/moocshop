<!-- ============================================================= HEADER : END ============================================================= -->
<section id="category-grid">
    <div class="container">

        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <!-- ========================================= PRODUCT FILTER ========================================= -->
            <div class="widget">
                <h1>商品筛选</h1>
                <div class="body bordered">

                    <div class="category-filter">
                        <h2>品牌</h2>
                        <hr>
                        <ul>
                            <li><input checked="checked" class="le-checkbox" type="checkbox"  /> <label>Samsung</label> <span class="pull-right">(2)</span></li>
                            <li><input  class="le-checkbox" type="checkbox" /> <label>Dell</label> <span class="pull-right">(8)</span></li>
                            <li><input  class="le-checkbox" type="checkbox" /> <label>Toshiba</label> <span class="pull-right">(1)</span></li>
                            <li><input  class="le-checkbox" type="checkbox" /> <label>Apple</label> <span class="pull-right">(5)</span></li>
                        </ul>
                    </div><!-- /.category-filter -->

                    <div class="price-filter">
                        <h2>价格</h2>
                        <hr>
                        <div class="price-range-holder">
                            <input type="text" class="price-slider" value="">
                            <span class="min-max">Price: $89 - $2899</span>
                            <span class="filter-button"><a href="#">筛选</a></span>
                        </div>
                    </div><!-- /.price-filter -->

                </div><!-- /.body -->
            </div><!-- /.widget -->
            <!-- ========================================= PRODUCT FILTER : END ========================================= -->
            <div class="widget">
                <h1 class="border">特价商品</h1>
                <ul class="product-list">
                    <?php foreach ($sale as $item): ?>
                    <li>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>" class="thumb-holder">
                                    <img alt="" src="<?php echo $item['cover'] ?>-coversmall" data-echo="<?php echo $item['cover'] ?>-coversmall"/>
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>"><?=$item['title']?></a>
                                <div class="price">
                                    <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                    <div class="price-current">&yen;<?=$item['saleprice'] ?></div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php endforeach;

                    use yii\helpers\Url; ?>
                </ul>
            </div><!-- /.widget -->
            <!-- ========================================= FEATURED PRODUCTS ========================================= -->
            <div class="widget">
                <h1 class="border">推荐商品</h1>
                <ul class="product-list">
                    <?php foreach ($tui as $item): ?>
                    <li class="sidebar-product-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>" class="thumb-holder">
                                    <img alt="" src="<?php echo $item['cover'] ?>-coversmall" data-echo="<?php echo $item['cover'] ?>-coversmall"/>
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>"><?=$item['title']?></a>
                                <div class="price">
                                    <div class="price-prev">&yen;<?=$item['price'] ?></div>
                                    <div class="price-current">&yen;<?=$item['saleprice'] ?></div>
                                </div>
                            </div>
                        </div>
                    </li><!-- /.sidebar-product-list-item -->
                    <?php endforeach; ?>
                </ul><!-- /.product-list -->
            </div><!-- /.widget -->
            <!-- ========================================= FEATURED PRODUCTS : END ========================================= -->
        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <section id="recommended-products" class="carousel-holder hover small">

                <div class="title-nav">
                    <h2 class="inverse">热销商品</h2>
                    <div class="nav-holder">
                        <a href="#prev" data-target="#owl-recommended-products" class="slider-prev btn-prev fa fa-angle-left"></a>
                        <a href="#next" data-target="#owl-recommended-products" class="slider-next btn-next fa fa-angle-right"></a>
                    </div>
                </div><!-- /.title-nav -->
                <div id="owl-recommended-products" class="owl-carousel product-grid-holder">
                    <?php foreach ($hot as $item): ?>
                    <div class="no-margin carousel-item product-item-holder hover size-medium">
                        <div class="product-item">
                            <div class="ribbon red"><span>sale</span></div>
                            <div class="image">
                                <img alt="" src="<?=$item['cover']?>-covermiddle" data-echo="<?=$item['cover']?>-covermiddle"/>
                            </div>
                            <div class="body">
                                <div class="title">
                                    <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>"><?=$item['title']?></a>
                                </div>
<!--                                <div class="brand">sharp</div>-->
                            </div>
                            <div class="prices">
                                <div class="price-current text-right">&yen;<?=$item['issale']?$item['saleprice']:$item['price'] ;?></div>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="<?=yii\helpers\Url::to(['cart/add', 'productid'=>$item['productid']]) ?>" class="le-button">加入购物车</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.carousel-item -->
                    <?php endforeach; ?>
                </div><!-- /#recommended-products-carousel .owl-carousel -->
            </section><!-- /.carousel-holder -->
            <section id="gaming">
                <div class="grid-list-products">
                    <h2 class="section-title">所有商品</h2>

                    <div class="control-bar" style="height: 60px;">
                        <div class="grid-list-buttons">
                            <ul>
                                <li class="grid-list-button-item active"><a data-toggle="tab" href="#grid-view"><i class="fa fa-th-large"></i> 图文</a></li>
                                <li class="grid-list-button-item "><a data-toggle="tab" href="#list-view"><i class="fa fa-th-list"></i> 列表</a></li>
                            </ul>
                        </div>
                    </div><!-- /.control-bar -->

                    <div class="tab-content">
                        <div id="grid-view" class="products-grid fade tab-pane in active">

                            <div class="product-grid-holder">
                                <div class="row no-margin">
                                    <?php foreach ($hot as $item): ?>
                                    <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                        <div class="product-item">
                                            <?php if ($item['ishot']): ?>
                                                <div class="ribbon red"><span>HOT</span></div>
                                            <?php endif; ?>
                                            <?php if ($item['issale']): ?>
                                                <div class="ribbon green"><span>sale</span></div>
                                            <?php endif; ?>
                                            <?php if ($item['istui']): ?>
                                                <div class="ribbon blue"><span>recommond</span></div>
                                            <?php endif; ?>
                                            <div class="image">
                                                <img alt="" src="<?=$item['cover']; ?>-covermiddle" data-echo="<?=$item['cover']; ?>-covermiddle"/>
                                            </div>
                                            <div class="body">
                                                <?php if($item['issale']): ?>
                                                    <div class="label-discount green"><?php echo round($item['saleprice']/$item['price']*100, 0) ?>% sale</div>
                                                <?php endif; ?>
                                                <div class="title">
                                                    <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>"><?=$item['title']; ?></a>
                                                </div>
                                            </div>
                                            <div class="prices">
                                                <?php if ($item['issale']): ?>
                                                    <div class="price-prev">￥<?=$item['price'] ?></div>
                                                    <div class="price-current pull-right">￥<?=$item['saleprice'] ?></div>
                                                <?php else: ?>
                                                    <div class="price-current pull-right">￥<?=$item['price'] ?></div>
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
                                </div><!-- /.row -->
                            </div><!-- /.product-grid-holder -->

                            <div class="pagination-holder">
                                <div class="row">

                                    <div class="col-xs-12 col-sm-6 text-left">
                                        <?=\yii\widgets\LinkPager::widget([
                                            'pagination' => $pager,
                                            'prevPageLabel' => 'prev',
                                            'nextPageLabel' => 'next',
                                        ])
                                        ?>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="result-counter">
                                            Showing <span>1-9</span> of <span><?=$count;?></span> results
                                        </div>
                                    </div>

                                </div><!-- /.row -->
                            </div><!-- /.pagination-holder -->
                        </div><!-- /.products-grid #grid-view -->

                        <div id="list-view" class="products-grid fade tab-pane ">
                            <div class="products-list">
                                <?php foreach ($hot as $item): ?>
                                <div class="product-item product-item-holder">
                                    <?php if ($item['ishot']): ?>
                                        <div class="ribbon red"><span>HOT</span></div>
                                    <?php endif; ?>
                                    <?php if ($item['issale']): ?>
                                        <div class="ribbon green"><span>sale</span></div>
                                    <?php endif; ?>
                                    <?php if ($item['istui']): ?>
                                        <div class="ribbon blue"><span>recommond</span></div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                            <div class="image">
                                                <img alt="" src="<?=$item['cover']; ?>-covermiddle" data-echo="<?=$item['cover']; ?>-covermiddle"/>
                                            </div>
                                        </div><!-- /.image-holder -->
                                        <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                            <div class="body">
                                                <?php if($item['issale']): ?>
                                                    <div class="label-discount green"><?=round($item['saleprice']/$item['price']*100, 0) ?>% sale</div>
                                                <?php endif; ?>
                                                <div class="title">
                                                    <a href="<?=yii\helpers\Url::to(['product/detail', 'productid'=>$item['productid']])?>"><?=$item['title'];?></a>
                                                </div>
                                                <div class="excerpt">
                                                    <p><?php echo mb_substr($item['descr'], 0, 250, 'utf-8') ?></p>
                                                </div>
                                            </div>
                                        </div><!-- /.body-holder -->
                                        <div class="no-margin col-xs-12 col-sm-3 price-area">
                                            <div class="right-clmn">
                                                <?php if($item['issale']): ?>
                                                    <div class="price-current">￥<?php echo $item['saleprice'] ?></div>
                                                    <div class="price-prev">￥<?php echo $item['price'] ?></div>
                                                <?php else: ?>
                                                    <div class="price-current">￥<?php echo $item['price'] ?></div>
                                                <?php endif; ?>
                                                <div class="availability"><label>库存:</label><span class="available">  <?php echo $item['num'] ?></span></div>
                                                <a class="le-button" href="<?=yii\helpers\Url::to(['cart/add', 'productid' => $item['productid']]) ?>">加入购物车</a>
                                            </div>
                                        </div><!-- /.price-area -->
                                    </div><!-- /.row -->
                                </div><!-- /.product-item -->
                                <?php endforeach; ?>
                            </div><!-- /.products-list -->

                            <div class="pagination-holder">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 text-left">
                                        <?=\yii\widgets\LinkPager::widget([
                                            'pagination' => $pager,
                                            'prevPageLabel' => 'prev',
                                            'nextPageLabel' => 'next',
                                        ])
                                        ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="result-counter">
                                            Showing <span>1-9</span> of <span><?=$count;?></span> results
                                        </div><!-- /.result-counter -->
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.pagination-holder -->

                        </div><!-- /.products-grid #list-view -->

                    </div><!-- /.tab-content -->
                </div><!-- /.grid-list-products -->

            </section><!-- /#gaming -->
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->
    </div><!-- /.container -->
</section><!-- /#category-grid -->
<!-- ============================================================= FOOTER ============================================================= -->

