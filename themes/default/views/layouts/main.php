<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

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
<div class="l-footer-pusher">
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
                ),
            )); ?>
        </div>

        <div class="l-brand-bar">
            <div class="l-brand">
                <a href="/">
                    <img
                    class="logo is-visible-desktop"
                    src="/images/logo.jpg"
                    alt="Lifecyle Building Center Logo" />
                </a>
            </div>

            <div class="l-large-nav">
            <ul class="large-nav is-visible-desktop">
                <a class="large-nav-pic-link" href="/items">
                    <li>
                        <img
                            src="/images/shop.png"
                            class="large-nav-icon" />

                        <span class="large-nav-icon-caption">Shop</span>
                    </li>
                </a>
                <a class="large-nav-pic-link" href="/items/donate">
                    <li>
                        <img
                            src="/images/donate.png"
                            class="large-nav-icon" />

                        <span class="large-nav-icon-caption">Donate</span>
                    </li>
                </a>
                <a class="large-nav-pic-link" href="/items/request">
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
    <div class="l-pusher"></div>
</div>

<div class="l-footer">
    <div class="l-meta">
        &copy; <?php echo date('Y'); ?> Lifecycle Building Center.
    </div>
    <div class="l-footer-nav">
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions'=>array(
                'class'=>'footer-navmenu'
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
                    'url'=>array('/items'),
                ),
                array(
                    'label'=>'Donate Materials',
                    'url'=>array('/items/donate'),
                ),
                array(
                    'label'=>'Request Materials',
                    'url'=>array('/items/request'),
                ),
            ),
        )); ?>
    </div>
</div>

</body>
</html>
