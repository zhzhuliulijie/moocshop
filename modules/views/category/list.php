	<!-- main container -->
    <div class="content">

        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>商品分类列表</h3>
                    <div class="span10 pull-right">
                        <a href="<?php echo \yii\helpers\Url::to(['category/add']); ?>" class="btn-flat success pull-right">
                            <span>&#43;</span> 添加商品分类
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span4 sortable">商品分类ID</th>
                                <th class="span3 sortable"><span class="line"></span>商品分类名称</th>
                                <th class="span3 sortable align-right"><span class="line"></span>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cates as $cate): ?>
                        <!-- row -->
                        <tr class="first">
                            <td><?= $cate['cateid']; ?></td>
                            <td><?= $cate['title']; ?></td>
                            <td class="align-right">
                                <a href="<?= \yii\helpers\Url::to(['category/mod', 'cateid'=>$cate['cateid']]); ?>">编辑</a>
                                <a href="<?= \yii\helpers\Url::to(['category/del', 'cateid'=>$cate['cateid']]); ?>">删除</a>
                            </td>
                        </tr>
                        <!-- row -->
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php
                    if (Yii::$app->session->hasFlash('info')){
                        echo Yii::$app->session->getFlash('info');
                    }
                    ?>
                </div>
                <div class="pagination pull-right">
                    <?php //echo \yii\widgets\LinkPager::widget(['pagination' => $pager, 'prevPageLabel' => '&#8249;', 'nextPageLabel' => '&#8250;']); ?>
                </div>
                <!-- end users table -->
            </div>
        </div>
    </div>
    <!-- end main container -->
