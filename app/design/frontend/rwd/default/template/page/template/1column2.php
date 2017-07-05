<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    design
 * @package     rwd_default
 * @copyright   Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
?>
<?php
/**
 * Template for Mage_Page_Block_Html
 */
?>

<!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="<?php echo $this->getLang(); ?>" id="top" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="<?php echo $this->getLang(); ?>" id="top" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="<?php echo $this->getLang(); ?>" id="top" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="<?php echo $this->getLang(); ?>" id="top" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="<?php echo $this->getLang(); ?>" id="top" class="no-js"> <!--<![endif]-->

<head>
<?php echo $this->getChildHtml('head') ?>
</head>
<body<?php echo $this->getBodyClass()?' class="'.$this->getBodyClass().'"':'' ?>>
<?php echo $this->getChildHtml('after_body_start') ?>
<div class="">
    <?php echo $this->getChildHtml('global_notices') ?>
    <div class="page">
        <?php echo $this->getChildHtml('header') ?>
        <div class="main-container col1-layout">
            <div class="main">
                <?php echo $this->getChildHtml('breadcrumbs') ?>
                <div class="col-main">
                    <?php echo $this->getChildHtml('global_messages')?>
    				<?php //echo $this->getLayout()->createBlock('cms/block')->setBlockId('rev_slider')->toHtml();?>
                    <?php echo $this->getChildHtml('content') ?>
                    <?php echo $this->getLayout()->createBlock("bestseller/bestseller")->setTemplate("bestseller/bestseller-responsive.phtml")->toHtml(); ?>
    				<div class="col-md-8">
    				<?php //echo $this->getLayout()->createBlock('cms/block')->setBlockId('special_offers')->toHtml();
                     echo $this->getLayout()->createBlock('bannerslider/bannerslider')->setCategoryId('1')->setTemplate('bannerslider/bannerslider.phtml')->toHtml();
                    ?>
    				</div>
                    <div class="col-md-4">
    				<?php echo $this->getLayout()->createBlock('cms/block')->setBlockId('deal')->toHtml();?>
    				</div>
                    <div class="col-md-3">
                    	<div class="sidebar">
					<h2>MAIN MENU</h2>
					<ul class="sidebar-menu">
						<li><a href="#">Products</a></li>
						<li><a href="#">Food Sport</a></li>
						<li><a href="#">Clothing</a></li>
						<li><a href="#">Accessories</a></li>
						<li><a href="#">Equipment</a></li>
						<li><a href="#">Interview</a></li>
						<li><a href="#">Championships</a></li>
					</ul>
					<h2><a href="#">INTERVIEW</a></h2>
					<div class="interview">
						<a href="#"><img src="http://127.0.0.1/24_proten/skin/frontend/rwd/default/img/champion.jpg" alt=""></a>
						<h4><a href="#">CHAMPION NAME</a></h4>
						<p>Mike has been a personal trainer for five and a half years, three and a half of which have been spent at our gym. He says his goal with every .. <a href="#">more..</a></p>
					</div>
					<h2><a href="#">YOUTUBE CHANNEL</a></h2>
					<div class="interview">
						<a href="#">
							</a><div class="channel-wrap"><a href="#">
								<img src="http://127.0.0.1/24_proten/skin/frontend/rwd/default/img/champion.jpg" alt="">
								</a><a class="fancybox fancybox.iframe" href="https://www.youtube.com/embed/zM7PgGkETys"><i class="fa fa-youtube-play"></i></a>
							</div>
						
						<p>Mike has been a personal trainer for five and a half years .. <a href="#">more..</a></p>
					</div>
				</div>
    				</div>
                    <div class="col-md-9">
    				<?php echo $this->getLayout()->createBlock('cms/block')->setBlockId('last_products')->toHtml();?>
    				</div>
                </div>
            </div>
        </div>
        <?php echo $this->getChildHtml('footer_before') ?>
        <?php echo $this->getChildHtml('footer') ?>
        <?php echo $this->getChildHtml('global_cookie_notice') ?>
        <?php echo $this->getChildHtml('before_body_end') ?>
    </div>
</div>
<?php echo $this->getAbsoluteFooter() ?>
</body>
</html>

