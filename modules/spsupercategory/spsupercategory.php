<?php
/**
 * package   SP Super Category
 *
 * @version 1.0.2
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;
include_once ( dirname (__FILE__).'/SpSuperCategoryClass.php' );


use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class SpSuperCategory extends Module
{
	protected $categories = array();
	protected $error = false;
	private $html;
	private $default_hook = array(
		'displaySuperCategory1',
		'displaySuperCategory2',
		'displaySuperCategory3',
		'displaySuperCategory4',
		'displaySuperCategory5'
	);
	public function __construct()
	{
		$this->name = 'spsupercategory';
		$this->tab = 'front_office_features';
		$this->version = '1.1.0';
		$this->author = 'MagenTech';
		$this->secure_key = Tools::encrypt ($this->name);
		$this->bootstrap = true;
		parent::__construct ();
		$this->displayName = $this->l('SP Super Category');
		$this->description = $this->l('Display categories with listing view.');
		$this->confirmUninstall = $this->l('Are you sure?');
		$this->ps_versions_compliancy = array('min' => '1.7.0.0', 'max' => _PS_VERSION_);
	}

	public function install()
	{
		if (parent::install () == false || !$this->registerHook ('displayHeader') || !$this->registerHook ('actionShopDataDuplication'))
			return false;
		foreach ($this->default_hook as $hook)
		{
			if (!$this->registerHook ($hook))
				return false;
		}
		$spsupercategory = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spsupercategory`')
			&& Db::getInstance ()->Execute ('
			CREATE TABLE '._DB_PREFIX_.'spsupercategory (
				`id_spsupercategory` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`hook` int(10) unsigned,
				`params` text NOT NULL DEFAULT \'\' ,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				`ordering` int(10) unsigned NOT NULL,
				PRIMARY KEY (`id_spsupercategory`)) ENGINE=InnoDB default CHARSET=utf8');
		$spsupercategory_shop = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spsupercategory_shop`')
			&& Db::getInstance ()->Execute ('
				CREATE TABLE '._DB_PREFIX_.'spsupercategory_shop (
				`id_spsupercategory` int(10) unsigned NOT NULL,
				`id_shop` int(10) unsigned NOT NULL,
				`active` tinyint(1) NOT NULL DEFAULT \'1\',
				 PRIMARY KEY (`id_spsupercategory`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
		$spsupercategory_lang = Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spsupercategory_lang`')
			&& Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'spsupercategory_lang (
				`id_spsupercategory` int(10) unsigned NOT NULL,
				`id_lang` int(10) unsigned NOT NULL,
				`title_module` varchar(255) NOT NULL DEFAULT \'\',
				PRIMARY KEY (`id_spsupercategory`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
		if (!$spsupercategory || !$spsupercategory_shop || !$spsupercategory_lang)
			return false;
		$this->installFixtures();
		return true;
	}

	public function uninstall()
	{
		if (parent::uninstall () == false)
			return false;
		if (!Db::getInstance ()->Execute ('DROP TABLE  IF EXISTS `'._DB_PREFIX_.'spsupercategory`')
			|| !Db::getInstance ()->Execute ('DROP TABLE  IF EXISTS `'._DB_PREFIX_.'spsupercategory_shop`')
			|| !Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'spsupercategory_lang`'))
			return false;
		$this->clearCacheItemForHook ();
		return true;
	}
	
	private function _getImageSize($_value_df = 'home_default'){
		$image_pro_types = ImageType::getImagesTypes ('products');
		$flag = true;
		foreach($image_pro_types  as $_image){
			if($flag && $_image['name'] == $_value_df){
				$_value_df = $_image['name'] ;
				$flag = false;
			}
		}
		if ($flag) {
			$product_type = array_shift($image_pro_types);
			$_value_df = $_value = isset($product_type['name']) ?  $product_type['name'] : 'none';	
		}
		return 	$_value_df;
	}
	public function installFixtures()
	{
		$image_cat_types = ImageType::getImagesTypes ('categories');
		$cat_types = array_shift($image_cat_types);
		$image_pro_types = ImageType::getImagesTypes ('products');
		$product_type = array_shift($image_pro_types);
		$datas = array(
			array(
				'id_spsupercategory' => 1,
				'active' => 1,
				'moduleclass_sfx' => 'sp_super_category_1',
				'display_title_module' => 0,
				'title_module' => 'Fashion',
				'hook' => Hook::getIdByName('displaySuperCategory1'),
				'nb__column1' => 7,
				'nb__column2' => 5,
				'nb__column3' => 3,
				'nb__column4' => 1,
				'nb_column1' => 5,
				'nb_column2' => 3,
				'nb_column3' => 2,
				'nb_column4' => 1,
				'target' => '_self',
				'show_loadmore_slider' => 'slider',

				'catids' => 'all',
				'field_select' => 'name',
				'field_preload' => 'name',
				'cat_count_number' => 12,
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				'count_number' => 10,

				'cat_image_size' => $this->_getImageSize('category_default'),
				'cat_name_maxlength' => 25,
				'cat_sub_name_display' => 1,
				'cat_sub_name_maxlength' => 50,
				'cat_field_ordering' => 'rand',
				'cat_field_direction' => 'ASC',

				'image_size' => $this->_getImageSize('home_default'),
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				//'display_wishlist' => 0,
				//'display_compare' => 0,
				'display_addtocart' => 1,
				'display_quickview' => 1,
				'display_availability' => 0,
				'display_variant' => 0,
				'display_new' => 1,
				'display_sale' => 1,

				'duration' => 0,
				'interval' => 0,
				'effect' => 'fadeIn',
				'center' => 0,
				'nav' => 0,
				'loop' => 0,
				'margin' => 0,
				'slideBy' => 1,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'startPosition' => 0,
				'mouseDrag' => 0,
				'touchDrag' => 0
				
			),
			array(
				'id_spsupercategory' => 2,
				'active' => 1,
				'moduleclass_sfx' => 'sp_super_category_2',
				'display_title_module' => 0,
				'title_module' => 'Electronic',
				'hook' => Hook::getIdByName('displaySuperCategory2'),
				'nb__column1' => 7,
				'nb__column2' => 5,
				'nb__column3' => 3,
				'nb__column4' => 1,
				'nb_column1' => 5,
				'nb_column2' => 3,
				'nb_column3' => 2,
				'nb_column4' => 1,
				'target' => '_self',
				'show_loadmore_slider' => 'slider',

				'catids' => 'all',
				'field_select' => 'name',
				'field_preload' => 'name',
				'cat_count_number' => 12,
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				'count_number' => 10,

				'cat_image_size' => $this->_getImageSize('category_default'),
				'cat_name_maxlength' => 25,
				'cat_sub_name_display' => 1,
				'cat_sub_name_maxlength' => 50,
				'cat_field_ordering' => 'rand',
				'cat_field_direction' => 'ASC',

				'image_size' => $this->_getImageSize('home_default'),
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				//'display_wishlist' => 0,
				//'display_compare' => 0,
				'display_addtocart' => 1,
				'display_quickview' => 1,
				'display_availability' => 0,
				'display_variant' => 0,
				'display_new' => 1,
				'display_sale' => 1,

				'duration' => 0,
				'interval' => 0,
				'effect' => 'fadeIn',
				'center' => 0,
				'nav' => 0,
				'loop' => 0,
				'margin' => 0,
				'slideBy' => 1,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'startPosition' => 0,
				'mouseDrag' => 0,
				'touchDrag' => 0
				
			),
			array(
				'id_spsupercategory' => 3,
				'active' => 1,
				'moduleclass_sfx' => 'sp_super_category_3',
				'display_title_module' => 0,
				'title_module' => 'Sport',
				'hook' => Hook::getIdByName('displaySuperCategory3'),
				'nb__column1' => 7,
				'nb__column2' => 5,
				'nb__column3' => 3,
				'nb__column4' => 1,
				'nb_column1' => 5,
				'nb_column2' => 3,
				'nb_column3' => 2,
				'nb_column4' => 1,
				'target' => '_self',
				'show_loadmore_slider' => 'slider',

				'catids' => 'all',
				'field_select' => 'name',
				'field_preload' => 'name',
				'cat_count_number' => 12,
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				'count_number' => 10,

				'cat_image_size' => $this->_getImageSize('category_default'),
				'cat_name_maxlength' => 25,
				'cat_sub_name_display' => 1,
				'cat_sub_name_maxlength' => 50,
				'cat_field_ordering' => 'rand',
				'cat_field_direction' => 'ASC',

				'image_size' => $this->_getImageSize('home_default'),
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				//'display_wishlist' => 0,
				//'display_compare' => 0,
				'display_addtocart' => 1,
				'display_quickview' => 1,
				'display_availability' => 0,
				'display_variant' => 0,
				'display_new' => 1,
				'display_sale' => 1,

				'duration' => 0,
				'interval' => 0,
				'effect' => 'fadeIn',
				'center' => 0,
				'nav' => 0,
				'loop' => 0,
				'margin' => 0,
				'slideBy' => 1,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'startPosition' => 0,
				'mouseDrag' => 0,
				'touchDrag' => 0
				
			),
			array(
				'id_spsupercategory' => 4,
				'active' => 1,
				'moduleclass_sfx' => 'sp_super_category_4',
				'display_title_module' => 0,
				'title_module' => 'Skirts',
				'hook' => Hook::getIdByName('displaySuperCategory4'),
				'nb__column1' => 6,
				'nb__column2' => 5,
				'nb__column3' => 3,
				'nb__column4' => 1,
				'nb_column1' => 3,
				'nb_column2' => 2,
				'nb_column3' => 2,
				'nb_column4' => 1,
				'target' => '_self',
				'show_loadmore_slider' => 'loadmore',

				'catids' => 'all',
				'field_select' => 'price',
				'field_preload' => 'price',
				'cat_count_number' => 3,
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				'count_number' => 4,

				'cat_image_size' => $this->_getImageSize('category_default'),
				'cat_name_maxlength' => 25,
				'cat_sub_name_display' => 1,
				'cat_sub_name_maxlength' => 50,
				'cat_field_ordering' => 'ID',
				'cat_field_direction' => 'ASC',

				'image_size' => $this->_getImageSize('home_default'),
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				//'display_wishlist' => 0,
				//'display_compare' => 0,
				'display_addtocart' => 1,
				'display_quickview' => 0,
				'display_availability' => 0,
				'display_variant' => 0,
				'display_new' => 0,
				'display_sale' => 0,

				'duration' => 0,
				'interval' => 0,
				'effect' => 'fadeIn',
				'center' => 0,
				'nav' => 0,
				'loop' => 0,
				'margin' => 0,
				'slideBy' => 0,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'startPosition' => 0,
				'mouseDrag' => 0,
				'touchDrag' => 0
				
			),
			array(
				'id_spsupercategory' => 5,
				'active' => 1,
				'moduleclass_sfx' => 'sp_super_category_5',
				'display_title_module' => 0,
				'title_module' => 'Jewelry',
				'hook' => Hook::getIdByName('displaySuperCategory5'),
				'nb__column1' => 6,
				'nb__column2' => 5,
				'nb__column3' => 3,
				'nb__column4' => 1,
				'nb_column1' => 3,
				'nb_column2' => 2,
				'nb_column3' => 2,
				'nb_column4' => 1,
				'target' => '_self',
				'show_loadmore_slider' => 'loadmore',

				'catids' => 'all',
				'field_select' => 'price',
				'field_preload' => 'price',
				'cat_count_number' => 3,
				'products_ordering' => 'name',
				'ordering_direction' => 'ASC',
				'count_number' => 4,

				'cat_image_size' => $this->_getImageSize('category_default'),
				'cat_name_maxlength' => 25,
				'cat_sub_name_display' => 1,
				'cat_sub_name_maxlength' => 50,
				'cat_field_ordering' => 'ID',
				'cat_field_direction' => 'ASC',

				'image_size' => $this->_getImageSize('home_default'),
				'display_name' => 1,
				'name_maxlength' => 50,
				'display_description' => 0,
				'description_maxlength' => 50,
				'display_price' => 1,
				//'display_wishlist' => 0,
				//'display_compare' => 0,
				'display_addtocart' => 1,
				'display_quickview' => 0,
				'display_availability' => 0,
				'display_variant' => 0,
				'display_new' => 0,
				'display_sale' => 0,

				'duration' => 0,
				'interval' => 0,
				'effect' => 'fadeIn',
				'center' => 0,
				'nav' => 0,
				'loop' => 0,
				'margin' => 0,
				'slideBy' => 0,
				'autoplay' => 0,
				'autoplayTimeout' => 1000,
				'autoplayHoverPause' => 1,
				'autoplaySpeed' => 1000,
				'navSpeed' => 1000,
				'startPosition' => 0,
				'mouseDrag' => 0,
				'touchDrag' => 0
				
			)
		);

		$return = true;
		foreach ($datas as $i => $data)
		{
			$spsupercategory = new SpSuperCategoryClass();
			$spsupercategory->hook = $data['hook'];
			$spsupercategory->active = $data['active'];
			$spsupercategory->ordering = $i;
			$spsupercategory->params = serialize($data);
			foreach (Language::getLanguages(false) as $lang)
				$spsupercategory->title_module[$lang['id_lang']] = $data['title_module'];

			$return &= $spsupercategory->add();
		}

		return $return;
	}

	public function getContent()
	{
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay') || Tools::isSubmit ('updateItemConfirmation'))
		{
			if ($this->postValidation())
			{
				if (Tools::isSubmit ('updateItemConfirmation') || Tools::isSubmit ('saveItem'))
					$this->html .= $this->displayConfirmation ($this->l('Module successfully updated!'));
				$this->html .= $this->postProcess();
				$this->html .= $this->initForm();
			}
			else
				$this->html .= $this->initForm();
		}
		elseif (Tools::isSubmit ('addItem') || (Tools::isSubmit('editItem')
				&& $this->moduleExists((int)Tools::getValue('id_spsupercategory'))) || Tools::isSubmit ('saveItem'))
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
				$associated_shop_ids = SpSuperCategoryClass::getAssociatedIdsShop((int)Tools::getValue('id_spsupercategory'));
				$context_shop_id = (int)Shop::getContextShopID();
				if ($associated_shop_ids === false)
					$this->html .= $this->getShopAssociationError((int)Tools::getValue('id_spsupercategory'));
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
	{
		$errors = array();
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (!Validate::isInt(Tools::getValue('active')) || (Tools::getValue('active') != 0
					&& Tools::getValue('active') != 1))
				$errors[] = $this->l('Invalid module state.');
			if (!Validate::isInt(Tools::getValue('position')) || (Tools::getValue('position') < 0))
				$errors[] = $this->l('Invalid module position.');

			if (!Validate::isInt(Tools::getValue('count_number')) || floor (Tools::getValue('count_number')) < 0)
				$errors[] = $this->l('Invalid Count Number.');

			if (Tools::isSubmit('id_spsupercategory'))
			{
				if (!Validate::isInt(Tools::getValue('id_spsupercategory'))
					&& !$this->moduleExists(Tools::getValue('id_spsupercategory')))
					$errors[] = $this->l('Invalid module ID');
			}
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('title_module_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
			}
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('title_module_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title module is not set.');
			if (Tools::strlen(Tools::getValue('moduleclass_sfx')) > 255)
				$errors[] = $this->l('The Module Class Suffix  is too long.');

			if (!is_numeric (Tools::getValue('count_number')) || floor (Tools::getValue('count_number')) < 0)
				$errors[] = $this->l('Invalid Count Number.');

			if (!is_numeric (Tools::getValue('interval')) || floor (Tools::getValue('interval')) < 0)
				$errors[] = $this->l('Invalid Interval');

			if (!is_numeric (Tools::getValue('duration')) || floor (Tools::getValue('duration')) < 0)
				$errors[] = $this->l('Invalid Speed');

			if (!is_numeric (Tools::getValue('margin')) || floor (Tools::getValue('margin')) < 0)
				$errors[] = $this->l('Invalid Margin');

			if (!is_numeric (Tools::getValue('slideBy')) || floor (Tools::getValue('slideBy')) < 0)
				$errors[] = $this->l('Invalid SlideBy');

			if (!is_numeric (Tools::getValue('autoplayTimeout')) || floor (Tools::getValue('autoplayTimeout')) < 0)
				$errors[] = $this->l('Invalid Autoplay Timeout');

			if (!is_numeric (Tools::getValue('autoplaySpeed')) || floor (Tools::getValue('autoplaySpeed')) < 0)
				$errors[] = $this->l('Invalid Autoplay Speed');

			if (!is_numeric (Tools::getValue('navSpeed')) || floor (Tools::getValue('navSpeed')) < 0)
				$errors[] = $this->l('Invalid Autoplay Speed');

			if (!is_numeric (Tools::getValue('startPosition')) || floor (Tools::getValue('startPosition')) < 0)
				$errors[] = $this->l('Invalid Start Poisition');
		}
		elseif (Tools::isSubmit('id_spsupercategory') && (!Validate::isInt(Tools::getValue('id_spsupercategory'))
				|| !$this->moduleExists((int)Tools::getValue('id_spsupercategory'))))
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
			if (Tools::getValue('id_spsupercategory'))
			{
				$supercategory = new SpSuperCategoryClass((int)Tools::getValue ('id_spsupercategory'));
				if (!Validate::isLoadedObject($supercategory))
				{
					$this->html .= $this->displayError($this->l('Invalid slide ID'));
					return false;
				}
			}
			else
				$supercategory = new SpSuperCategoryClass();
			$supercategory = new SpSuperCategoryClass(Tools::getValue ('id_spsupercategory'));
			$next_ps = $this->getNextPosition();
			$supercategory->ordering = (!empty($supercategory->ordering)) ? (int)$supercategory->ordering : $next_ps;
			$supercategory->active = (Tools::getValue('active')) ? (int)Tools::getValue('active') : 0;
			$supercategory->hook	= (int)Tools::getValue('hook');

			$tmp_data = array();
			$id_spsupercategory = (int)Tools::getValue ('id_spsupercategory');
			$id_spsupercategory = $id_spsupercategory ? $id_spsupercategory : $supercategory->getHigherModuleID();
			$tmp_data['id_spsupercategory'] = $id_spsupercategory;
			$tmp_data['moduleclass_sfx'] = (string)Tools::getValue ('moduleclass_sfx');
			$tmp_data['display_title_module'] = (int)Tools::getValue ('display_title_module');
			$tmp_data['active'] = (int)Tools::getValue ('active');
			$tmp_data['hook'] = (int)Tools::getValue ('hook');
			for ($i = 1; $i < 5; $i ++)
				$tmp_data['nb__column'.$i] = (int)Tools::getValue ('nb__column'.$i);
			for ($i = 1; $i < 5; $i ++)
				$tmp_data['nb_column'.$i] = (int)Tools::getValue ('nb_column'.$i);
			$tmp_data['target'] = (string)Tools::getValue ('target');
			$tmp_data['show_loadmore_slider'] = (string)Tools::getValue ('show_loadmore_slider');
			//source option
			$catids = (int)Tools::getValue ('catids');
			$tmp_data['catids'] = $catids;
			$tmp_data['cat_count_number'] = (int)Tools::getValue ('cat_count_number');
			$field_select = Tools::getValue ('field_select');
			$field_select = ( is_array($field_select) && !empty( $field_select ) )?implode (',', $field_select):false;
			$tmp_data['field_select'] = $field_select;
			$tmp_data['field_preload'] = (string)Tools::getValue ('field_preload');
			$tmp_data['ordering_direction'] = (string)Tools::getValue ('ordering_direction');
			$tmp_data['count_number'] = (string)Tools::getValue ('count_number');
			//tab options
			$tmp_data['cat_image_size'] = (string)Tools::getValue ('cat_image_size');
			$tmp_data['cat_name_maxlength'] = (int)Tools::getValue ('cat_name_maxlength');
			$tmp_data['cat_sub_name_display'] = (int)Tools::getValue ('cat_sub_name_display');
			$tmp_data['cat_sub_name_maxlength'] = (int)Tools::getValue ('cat_sub_name_maxlength');
			$tmp_data['cat_field_ordering'] = (string)Tools::getValue ('cat_field_ordering');
			$tmp_data['cat_field_direction'] = (string)Tools::getValue ('cat_field_direction');
			//product options
			$tmp_data['image_size'] = (string)Tools::getValue ('image_size');
			$tmp_data['display_name'] = (int)Tools::getValue ('display_name');
			$tmp_data['name_maxlength'] = (int)Tools::getValue ('name_maxlength');
			$tmp_data['display_description'] = (int)Tools::getValue ('display_description');
			$tmp_data['description_maxlength'] = (int)Tools::getValue ('description_maxlength');
			$tmp_data['display_price'] = (int)Tools::getValue ('display_price');
			$tmp_data['display_wishlist'] = (int)Tools::getValue ('display_wishlist');
			$tmp_data['display_compare'] = (int)Tools::getValue ('display_compare');
			$tmp_data['display_addtocart'] = (int)Tools::getValue ('display_addtocart');
			$tmp_data['display_quickview'] = (int)Tools::getValue ('display_quickview');
			$tmp_data['display_availability'] = (int)Tools::getValue ('display_availability');
			$tmp_data['display_variant'] = (int)Tools::getValue ('display_variant');
			$tmp_data['display_new'] = (int)Tools::getValue ('display_new', 1);
			$tmp_data['display_sale'] = (int)Tools::getValue ('display_sale', 1);
			//effect options
			$tmp_data['duration'] = (int)Tools::getValue ('duration');
			$tmp_data['interval'] = (int)Tools::getValue ('interval');
			$tmp_data['effect'] = Tools::getValue ('effect');
			$tmp_data['center'] = Tools::getValue ('center', 0);
			$tmp_data['nav'] = (int)Tools::getValue ('nav');
			$tmp_data['loop'] = (int)Tools::getValue ('loop');
			$tmp_data['margin'] = (int)Tools::getValue ('margin');
			$tmp_data['slideBy'] = (int)Tools::getValue ('slideBy');
			$tmp_data['autoplay'] = (int)Tools::getValue ('autoplay');
			$tmp_data['autoplayTimeout'] = (int)Tools::getValue ('autoplayTimeout');
			$tmp_data['autoplayHoverPause'] = (int)Tools::getValue ('autoplayHoverPause');
			$tmp_data['autoplaySpeed'] = (int)Tools::getValue ('autoplaySpeed');
			$tmp_data['navSpeed'] = (int)Tools::getValue ('navSpeed');
			$tmp_data['startPosition'] = (int)Tools::getValue ('startPosition');
			$tmp_data['mouseDrag'] = (int)Tools::getValue ('mouseDrag');
			$tmp_data['touchDrag'] = (int)Tools::getValue ('touchDrag');

			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
				$supercategory->title_module[$language['id_lang']] = Tools::getValue('title_module_'.$language['id_lang']);
			$supercategory->params = serialize($tmp_data);
			$get_id = Tools::getValue ('id_spsupercategory');
			($get_id && $this->moduleExists($get_id) )? $supercategory->update() : $supercategory->add ();
			$this->clearCacheItemForHook ();
			if (Tools::isSubmit ('saveAndStay'))
			{
				$id_spsupercategory = Tools::getValue ('id_spsupercategory')?
					(int)Tools::getValue ('id_spsupercategory'):(int)$supercategory->getHigherModuleID ();

				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spsupercategory='
					.$id_spsupercategory.'&updateItemConfirmation');
			}
			else
				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&saveItemConfirmation');
		}
		elseif (Tools::isSubmit ('changeStatusItem') && (int)Tools::getValue ('id_spsupercategory'))
		{
			$supercategory = new SpSuperCategoryClass((int)Tools::getValue ('id_spsupercategory'));
			if ($supercategory->active == 0)
				$supercategory->active = 1;
			else
				$supercategory->active = 0;
			$supercategory->update();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name
				.'&token='.Tools::getAdminTokenLite ('AdminModules'));
		}
		elseif (Tools::isSubmit ('deleteItem') && (int)Tools::getValue ('id_spsupercategory'))
		{
			$supercategory = new SpSuperCategoryClass(Tools::getValue ('id_spsupercategory'));
			$supercategory->delete ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
				.'&deleteItemConfirmation');
		}
		elseif (Tools::isSubmit ('duplicateItem') && (int)Tools::getValue ('id_spsupercategory'))
		{
			$supercategory = new SpSuperCategoryClass(Tools::getValue ('id_spsupercategory'));
			foreach (Language::getLanguages (false) as $lang)
				$supercategory->title_module[(int)$lang['id_lang']] = $supercategory->title_module[(int)$lang['id_lang']].$this->l(' (Copy)');
			$supercategory->duplicate ();
			$this->clearCacheItemForHook ();
			Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
				.'&duplicateItemConfirmation');
		}
		elseif (Tools::isSubmit ('saveItemConfirmation'))
			$this->html = $this->displayConfirmation ($this->l('Module created successfully!'));
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

	public function moduleExists($id_module)
	{
		$req = 'SELECT cs.`id_spsupercategory`
				FROM `'._DB_PREFIX_.'spsupercategory` cs
				WHERE cs.`id_spsupercategory` = '.(int)$id_module;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
		return ($row);
	}
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(cs.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'spsupercategory` cs, `'._DB_PREFIX_.'spsupercategory_shop` css
			WHERE css.`id_spsupercategory` = cs.`id_spsupercategory`
			AND css.`id_shop` = '.(int)$this->context->shop->id
		);
		return (++$row['next_position']);
	}

	private function getGridItems()
	{
		$this->context = Context::getContext ();
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		if (!$result = Db::getInstance ()->ExecuteS ('
			SELECT b.`id_spsupercategory`, b.`hook`, b.`ordering`, bs.`active`, bl.`title_module`
			FROM `'._DB_PREFIX_.'spsupercategory` b
			LEFT JOIN `'._DB_PREFIX_.'spsupercategory_shop` bs ON (b.`id_spsupercategory` = bs.`id_spsupercategory`)
			LEFT JOIN `'._DB_PREFIX_.'spsupercategory_lang` bl ON (b.`id_spsupercategory` = bl.`id_spsupercategory`'
			.( $id_shop?'AND bs.`id_shop` = '.$id_shop:' ' ).')
			WHERE bl.`id_lang` = '.(int)$id_lang.( $id_shop?' AND bs.`id_shop` = '.$id_shop:' ' ).'
			ORDER BY b.`ordering`'))
			return false;
		return $result;
	}

	private function getHookTitle($id_hook, $name = false)
	{
		if (!$result = Db::getInstance ()->getRow ('
			SELECT `name`,`title` FROM `'._DB_PREFIX_.'hook` WHERE `id_hook` = '.( $id_hook )))
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
					$associated_shop_ids = SpSuperCategoryClass::getAssociatedIdsShop((int)$mod['id_spsupercategory']);
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
					<a class="list-toolbar-btn" href="'.$currentIndex
			.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
			.'&addItem"><span data-toggle="tooltip" class="label-tooltip" data-original-title="'
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
			foreach ($modules as $mod)
			{
				$this->html .= '
				<tr id="item_'.$mod['id_spsupercategory'].'" class=" '.( $irow ++ % 2?' ':'' ).'">
					<td class=" 	" onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spsupercategory='
					.$mod['id_spsupercategory'].'\'">'
					.$mod['id_spsupercategory'].'</td>
					<td class=" dragHandle"><div class="dragGroup"><div class="positions">'.$mod['ordering']
					.'</div></div></td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_spsupercategory='.$mod['id_spsupercategory'].'\'">'
					.$mod['title_module'].' '
					.($mod['is_shared'] ? '<span class="label color_field"
				style="background-color:#108510;color:white;margin-top:5px;">'.$this->l('Shared').'</span>' : '').'</td>
					<td class="  " onclick="document.location = \''.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules')
					.'&editItem&id_spsupercategory='.$mod['id_spsupercategory'].'\'">'
					.( Validate::isInt ($mod['hook'])?$this->getHookTitle ($mod['hook']):'' ).'</td>
					<td class="  "> <a href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&changeStatusItem&id_spsupercategory='
					.$mod['id_spsupercategory'].'&status='
					.$mod['active'].'&hook='.$mod['hook'].'">'
					.( $mod['active']?'<i class="icon-check"></i>':'<i class="icon-remove"></i>' ).'</a> </td>
					<td class="text-right">
						<div class="btn-group-action">
							<div class="btn-group pull-right">
								<a class="btn btn-default" href="'.$currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editItem&id_spsupercategory='
					.$mod['id_spsupercategory'].'">
									<i class="icon-pencil"></i> Edit
								</a>
								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
									<span class="caret"></span>&nbsp;
								</button>
								<ul class="dropdown-menu">
									<li>
									<a onclick="return confirm(\''.$this->l('Are you sure want duplicate this item?',
						__CLASS__, true, false).'\');"  title="'.$this->l('Duplicate').'" href="'
					.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&duplicateItem&id_spsupercategory='
					.$mod['id_spsupercategory'].'">
											<i class="icon-copy"></i> '.$this->l('Duplicate').'
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a title ="'.$this->l('Delete')
					.'" onclick="return confirm(\''.$this->l('Are you sure?',
						__CLASS__, true, false).'\');" href="'.$currentIndex.'&configure='.$this->name.'&token='
					.Tools::getAdminTokenLite ('AdminModules').'&deleteItem&id_spsupercategory='
					.$mod['id_spsupercategory'].'">
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

	protected function generateCategoriesOption($categories, $current = null, $id_selected = 1)
	{
		foreach ($categories as $category)
		{
			$this->categories[$category['id_category']] = str_repeat(' -|- ', $category['level_depth'] * 1)
				.Tools::stripslashes($category['name']);
			if (isset($category['children']) && !empty($category['children']))
			{
				$current = $category['id_category'];
				$this->generateCategoriesOption($category['children'], $current, $id_selected);
			}
		}
	}
	public function customGetNestedCategories($shop_id, $root_category = null, $id_lang = false, $active = true,
		$groups = null, $use_shop_restriction = true, $sql_filter = '', $sql_sort = '', $sql_limit = '')
	{
		if (isset($root_category) && !Validate::isInt($root_category))
			die(Tools::displayError());
		if (!Validate::isBool($active))
			die(Tools::displayError());
		if (isset($groups) && Group::isFeatureActive() && !is_array($groups))
			$groups = (array)$groups;
		$cache_id = 'Category::getNestedCategories_'.md5((int)$shop_id
				.(int)$root_category.(int)$id_lang.(int)$active.(int)$active
				.(isset($groups) && Group::isFeatureActive() ? implode('', $groups) : ''));
		if (!Cache::isStored($cache_id))
		{
			$result = Db::getInstance()->executeS('
				SELECT c.*, cl.*
				FROM `'._DB_PREFIX_.'category` c
				INNER JOIN `'._DB_PREFIX_.'category_shop` category_shop
				ON (category_shop.`id_category` = c.`id_category` AND category_shop.`id_shop` = "'.(int)$shop_id.'")
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
				ON (c.`id_category` = cl.`id_category` AND cl.`id_shop` = "'.(int)$shop_id.'")
				WHERE 1 '.$sql_filter.' '.($id_lang ? 'AND cl.`id_lang` = '.(int)$id_lang : '').'
				'.($active ? ' AND (c.`active` = 1 OR c.`is_root_category` = 1)' : '').'
			'.(isset($groups) && Group::isFeatureActive() ? ' AND cg.`id_group` IN ('.implode(',', $groups).')' : '').'
				'.(!$id_lang || (isset($groups) && Group::isFeatureActive()) ? ' GROUP BY c.`id_category`' : '').'
				'.($sql_sort != '' ? $sql_sort : ' ORDER BY c.`level_depth` ASC , c.`nleft` ASC').'
				'.($sql_sort == '' && $use_shop_restriction ? ', category_shop.`position` ASC' : '').'
				'.($sql_limit != '' ? $sql_limit : '')
			);

			$categories = array();
			$buff = array();
			foreach ($result as $row)
			{
				$current = &$buff[$row['id_category']];
				$current = $row;
				if ($row['id_parent'] == 0)
					$categories[$row['id_category']] = &$current;
				else
					$buff[$row['id_parent']]['children'][$row['id_category']] = &$current;
			}
			Cache::store($cache_id, $categories);
		}
		return Cache::retrieve($cache_id);
	}

	private function descFormHtml($text = null)
	{
		return array(
			'type'         => 'html',
			'name'         => 'description',
			'html_content' => '<div style="text-transform:uppercase;width:400px;color:#3586ae;
				padding:3px 5px; border-radius:2px;background-color:#edf7fb;">
					<i class="icon-question-sign"></i>  '.$text.'</div>',
		);
	}
	public function getCatSelect($default = false)
	{
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));
		$catopt = array();
		if (!empty( $this->categories ))
		{
			foreach ($this->categories as $key => $cat)
			{
				if ($cat !== 'Root')
				{
					if ($default)
						$catopt[] = $key;
					else
					{
						$tmp = array();
						if ($cat != '')
						{
							$tmp['id_option'] = $key;
							$tmp['name'] = $cat;
							$catopt[] = $tmp;
						}
					}
				}
			}
		}
		return $catopt;
	}

	public function initForm()
	{
		$image_cat_types = ImageType::getImagesTypes ('categories');
		$image_pro_types = ImageType::getImagesTypes ('products');
		array_push ($image_cat_types, array( 'name' => 'none' ));
		array_push ($image_pro_types, array( 'name' => 'none' ));
		$default_lang = (int)Configuration::get ('PS_LANG_DEFAULT');
		$shops_to_get = Shop::getContextListShopID();
		foreach ($shops_to_get as $shop_id)
			$this->generateCategoriesOption($this->customGetNestedCategories($shop_id, null, (int)$this->context->language->id, true));

		$catopt = $this->getCatSelect();
		$hooks = $this->getHookList ();
		$opt_column = array(
			array(
				'id_option' => 1,
				'name'      => 1
			),
			array(
				'id_option' => 2,
				'name'      => 2
			),
			array(
				'id_option' => 3,
				'name'      => 3
			),
			array(
				'id_option' => 4,
				'name'      => 4
			),
			array(
				'id_option' => 5,
				'name'      => 5
			),
			array(
				'id_option' => 6,
				'name'      => 6
			)
		);
		$opt_target = array(
			array(
				'id_option' => '_blank',
				'name'      => $this->l('New Window')
			),
			array(
				'id_option' => '_self',
				'name'      => $this->l('Same Window')
			),
			array(
				'id_option' => '_windowopen',
				'name'      => $this->l('Popup window')
			)
		);

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
					'class'    => 'fixed-width-xl'
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Title Module'),
					'name'   => 'display_title_module',
					'hint'   => $this->l('Allow show/hide title of module.'),
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
					'type'  => 'text',
					'label' => $this->l('Module Class Suffix'),
					'name'  => 'moduleclass_sfx',
					'hint'  => $this->l('A suffix to be applied to the CSS class of the module.
					This allows for individual module styling.'),
					'class' => 'fixed-width-xl'
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Hook into'),
					'name'    => 'hook',
					'options' => array(
						'query' => $hooks,
						'id'    => 'key',
						'name'  => 'name'
					)
				),
				$this->descFormHtml ('For Category'),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb__column1',
					'desc'    => $this->l('For devices have screen width from 1200px to greater.'),
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb__column2',
					'desc'    => $this->l('For devices have screen width from 768px up to 1199px.'),
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb__column3',
					'desc'    => $this->l('For devices have screen width from 480px up to 767px.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb__column4',
					'desc'    => $this->l('For devices have screen width less than or equal 479px.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),

				$this->descFormHtml ('For Products'),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb_column1',
					'desc'    => $this->l('For devices have screen width from 1200px to greater.'),
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb_column2',
					'desc'    => $this->l('For devices have screen width from 768px up to 1199px.'),
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb_column3',
					'desc'    => $this->l('For devices have screen width from 480px up to 767px.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('# Column'),
					'name'    => 'nb_column4',
					'desc'    => $this->l('For devices have screen width less than or equal 479px.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_column,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Open Link'),
					'name'    => 'target',
					'hint'    => $this->l('The Type shows when you click on the link.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => $opt_target,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'label'   => $this->l('Select Type Show For Module'),
					'name'    => 'show_loadmore_slider',
					'hint'    => $this->l('Select Type Show For Module is LoadMore or Slider.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'loadmore',
								'name'      => $this->l('Load More')
							),
							array(
								'id_option' => 'slider',
								'name'      => $this->l('Slider')
							)
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
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

		$this->fields_form[1]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Source Options '),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				$this->descFormHtml ('For Category'),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Category'),
					'name'    => 'catids',
					'class'   => 'fixed-width-xxl',
					'options' => array(
						'query' => $catopt,
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Count Category'),
					'name'  => 'cat_count_number',
					'hint'  => $this->l('Define the number of categories to be displayed in this block.'),
					'class' => 'fixed-width-xl'
				),
				$this->descFormHtml ('For Field Products'),
				array(
					'type'     => 'select',
					'lang'     => true,
					'label'    => $this->l('Product Field to Order By'),
					'name'     => 'field_select[]',
					'hint'     => $this->l('Choose the position for showing button.'),
					'class'    => 'fixed-width-xl',
					'height'   => '200px',
					'multiple' => 'multiple',
					'options'  => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_product',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'date_add',
								'name'      => $this->l('Date Add')
							),
							array(
								'id_option' => 'price',
								'name'      => $this->l('Price')
							),
							array(
								'id_option' => 'sales',
								'name'      => $this->l('Sales')
							)
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Field Preload'),
					'name'    => 'field_preload',
					'hint'    => $this->l('Product Field to Order By.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_product',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'date_add',
								'name'      => $this->l('Date Add')
							),
							array(
								'id_option' => 'price',
								'name'      => $this->l('Price')
							),
							array(
								'id_option' => 'sales',
								'name'      => $this->l('Sales')
							),

						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Ordering Direction'),
					'name'    => 'ordering_direction',
					'hint'    => $this->l('Select the direction you would like Products.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'DESC',
								'name'      => $this->l('Descending')
							),
							array(
								'id_option' => 'ASC',
								'name'      => $this->l('Ascending')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Count Product'),
					'name'  => 'count_number',
					'hint'  => $this->l('Define the number of products to be displayed in this block.'),
					'class' => 'fixed-width-xl'
				),

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

		$this->fields_form[2]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Categories Options'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'    => 'select',
					'label'   => $this->l('Size image (W x H)'),
					'name'    => 'cat_image_size',
					'options' => array(
						'query' => $image_cat_types,
						'id'    => 'name',
						'name'  => 'name'
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Sub Category Name'),
					'name'   => 'cat_sub_name_display',
					'hint'   => $this->l('Allow show/hide sub name of module.'),
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
					'type'  => 'text',
					'label' => $this->l('Category Name Maxlength'),
					'name'  => 'cat_name_maxlength',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('The max length of name can be show. Choose 0 for showing full name.For Category Parent and Sub Categories')
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Categories Order By'),
					'name'    => 'cat_field_ordering',
					'hint'    => $this->l('Categories Order By'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'name',
								'name'      => $this->l('Name')
							),
							array(
								'id_option' => 'id_category',
								'name'      => $this->l('ID')
							),
							array(
								'id_option' => 'rand',
								'name'      => $this->l('Random')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Categories Ordering Direction'),
					'name'    => 'cat_field_direction',
					'hint'    => $this->l('Select the direction you would like Categories to be ordered by.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'DESC',
								'name'      => $this->l('Descending')
							),
							array(
								'id_option' => 'ASC',
								'name'      => $this->l('Ascending')
							),
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
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

		$this->fields_form[3]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Product Options'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				array(
					'type'    => 'select',
					'label'   => $this->l('Size image (W x H)'),
					'name'    => 'image_size',
					'options' => array(
						'query' => $image_pro_types,
						'id'    => 'name',
						'name'  => 'name'
					)
				),
				array(
					'type'    => 'switch',
					'label'   => $this->l('Display Name'),
					'name'    => 'display_name',
					'hint'    => $this->l('Allow to show/hide name of product'),
					'is_bool' => true,
					'values'  => array(
						array(
							'id'    => 'avatar_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'avatar_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Name Maxlength'),
					'name'  => 'name_maxlength',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('The max length of title can be showed. Choose 0 for showing full title.')
				),
				array(
					'type'    => 'switch',
					'label'   => $this->l('Display Description'),
					'name'    => 'display_description',
					'hint'    => $this->l('Allow to show/hide description of product'),
					'is_bool' => true,
					'values'  => array(
						array(
							'id'    => 'avatar_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'avatar_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Description Maxlength'),
					'name'  => 'description_maxlength',
					'class' => 'fixed-width-xl',
					'hint'  => $this->l('The max length of description can be showed. Choose 0 for showing full description.')
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Price'),
					'name'   => 'display_price',
					'hint'   => $this->l('Allow to show/hide Price of product'),
					'values' => array(
						array(
							'id'    => 'price_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'price_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Add to Cart Button'),
					'name'   => 'display_addtocart',
					'hint'   => $this->l('Allow to show/hide button Addtocart of product'),
					'values' => array(
						array(
							'id'    => 'addcart_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'addcart_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				// array(
					// 'type'   => 'switch',
					// 'label'  => $this->l('Display Add to Wishlist Button'),
					// 'name'   => 'display_wishlist',
					// 'hint'   => $this->l('Allow to show/hide button Wishlist of product'),
					// 'values' => array(
						// array(
							// 'id'    => 'on',
							// 'value' => 1,
							// 'label' => $this->l('Enabled')
						// ),
						// array(
							// 'id'    => 'off',
							// 'value' => 0,
							// 'label' => $this->l('Disabled')
						// )
					// )
				// ),
				// array(
					// 'type'   => 'switch',
					// 'label'  => $this->l('Display Add to Compare Button'),
					// 'name'   => 'display_compare',
					// 'hint'   => $this->l('Allow to show/hide button Compare of product'),
					// 'values' => array(
						// array(
							// 'id'    => 'on',
							// 'value' => 1,
							// 'label' => $this->l('Enabled')
						// ),
						// array(
							// 'id'    => 'off',
							// 'value' => 0,
							// 'label' => $this->l('Disabled')
						// )
					// )
				// ),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display QuickView'),
					'name'   => 'display_quickview',
					'hint'   => $this->l('Allow to show/hide link for Detail'),
					'values' => array(
						array(
							'id'    => 'detail_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'detail_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Availability'),
					'name'   => 'display_availability',
					'hint'   => $this->l('Allow to show/hide Availability'),
					'values' => array(
						array(
							'id'    => 'availability_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'availability_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Variant'),
					'name'   => 'display_variant',
					'hint'   => $this->l('Allow to show/hide Variant'),
					'values' => array(
						array(
							'id'    => 'variant_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'variant_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),				
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display New'),
					'name'   => 'display_new',
					'hint'   => $this->l('Allow to show/hide image New'),
					'values' => array(
						array(
							'id'    => 'new_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'new_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Sale'),
					'name'   => 'display_sale',
					'hint'   => $this->l('Allow to show/hide image Sale'),
					'values' => array(
						array(
							'id'    => 'sale_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'sale_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
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

		$this->fields_form[4]['form'] = array(
			'legend'  => array(
				'title' => $this->l('Effect Options'),
				'icon'  => 'icon-cogs'
			),
			'input'   => array(
				$this->descFormHtml ('For Item Products'),
				array(
					'type'   => 'text',
					'label'  => $this->l('Speed'),
					'name'   => 'duration',
					'class'  => 'fixed-width-xl',
					'hint'   => $this->l('Speed of module. Larger = Slower.'),
					'suffix' => 'ms',
				),
				array(
					'type'   => 'text',
					'label'  => $this->l('Interval'),
					'name'   => 'interval',
					'class'  => 'fixed-width-xl',
					'hint'   => 'Speed of Timer. Larger = Slower.',
					'suffix' => 'ms',
				),
				$this->descFormHtml ('For Type Load More'),
				array(
					'type'    => 'select',
					'lang'    => true,
					'label'   => $this->l('Select Effect'),
					'name'    => 'effect',
					'hint'    => $this->l('Choose the effect for the module here.'),
					'class'   => 'fixed-width-xl',
					'options' => array(
						'query' => array(
							array(
								'id_option' => 'slideLeft',
								'name'      => $this->l('Slide Left')
							),
							array(
								'id_option' => 'slideRight',
								'name'      => $this->l('Slide Right')
							),
							array(
								'id_option' => 'zoomOut',
								'name'      => $this->l('Zoom Out')
							),
							array(
								'id_option' => 'zoomIn',
								'name'      => $this->l('Zoom In')
							),
							array(
								'id_option' => 'flip',
								'name'      => $this->l('Flip')
							),
							array(
								'id_option' => 'flipInX',
								'name'      => $this->l('Fip in Vertical')
							),
							array(
								'id_option' => 'flipInY',
								'name'      => $this->l('Flip in Horizontal')
							),
							array(
								'id_option' => 'starwars',
								'name'      => $this->l('Star Wars')
							),
							array(
								'id_option' => 'bounceIn',
								'name'      => $this->l('Bounce In')
							),
							array(
								'id_option' => 'fadeIn',
								'name'      => $this->l('Fade In')
							),
							array(
								'id_option' => 'pageTop',
								'name'      => $this->l('Page Top')
							)
						),
						'id'    => 'id_option',
						'name'  => 'name'
					)
				),
				$this->descFormHtml ('For Category Slider && For Item Products'),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Center'),
					'name'   => 'center',
					'hint'   => $this->l('Allow to show/hide class center for slider'),
					'values' => array(
						array(
							'id'    => 'center_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'center_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Navigation'),
					'name'   => 'nav',
					'hint'   => $this->l('Allow to show/hide navigation for slider'),
					'values' => array(
						array(
							'id'    => 'nav_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'nav_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Display Loop'),
					'name'   => 'loop',
					'hint'   => $this->l('Infinity loop. Duplicate last and first items to get loop illusion.'),
					'values' => array(
						array(
							'id'    => 'lop_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'lop_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Margin Right Subcategory'),
					'name'  => 'margin',
					'class' => 'fixed-width-xl',
					'hint'  => 'margin-right(px) on subcategory.',
				),
				array(
					'type'  => 'text',
					'label' => $this->l('SlideBy Subcategory'),
					'name'  => 'slideBy',
					'class' => 'fixed-width-xl',
					'hint'  => 'Navigation slide by x. page string can be set to slide by page.',
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Auto Play'),
					'name'   => 'autoplay',
					'hint'   => $this->l('Allow to on/off auto play for slider'),
					'values' => array(
						array(
							'id'    => 'lop_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'lop_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Auto Interval Timeout'),
					'name'  => 'autoplayTimeout',
					'class' => 'fixed-width-xl',
					'hint'  => 'Autoplay interval timeout for slider.',
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Pause On Hover'),
					'name'   => 'autoplayHoverPause',
					'hint'   => $this->l('Pause on mouse hover'),
					'values' => array(
						array(
							'id'    => 'pause_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'pause_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Auto Play Speed'),
					'name'  => 'autoplaySpeed',
					'class' => 'fixed-width-xl',
					'hint'  => 'Autoplay Speed.',
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Navigation Speed'),
					'name'  => 'navSpeed',
					'class' => 'fixed-width-xl',
					'hint'  => 'Autoplay Navigation Speed.',
				),
				array(
					'type'  => 'text',
					'label' => $this->l('Start Position Subcategory'),
					'name'  => 'startPosition',
					'class' => 'fixed-width-xl',
					'hint'  => 'Start position or URL Hash string like #id.',
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Mouse Drag'),
					'name'   => 'mouseDrag',
					'hint'   => $this->l('Mouse drag enabled'),
					'values' => array(
						array(
							'id'    => 'mouse_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'mouse_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
				array(
					'type'   => 'switch',
					'label'  => $this->l('Touch Drag'),
					'name'   => 'touchDrag',
					'hint'   => $this->l('Touch drag enabled'),
					'values' => array(
						array(
							'id'    => 'touch_on',
							'value' => 1,
							'label' => $this->l('Enabled')
						),
						array(
							'id'    => 'touch_off',
							'value' => 0,
							'label' => $this->l('Disabled')
						)
					)
				),
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
		$helper->name_controller = 'spsupercategory';
		$helper->identifier = $this->identifier;
		$helper->token = Tools::getAdminTokenLite ('AdminModules');
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules');
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
			'save'          => array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
			),
			'back'          => array(
				'href' => AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules'),
				'desc' => $this->l('Back to list')
			),
			'save-and-stay' => array(
				'title' => $this->l('Save then add another value'),
				'name'  => 'submitAdd'.$this->table.'AndStay',
				'type'  => 'submit',
				'class' => 'btn btn-default pull-right',
				'icon'  => 'process-icon-save'
			)
		);

		$id_spsupercategory = Tools::getValue ('id_spsupercategory');
		if (Tools::isSubmit ('id_spsupercategory') && $id_spsupercategory)
		{
			$supercategory = new SpSuperCategoryClass((int)$id_spsupercategory);
			$this->fields_form[0]['form']['input'][] = array(
				'type' => 'hidden',
				'name' => 'id_spsupercategory'
			);
			$params = unserialize($supercategory->params);
			$helper->fields_value['id_spsupercategory'] = (int)Tools::getValue ('id_spsupercategory',
				$supercategory->id_spsupercategory);
		}
		else
		{
			$supercategory = new SpSuperCategoryClass();
			$params = array();
		}
		foreach (Language::getLanguages (false) as $lang)
		{
			$helper->fields_value['title_module'][(int)$lang['id_lang']] = Tools::getValue ('title_module_'.$lang['id_lang'],
				$supercategory->title_module[(int)$lang['id_lang']]);
		}

		$helper->fields_value['display_title_module'] = Tools::getValue ('display_title_module',
			isset( $params['display_title_module'] )?$params['display_title_module']:1);
		$moduleclass_sfx = isset( $params['moduleclass_sfx'] ) ? $params['moduleclass_sfx']:'';
		$helper->fields_value['moduleclass_sfx'] = Tools::getValue('moduleclass_sfx', $moduleclass_sfx);
		$helper->fields_value['hook'] = Tools::getValue ('hook', $supercategory->hook);
		$helper->fields_value['active'] = Tools::getValue ('active', $supercategory->active);
		$helper->fields_value['nb__column1'] = (int)Tools::getValue('nb__column1', isset( $params['nb__column1'] )?$params['nb__column1']:4);
		$helper->fields_value['nb__column2'] = (int)Tools::getValue('nb__column2', isset( $params['nb__column2'] )?$params['nb__column2']:3);
		$helper->fields_value['nb__column3'] = (int)Tools::getValue ('nb__column3', isset( $params['nb__column3'] )?$params['nb__column3']:2);
		$helper->fields_value['nb__column4'] = (int)Tools::getValue('nb__column4', isset( $params['nb__column4'] )?$params['nb__column4']:1);
		$helper->fields_value['nb_column1'] = (int)Tools::getValue ('nb_column1', isset( $params['nb_column1'] )?$params['nb_column1']:4);
		$helper->fields_value['nb_column2'] = (int)Tools::getValue ('nb_column2', isset( $params['nb_column2'] )?$params['nb_column2']:3);
		$helper->fields_value['nb_column3'] = (int)Tools::getValue ('nb_column3', isset( $params['nb_column3'] )?$params['nb_column3']:2);
		$helper->fields_value['nb_column4'] = (int)Tools::getValue ('nb_column4', isset( $params['nb_column4'] )?$params['nb_column4']:1);
		$helper->fields_value['target'] = (string)Tools::getValue ('target', isset( $params['target'] )?$params['target']:'_self');
		$helper->fields_value['show_loadmore_slider'] = (string)Tools::getValue ('show_loadmore_slider',
			isset( $params['show_loadmore_slider'] )?$params['show_loadmore_slider']:'loadmore');

		if ($this->getCatSelect(true) != null && isset($params['catids']))
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 1);
			else
				$catids = $params['catids'];
		}
		else
			$catids = false;
		$helper->fields_value['catids'] = Tools::getValue ('catids', $catids);
		$helper->fields_value['cat_count_number'] = Tools::getValue ('cat_count_number',
			isset( $params['cat_count_number'] ) ? $params['cat_count_number']:8);

		if ($this->getFieldSelect() != null && isset($params['field_select']))
		{
			if ($params['field_select'] == 'all')
				$field_select = $this->getFieldSelect();
			else
				$field_select = $params['field_select'];
		}
		else
			$field_select = false;
		if (!is_array($field_select))
			$field_select = explode(',', $field_select);
		$helper->fields_value['field_select[]'] = Tools::getValue ('field_select', $field_select);
		$helper->fields_value['field_preload'] = Tools::getValue ('field_preload',
			isset( $params['field_preload'] )?$params['field_preload']:false);
		$helper->fields_value['ordering_direction'] = Tools::getValue ('ordering_direction',
			( isset($params['ordering_direction'])) ? $params['ordering_direction']:'DESC');
		$helper->fields_value['count_number'] = Tools::getValue('count_number',
			isset($params['count_number']) ? $params['count_number']:8);
		// categories options
		$helper->fields_value['cat_image_size'] = Tools::getValue ('cat_image_size',
			isset( $params['cat_image_size'] ) ? $params['cat_image_size'] :'');
		$helper->fields_value['cat_name_maxlength'] = Tools::getValue ('cat_name_maxlength',
			isset( $params['cat_name_maxlength']) ? $params['cat_name_maxlength']:25);
		$helper->fields_value['cat_sub_name_display'] = Tools::getValue ('cat_sub_name_display',
			isset( $params['cat_sub_name_display']) ? $params['cat_sub_name_display']:1);
		$helper->fields_value['cat_sub_name_maxlength'] = Tools::getValue ('cat_sub_name_maxlength',
			isset( $params['cat_sub_name_maxlength']) ? $params['cat_sub_name_maxlength']:25);
		$helper->fields_value['cat_field_ordering'] = Tools::getValue ('cat_field_ordering',
			isset( $params['cat_field_ordering']) ? $params['cat_field_ordering']:false);
		$helper->fields_value['cat_field_direction'] = Tools::getValue ('cat_field_direction',
			isset( $params['cat_field_direction']) ? $params['cat_field_direction']:false);
		// product options
		$helper->fields_value['image_size'] = Tools::getValue ('image_size',
			( isset( $params['image_size'] ) ) ? $params['image_size'] :'');
		$helper->fields_value['display_name'] = Tools::getValue ('display_name',
			isset( $params['display_name'] )?$params['display_name']:1);
		$helper->fields_value['name_maxlength'] = Tools::getValue ('name_maxlength',
			isset( $params['name_maxlength'] )?$params['name_maxlength']:25);
		$helper->fields_value['display_description'] = Tools::getValue ('display_description',
			isset( $params['display_description'] )?$params['display_description']:0);
		$helper->fields_value['description_maxlength'] = Tools::getValue ('description_maxlength',
			isset( $params['description_maxlength'] )?$params['description_maxlength']:100);
		$helper->fields_value['display_price'] = Tools::getValue ('display_price',
			isset( $params['display_price'] )?$params['display_price']:1);
		$helper->fields_value['display_addtocart'] = Tools::getValue ('display_addtocart',
			isset( $params['display_addtocart'] )?$params['display_addtocart']:1);
		$helper->fields_value['display_wishlist'] = Tools::getValue ('display_wishlist',
			isset( $params['display_wishlist'] )?$params['display_wishlist']:0);
		$helper->fields_value['display_compare'] = (int)Tools::getValue ('display_compare',
			isset( $params['display_compare'] )?$params['display_compare']:0);
		$helper->fields_value['display_quickview'] = (int)Tools::getValue ('display_quickview',
			isset( $params['display_quickview'] )?$params['display_quickview']:1);
		$helper->fields_value['display_availability'] = (int)Tools::getValue ('display_availability',
			isset( $params['display_availability'] )?$params['display_availability']:1);
		$helper->fields_value['display_variant'] = (int)Tools::getValue ('display_variant',
			isset( $params['display_variant'] )?$params['display_variant']:1);			
		$helper->fields_value['display_sale'] = (int)Tools::getValue ('display_sale', isset( $params['display_sale'] )?$params['display_sale']:1);
		$helper->fields_value['display_new'] = (int)Tools::getValue ('display_new', isset( $params['display_new'] )?$params['display_new']:1);
		// effect options
		$helper->fields_value['duration'] = (int)Tools::getValue ('duration', isset( $params['duration'] )?$params['duration']:500);
		$helper->fields_value['interval'] = (int)Tools::getValue ('interval', isset( $params['interval'] )?$params['interval']:1500);
		$helper->fields_value['effect'] = Tools::getValue ('effect', isset( $params['effect'] )?$params['effect']:'flip');
		$helper->fields_value['center'] = (int)Tools::getValue ('center', isset( $params['center'] )?$params['center']:0);
		$helper->fields_value['nav'] = (int)Tools::getValue ('nav', isset( $params['nav'] )?$params['nav']:1);
		$helper->fields_value['loop'] = (int)Tools::getValue ('loop', isset( $params['loop'] )?$params['loop']:1);
		$helper->fields_value['margin'] = (int)Tools::getValue ('margin',
			isset( $params['margin'] )?$params['margin']:5);
		$helper->fields_value['slideBy'] = (int)Tools::getValue ('slideBy',
			isset( $params['slideBy'] )?$params['slideBy']:1);
		$helper->fields_value['autoplay'] = (int)Tools::getValue ('autoplay', isset( $params['autoplay'] )?$params['autoplay']:1);
		$helper->fields_value['autoplayTimeout'] = (int)Tools::getValue ('autoplayTimeout',
			isset( $params['autoplayTimeout'] )?$params['autoplayTimeout']:1000);
		$helper->fields_value['autoplayHoverPause'] = (int)Tools::getValue ('autoplayHoverPause',
			isset( $params['autoplayHoverPause'] )?$params['autoplayHoverPause']:1);
		$helper->fields_value['autoplaySpeed'] = (int)Tools::getValue ('autoplaySpeed',
			isset( $params['autoplaySpeed'] )?$params['autoplaySpeed']:1500);
		$helper->fields_value['navSpeed'] = (int)Tools::getValue ('navSpeed', isset( $params['navSpeed'] )?$params['navSpeed']:1500);
		//$helper->fields_value['smartSpeed'] = (int)Tools::getValue ('smartSpeed', isset( $params['smartSpeed'] )?$params['smartSpeed']:1500);
		$helper->fields_value['startPosition'] = (int)Tools::getValue ('startPosition', isset( $params['startPosition'] )?$params['startPosition']:0);
		$helper->fields_value['mouseDrag'] = (int)Tools::getValue ('mouseDrag', isset( $params['mouseDrag'] )?$params['mouseDrag']:1);
		$helper->fields_value['touchDrag'] = (int)Tools::getValue ('touchDrag', isset( $params['touchDrag'] )?$params['touchDrag']:1);
		$helper->fields_value['pullDrag'] = (int)Tools::getValue ('pullDrag', isset( $params['pullDrag'] )?$params['pullDrag']:1);
		$this->html .= $helper->generateForm ($this->fields_form);
	}

	private function getFieldSelect()
	{
		$value = array(
			0 => 'name',
			1 => 'id_product',
			2 => 'date_add',
			3 => 'price',
			4 => 'sales',

		);
		$id_spsupercategory = Tools::getValue ('id_spsupercategory');
		if (Tools::isSubmit ('id_spsupercategory') && $id_spsupercategory)
		{
			$supercategory = new SpSuperCategoryClass((int)$id_spsupercategory);
			$params = unserialize($supercategory->params);
		}
		else
		{
			$supercategory = new SpSuperCategoryClass();
			$params = array();
		}

		if (isset($params) && !empty($params))
		{
			if ($params['field_select'] == 'all')
				$field_select = array_slice($value, 0, 3);
			else
				$field_select = $params['field_select'];
			$field_select = (!empty($field_select) && is_string($field_select)) ? explode(',', $field_select) : $field_select;
			$field_select = Tools::getValue ('field_select', $field_select);
		}
		else
			$field_select = array_slice($value, 0, 3);
		return $field_select;
	}

	private function getFormValuesCat()
	{
		$id_spsupercategory = Tools::getValue ('id_spsupercategory');
		if (Tools::isSubmit ('id_spsupercategory') && $id_spsupercategory)
		{
			$supercategory = new SpSuperCategoryClass((int)$id_spsupercategory);
			$params = unserialize($supercategory->params);
		}
		else
		{
			$supercategory = new SpSuperCategoryClass();
			$params = array();
		}
		if ($this->getCatSelect(true) != null && isset($params['catids']) && $params['catids'])
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 5);
			else
				$catids = $params['catids'];
			$catids = (!empty($catids) && is_string($catids)) ? explode(',', $catids) : $catids;
			$catids = Tools::getValue ('catids', $catids);
		}
		else
			$catids = array();
		return $catids;
	}

	public function getCategoriesInfor($catids, $params)
	{
		!is_array ($catids) && settype ($catids, 'array');
		if (empty( $catids ))
			return;
		$context = Context::getContext ();
		$id_lang = (int)$context->language->id;
		$cat_root = '';
		foreach ($catids as $cat)
		{
			$category = new Category($cat);
			if ($category->isRootCategoryForAShop())
			{
				$cat_root .= $cat;
				break;
			}
		}
		$categories = Category::getCategoryInformations ($catids, $id_lang);
		if (empty( $categories ))
			return;
		$list = array();
		foreach ($categories as $category)
		{
			$category_image_url = $this->context->link->getCatImageLink (
				$category['link_rewrite'],
				$category['id_category']
			);
			$category['image'] = $category_image_url;
			$category['count'] = $this->countProduct ($category['id_category'], $params);
			$category['link'] = $this->context->link->getCategoryLink ($category['id_category'], $category['link_rewrite']);
			$category['_target'] = $this->parseTarget ($params['target']);
			$category['name'] = Tools::truncateString ($category['name'], $params['cat_name_maxlength']);				
			$list[] = $category;
		}

		$cat_order_by = $params['cat_field_ordering'];
		$cat_ordering = $params['cat_field_direction'];
		if ($cat_order_by != null)
		{
			switch ($cat_order_by)
			{
				default:
				case 'name':
					if ($cat_ordering == 'ASC')
						usort ($list, create_function ('$a, $b', 'return strnatcasecmp( $a["name"], $b["name"]);'));
					else
						usort ($list, create_function ('$a, $b', 'return strnatcasecmp( $b["name"], $a["name"]);'));
					break;
				case 'id_category':
					if ($cat_ordering == 'ASC')
						usort ($list, create_function ('$a, $b', 'return $a["id_category"] > $b["id_category"];'));
					else
						usort ($list, create_function ('$a, $b', 'return $a["id_category"] < $b["id_category"];'));
					break;
				case 'rand':
					shuffle ($list);
					break;
			}
		}

		return $list;
	}

	public function getProductInfor($params, $catids, $count_product = false, $product_filter = null)
	{
		if ($catids == '*')
			$catids = $this->getCatIds ($params);
		!is_array ($catids) && settype ($catids, 'array');
		
		$products = $this->getProducts ($catids, $params, $count_product, $product_filter);
		if (empty( $products ))
			return;
		
		$list = array();
			
		$assembler = new ProductAssembler($this->context);
		
		$presenterFactory = new ProductPresenterFactory($this->context);
		$presentationSettings = $presenterFactory->getPresentationSettings();
		$presenter = new ProductListingPresenter(
			new ImageRetriever(
				$this->context->link
			),
			$this->context->link,
			new PriceFormatter(),
			new ProductColorsRetriever(),
			$this->context->getTranslator()
		);
	
		$list = [];
		
		foreach ($products as $product)
		{
			$product['_target'] = $this->parseTarget ($params['target']);
			$product['title'] = Tools::truncateString ($product['name'], $params['name_maxlength']);
			$product['description'] = $this->trimEncode ($product['description']) != ''?$product['description']:$this->cleanText ($product['description_short']);
			$product['description'] = Tools::truncateString ($product['description'], $params['description_maxlength']);
			$list[] = $presenter->present(
				$presentationSettings,
				$assembler->assembleProduct($product),
				$this->context->language
			);	
		}
		
		return $list;
	}

	public function getCatIds($params)
	{
		$catids = ( isset( $params['catids'] ) && $params['catids'] != '' )?explode (',', $params['catids']):'';

		if ($catids == '')
			return;
		return $catids;
	}

	public function getList($params)
	{
		if ($this->getCatSelect(true) != null && isset($params['catids']))
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 5);
			else
				$catids = $this->getCatIds($params);
		}
		!is_array ($catids) && settype ($catids, 'array');
		if (empty( $catids ))
			return;

		$list = array();

		$level_depth = 999;
		$child_category_products = 'include';
		$child_cat = ( $child_category_products == 'include' )?$this->getChildenCategories ($catids, $level_depth, false, $params):'';
		if (!empty( $child_cat ))
			$list['category_tree'] = $this->getCategoriesInfor ($child_cat, $params);

		$list['_category_parent'] = $this->getCategoriesInfor ($catids, $params);
		if (empty( $list['_category_parent'] ))
			return;
		foreach ($list['_category_parent'] as $item)
		{
			$catids_parent = ( $child_category_products == 'include' )?$this->getChildenCategories ($item['id_category'], $level_depth,
				true, $params):$item['id_category'];
			!is_array ($catids_parent) && settype ($catids_parent, 'array');
			$item['cat_array'] = implode (',', $catids_parent);
			$list['category_parent'] = $item;
		}

		$orderby_preload = $params['field_preload'];
		if ($params['field_select'] == 'all')
			$orderby = $this->getFieldSelect();
		else
			$orderby = ( $params['field_select'] )?explode (',', $params['field_select']):$orderby_preload;
		!is_array ($orderby) && settype ($orderby, 'array');
		if (!in_array ($orderby_preload, $orderby))
			$orderby_preload = $orderby[0];
		$product_filter = array();
		foreach ($orderby as $order)
		{
			$product = array();
			$product['count'] = $this->countProduct ($catids, $params);
			$product['id'] = $order;
			$title_pro = $this->getLabel ($order);
			$product['title'] = $title_pro;
			array_push ($product_filter, $product);
		}

		$_list = array();
		foreach ($product_filter as $order)
		{
			if ($order['count'] > 0)
			{
				if ($order['id'] == $orderby_preload)
				{
					$order['sel'] = 'sel';
					$order['child'] = $this->getProductInfor ($params, $catids, false, $orderby_preload);
				}
				$_list[$order['id']] = $order;
			}
		}

		$list['tab'] = $_list;

		return $list;
	}
	
	public function getList2($params)
	{//ini_set('xdebug.var_display_max_depth', 10);
		if ($this->getCatSelect(true) != null && isset($params['catids']))
		{
			if ($params['catids'] == 'all')
				$catids = array_slice($this->getCatSelect(true), 0, 5);
			else
				$catids = $this->getCatIds($params);
		}
		!is_array ($catids) && settype ($catids, 'array');
		if (empty( $catids ))
			return;

		$list = array();

		$level_depth = 999;
		$child_category_products = 'include';
		$child_cat = ( $child_category_products == 'include' )?$this->getChildenCategories ($catids, $level_depth, false, $params):'';
		if (!empty( $child_cat ))
			$list['category_tree'] = $this->getCategoriesInfor ($child_cat, $params);

		$list['_category_parent'] = $this->getCategoriesInfor ($catids, $params);
		if (empty( $list['_category_parent'] ))
			return;
		foreach ($list['_category_parent'] as $item)
		{
			$catids_parent = ( $child_category_products == 'include' )?$this->getChildenCategories ($item['id_category'], $level_depth,
				true, $params):$item['id_category'];
			!is_array ($catids_parent) && settype ($catids_parent, 'array');
			$item['cat_array'] = implode (',', $catids_parent);
			$list['category_parent'] = $item;
		}

		$orderby_preload = $params['field_preload'];
		if ($params['field_select'] == 'all')
		{
			$orderby = $this->getFieldSelect();
		}else{
			$orderby = ( $params['field_select'] )?explode (',', $params['field_select']):$orderby_preload;
		}
		
		!is_array ($orderby) && settype ($orderby, 'array');
		if (!in_array ($orderby_preload, $orderby))
			$orderby_preload = $orderby[0];

		$product_filter = array();
		foreach ($orderby as $order)
		{
			$product = array();
			$product['count'] = $this->countProduct ($catids, $params);
			$product['id'] = $order;
			$title_pro = $this->getLabel ($order);
			$product['title'] = $title_pro;
			array_push ($product_filter, $product);
		}

		$_list = array();
		foreach ($product_filter as $order)
		{
			if ($order['count'] > 0)
			{
				if ($order['id'] == $orderby_preload)
				{
					$order['sel'] = 'sel';
					$order['child'] = $this->getProductInfor ($params, $catids, false, $orderby_preload);
					
					$flag = true;
					foreach($order['child'] as $key => $product){
						$product['specific_prices'] = SpecificPriceCore::getByProductId($product['id_product']);
						
						if (!empty($product['specific_prices']) && $product['specific_prices']){
							foreach($product['specific_prices'] as $i => $specific){
								
								if (strtotime ($product['specific_prices'][$i]['from']) != false && strtotime ($product['specific_prices'][$i]['to']) != false)
								{
									
									$current = date ('Y-m-d H:i:s');
									$start_date = date ('Y-m-d H:i:s', strtotime ($product['specific_prices'][$i]['from']));
									$date_end = date ('Y-m-d H:i:s', strtotime ($product['specific_prices'][$i]['to']));
									
									if ($flag && strtotime ($date_end) >= strtotime ($current) && strtotime ($start_date) <= strtotime ($date_end)){
										$order['child'][$key]['specialPriceToDate'] = $date_end;
										$order['first_child'] = $order['child'][$key];
										unset($order['child'][$key]);
										$flag = false;
									}
										
								}
							}
						}
					}
					
					if (!isset($order['first_child'] )){
						$order['first_child'] = array_shift($order['child']);
					}
				}
				
				$_list[$order['id']] = $order;
			}
		}
		
		$list['tab'] = $_list;
		return $list;
	}

	private function countProduct($catids, $params)
	{
		!is_array ($catids) && settype ($catids, 'array');
		$count_product = $this->getProducts ($catids, $params, true, false);
		return $count_product;
	}

	public function getProducts($id_category = false, $params, $count_product = false, $order_by = false)
	{
		$context = Context::getContext ();
		$id_lang = (int)$context->language->id;
		if ($order_by == false)
			$order_by = $params['field_preload'];

		$order_way = $params['ordering_direction'];

		if (empty( $id_category ))
			return;

		if ($params['show_loadmore_slider'] == 'loadmore')
			$start = (int)Tools::getValue ('ajax_limit_start');
		else
			$start = 0;

		$limit = (int)$params['count_number'];
		$only_active = true;
		$front = true;
		if (!in_array ($context->controller->controller_type, array( 'front', 'modulefront' )))
			$front = false;

		if (!Validate::isOrderBy ($order_by) || !Validate::isOrderWay ($order_way))
			die ( Tools::displayError () );
		if ($order_by == 'id_product' || $order_by == 'price' || $order_by == 'date_add' || $order_by == 'date_upd')
			$order_by_prefix = 'p';
		else if ($order_by == 'name')
			$order_by_prefix = 'pl';
		else if ($order_by == 'position')
			$order_by_prefix = 'c';

		if (strpos ($order_by, '.') > 0)
		{
			$order_by = explode ('.', $order_by);
			$order_by_prefix = $order_by[0];
			$order_by = $order_by[1];
		}

		if ($order_by == 'sales' || $order_by == 'rand')
			$order_by_prefix = '';
		$sql = 'SELECT DISTINCT  p.`id_product`, p.*, product_shop.*, pl.* , m.`name` AS manufacturer_name, s.`name` AS supplier_name,
				MAX(product_attribute_shop.id_product_attribute) id_product_attribute,  MAX(image_shop.`id_image`) id_image,
				  il.`legend`, ps.`quantity` AS sales, cl.`link_rewrite` AS category,
				   IFNULL(stock.quantity,0) as quantity,
				    IFNULL(pa.minimal_quantity, p.minimal_quantity) as minimal_quantity,
				     stock.out_of_stock,
				     product_shop.`on_sale`
				FROM `'._DB_PREFIX_.'product` p
				'.Shop::addSqlAssociation ('product', 'p').'
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` '.Shop::addSqlRestrictionOnLang ('pl').')
				LEFT JOIN `'._DB_PREFIX_.'product_sale` ps ON (p.`id_product` = ps.`id_product` '.Shop::addSqlAssociation ('product_sale', 'ps').')
				LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa ON (p.`id_product` = pa.`id_product`)
				'.Shop::addSqlAssociation ('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
				'.Product::sqlStock ('p', 'product_attribute_shop', false, $context->shop).'
				LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
				ON cl.`id_category` = product_shop.`id_category_default`
				AND cl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang ('cl').'
				LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`)'.
			Shop::addSqlAssociation ('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
				LEFT JOIN `'._DB_PREFIX_.'supplier` s ON (s.`id_supplier` = p.`id_supplier`)'.
			( $id_category?' LEFT JOIN `'._DB_PREFIX_.'category_product` c ON (c.`id_product` = p.`id_product`)':'' ).'
				WHERE pl.`id_lang` = '.(int)$id_lang.
			( $id_category?' AND c.`id_category` IN ('.implode (',', $id_category).')':'' ).
			( $front?' AND product_shop.`visibility` IN ("both", "catalog")':'' ).
			( $only_active?' AND product_shop.`active` = 1':'' ).'
				GROUP BY  p.`id_product`
				ORDER BY '.( isset( $order_by_prefix )?( ( $order_by_prefix != '' )?pSQL ($order_by_prefix).'.':'' ):'' )
			.( $order_by == 'rand'?' rand() ':'`'.pSQL ($order_by).'`' ).pSQL ($order_way);
		if (!$count_product)
			$sql .= ( $limit > 0?' LIMIT '.(int)$start.','.(int)$limit:'' );
		$rq = Db::getInstance (_PS_USE_SQL_SLAVE_)->executeS ($sql);
		if ($count_product)
			return count ($rq);
		if ($order_by == 'price')
			Tools::orderbyPrice ($rq, $order_way);
		$products_ids = array();
		if ($rq)
			foreach ($rq as $row)
				$products_ids[] = $row['id_product'];
		Product::cacheFrontFeatures ($products_ids, $id_lang);
		return Product::getProductsProperties ((int)$id_lang, $rq);
	}

	private function getChildenCategories($catids, $levels, $withparent = true, $params)
	{
		!is_array ($catids) && settype ($catids, 'array');
		$list_catids = '';
		if (!empty ( $catids ))
		{
			$additional_catids = array();
			foreach ($catids as $catid)
			{
				$categ = new Category($catid);
				$parent_level = $categ->calcLevelDepth ();
				$items = $this->getSubCategories ($catid, false, true, '', '');
				if (!empty( $items ))
				{
					foreach ($items as $category)
					{
						$condition = ( $category['level_depth'] - $parent_level ) <= $levels;
						if ($condition)
						{
							if ($withparent)
								$additional_catids[] = (int)$category['id_category'];
							else
								if ($category['id_category'] !== $catid)
									$additional_catids[] = (int)$category['id_category'];
						}
					}
				}
			}

			$list_catids = array_unique ($additional_catids);
		}

		$cat_count = $params['cat_count_number'];
		if ($cat_count > 0)
			$catids = array_slice ($list_catids, 0, $cat_count);
		else
			$catids = $list_catids;

		return $catids;
	}

	private function getSubCategories($parent_id = null, $id_lang = false, $active = true, $sql_sort = '', $sql_limit = '')
	{
		$sql_groups_where = '';
		$sql_groups_join = '';
		if (Group::isFeatureActive ())
		{
			$sql_groups_join = 'LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)';
			$groups = FrontController::getCurrentCustomerGroups ();
			$sql_groups_where = 'AND cg.`id_group` '.( count ($groups)?'IN ('.implode (',', $groups).')':'='.(int)Group::getCurrent ()->id );
		}
		$result = Db::getInstance (_PS_USE_SQL_SLAVE_)->executeS ('
		SELECT c.*,  cl.`id_lang`, cl.`name`, cl.`description`, cl.`link_rewrite`, cl.`meta_title`, cl.`meta_keywords`, cl.`meta_description`
		FROM `'._DB_PREFIX_.'category` c
		'.Shop::addSqlAssociation ('category', 'c').'
		LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.(int)$id_lang.' '
			.Shop::addSqlRestrictionOnLang ('cl').')
		'.$sql_groups_join.'
		'.( isset( $parent_id )?'RIGHT JOIN `'._DB_PREFIX_.'category` c2 ON c2.`id_category` = '
				.(int)$parent_id.' AND c.`nleft` >= c2.`nleft` AND c.`nright` <= c2.`nright`':'' ).'
		WHERE 1
		'.( $active?'AND c.`active` = 1':'' ).'
		'.( $id_lang?'AND `id_lang` = '.(int)$id_lang:'' ).'
		'.$sql_groups_where.'
		GROUP BY c.`id_category`
		'.( $sql_sort != ''?$sql_sort:'ORDER BY `level_depth` ASC, category_shop.`position` ASC' ).'
		'.( $sql_limit != ''?$sql_limit:'' ).'');

		return $result;
	}

	public function getLabel($order)
	{
		if (empty( $order ))
			return;
		switch ($order)
		{
			case 'name':
				return $this->l('Name');
			case 'id_product':
				return $this->l('ID Product');
			case 'date_add':
				return $this->l('Date Add');
			case 'price':
				return $this->l('Price');
			case 'sales':
				return $this->l('Sales');
			case 'position':
				return $this->l('Position');
			case 'rand':
				return $this->l('Random');
		}
	}

	private function getItemInHook($hook_name)
	{
		$list = array();
		$this->context = Context::getContext ();
		$id_shop = $this->context->shop->id;
		$id_hook = Hook::getIdByName ($hook_name);
		if ($id_hook)
		{
			$results = Db::getInstance ()->ExecuteS ('
			SELECT b.`id_spsupercategory`
			FROM `'._DB_PREFIX_.'spsupercategory` b
			LEFT JOIN `'._DB_PREFIX_.'spsupercategory_shop` bs ON (b.`id_spsupercategory` = bs.`id_spsupercategory`)
			WHERE bs.`active` = 1 AND (bs.`id_shop` = '.$id_shop.') AND b.`hook` = '.( $id_hook ).'
			ORDER BY b.`ordering`');
		$language_site = '';
		foreach (Language::getLanguages(false) as $lang)
		{
			if ($lang['id_lang'] == $this->context->language->id)
			{
				if ($lang['is_rtl'] == 1)
					$language_site = 'true';
				else
					$language_site = 'false';
			}
		}
			foreach ($results as $row)
			{
				$temp = new SpSuperCategoryClass($row['id_spsupercategory']);
				$temp->params = unserialize($temp->params);
				if ($hook_name == 'displaySuperCategory4')
					$temp->products = $this->getList2($temp->params);
				elseif ($hook_name == 'displaySuperCategory5')
					$temp->products = $this->getList2($temp->params);
				else
					$temp->products = $this->getList ($temp->params);
				
				$temp->language_site = $language_site;
				$list[] = $temp;
			}
		}
		if (empty( $list ))
			return;
		return $list;
	}

	public function hookdisplayHeader()
	{
		if (isset( $this->context->controller->php_self ) && $this->context->controller->php_self == 'index')
			$this->context->controller->addCSS (_THEME_CSS_DIR_.'product_list.css');
		
		$this->context->controller->registerStylesheet('modules-style', 'modules/'.$this->name.'/views/css/style.css', ['media' => 'all', 'priority' => 155]);
		$this->context->controller->registerJavascript('modules-supercategory', 'modules/'.$this->name.'/views/js/spsupercategory.js', ['position' => 'bottom', 'priority' => 155]);
	}

	public function hookDisplayTop()
	{
		return $this->hookDisplayCustom ('displayTop');
	}

	public function hookDisplayLeftColumn()
	{
		return $this->hookDisplayCustom ('displayLeftColumn');
	}

	
	public function hookDisplayCustom($hook = 'displayCustom')
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId('spsupercategory_'.$hook);
			$list = $this->getItemInHook ($hook);
			if (empty($list))
				return;
			$smarty->assign (array(
				'list' => $list,
				
				'id_lang' => $this->context->language->id
			));
		return $this->display (__FILE__, 'default.tpl');
	}

	public function hookdisplaySuperCategory1()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('splistingtabs_displaySuperCategory1');
			$list = $this->getItemInHook ('displaySuperCategory1');					
			if (empty($list))
				return;
			$smarty->assign (array(
				'list' => $list,
				
				'id_lang' => $this->context->language->id
			));
		
		return $this->display (__FILE__, 'default.tpl');
	}

		public function hookdisplaySuperCategory2()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('splistingtabs_displaySuperCategory2');
			$list = $this->getItemInHook ('displaySuperCategory2');					
			if (empty($list))
				return;
			$smarty->assign (array(
				'list' => $list,
				
				'id_lang' => $this->context->language->id
			));
		
		return $this->display (__FILE__, 'default.tpl');
	}

	public function hookdisplaySuperCategory3()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('splistingtabs_displaySuperCategory3');
			$list = $this->getItemInHook ('displaySuperCategory3');					
			if (empty($list))
				return;
			$smarty->assign (array(
				'list' => $list,
				
				'id_lang' => $this->context->language->id
			));
		
		return $this->display (__FILE__, 'default.tpl');
	}

		public function hookdisplaySuperCategory4()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('splistingtabs_displaySuperCategory4');
			$list = $this->getItemInHook ('displaySuperCategory4');					
			if (empty($list))
				return;
			$smarty->assign (array(
				'list' => $list,
				
				'id_lang' => $this->context->language->id
			));
		
		return $this->display (__FILE__, 'default_2.tpl');
	}

	public function hookdisplaySuperCategory5()
	{
		$smarty = $this->context->smarty;
		$smarty_cache_id = $this->getCacheId ('splistingtabs_displaySuperCategory5');
			$list = $this->getItemInHook ('displaySuperCategory5');					
			if (empty($list))
				return;
			$smarty->assign (array(
				'list' => $list,
				
				'id_lang' => $this->context->language->id
			));
		
		return $this->display (__FILE__, 'default_2.tpl');
	}

	public function hookDisplayHome($hook)
	{
		return $this->hookDisplayCustom ('displayHome');
	}

	public function hookcustomCMS()
	{
		if (Tools::getValue('id_cms') && Tools::getValue('id_cms') == 6)
		{
			return $this->hookDisplayCustom ('customCMS');
		}
	}

	public function loadproductajax()
	{
		if ((int)Tools::getValue ('is_ajax_super_category') == 1)
		{
			$smarty = $this->context->smarty;
			$id_spsupercategory = (int)Tools::getValue ('spcat_module_id');
			$supercategory = new SpSuperCategoryClass($id_spsupercategory);
			$params = unserialize($supercategory->params);
			if ($id_spsupercategory == $supercategory->id_spsupercategory)
			{
				$k = (int)Tools::getValue ('ajax_limit_start');
				$fieldorder = Tools::getValue ('fieldorder');
				$id_category = Tools::getValue ('categoryid');
				$child_items = $this->getProductInfor ($params, $id_category, false, $fieldorder);
				$conditon = '';
				if ($params['show_loadmore_slider'] == 'slider')
					$conditon = true;
				$smarty->assign (array(
					'kk'           => $k,
					'child_items'  => $child_items,
					'items_params' => $params,
					'condition'    => $conditon
				));
				$buffer = $this->display (__FILE__, 'default_items.tpl');
				$result = new stdClass();
				$result->items_markup = $buffer;
				die( Tools::jsonEncode ($result) );
			}
		}
	}

	public function hookdisplayTopColumn()
	{
		return $this->hookDisplayCustom ('displayTopColumn');
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
					opacity: 0.8,
					cursor: "move",
					handle: ".dragGroup",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateSlidesPosition";
							$.ajax({
								type: "POST",
								dataType: "json",
								data:order,
								url:"'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'
			.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'",
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
		$html .= '<style type="text/css">#gird_items .ui-sortable-helper{display:table!important;}
		#gird_items .ui-sortable-helper td{ background-color:#00aff0!important;color:#FFF;}</style>';
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
			sprintf($this->l('You can only edit this module from the shop(s) context: %s'), $shop_contextualized_name).
			'</p>';
		else
			return '<p class="alert alert-danger">'.
			sprintf($this->l('You cannot add modules from a "All Shops" or a "Group Shop" context')).
			'</p>';
	}

	private function getShopAssociationError($id_module)
	{
		return '<p class="alert alert-danger">'.
		sprintf($this->l('Unable to get module shop association information (id_module: %d)'), (int)$id_module).
		'</p>';
	}

	private function getCurrentShopInfoMsg()
	{
		$shop_info = null;

		if (Shop::isFeatureActive())
		{
			if (Shop::getContext() == Shop::CONTEXT_SHOP)
				$shop_info = sprintf($this->l('The modifications will be applied to shop: %s'),
					$this->context->shop->name);
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
		INSERT IGNORE INTO `'._DB_PREFIX_.'spsupercategory_shop` (`id_spsupercategory`, `id_shop`)
		SELECT `id_spsupercategory`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'spsupercategory_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}

	public function cleanText($text)
	{
		$text = strip_tags ($text, '<a><b><blockquote><code><del><dd><dl><dt><em><h1><h2><h3><i><kbd><p><pre><s><sup><strong><strike><br><hr>');
		$text = trim ($text);
		return $text;
	}

	public function trimEncode($text)
	{
		$str = strip_tags ($text);
		$str = preg_replace ('/\s(?=\s)/', '', $str);
		$str = preg_replace ('/[\n\r\t]/', '', $str);
		$str = str_replace (' ', '', $str);
		$str = trim ($str, "\xC2\xA0\n");
		return $str;
	}

	/**
	 * Parse and build target attribute for links.
	 * @param string $value (_self, _blank, _windowopen, _modal)
	 * _blank    Opens the linked document in a new window or tab
	 * _self    Opens the linked document in the same frame as it was clicked (this is default)
	 * _parent    Opens the linked document in the parent frame
	 * _top    Opens the linked document in the full body of the window
	 * _windowopen  Opens the linked document in a Window
	 * _modal        Opens the linked document in a Modal Window
	 */
	public function parseTarget($type = '_self')
	{
		$target = '';
		switch ($type)
		{
			default:
			case '_self':
				break;
			case '_blank':
			case '_parent':
			case '_top':
				$target = 'target="'.$type.'"';
				break;
			case '_windowopen':
				$target = "onclick=\"window.open(this.href,'targetWindow',
				'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,false');return false;\"";
				break;
			case '_modal':
				// user process
				break;
		}
		return $target;
	}
}
