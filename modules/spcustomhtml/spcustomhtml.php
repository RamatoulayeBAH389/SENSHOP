<?php
/**
 * package SP Custom Html
 *
 * @version 1.0.1
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2014 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;
include_once ( dirname (__FILE__).'/SpCustomHtmlClass.php' );

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
class SpCustomHtml extends Module implements WidgetInterface
{
	protected $error = false;
	private $html;
	private $templateFile;
	private $default_hook = array( 
		'displayCustomhtmlMobile1',
		'displayCustomhtmlMobile2',
		'displayCustomhtml1',
		'displayCustomhtml2',
		'displayCustomhtml3',
		'displayCustomhtml4',
		'displayCustomhtml5',
		'displayCustomhtml6',
		'displayCustomhtml7',
		'displayCustomhtml8',
		'displayCustomhtml9',
		'displayCustomhtml10',
		'displayCustomhtml11',
		'displayCustomhtml12',
		'displayCustomhtml13',
		'displayCustomhtml14',
		'displayCustomhtml15',
		'displayCustomhtml16',
		'displayCustomhtml17',
		'displayCustomhtml18',
		'displayCustomhtml19',
		'displayCustomhtml20',
		'displayCustomhtml21',
		'displayCustomhtml22',
		'displayCustomhtml23',
		'displayCustomhtml24',
		'displayCustomhtml25',
		'displayCustomhtml26',
		'displayCustomhtml27',
		'displayCustomhtml28',
		'displayCustomhtml29',
		'displayCustomhtml30',
		'displayCustomhtml31',
		'displayCustomhtml32',
		'displayFooter',
		'displayLeftColumn',
		'displayFooterMiddle',
		'displayFooterBottom',
		'displayCustomProduct');

	public function __construct()
	{
		$this->name = 'spcustomhtml';
		$this->tab = 'front_office_features';
		$this->version = '1.1.0';
		$this->author = 'MagenTech';
		$this->secure_key = Tools::encrypt ($this->name);
		$this->bootstrap = true;
		parent::__construct ();
		$this->displayName = $this->l('SP Custom Html');
		$this->description = $this->l('This Module allows you to create your own HTML Module using a WYSIWYG editor.');
		$this->confirmUninstall = $this->l('Are you sure?');
		$this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
		$this->templateFile  = 'module:spcustomhtml/views/templates/hook/default.tpl';
	}

	public function install()
	{
		$this->_clearCache('*');
		if (parent::install () == false || !$this->registerHook ('header') || !$this->registerHook ('actionShopDataDuplication'))
			return false;
		foreach ($this->default_hook as $hook)
		{
			if (!$this->registerHook ($hook))
				return false;
		}
		$spcustomhtml = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spcustomhtml`')
			&& Db::getInstance ()->Execute ('CREATE TABLE `'._DB_PREFIX_.'spcustomhtml` (`id_spcustomhtml` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`hook` int(10) unsigned, 
			`params` text NOT NULL DEFAULT \'\' ,
			`active` tinyint(1) NOT NULL DEFAULT \'1\',
			`ordering` int(10) unsigned NOT NULL,
			PRIMARY KEY (`id_spcustomhtml`)) ENGINE=InnoDB default CHARSET=utf8');
		$spcustomhtml_shop = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spcustomhtml_shop`')
			&& Db::getInstance ()->Execute ('CREATE TABLE `'._DB_PREFIX_.'spcustomhtml_shop` (`id_spcustomhtml` int(10) unsigned NOT NULL,
			`id_shop` int(10) unsigned NOT NULL, 
			`active` tinyint(1) NOT NULL DEFAULT \'1\',
			PRIMARY KEY (`id_spcustomhtml`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
		$spcustomhtml_lang = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spcustomhtml_lang`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'spcustomhtml_lang (`id_spcustomhtml` int(10) unsigned NOT NULL,
			`id_lang` int(10) unsigned NOT NULL,
			`title_module` varchar(255) NOT NULL DEFAULT \'\',
			`content` text,
			PRIMARY KEY (`id_spcustomhtml`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
		if (!$spcustomhtml || !$spcustomhtml_shop || !$spcustomhtml_lang)
			return false;

		$this->installFixtures();

		return true;
	}

	public function uninstall()
	{
		$this->_clearCache('*');
		if (parent::uninstall () == false)
			return false;
		if (!Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spcustomhtml`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spcustomhtml_shop`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spcustomhtml_lang`'))
			return false;
		$this->clearCacheItemForHook ();
		return true;
	}

    public function _clearCache($template, $cache_id = null, $compile_id = null)
    {
        parent::_clearCache($this->templateFile);
    }
	
	public function installFixtures()
	{
		$ps_root_dir=str_replace("\\","/",__PS_BASE_URI__);
		$datas = array(
			array(
				'active' => 1,
				'id_spcustomhtml' => 1,
				'hook' => Hook::getIdByName('displayCustomhtml1'),
				'title_module' => 'Contact Html',
				'content' => '
						<div class="icon"></div>
						<div class="text">
							<p class="phone"><strong>Call Us Now</strong>: 0123-456-789</p>
							<p class="email">Email: Contact@revo.com</p>
						</div>
				',
				'moduleclass_sfx' => 'contact-html col-lg-3 hidden-md-down',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 2,
				'hook' => Hook::getIdByName('displayCustomhtml2'),
				'title_module' => 'Featured Categories',
				'content' => '
								<div class="featured clearfix">
								<h3 class="title">Featured Categories</h3>
								<div class="main clearfix">
								<div class="item item-1">
								<div class="content">
								<div class="image"><a href="#"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-1-4.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Iwatch</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-2">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-1-5.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Bags</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-3">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-1-6.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Swimwear</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-4">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-1-7.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Shoes</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-5">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-1-8.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Fashion</a></h4>
								</div>
								</div>
								</div>
								</div>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'id_spcustomhtml' => 3,
				'title_module' => 'Bonus Menu',
				'moduleclass_sfx' => '',
				'display_title_module' => 0,
				'active' => 1,
				'hook' => Hook::getIdByName('displayCustomhtml3'),
				'content' =>'
						<div class="clearfix bonus-menu">
						<ul>
						<li class="item free">
						<div class="icon"></div>
						<div class="text">
						<h5><a href="#">free delivery</a></h5>
						<p>From 275 AED</p>
						</div>
						</li>
						<li class="item cash">
						<div class="icon"></div>
						<div class="text">
						<h5><a href="#">cash on delivery</a></h5>
						<p>From 275 AED</p>
						</div>
						</li>
						<li class="item rewarded">
						<div class="icon"></div>
						<div class="text">
						<h5><a href="#">Rewarded</a></h5>
						<p>From 275 AED</p>
						</div>
						</li>
						<li class="item gift">
						<div class="icon"></div>
						<div class="text">
						<h5><a href="#">free gift box</a></h5>
						<p>& gift note</p>
						</div>
						</li>
						<li class="item secured">
						<div class="icon"></div>
						<div class="text">
						<h5><a href="#">Secured</a></h5>
						<p>Payment</p>
						</div>
						</li>
						<li class="item contact">
						<div class="icon"></div>
						<div class="text">
						<h5><a href="#">Contact us</a></h5>
						<p>123 456 789</p>
						</div>
						</li>
						</ul>
						</div>
					'
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 4,
				'hook' => Hook::getIdByName('displayCustomhtml4'),
				'title_module' => 'Menu Bottom',
				'content' => '
							<div class="menu-bottom">
								<ul>
									<li><a href="#">Home</a></li>
									<li><a href="#">Categories</a></li>
									<li><a href="#">Mobiles</a></li>
									<li><a href="#">Electronics</a></li>
									<li><a href="#">Accessories</a></li>
									<li><a href="#">Laptop</a></li>
									<li><a href="../about-us">About Us</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 5,
				'hook' => Hook::getIdByName('displayCustomhtml5'),
				'title_module' => 'Text Html',
				'content' => '
								<div class="text-html">
									<p>
										Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece 
										<br>of classical Latin literature from 45 BC, making it over 2000 years old.
									</p>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 6,
				'hook' => Hook::getIdByName('displayCustomhtml6'),
				'title_module' => 'Text HTML Layout 3',
				'content' => '
								<div class="free-delivery col-md-6 hidden-sm-down">Free 3-day delivery and free returns within the US</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 7,
				'hook' => Hook::getIdByName('displayCustomhtml7'),
				'title_module' => 'Contact Layout 3',
				'content' => '
								<p><strong>Call Us Now:</strong> 0123-444-666</p>
							',
				'moduleclass_sfx' => 'contact-html-2',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 8,
				'hook' => Hook::getIdByName('displayCustomhtml8'),
				'title_module' => 'Category Customer',
				'content' => '
								<div class="category-customer clearfix">
									<ul>
										<li class="item col-sm-6 col-xs-12">
											<div class="item-image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-3-1.jpg" alt="#" /></a>
											<h3><a href="#">Shop for Women</a></h3>
											</div>
											<div class="text">
											<h5>DEPTH IN DETAIL</h5>
											<h4>SHIRTING FAVORITES</h4>
											</div>
										</li>
										<li class="item col-sm-6 col-xs-12">
											<div class="item-image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-3-2.jpg" alt="#" /></a>
											<h3><a href="#">Shop for Men</a></h3>
											</div>
											<div class="text">
											<h5>Timeless Icon</h5>
											<h4>Herringbone Plaid Shirts</h4>
											</div>
										</li>
									</ul>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 9,
				'hook' => Hook::getIdByName('displayCustomhtml9'),
				'title_module' => 'Category Customer 2',
				'content' => '
								<div class="category-customer-2 clearfix">
									<div class="title">
										<h3>Revo® STYLE. HEAD TO TOE.</h3>
										<h5>Every pair of jeans needs something great to go with them. And we are got it all</h5>
									</div>
									<div class="content">
										<div class="item item-1 col lg-3 col-md-3 col-sm-3 col-xs-3">
											<a href="#"> 
												<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-3-3.jpg" alt="image" /> 
											</a>
											<ul>
												<li>
													<a href="#">Shop sweatshirt</a>
												</li>
												<li>
													<a href="#">Shop jean</a>
												</li>
											</ul>
										</div>
										<div class="item item-2 col lg-6 col-md-6 col-sm-6 col-xs-6">
											<a class="first" href="#"> 
												<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-3-4.jpg" alt="image" /> 
											</a>
										</div>
										<div class="item item-3 col lg-3 col-md-3 col-sm-3 col-xs-3">
											<a href="#"> 
												<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-img-3-5.jpg" alt="image" />
											</a>
											<ul>
												<li>
													<a href="#">
														Shop jackets &amp; vest
													</a>
												</li>
												<li>
													<a href="#">
														Shop t-shirt
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 10,
				'hook' => Hook::getIdByName('displayCustomhtml10'),
				'title_module' => 'Info Top Layout 4',
				'content' => '
								<div class="text-html-2 clearfix">
								<ul>
								<li class="item item-1 col-sm-4 col-xs-12">
									<i class="fa fa-check" aria-hidden="true"></i>
									<span>
										<strong>
											Official Revo Shop
										</strong>
										over 1100 products online
									</span>
								</li>
								<li class="item item-2 col-sm-4 col-xs-12">
									<i class="fa fa-check" aria-hidden="true"></i>
									<span>
										<strong>
											Free shipping and returns
										</strong>
											for members
									</span>
								</li>
								<li class="item item-3 col-sm-4 col-xs-12">
									<i class="fa fa-check" aria-hidden="true"></i>
									<span>
										<strong>
											Same-day dispatch
										</strong>
											before 8pm (Mon-Fri)
									</span>
								</li>
								</ul>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 11,
				'hook' => Hook::getIdByName('displayCustomhtml11'),
				'title_module' => 'Static Infos',
				'content' => '
							<div class="static-infos clearfix">
								<ul>
									<li class="info info-1 col-sm-6">
										<div class="content">
											<h4>min 20% - 70% off</h4>
											<h5>on Sweatshirt</h5>
										</div>
									</li>
									<li class="info info-2 col-sm-6">
										<div class="content">
											<h4>get 20%* cashback</h4>
											<h5>via paytm wallet</h5>
										</div>
									</li>
								</ul>
							</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 12,
				'hook' => Hook::getIdByName('displayCustomhtml12'),
				'title_module' => 'Featured Categories 2',
				'content' => '
								<div class="featured featured-2 clearfix">
								<h3>YOU’Ll love THESE NEW STYLES</h3>
								<h5>Every pair of jeans needs something great to go with them. And we are got it all</h5>
								<div class="main clearfix">
								<div class="item item-1">
								<div class="content">
								<div class="image"><a href="#"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-1.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">boys</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-2">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-2.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">girls</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-3">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-3.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Toddler Boys</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-4">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-4.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Toddler Girls</a></h4>
								</div>
								</div>
								</div>
								<div class="item item-5">
								<div class="content">
								<div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-5.jpg" alt="#" /></a></div>
								<div class="text">
								<h4><a href="#">Babys</a></h4>
								</div>
								</div>
								</div>
								</div>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 13,
				'hook' => Hook::getIdByName('displayCustomhtml13'),
				'title_module' => 'Banner Layout 4',
				'content' => '
								<div class="category-customer-3 clearfix">
								<ul>
									<li class="item col-md-4 col-xs-12">
										<div class="item-image">
											<a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-6.jpg" alt="#" /></a>
										</div>
										<div class="text">
										<h5>divided</h5>
										<h4>reunited in style.</h4>
										</div>
									</li>
									<li class="item col-md-4 col-xs-12">
										<div class="item-image">
											<a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-7.jpg" alt="#" /></a>
										</div>
										<div class="text">
										<h5>DEPTH IN DETAIL</h5>
										<h4>SHIRTING FAVORITES</h4>
										</div>
									</li>
									<li class="item col-md-4 col-xs-12">
										<div class="item-image">
											<a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/home-image-4-8.jpg" alt="#" /></a>
										</div>
										<div class="text">
										<h5>Timeless Icon</h5>
										<h4>Herringbone Plaid Shirts</h4>
										</div>
									</li>
								</ul>
								</div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 14,
				'hook' => Hook::getIdByName('displayCustomhtml14'),
				'title_module' => 'Video',
				'content' => '
								<div class="title">
									<h3>The Suede</h3>
									<h6>Keeping it real smooth since 1986</h6>
								</div>
								<div class="banner-video">
									<div id="thumnail">
										<div class="image-thumnail">
											<a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/thumnail_video.jpg" alt="#" /></a>
										</div>
										<div id="des">
											<div class="button-video"> </div>
										</div>
									</div>
									<div id="video">
										<a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/thumnail_video.jpg" alt="#" /></a>
									</div>
								</div>
							',
				'moduleclass_sfx' => 'video',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 15,
				'hook' => Hook::getIdByName('displayCustomhtml15'),
				'title_module' => 'Find Your',
				'content' => '
								<div class="find-your col-lg-4 col-md-6 col-xs-12">
								<h3 class="block-title font-title"><i class="fa fa-map-marker"></i> Find your nearest store</h3>
								<div class="block-content">
								<p>A contemporary grooming collection infused with the invigorating and sensual scent of Revoshop</p>
									<h6><a href="#">find your store</a></h6>
									<h6><a class="active" href="#">Shop System</a></h6>
								</div>
								</div>
							',
				'moduleclass_sfx' => 'video',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 16,
				'hook' => Hook::getIdByName('displayCustomhtml16'),
				'title_module' => 'App Store',
				'content' => '
								<div><a class="first" href="#">google store</a> <a class="last" href="#">apple store</a></div>
							',
				'moduleclass_sfx' => 'app-store',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 17,
				'hook' => Hook::getIdByName('displayCustomhtml17'),
				'title_module' => 'Header text Layout 5',
				'content' => '
								<p>Summer sale discount off 50%!</p><p><a href="#">Shop Now</a></p>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 18,
				'hook' => Hook::getIdByName('displayCustomhtml18'),
				'title_module' => 'Categories layout 5',
				'content' => '
								<div class="categories-layout5 featured featured-2 clearfix"> 
								<div class="main clearfix">
								<div class="item item-1">
								<div class="content"> 
								<div class="image"><a href="#"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/cate1-layout5.jpg" alt="#" /></a>
								</div> 
								<div class="text"> <h4><a href="#">WOMEN COLLECTIONS</a></h4> </div> </div> </div> <div class="item item-2"> <div class="content"> <div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/cate2-layout5.jpg" alt="#" /></a></div> <div class="text"> <h4><a href="#">BAG COLLECTIONS</a></h4> </div> </div> </div> <div class="item item-3"> <div class="content"> <div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/cate3-layout5.jpg" alt="#" /></a></div> <div class="text"> <h4><a href="#">SHOES COLLECTIONS</a></h4> </div> </div> </div> <div class="item item-4"> <div class="content"> <div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/cate4-layout5.jpg" alt="#" /></a></div> <div class="text"> <h4><a href="#">MEN COLLECTIONS</a></h4> </div> </div> </div> <div class="item item-5"> <div class="content"> <div class="image"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/cate5-layout5.jpg" alt="#" /></a></div> <div class="text"> <h4><a href="#">ACCESSORIES</a></h4> </div> </div> </div> </div> </div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 19,
				'hook' => Hook::getIdByName('displayCustomhtml19'),
				'title_module' => 'ABOUT REVO STORE',
				'content' => '
								<p class="spfooter-text">Donec tellus Nulla lorem Nullam elit id ut elit feugiat lacus. Congue eget dapibus congue tincidunt senectus nibh risus Morbi at ligula porta, vulputate nulla vitae, accumsan sapien. Maecenas molestie maximus varius. Aliquam blandit rhoncus...</p> <p class="spbuy-button-box"><a class="spbuy-button" href="#">BUY THIS THEME</a></p>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 1
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 20,
				'hook' => Hook::getIdByName('displayCustomhtml20'),
				'title_module' => 'Header text Layout 6',
				'content' => '
								<div class="header6-text"> <p>Free shipping on orders of $150+ or $5 flat-rate shipping. Free shipping on all crewcuts orders, all the time.</p> <span class="spremove-button">X</span></div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 21,
				'hook' => Hook::getIdByName('displayCustomhtml21'),
				'title_module' => 'Scroll block layout6',
				'content' => '
								<div class="scroll-block"> <div class="container"> <div class="scroll-text1">A SPLENDID BIRTHDAY SURPRISE</div> <div class="scroll-text2">Celebrate their big day with a stunning arrangement</div> <a class="scroll-button" href="#"> EXPLORE</a></div> </div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 22,
				'hook' => Hook::getIdByName('displayCustomhtml22'),
				'title_module' => 'Categories layout6',
				'content' => '
								<div class="spcategories-layout6"> <div class="spcategory-box col-xs-12 col-sm-6 col-md-2"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/c1.jpg" alt="c1.jpg" /><span class="cate-name">RAYBAN</span></a> <span class="productnb">136 Products</span></div> <div class="spcategory-box col-xs-12 col-sm-6 col-md-2"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/c2.jpg" alt="c2.jpg" /><span class="cate-name">RAYBAN</span></a> <span class="productnb">96 Products</span></div> <div class="spcategory-box col-xs-12 col-sm-6 col-md-2"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/c3.jpg" alt="c3.jpg" /><span class="cate-name">RAYBAN</span></a> <span class="productnb">186 Products</span></div> <div class="spcategory-box col-xs-12 col-sm-6 col-md-2"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/c4.jpg" alt="c4.jpg" /><span class="cate-name">RAYBAN</span></a> <span class="productnb">677 Products</span></div> <div class="spcategory-box col-xs-12 col-sm-6 col-md-2"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/c1.jpg" alt="c1.jpg" /><span class="cate-name">RAYBAN</span></a> <span class="productnb">266 Products</span></div> <div class="spcategory-box col-xs-12 col-sm-6 col-md-2"><a href="#"><img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/c2.jpg" alt="c2.jpg" /><span class="cate-name">RAYBAN</span></a> <span class="productnb">436 Products</span></div> </div>
							',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 23,
				'hook' => Hook::getIdByName('displayCustomhtmlMobile1'),
				'title_module' => 'Mobile box 1',
				'content' => '
					<div class="services-home">
						<ul>
						<li><a href="#" title="Free Shipping On All Order"><em class="fa fa-truck"></em> Free Shipping On All Order</a></li>
						<li><a href="#" title="Money Back Guarantee"><em class="fa fa-recycle"></em> Money Back Guarantee</a></li>
						<li><a href="#" title="Safe Shopping Guarantee"><em class="fa fa-umbrella"></em> Safe Shopping Guarantee</a></li>
						</ul>
					</div>
				',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			array(
				'active' => 1,
				'id_spcustomhtml' => 24,
				'hook' => Hook::getIdByName('displayCustomhtmlMobile2'),
				'title_module' => 'Mobile box 2',
				'content' => '
					<div class="collection">
					<h3 class="title-collections">Top Collections</h3>
					<div class="scroll-container">
					<div class="scroll-block">
					<div class="item-table">
					<div class="item item-table-cell">
					<div class="item-inner"><a href="#" title="Collection Image"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/item-1.png" alt="Collection Image" /><span>Furniture</span> </a></div>
					</div>
					<div class="item item-table-cell">
					<div class="item-inner"><a href="#" title="Collection Image"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/item-2.png" alt="Collection Image" /><span>GIFT IDEA</span> </a></div>
					</div>
					<div class="item item-table-cell">
					<div class="item-inner"><a href="#" title="Collection Image"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/item-3.png" alt="Collection Image" /><span>COOL GADGETS</span> </a></div>
					</div>
					<div class="item item-table-cell">
					<div class="item-inner"><a href="#" title="Collection Image"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/item-4.png" alt="Collection Image" /><span>OUTDOOR</span> </a></div>
					</div>
					<div class="item item-table-cell">
					<div class="item-inner"><a href="#" title="Collection Image"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/item-5.png" alt="Collection Image" /><span>Jewelry</span> </a></div>
					</div>
					<div class="item item-table-cell">
					<div class="item-inner"><a href="#" title="Collection Image"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/item-6.png" alt="Collection Image" /><span>Men\'s Fashion</span> </a></div>
					</div>
					</div>
					</div>
					</div>
					</div>
				',
				'moduleclass_sfx' => '',
				'display_title_module' => 0
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 25,
				'hook' => Hook::getIdByName('displayCustomhtml23'),
				'title_module' => 'Testimonials',
				'content' => 	'
									<div class="testimonial-items">
										<div class="item">
											<div class="img">
												<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/cus.png" alt="#" />
											</div>
											<div class="text">
												<div class="t">
													First time shopping here. I love the shop! Its really bright and welcoming.
													<br/>The staff are friendly which is always nice. The clothes are stylish and affordable.
													<br/>Definitely will be shopping here
												</div>
											</div>
											<div class="name">David Beckham</div>
											<div class="job">Ceo - Magentech</div>
										</div>
										<div class="item">
											<div class="img">
												<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/cus-2.png" alt="#" />
											</div>
											<div class="text">
												<div class="t">
													Lorem Khaled Ipsum is a major key to success. <br/> It’s on you how you want to live your life. <br/> Everyone has a choice. I pick my choice, squeaky clean.
												</div>
											</div>
											<div class="name">
												Ole
											</div>
											<div class="job">
												Manager - United
											</div>
										</div>
										<div class="item">
											<div class="img">
												<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/icon/cus.png" alt="#" />
											</div>
											<div class="text">
												<div class="t">
													Lorem Khaled Ipsum is a major key to success.
													<br/> The staff are friendly which is always nice. The clothes are stylish and affordable.
													<br/> Everyone has a choice. I pick my choice, squeaky clean.
												</div>
											</div>
											<div class="name">
												Sharon Stone
											</div>
											<div class="job">
												Acc - Hollywood
											</div>
										</div>
									</div>
								',
				'moduleclass_sfx' => 'testimonials clearfix',
				'display_title_module' =>  1
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 26,
				'hook' => Hook::getIdByName('displayCustomhtml24'),
				'title_module' => 'Bonus Menu',
				'content' => 	'
									<ul class="row">
										<li class="item item-1 col-lg-4 col-md-4 col-xs-12">
											<div class="group">
												<div class="icon"></div>
												<div class="text">
													<h5 class="name" href="#">100% MONEY BACK</a>
													<p>Guarantee</p>
												</div>
											</div>
										</li>
										<li class="item item-2 col-lg-4 col-md-4 col-xs-12">
											<div class="group">
												<div class="icon"></div>
												<div class="text">
													<h5 class="name" href="#">Free shipping</a>
													<p>When Order Over $150</p>
												</div>
											</div>
										</li>
										<li class="item item-3 col-lg-4 col-md-4 col-xs-12">
											<div class="group">
												<div class="icon"></div>
												<div class="text">
													<h5 class="name" href="#">24-Hours</a>
													<p>Life Time Support</p>
												</div>
											</div>
										</li>
									</ul>
								',
				'moduleclass_sfx' => 'bonus-menu-2',
				'display_title_module' =>  0
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 27,
				'hook' => Hook::getIdByName('displayCustomhtml25'),
				'title_module' => 'Logo Bottom',
				'content' => '
								<a href="#"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/logo-7.png" alt="#" /></a>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque ... Read more</p>
							',
				'moduleclass_sfx' => 'logo-bottom',
				'display_title_module' => 0
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 28,
				'hook' => Hook::getIdByName('displayCustomhtml26'),
				'title_module' => 'Working Time',
				'content' => '
								<ul>
									<li><label>Mon</label> <span>08:00 AM - 10:00 PM</span></li>
									<li><label>Tue</label> <span>08:00 AM - 10:00 PM</span></li>
									<li><label>Wed</label> <span>08:00 AM - 10:00 PM</span></li>
									<li><label>Thur</label> <span>08:00 AM - 10:00 PM</span></li>
									<li><label>Fri</label> <span>08:00 AM - 10:00 PM</span></li>
									<li><label>Weekend</label> <span>CLOSED</span></li>
								</ul>
							',
				'moduleclass_sfx' => 'working-time',
				'display_title_module' => 1
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 29,
				'hook' => Hook::getIdByName('displayCustomhtml27'),
				'title_module' => 'Payment Accept',
				'content' => '
								<a href="#"> <img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/payment.png" alt="#" /></a>
							',
				'moduleclass_sfx' => 'payment-accept',
				'display_title_module' => 1
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 30,
				'hook' => Hook::getIdByName('displayCustomhtml28'),
				'title_module' => 'Menu Bottom 2',
				'content' => '
								<ul>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Term of Use</a></li>
									<li><a href="#">Privacy Policy </a></li>
									<li><a href="#">Site Map</a></li>
								</ul>
							',
				'moduleclass_sfx' => 'menu-bottom-2',
				'display_title_module' => 0
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 31,
				'hook' => Hook::getIdByName('displayCustomhtml29'),
				'title_module' => 'Bonus Menu',
				'content' => 	'
								<ul>
									<li class="item item-1">
										<div class="icon"></div>
										<div class="text">
											<a class="name" href="#"><span class="one">Official Revo Shop</span> <span class="two">over 1100 products online</span></a>
										</div>
									</li>
									<li class="item item-2">
										<div class="icon"></div>
										<div class="text">
											<a class="name" href="#"><span class="one">Free shipping and returns</span> <span class="two">for members</span></a>
										</div>
									</li>
									<li class="item item-3">
										<div class="icon"></div>
										<div class="text">
											<a class="name" href="#"><span class="one">Same-day dispatch</span> <span class="two">before 8pm (Mon-Fri)</span></a>
										</div>
									</li>
								</ul>
				',
				'moduleclass_sfx' => 'bonus-menu-8 clearfix',
				'display_title_module' =>  0
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 32,
				'hook' => Hook::getIdByName('displayCustomhtml30'),
				'title_module' => 'Help and Confirm',
				'content' => '
								<ul>
									<li class ="help">
										<div class="icon"></div>
										<a href="#">Help</a>
									</li>
									<li class ="confirm">
										<div class="icon"></div>
										<a href="#">Confirmation</a>
									</li>
								</ul>
							',
				'moduleclass_sfx' => 'help-confirm hidden-sm-down',
				'display_title_module' => 0
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 33,
				'hook' => Hook::getIdByName('displayCustomhtml31'),
				'title_module' => 'FEATURED CATEGORIES <span>Featured collections created and curated by our editors.</span>',
				'content' => 	'
								<div class="col-md-6 col-xs-12 banner-left">
									<div class="banner-image spbanner">
										<a class="banner" href="#"><img class="mark-lazy" src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/banner-8-1.jpg" alt="Banner Image"></a>
									</div>
								</div>
								
								<div class="col-md-6 col-xs-12 banner-right">
									<div class="row">
										<div class="banner-image-2 col-md-6 col-sm-6 spbanner">
											<a class="banner" href="#"><img class="mark-lazy" src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/banner-8-2.jpg" alt="Banner Image"></a>
										</div>
										
										<div class="banner-image-3 col-md-6 col-sm-6 spbanner">
											<a class="banner" href="#"><img class="mark-lazy" src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/banner-8-3.jpg" alt="Banner Image"></a>
										</div>
									</div>
									<div class="banner-image-4 spbanner">
										<a class="banner" href="#"><img class="mark-lazy" src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/banner-8-4.jpg" alt="Banner Image"></a>
									</div>
								</div>
								
								<div class="col-md-12 banner-bottom">
									<div class="banner-image spbanner">
										<a class="banner" href="#"><img class="mark-lazy" src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/banner-8-5.jpg" alt="Banner Image"></a>
									</div>
								</div>
								',
				'moduleclass_sfx' => 'banner-8-3 clearfix',
				'display_title_module' =>  1
			),
			
			array(
				'active' => 1,
				'id_spcustomhtml' => 34,
				'hook' => Hook::getIdByName('displayCustomhtml32'),
				'title_module' => 'Video',
				'content' => 	'
									<div class="video-content">
										<img src="'.$ps_root_dir.'themes/sp_revo17/assets/img/cms/video.jpg" alt="Video">
										<div class="video-description">
											<a class="btn-play" href="https://www.youtube.com/watch?v=a8Wn6M9Wf-Y" title="Play">Play</a>
											<h5 class="hidden-sm-down">Lookbook revo 2017</h5>
											<h4 class="hidden-sm-down">Stuart weitzman fall 2016 ad campaign featuring Gigi Hadid Video</h4>
											<p class="hidden-md-down">“Kate Moss. Sexy Stuart Weitzman boots. Enough said. It is a long established fact that a reader will be distracted <br>
											by the readable content of a page ”</p>
											<span class="hidden-sm-down">shop the collection</span>
										</div>
									</div>
								',
				'moduleclass_sfx' => 'video-play',
				'display_title_module' =>  0
			)
			
		);
		$return = true;
		$temp = array();
		foreach ($datas as $i => $data)
		{
		$customs = new SpCustomHtmlClass();
		$temp['content'] = $data['content'];
		$temp['title_module'] = $data['title_module'];
		$customs->hook = $data['hook'];
		$customs->active = $data['active'];
		$customs->ordering = $i;
		unset($data['content']);
		unset($data['title_module']);
		$customs->params = serialize($data);
		foreach (Language::getLanguages(false) as $lang)
		{
		$customs->content[$lang['id_lang']] = $temp['content'];
		$customs->title_module[$lang['id_lang']] = $temp['title_module'];
		}
		$return &= $customs->add();
		}

		return $return;
	}

	public function getContent()
	{
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if ($this->postValidation())
			{
				$this->html .= $this->postProcess();
				$this->html .= $this->initForm();
			}
			else
				$this->html .= $this->initForm();
		}
		elseif (Tools::isSubmit ('addItem') || (Tools::isSubmit('editItem')
				&& $this->moduleExists((int)Tools::getValue('id_spcustomhtml'))) || Tools::isSubmit ('saveItem'))
		{
			if (Tools::isSubmit('addItem'))
				$mode = 'add';
			else
				$mode = 'edit';
			if ($mode == 'add')
			{
				if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL)
					$this->html .= $this->initForm ();
				else
					$this->html .= $this->getShopContextError(null, $mode);
			}
			else
			{
				$associated_shop_ids = SpCustomHtmlClass::getAssociatedIdsShop((int)Tools::getValue('id_spcustomhtml'));
				$context_shop_id = (int)Shop::getContextShopID();

				if ($associated_shop_ids === false)
					$this->html .= $this->getShopAssociationError((int)Tools::getValue('id_spcustomhtml'));
				else if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL
					&& in_array($context_shop_id, $associated_shop_ids))
				{
					if (count($associated_shop_ids) > 1)
						$this->html = $this->getSharedSlideWarning();
					$this->html .= $this->initForm();
				}
				else
				{
					$shops_name_list = array();
					foreach ($associated_shop_ids as $shop_id)
					{
						$associated_shop = new Shop((int)$shop_id);
						$shops_name_list[] = $associated_shop->name;
					}
					$this->html .= $this->getShopContextError($shops_name_list, $mode);
				}
			}
		}
		else
		{
			if ($this->postValidation())
			{
				$this->html .= $this->postProcess();
				$this->html .= $this->displayForm ();
			}
			else
				$this->html .= $this->displayForm ();
		}
		return $this->html;
	}
	private function postValidation()
	{	$errors = array();
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (!Validate::isInt(Tools::getValue('active')) || (Tools::getValue('active') != 0
					&& Tools::getValue('active') != 1))
				$errors[] = $this->l('Invalid slide state.');
			if (!Validate::isInt(Tools::getValue('position')) || (Tools::getValue('position') < 0))
				$errors[] = $this->l('Invalid slide position.');
			if (Tools::isSubmit('id_spcustomhtml'))
			{
				if (!Validate::isInt(Tools::getValue('id_spcustomhtml'))
					&& !$this->moduleExists(Tools::getValue('id_spcustomhtml')))
					$errors[] = $this->l('Invalid module ID');
			}
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('title_module_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
				if (Tools::strlen(Tools::getValue('content_'.$language['id_lang'])) > 4000)
					$errors[] = $this->l('The content is too long.');
			}
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('title_module_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title module is not set.');
			if (Tools::strlen(Tools::getValue('content_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The content is not set.');
			if (Tools::strlen(Tools::getValue('moduleclass_sfx')) > 255)
				$errors[] = $this->l('The Module Class Suffix  is too long.');
		}elseif (Tools::isSubmit('id_spcustomhtml')
			&& (!Validate::isInt(Tools::getValue('id_spcustomhtml'))
				|| !$this->moduleExists((int)Tools::getValue('id_spcustomhtml'))))
			$errors[] = $this->l('Invalid module ID');
		if (count($errors))
		{
			$this->html .= $this->displayError(implode('<br />', $errors));
			return false;
		}
		return true;
	}

	private function postProcess()
	{
		$currentIndex = AdminController::$currentIndex;
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (Tools::getValue('id_spcustomhtml'))
			{
				$customhtml = new SpCustomHtmlClass((int)Tools::getValue ('id_spcustomhtml'));
				if (!Validate::isLoadedObject($customhtml))
				{
					$this->html .= $this->displayError($this->l('Invalid slide ID'));
					return false;
				}
			}
			else
				$customhtml = new SpCustomHtmlClass();
			$next_ps = $this->getNextPosition();
			$customhtml->ordering = (!empty($customhtml->ordering)) ? (int)$customhtml->ordering : $next_ps;
			$customhtml->active = (Tools::getValue('active')) ? (int)Tools::getValue('active') : 0;
			$customhtml->hook	= (int)Tools::getValue('hook');
			$tmp_data = array();
			$id_spcustomhtml = (int)Tools::getValue ('id_spcustomhtml');
			$id_spcustomhtml = $id_spcustomhtml ? $id_spcustomhtml : (int)$customhtml->getHigherModuleID();
			$tmp_data['id_spcustomhtml'] = $id_spcustomhtml;

			$tmp_data['active'] = (int)Tools::getValue ('active', 1);
			$tmp_data['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx');
			$tmp_data['display_title_module'] = Tools::getValue ('display_title_module');
			$tmp_data['hook '] = Tools::getValue('hook');
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				$customhtml->title_module[$language['id_lang']] = Tools::getValue('title_module_'.$language['id_lang']);
				$customhtml->content[(int)$language['id_lang']] = Tools::getValue ('content_'.$language['id_lang']);
			}
			$customhtml->params = serialize($tmp_data);
			(Tools::getValue ('id_spcustomhtml')
		&& $this->moduleExists((int)Tools::getValue ('id_spcustomhtml')) )? $customhtml->update() : $customhtml->add ();
			$this->clearCacheItemForHook ();
			if (Tools::isSubmit ('saveAndStay'))
			{
				$tool_id_spcustomhtml = Tools::getValue ('id_spcustomhtml');
				$higher_module = $customhtml->getHigherModuleID();
				$id_spcustomhtml = $tool_id_spcustomhtml?(int)$tool_id_spcustomhtml:(int)$higher_module;
				Tools::redirectAdmin ($currentIndex.'&configure='
				.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spcustomhtml='
					.$id_spcustomhtml.'&updateItemConfirmation');
			}
			else
				Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
					.'&token='.Tools::getAdminTokenLite ('AdminModules').'&saveItemConfirmation');
		}
		elseif (Tools::isSubmit('changeStatusItem') && Tools::getValue ('id_spcustomhtml'))
		{
			$customhtml = new SpCustomHtmlClass((int)Tools::getValue ('id_spcustomhtml'));
			if ($customhtml->active == 0)
				$customhtml->active = 1;
			else
				$customhtml->active = 0;
			//$customhtml->updateStatus (Tools::getValue ('active'));
			$customhtml->update();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
				.'&token='.Tools::getAdminTokenLite ('AdminModules'));
		}
		elseif (Tools::isSubmit ('deleteItem') && Tools::getValue ('id_spcustomhtml'))
		{
			$customhtml = new SpCustomHtmlClass((int)Tools::getValue ('id_spcustomhtml'));
			$customhtml->delete ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='
				.Tools::getAdminTokenLite ('AdminModules').'&deleteItemConfirmation');
		}
		elseif (Tools::isSubmit ('duplicateItem') && Tools::getValue ('id_spcustomhtml'))
		{
			$customhtml = new SpCustomHtmlClass(Tools::getValue ('id_spcustomhtml'));
			foreach (Language::getLanguages (false) as $lang)
				$customhtml->title_module[(int)$lang['id_lang']] = $customhtml->title_module[(int)$lang['id_lang']]
					.$this->l(' (Copy)');
			$customhtml->duplicate();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='
				.Tools::getAdminTokenLite ('AdminModules').'&duplicateItemConfirmation');
		}
		elseif (Tools::isSubmit ('saveItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully updated!'));
		elseif (Tools::isSubmit ('deleteItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully deleted!'));
		elseif (Tools::isSubmit ('duplicateItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully duplicated!'));
		elseif (Tools::isSubmit ('updateItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module successfully updated!'));
	}

	private function clearCacheItemForHook()
	{
		$this->_clearCache ('default.tpl');
	}
	public function moduleExists($id_spcustomhtml)
	{
		$req = 'SELECT cs.`id_spcustomhtml` 
				FROM `'._DB_PREFIX_.'spcustomhtml` cs
				WHERE cs.`id_spcustomhtml` = '.(int)$id_spcustomhtml;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

		return ($row);
	}
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(cs.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'spcustomhtml` cs, `'._DB_PREFIX_.'spcustomhtml_shop` css
			WHERE css.`id_spcustomhtml` = cs.`id_spcustomhtml` AND css.`id_shop` = '.(int)$this->context->shop->id
		);

		return (++$row['next_position']);
	}

	private function getGridItems()
	{
		$this->context = Context::getContext ();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		$sql = 'SELECT b.`id_spcustomhtml`,  b.`hook`, b.`ordering`, bs.`active`, bl.`title_module`, bl.`content`
			FROM `'._DB_PREFIX_.'spcustomhtml` b
			LEFT JOIN `'._DB_PREFIX_.'spcustomhtml_shop` bs ON (b.`id_spcustomhtml` = bs.`id_spcustomhtml` )
			LEFT JOIN `'._DB_PREFIX_.'spcustomhtml_lang` bl ON (b.`id_spcustomhtml` = bl.`id_spcustomhtml`)
			WHERE bs.`id_shop` = '.(int)$id_shop.' 
			AND bl.`id_lang` = '.(int)$id_lang.'
			ORDER BY b.`ordering`';
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql );
	}

	private function getHookTitle($id_hook, $name = false)
	{
		if (!$result = Db::getInstance ()->getRow ('
			SELECT `name`,`title`
			FROM `'._DB_PREFIX_.'hook`
			WHERE `id_hook` = '.( $id_hook )))
			return false;
		return ( ( $result['title'] != '' && $name )?$result['title']:$result['name'] );
	}

	private function displayForm()
	{
		$currentIndex = AdminController::$currentIndex;
		$modules = array();
		$this->html .= $this->headerHTML ();
		if (Shop::getContext() == Shop::CONTEXT_GROUP || Shop::getContext() == Shop::CONTEXT_ALL)
			$this->html .= $this->getWarningMultishopHtml();
		else if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL)
		{
			$modules = $this->getGridItems ();
			if (!empty($modules))
			{
				foreach ($modules as $key => $mod)
				{
					$associated_shop_ids = SpCustomHtmlClass::getAssociatedIdsShop((int)$mod['id_spcustomhtml']);
					if ($associated_shop_ids && count($associated_shop_ids) > 1)
						$modules[$key]['is_shared'] = true;
					else
						$modules[$key]['is_shared'] = false;
				}
			}
		}
		$this->html .= '
	 	<div class="panel">
			<div class="panel-heading">
			'.$this->l('Module Manager').'
			<span class="panel-heading-action">
					<a class="list-toolbar-btn" href="'.$currentIndex.'&configure='.$this->name
			.'&token='.Tools::getAdminTokenLite ('AdminModules').'&addItem">
			<span data-toggle="tooltip" class="label-tooltip" data-original-title="'
			.$this->l('Add new module').'" data-html="true"><i class="process-icon-new "></i></span></a>
			</span>
			</div>
			<table width="100%" class="table" cellspacing="0" cellpadding="0">
			<thead>
			<tr class="nodrag nodrop">
				<th>'.$this->l('ID').'</th>
				<th>'.$this->l('Ordering').'</th>
				<th class=" left">'.$this->l('Title').'</th>
				<th class=" left">'.$this->l('Hook into').'</th>
				<th class=" left">'.$this->l('Status').'</th>
				<th class=" right"><span class="title_box text-right">'.$this->l('Actions').'</span></th>
			</tr>
			</thead>
			<tbody id="gird_items">';
		if (!empty($modules))
		{
			static $irow;
			foreach ($modules as $customhtml)
			{
				$this->html .= '
				<tr id="item_'.$customhtml['id_spcustomhtml'].'" class=" '.( $irow ++ % 2?' ':'' ).'">
					<td class=" 	" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spcustomhtml='
					.$customhtml['id_spcustomhtml'].'\'">'
					.$customhtml['id_spcustomhtml'].'</td>
					<td class=" dragHandle"><div class="dragGroup"><div class="positions">'.$customhtml['ordering']
					.'</div></div></td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_spcustomhtml='.$customhtml['id_spcustomhtml'].'\'">'.$customhtml['title_module']
					.' '.($customhtml['is_shared'] ? '<span class="label color_field"
		style="background-color:#108510;color:white;margin-top:5px;">'.$this->l('Shared').'</span>' : '').'</td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name
					.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spcustomhtml='
					.$customhtml['id_spcustomhtml'].'\'">'
					.( Validate::isInt ($customhtml['hook'])?$this->getHookTitle ($customhtml['hook']):'' ).'</td>
					<td class="  "> <a href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&changeStatusItem&id_spcustomhtml='.$customhtml['id_spcustomhtml'].'&status='
					.$customhtml['active'].'&hook='.$customhtml['hook'].'">'.( $customhtml['active']?'
					<i class="icon-check"></i>':'<i class="icon-remove"></i>' ).'</a> </td>
					<td class="text-right">
						<div class="btn-group-action">
							<div class="btn-group pull-right">
								<a class="btn btn-default" href="'.$currentIndex.'&configure='.$this->name.'&token='
		.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spcustomhtml='.$customhtml['id_spcustomhtml'].'">
									<i class="icon-pencil"></i> Edit
								</a> 
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<span class="caret"></span>&nbsp;
								</button>
								<ul class="dropdown-menu">
									<li>
							<a onclick="return confirm(\''
					.$this->l('Are you sure want duplicate this item?', __CLASS__, true, false)
					.'\');"  title="'.$this->l('Duplicate').'" href="'.$currentIndex.'&configure='
					.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&duplicateItem&id_spcustomhtml='
					.$customhtml['id_spcustomhtml'].'">
											<i class="icon-copy"></i> '.$this->l('Duplicate').'
										</a>								
									</li>
									<li class="divider"></li>
									<li>
										<a title ="'.$this->l('Delete').'" onclick="return confirm(\''
					.$this->l('Are you sure?', __CLASS__, true, false).'\');" href="'.$currentIndex
					.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&deleteItem&id_spcustomhtml='
					.$customhtml['id_spcustomhtml'].'">
											<i class="icon-trash"></i> '.$this->l('Delete').'
										</a>
									</li>
								</ul>
							</div>
						</div>
					</td>
				</tr>';
			}
		}
		else
		{
			$this->html .= '<td colspan="5" class="list-empty">
								<div class="list-empty-msg">
									<i class="icon-warning-sign list-empty-icon"></i>
									'.$this->l('No records found').'
								</div>
							</td>';
		}
		$this->html .= '
			</tbody>
			</table>
		</div>';
	}

	public function getHookList()
	{
		$hooks = array();
		foreach ($this->default_hook as $key => $hook)
		{
			$id_hook = Hook::getIdByName ($hook);
			$name_hook = $this->getHookTitle ($id_hook);
			$hooks[$key]['key'] = $id_hook;
			$hooks[$key]['name'] = $name_hook;
		}
		return $hooks;
	}

	public function initForm()
	{
		$default_lang = (int)Configuration::get ('PS_LANG_DEFAULT');
		$hooks = $this->getHookList ();
		$this->fields_form[0]['form'] = array(
			'tinymce' => true,
			'legend'  => array(
				'title' => $this->l('General Options'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'     => 'text',
					'label'    => $this->l('Title'),
					'lang'     => true,
					'name'     => 'title_module',
					'class'    => 'fixed-width-xl',
					'hint'     => $this->l('Title Of Module')
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Module Class Suffix'),
					'name'  => 'moduleclass_sfx',
					'hint'  => $this->l('A suffix to be applied to the CSS class of the module.
					This allows for individual module styling.'),
					'class' => 'fixed-width-xl'
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Title'),
					'name'   => 'display_title_module',
					'hint'   => $this->l('Display Title Of Module'),
					'values' => array(
						array(
							'id'    => 'active_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'active_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Status'),
					'name'   => 'active',
					'hint'   => $this->l('Status Of Module'),
					'values' => array(
						array(
							'id'    => 'active_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'active_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Hook into'),
					'name'    => 'hook',
					'hint'    => $this->l('Select Hook for Module'),
					'options' => array(
						'query' => $hooks,
						'id'    => 'key',
						'name'  => 'name'
					)
				),
				array(
					'type'         => 'textarea',
					'label'        => $this->l('Content'),
					'name'         => 'content',
					'hint'         => $this->l('Show Content Of Module'),
					'lang'         => true,
					'autoload_rte' => true,
					'cols'         => 40,
					'rows'         => 10
				)
			),
			'submit'  => array(
				'title' => $this->l('Save')
			),
			'buttons' => array(
				array(
					'title' => $this->l('Save and stay'),
					'name'  => 'saveAndStay',
					'type'  => 'submit',
					'class' => 'btn btn-default pull-right',
					'icon'  => 'process-icon-save'
				)
			)
		);
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = 'spcustomhtml';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite ('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='
			.Tools::getAdminTokenLite ('AdminModules');
		foreach (Language::getLanguages (false) as $lang)
			$helper->languages[] = array(
				'id_lang'    => $lang['id_lang'],
				'iso_code'   => $lang['iso_code'],
				'name'       => $lang['name'],
				'is_default' => ( $default_lang == $lang['id_lang']?1:0 )
			);
		$helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->toolbar_scroll = true;
		$helper->title = $this->displayName;
		$helper->submit_action = 'saveItem';
		$helper->toolbar_btn = array(
			'save' => array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name
					.'&save'.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
			),
			'back' => array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules'),
				'desc' => $this->l('Back to list') )
		);
		$id_spcustomhtml = (int)Tools::getValue ('id_spcustomhtml');

		if (Tools::isSubmit ('id_spcustomhtml') && $id_spcustomhtml)
		{
			$customhtml = new SpCustomHtmlClass((int)$id_spcustomhtml);
			$params = unserialize($customhtml->params);
			$this->fields_form[0]['form']['input'][] = array(
				'type' => 'hidden',
				'name' => 'id_spcustomhtml' );
		$helper->fields_value['id_spcustomhtml'] = Tools::getValue ('id_spcustomhtml', $customhtml->id_spcustomhtml);
		}
		else
		{
			$customhtml = new SpCustomHtmlClass();
			$params = array();
		}
		foreach (Language::getLanguages (false) as $lang)
		{
			$helper->fields_value['title_module'][(int)$lang['id_lang']] = Tools::getValue ('title_module_'
				.(int)$lang['id_lang'],
				$customhtml->title_module[(int)$lang['id_lang']]);
			$helper->fields_value['content'][(int)$lang['id_lang']] = Tools::getValue ('content_'.(int)$lang['id_lang'],
				$customhtml->content[(int)$lang['id_lang']]);
		}
		$helper->fields_value['hook'] = Tools::getValue ('hook', $customhtml->hook);
		$helper->fields_value['active'] = (int)Tools::getValue('active', $customhtml->active);
		$display_title_module = isset( $params['display_title_module'] ) ? $params['display_title_module'] : 1;
		$helper->fields_value['display_title_module'] = Tools::getValue ('display_title_module', $display_title_module);
		$helper->fields_value['moduleclass_sfx'] = Tools::getValue ('moduleclass_sfx',
			isset($params['moduleclass_sfx']) ? $params['moduleclass_sfx'] : '' );
		$this->html .= $helper->generateForm ($this->fields_form);
	}

	private function getItemInHook($hook_name)
	{
		$this->_clearCache('*');
		$list = array();
		$this->context = Context::getContext ();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		$id_hook = Hook::getIdByName ($hook_name);
		if ($id_hook)
		{
			$sql = 'SELECT * FROM `'._DB_PREFIX_.'spcustomhtml` b
			LEFT JOIN `'._DB_PREFIX_.'spcustomhtml_shop` bs ON (b.`id_spcustomhtml` = bs.`id_spcustomhtml`)
			LEFT JOIN `'._DB_PREFIX_.'spcustomhtml_lang` bl ON (b.`id_spcustomhtml` = bl.`id_spcustomhtml`)
			WHERE bs.`active` = 1 AND (bs.`id_shop` = '.$id_shop.')
			AND (bl.`id_lang` = '.$id_lang.')
			AND b.`hook` = '.( $id_hook ).' ORDER BY b.`ordering`';
			$results = Db::getInstance ()->ExecuteS ($sql);
			foreach ($results as &$row)
			{

				$row['params'] = unserialize($row['params']);

			}
		}
		return $results;
	}

	public function hookHeader()
	{
		$this->context->controller->addCSS ($this->_path.'views/css/style.css', 'all');
	}
	
	public function renderWidget($hookName = null, array $configuration = [])
    {

			$variables = $this->getWidgetVariables($hookName, $configuration);
			
			$this->smarty->assign($variables);
        return $this->fetch($this->templateFile);
    }
	
	
	 public function getWidgetVariables($hookName = null, array $configuration = [])
    {
		
		$list = $this->getItemInHook ($hookName);
		if (!empty($list)){
			return array(
				'htmllist' => $list
			);
		}else{
			return array(
				'htmllist' => ''
			);
		}
    }

	public function headerHTML()
	{
		if (Tools::getValue ('controller') != 'AdminModules' && Tools::getValue ('configure') != $this->name)
			return;
		$this->context->controller->addJqueryUI ('ui.sortable');
		$html = '<script type="text/javascript">
			$(function() {
				var $gird_items = $("#gird_items");
				$gird_items.sortable({
					opacity: 0.6,
					cursor: "move",
					handle: ".dragGroup",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
							$.ajax({
								type: "POST",
								dataType: "json",
								data:order,
								url:"'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/ajax_'.$this->name
			.'.php?secure_key='.$this->secure_key.'",
								success: function (msg){
									if (msg.error)
									{
										showErrorMessage(msg.error);
										return;
									}
									$(".positions", $gird_items).each(function(i){
										$(this).text(i);
									});
									showSuccessMessage(msg.success);
								}
							});
						
						}
					});
					$(".dragGroup",$gird_items).hover(function() {
						$(this).css("cursor","move");
					},
					function() {
						$(this).css("cursor","auto");
				    });
			});
		</script>
		';
		$html .= '<style type="text/css">#gird_items .ui-sortable-helper{display:table!important;}</style>';
		return $html;
	}
	private function getWarningMultishopHtml()
	{
		if (Shop::getContext() == Shop::CONTEXT_GROUP || Shop::getContext() == Shop::CONTEXT_ALL)
			return '<p class="alert alert-warning">'.
						$this->l('You cannot manage modules items from a "All Shops" or a "Group Shop" context,
						select directly the shop you want to edit').
					'</p>';
		else
			return '';
	}

	private function getShopContextError($shop_contextualized_name, $mode)
	{
		if (is_array($shop_contextualized_name))
			$shop_contextualized_name = implode('<br/>', $shop_contextualized_name);

		if ($mode == 'edit')
			return '<p class="alert alert-danger">'.
							sprintf($this->l('You can only edit this module from the shop(s) context: %s'),
								$shop_contextualized_name).
					'</p>';
		else
			return '<p class="alert alert-danger">'.
							sprintf($this->l('You cannot add modules from a "All Shops" or a "Group Shop" context')).
					'</p>';
	}

	private function getShopAssociationError($id_customhtml)
	{
		return '<p class="alert alert-danger">'.
			sprintf($this->l('Unable to get module shop association information (id_module: %d)'), (int)$id_customhtml).
				'</p>';
	}


	private function getCurrentShopInfoMsg()
	{
		$shop_info = null;

		if (Shop::isFeatureActive())
		{
			if (Shop::getContext() == Shop::CONTEXT_SHOP)
			$shop_info = sprintf($this->l('The modifications will be applied to shop: %s'), $this->context->shop->name);
			else if (Shop::getContext() == Shop::CONTEXT_GROUP)
				$shop_info = sprintf($this->l('The modifications will be applied to this group: %s'),
					Shop::getContextShopGroup()->name);
			else
				$shop_info = $this->l('The modifications will be applied to all shops and shop groups');

			return '<div class="alert alert-info">'.
						$shop_info.
					'</div>';
		}
		else
			return '';
	}
	private function getSharedSlideWarning()
	{
		return '<p class="alert alert-warning">'.
					$this->l('This module is shared with other shops!
					All shops associated to this module will apply modifications made here').
				'</p>';
	}

	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance ()->execute ('
		INSERT IGNORE INTO `'._DB_PREFIX_.'spcustomhtml_shop` (`id_spcustomhtml`, `id_shop`)
		SELECT `id_spcustomhtml`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'spcustomhtml_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}
}
