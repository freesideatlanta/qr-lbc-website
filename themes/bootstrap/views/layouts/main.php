<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <?php
    $yapp = Yii::app();

    $yapp->bootstrap->register();

    $css = $yapp->theme->baseUrl . "/css/styles.css";
    $yapp->clientScript->registerCssFile($css);
    ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>

<body>
<div class="footer-pusher">

    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
        'type'=>'inverse',
        'fluid'=>true,
        'brandUrl'=>'#',
        'fixed'=>null,
        'brand'=>'', // empty to keep "LBC"
        'collapse'=>true,
        'htmlOptions'=>array(
            'class'=>'navbar-static-top lbc-nav'
        ),
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.TbMenu',
                'htmlOptions'=>array(
                    'class'=>'pull-right',
                ),
                'items'=>array(
                    array('label'=>'Home', 'url'=>array('/site/index')),
                    array(
                        'label'=>'Shop',
                        'url'=>array('/shop/index'),
                        'itemOptions'=>array(
                            'class'=>'hidden-desktop'
                        ),
                    ),
                    array(
                        'label'=>'Donate',
                        'url'=>array('/site/donate'),
                        'itemOptions'=>array(
                            'class'=>'hidden-desktop'
                        ),
                    ),
                    array(
                        'label'=>'Request Materials',
                        'url'=>array('/site/request'),
                        'itemOptions'=>array(
                            'class'=>'hidden-desktop'
                        ),
                    ),
                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                    array('label'=>'Register', 'url'=>array('/site/register')),
                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    )); ?>

    <div class="container-fluid logo-bar visible-desktop">
        <div class="row-fluid">
            <div class="span4 visible-desktop">
                <img class="logo" src="/images/logo.jpg" />
            </div>
            <div class="span8">
                <ul class="large-nav visible-desktop">
                    <li class="pic-link">
                        <img src="/images/shop.png"/>
                        Shop
                    </li>
                    <li class="pic-link">
                        <img src="/images/donate.png"/>
                        Donate
                    </li>
                    <li class="pic-link">
                        <img src="/images/request-materials.png"/>
                        Request
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php // alternate centered logo for smaller displays ?>
    <div class="container-fluid logo-bar hidden-desktop">
        <div class="row-fluid">
            <div class="span12">
                <img class="logo" src="/images/logo.jpg" />
            </div>
        </div>
    </div>


    <div class="container-fluid content">
        <div class="row-fluid">
            <?php
                // put bootstrap breadcrumbs and spans in layout/views
                echo $content;
            ?>
        </div>
    </div>
    <div class="pusher"></div>
</div>

<div class="footer">
    <div class="container-fluid">
    &copy; <?php echo date('Y'); ?> Lifecycle Building Center.
    </div>
</div>

</body>
</html>
