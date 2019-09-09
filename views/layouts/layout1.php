<?php

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>MediaCenter</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/bootstrap.min.css']) ?>">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/main.css']) ?>">
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/red.css']) ?>">
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/owl.carousel.css']) ?>">
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/owl.transitions.css']) ?>">
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/animate.min.css']) ?>">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="<?= \yii\helpers\Url::to(['assets/css/font-awesome.min.css']) ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= \yii\helpers\Url::to(['assets/images/favicon.ico']) ?>">

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
    <script src="<?= \yii\helpers\Url::to(['assets/js/html5shiv.js'])?>"></script>
    <script src="<?= \yii\helpers\Url::to(['assets/js/respond.min.js'])?>"></script>
    <![endif]-->

    <?php //$this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<div class="wrapper">
    <!-- ============================================================= TOP NAVIGATION ============================================================= -->
    <?php include 'nav.php' ?>
    <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->
    <!-- ============================================================= HEADER ============================================================= -->
    <header>
        <?php include 'header.php' ?>
    </header>

    <?php echo $content; ?>

    <?php include 'footer.php' ?>

    <!-- ============================================================= FOOTER : END ============================================================= -->
</div><!-- /.wrapper -->
<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="<?= \yii\helpers\Url::to(['assets/js/jquery-1.10.2.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/jquery-migrate-1.2.1.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/bootstrap.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/gmap3.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/bootstrap-hover-dropdown.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/owl.carousel.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/css_browser_selector.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/echo.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/jquery.easing-1.3.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/bootstrap-slider.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/jquery.raty.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/jquery.prettyPhoto.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/jquery.customSelect.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/wow.min.js']) ?>"></script>
<script src="<?= \yii\helpers\Url::to(['assets/js/scripts.js']) ?>"></script>

<!-- For demo purposes – can be removed on production -->

<script src="<?= \yii\helpers\Url::to(['switchstylesheet/switchstylesheet.js']) ?>"></script>

<script src="<?= \yii\helpers\Url::to(['assets/js/buttons.js']) ?>"></script>
<script>
    $("#createlink").click(function () {
        $(".billing-address").slideDown();
    });
</script>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
