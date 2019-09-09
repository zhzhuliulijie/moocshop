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

    <title>MediaCenter - Responsive eCommerce Template</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/bootstrap.min.css'])?>">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/main.css'])?>">
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/red.css'])?>">
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/owl.carousel.css'])?>">
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/owl.transitions.css'])?>">
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/animate.min.css'])?>">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/css/font-awesome.min.css'])?>">

    <!-- Favicon -->
    <link rel="stylesheet" href="<?=\yii\helpers\Url::to(['assets/images/favicon.ico'])?>">

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
    <script src="<?=\yii\helpers\Url::to(['assets/js/html5shiv.js'])?>"></script>
    <script src="<?=\yii\helpers\Url::to(['assets/js/respond.min.js'])?>"></script>
    <![endif]-->
</head>
<body>

<div class="wrapper">
    <!-- ============================================================= TOP NAVIGATION ============================================================= -->
    <?php include 'nav.php' ?>
    <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->		<!-- ============================================================= HEADER ============================================================= -->
    <header class="no-padding-bottom header-alt">

        <?php include 'header.php' ?>
        <!-- ========================================= NAVIGATION ========================================= -->
        <nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
            <div class="container">
                <div class="yamm navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div><!-- /.navbar-header -->
                    <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                        <ul class="nav navbar-nav">
                            <?php foreach($this->params['menu'] as $top): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><?=$top['title']?></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-12 col-xs-12 col-sm-12">
                                                    <ul>
                                                        <?php foreach ($top['children'] as $cate): ?>
                                                            <li><a href="<?=\yii\helpers\Url::to(['product/index', 'cateid'=>$cate['cateid']])?>"><?=$cate['title']?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div><!-- /.col -->
                                            </div>
                                        </div><!-- /.yamm-content -->
                                    </li>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul><!-- /.navbar-nav -->
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.navbar -->
            </div><!-- /.container -->
        </nav><!-- /.megamenu-vertical -->
        <!-- ========================================= NAVIGATION : END ========================================= -->
        <div class="animate-dropdown">
            <div id="breadcrumb-alt">
                <div class="container">
                </div><!-- /.container -->
            </div><!-- /#breadcrumb-alt -->
        </div>
    </header>

    <?php echo $content; ?>

    <?php include 'footer.php' ?>
<!-- ============================================================= FOOTER : END ============================================================= -->	</div><!-- /.wrapper -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="<?=\yii\helpers\Url::to(['assets/js/jquery-1.10.2.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/jquery-migrate-1.2.1.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/bootstrap.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/gmap3.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/bootstrap-hover-dropdown.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/owl.carousel.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/css_browser_selector.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/echo.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/jquery.easing-1.3.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/bootstrap-slider.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/jquery.raty.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/jquery.prettyPhoto.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/jquery.customSelect.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/wow.min.js'])?>"></script>
<script src="<?=\yii\helpers\Url::to(['assets/js/scripts.js'])?>"></script>

<!-- For demo purposes – can be removed on production -->
<script src="<?=\yii\helpers\Url::to(['switchstylesheet/switchstylesheet.js'])?>"></script>
<!-- For demo purposes – can be removed on production : End -->

<script src="<?=\yii\helpers\Url::to(['assets/js/buttons.js'])?>"></script>

<script>
    $(".minus").click(function () {
        var cartid = $(this).parent().find("input[name=productnum]").attr('id');
        var num = parseInt($(this).parent().find("input[name=productnum]").val()) - 1;
        if (parseInt($("input[name=productnum]").val()) <= 1) {
            var num = 1;
        }
        var total = parseFloat($(".value.pull-right span").html());
        var price = parseFloat($(".price span").html());
        changeNum(cartid, num);
        var p = total - price;
        if (p < 0) {
            var p = "0";
        }
        $(".value.pull-right span").html(p + "");
        $(".value.pull-right.ordertotal span").html(p + "");
    });
    $(".plus").click(function () {
        var cartid = $(this).parent().find("input[name=productnum]").attr('id');
        var num = parseInt($(this).parent().find("input[name=productnum]").val()) + 1;
        var total = parseFloat($(".value.pull-right span").html());
        var price = parseFloat($(".price span").html());
        changeNum(cartid, num);
        var p = total + price;
        $(".value.pull-right span").html(p + "");
        $(".value.pull-right.ordertotal span").html(p + "");
    });

    function changeNum(cartid, num) {
        $.get('<?php echo yii\helpers\Url::to(['cart/mod']) ?>', {
            'productnum': num,
            'cartid': cartid
        }, function (data) {
            location.reload();
        });
    }

    var total = parseFloat($("#total span").html());
    $(".le-radio.express").click(function () {
        var ototal = parseFloat($(this).attr('data')) + total;
        $("#ototal span").html(ototal);
    });

    $(".expressshow").hide();
    $(".express").click(function (e) {
        e.preventDefault();
    });
    $(".express").hover(function () {
        var a = $(this);
        if ($(this).attr('data') != 'ok') {
            $.get('<?php echo yii\helpers\Url::to(['order/getexpress']) ?>', {'expressno': $(this).attr('data')}, function (res) {
                var str = "";
                if (res.message = 'ok') {
                    for (var i = 0; i < res.data.length; i++) {
                        str += "<p>" + res.data[i].context + " " + res.data[i].time + " </p>";
                    }
                }
                a.find(".expressshow").html(str);
                a.attr('data', 'ok');
            }, 'json');
        }
        $(this).find(".expressshow").show();
    }, function () {
        $(this).find(".expressshow").hide();
    });
</script>

</body>
</html>
