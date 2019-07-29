<?php

/**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
class SampleBlocks {

    public function initData($base_url) {
        
        $content_block1 = '
            <div class="ht-offer-section">
<div class="inner-wrapper">
<div class="container">
<div class="row">
<div class="img-block left-block"><a href="#"> <img src="img/cms/offer-img-1.jpg" alt="offer-img-1" /> </a></div>
<div class="img-block right-block"><a href="#"> <img src="img/cms/offer-img-2.jpg" alt="offer-img-2" /> </a></div>
</div>
</div>
</div>
</div>
';
        $content_block2 = '
            <div id="testimonial-section" class="testimonial-section">
<div class="testimonial-wrapper">
<div class="testimonial-inner ">
<div class="container">
<div class="section-title">
<h2>What client Says</h2>
</div>
<div class="row">
<div class="owl-carousel owl-theme testimonial-slider">
<div class="testimonial-content">
<div class="inner-content">
<div class="testimonial-detail"><img src="img/cms/testimonial-img-1.jpg" alt="testimonial1" />
<div class="profile">
<h4>Joh Doe</h4>
<p>Web Designer</p>
</div>
</div>
<div class="testimonial-desc">
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
</div>
<div class="testimonial-content">
<div class="inner-content">
<div class="testimonial-detail"><img src="img/cms/testimonial-img-2.jpg" alt="testimonial2" />
<div class="profile">
<h4>Joh Doe</h4>
<p>Web Designer</p>
</div>
</div>
<div class="testimonial-desc">
<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which slightly believable.</p>
</div>
</div>
</div>
<div class="testimonial-content">
<div class="inner-content">
<div class="testimonial-detail"><img src="img/cms/testimonial-img-3.jpg" alt="testimonial3" />
<div class="profile">
<h4>Joh Doe</h4>
<p>Web Designer</p>
</div>
</div>
<div class="testimonial-desc">
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
';
        $content_block3 = '
            <div class="contactinfo-section">
<div class="footer-links-column">
<div class="footer-colum-title"><img src="img/cms/footer-logo.png" alt="logo" /></div>
<div class="footer-column-content">
<div class="content">
<p class="address">15 Main Rd E. St Albans VIC 1234, Australia</p>
<p class="email"><a href="mailto:info@hiddentechies.com" title="info@hiddentechies.com">info@hiddentechies.com</a></p>
<p class="phone">(123)-456-7890</p>
</div>
</div>
</div>
</div>
';

        $displayHome = Hook::getIdByName('displayHome');
        $displayFooter = Hook::getIdByName('displayFooter');
        $displayNav1 = Hook::getIdByName('displayNav1');
        $displayHomeTop1 = Hook::getIdByName('displayHomeTop1');
        $displayHomeTop2 = Hook::getIdByName('displayHomeTop2');
        $displayHomeTop3 = Hook::getIdByName('displayHomeTop3');
        $displayHomeBottom1 = Hook::getIdByName('displayHomeBottom1');
        $displayHomeBottom2 = Hook::getIdByName('displayHomeBottom2');
        $displayHomeBottom3 = Hook::getIdByName('displayHomeBottom3');
        $id_shop = Configuration::get('PS_SHOP_DEFAULT');

        /* install static Block */
        $result = true;
        $result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'ht_staticblocks` (`id_ht_staticblocks`, `hook`, `active`) 
			VALUES
                        (1, "displayHomeTop3", 1),
                        (2, "displayHomeBottom2", 1),
                        (3, "displayFooter", 1)
			;');

        $result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'ht_staticblocks_shop` (`id_ht_staticblocks`, `id_shop`,`active`) 
			VALUES 
			(1,' . $id_shop . ', 1),
			(2,' . $id_shop . ', 1),
			(3,' . $id_shop . ', 1)
			;');

        foreach (Language::getLanguages(false) as $lang) {
            $result &= Db::getInstance()->Execute('INSERT INTO `' . _DB_PREFIX_ . 'ht_staticblocks_lang` (`id_ht_staticblocks`, `id_shop`, `id_lang`, `title`, `content`) 
			VALUES 
			("1", "' . $id_shop . '","' . $lang['id_lang'] . '","Header Offer Block", \'' . $content_block1 . '\'),
			("2", "' . $id_shop . '","' . $lang['id_lang'] . '","Home Testimonial Block", \'' . $content_block2 . '\'),
			("3", "' . $id_shop . '","' . $lang['id_lang'] . '","Footer Contact Block", \'' . $content_block3 . '\')
			
                ;');
        }
        return $result;
    }

}
