<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
    $yapp = Yii::app();
    $css = $yapp->theme->baseUrl . "/css";
    $yapp->clientScript->registerCssFile($css."/screen.css", "screen, projection");
    $yapp->clientScript->registerCssFile($css."/print.css", "print");
    ?>

    <!--[if IE]>
    <link rel="stylesheet" type="text/css" media="screen, projection" href="<?php echo $css."/ie.css" ?>" />
    <![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="l-footer-pusher" id="top">
    <div class="l-grid">
        <div class="l-navbar">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions'=>array(
                    'class'=>'navmenu'
                ),
                'items'=>array(
                    array(
                        'label'=>'Contact',
                        'url'=>array('/site/contact'),
                    ),
                    array(
                        'label'=>'About',
                        'url'=>array(
                                '/site/page',
                                'view'=>'about',
                               ),
                    ),
                    array(
                        'label'=>'Register',
                        'url'=>array('/user/register'),
                    ),
                    array(
                        'label'=>'Login',
                        'url'=>array('/user/login'),
                        'visible'=>$yapp->user->isGuest,
                    ),
                    array(
                        'label'=>'Logout ('.$yapp->user->name.')', 
                        'url'=>array('/user/logout'),
                        'visible'=>!$yapp->user->isGuest,
                    ),
                    array(
                        'label'=>'Create Asset', 
                        'url'=>array('/asset/create'),
                        'visible'=>!$yapp->user->isGuest,
                    ),
                ),
            )); ?>
        </div>

        <div class="l-brand-bar">
            <div class="l-brand">
                <a href="/">
                    <img
                    class="logo"
                    src="/images/logo.jpg"
                    alt="Lifecyle Building Center Logo" />
                </a>
            </div>

            <div class="l-large-nav is-visible-desktop">
            <ul class="large-nav">
                <a class="large-nav-pic-link" href="/asset">
                    <li>
                        <img
                            src="/images/shop.png"
                            class="large-nav-icon" />

                        <span class="large-nav-icon-caption">Shop</span>
                    </li>
                </a>
                <a class="large-nav-pic-link" href="/site/donate">
                    <li>
                        <img
                            src="/images/donate.png"
                            class="large-nav-icon" />

                        <span class="large-nav-icon-caption">Donate</span>
                    </li>
                </a>
                <a class="large-nav-pic-link" href="/site/request">
                    <li>
                        <img
                            src="/images/request-materials.png"
                            class="large-nav-icon" />

                        <span class="large-nav-icon-caption">Request</span>
                    </li>
                </a>
            </ul>
            </div>
        </div>

        <div class="l-body">
        <?php echo $content; ?>
        </div>
    </div>
    <div class="l-footer-pusher-root"></div>
</div>

<div class="l-footer">
    <div class="l-footer-grid">
        <div class="l-meta">
            &copy; <?php echo date('Y'); ?> Lifecycle Building Center.
        </div>
        <div class="l-footer-nav">
            <a href="#top" class="is-hidden-desktop">Back to top</a>
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'htmlOptions'=>array(
                    'class'=>'footer-navmenu is-visible-desktop'
                ),
                'items'=>array(
                    array(
                        'label'=>'Contact',
                        'url'=>array('/site/contact'),
                    ),
                    array(
                        'label'=>'About',
                        'url'=>array(
                                '/site/page',
                                'view'=>'about',
                               ),
                    ),
                    array(
                        'label'=>'Register',
                        'url'=>array('/site/register'),
                    ),
                    array(
                        'label'=>'Login',
                        'url'=>array('/site/login'),
                        'visible'=>$yapp->user->isGuest,
                    ),
                    array(
                        'label'=>'Logout ('.$yapp->user->name.')', 
                        'url'=>array('/site/logout'),
                        'visible'=>!$yapp->user->isGuest,
                    ),
                    array(
                        'label'=>'Shop',
                        'url'=>array('/asset'),
                    ),
                    array(
                        'label'=>'Donate Materials',
                        'url'=>array('/site/donate'),
                    ),
                    array(
                        'label'=>'Request Materials',
                        'url'=>array('/site/request'),
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>

</body>
</html>
