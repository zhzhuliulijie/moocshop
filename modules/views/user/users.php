<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>用户列表</h3>
                <div class="span10 pull-right">
                    <a href="<?= \yii\helpers\Url::to(['user/reg']); ?>" class="btn-flat success pull-right">
                        <span>&#43;</span>
                        添加新用户
                    </a>
                </div>
            </div>

            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span4 sortable">用户名</th>
                        <th class="span3 sortable"><span class="line"></span>真是姓名</th>
                        <th class="span2 sortable"><span class="line"></span>昵称</th>
                        <th class="span2 sortable"><span class="line"></span>性别</th>
                        <th class="span2 sortable"><span class="line"></span>年龄</th>
                        <th class="span2 sortable"><span class="line"></span>生日</th>
                        <th class="span3 sortable align-right"><span class="line"></span>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php foreach ($users as $user): ?>
                    <tr class="first">
                        <td>
                            <?php if (empty($user->profile->avatar)): ?>
                            <img src="<?=\yii\helpers\Url::to([Yii::$app->params['defaultValue']['avatar']]) ?>" class="img-circle avatar hidden-phone"/>
                            <?php else: ?>
                            <img src="<?=\yii\helpers\Url::to(['/assets/upload/avatar/' . $user->profile->avatar]); ?>" class="img-circle avatar hidden-phone"/>
                            <?php endif; ?>
                            <a href="user-profile.html" class="name"><?= $user->username; ?></a>
                            <span class="subtext"><?= $user->useremail; ?></span>
                        </td>
                        <td><?= isset($user->truename) ? $user->truename : '未填写'; ?></td>
                        <td><?= isset($user->nickname) ? $user->nickname : '未填写'; ?></td>
                        <td><?= isset($user->sex) ? $user->sex : '未填写'; ?></td>
                        <td><?= isset($user->age) ? $user->age : '未填写'; ?></td>
                        <td><?= isset($user->birthday) ? $user->birthday : '未填写'; ?></td>
                        <td class="align-right"><a href="<?= \yii\helpers\Url::to(['user/del', 'userid' => $user->userid]); ?>">删除</a></td>
                    </tr>
                    <?php endforeach; ?>
                    <!-- row -->
                    </tbody>
                </table>
                <?php
                if (Yii::$app->session->hasFlash('info')){
                    echo Yii::$app->session->getFlash('info');
                }
                ?>
            </div>
            <div class="pagination pull-right">
                <?= \yii\widgets\LinkPager::widget(['pagination' => $pager, 'prevPageLabel' => '&#8249;', 'nextPageLabel' => '&#8250;']); ?>
            </div>
            <!-- end users table -->
        </div>
    </div>
</div>
<!-- end main container -->
