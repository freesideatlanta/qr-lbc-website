<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <?php
    $yapp = Yii::app();
    $css = $yapp->theme->baseUrl . "/css";
    $yapp->clientScript->registerCssFile($css."/style.css");
    ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="l-footer-pusher">
    <?php $this->widget('zii.widgets.CMenu',
        array(
        'htmlOptions'=>array(
            'class'=>'navbar'
        ),
        'items'=>array(
            array(
                'class'=>'zii.widgets.CMenu',
                'items'=>array(
                    array('label'=>'Home', 'url'=>array('/site/index')),
                    array(
                        'label'=>'Shop',
                        'url'=>array('/shop/index'),
                        'itemOptions'=>array(
                            'class'=>'is-hidden-desktop'
                        ),
                    ),
                    array(
                        'label'=>'Donate',
                        'url'=>array('/site/donate'),
                        'itemOptions'=>array(
                            'class'=>'is-hidden-desktop'
                        ),
                    ),
                    array(
                        'label'=>'Request Materials',
                        'url'=>array('/site/request'),
                        'itemOptions'=>array(
                            'class'=>'is-hidden-desktop'
                        ),
                    ),
                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                    array('label'=>'Register', 'url'=>array('/site/register')),
                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.$yapp->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!$yapp->user->isGuest)
                ),
            ),
        ),
    )); ?>

    <!--
    <div class="logo-bar is-visible-desktop">
        <div class="row-fluid">
            <div class="span4 is-visible-desktop">
                <img class="logo" src="/images/logo.jpg" />
            </div>
            <div class="span8">
                <ul class="large-nav is-visible-desktop">
                    <a class="large-nav-pic-link" href="/shop">
                        <li>
                            <img src="/images/shop.png" class="large-nav-icon" />
                            Shop
                        </li>
                    </a>
                    <a class="large-nav-pic-link" href="/site/donate">
                        <li>
                            <img src="/images/donate.png" class="large-nav-icon" />
                            Donate
                        </li>
                    </a>
                    <a class="large-nav-pic-link" href="/site/request">
                        <li>
                            <img src="/images/request-materials.png" class="large-nav-icon" />
                            Request
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    -->

    <div class="l-content">
        <div class="row-fluid">
            <?php
                // put bootstrap breadcrumbs and spans in layout/views
                echo $content;
            ?>
        </div>
    </div>
    <div class="l-pusher"></div>
</div>

<div class="l-footer">
    <div class="l-span-6">
        &copy; <?php echo date('Y'); ?> Lifecycle Building Center.
    </div>
</div>

</body>
</html>
