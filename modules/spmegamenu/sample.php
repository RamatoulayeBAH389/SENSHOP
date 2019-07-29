<?php

if (!defined('_PS_VERSION_'))
	exit;
$ps_root_dir=str_replace("\\","/",__PS_BASE_URI__);

//spmegamenu
$samples['spmegamenu'] = 
	"INSERT INTO `"._DB_PREFIX_."spmegamenu` (`id_spmegamenu`, `id_spmegamenu_group`, `id_parent`, `value`, `type`, `width`, `menu_class`, `show_title`, `show_sub_title`, `sub_menu`, `sub_width`, `group`, `type_submenu`, `lesp`, `cat_subcategories`, `sp_lesp`, `position`, `active`) VALUES
(1, 1, 0, '', '', '', '', 1, 1, '', '', 0, 0, 0, 0, 1, 1, 1),
(2, 1, 1, 'a:1:{s:8:\"category\";s:1:\"3\";}', 'category', '', 'mega_type1', 1, 1, 'yes', '100%', 0, 0, 0, 0, 1, 0, 1),
(3, 1, 1, 'a:1:{s:8:\"category\";s:2:\"14\";}', 'category', '', 'mega_type2', 1, 1, 'yes', '100%', 0, 0, 0, 0, 2, 1, 1),
(7, 1, 2, 'a:4:{s:6:\"limit1\";s:1:\"5\";s:6:\"limit2\";s:1:\"0\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '25%', '', 0, 1, 'no', '', 1, 0, 0, 16, 2, 1, 1),
(8, 1, 2, 'a:4:{s:6:\"limit1\";s:1:\"5\";s:6:\"limit2\";s:1:\"0\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '25%', '', 0, 1, 'no', '', 1, 0, 0, 14, 2, 2, 1),
(9, 1, 2, 'a:4:{s:6:\"limit1\";s:1:\"5\";s:6:\"limit2\";s:1:\"0\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '25%', '', 0, 1, 'no', '', 1, 0, 0, 12, 2, 3, 1),
(10, 1, 2, 'a:5:{s:6:\"limit1\";s:1:\"5\";s:6:\"limit2\";s:1:\"5\";s:6:\"limit3\";s:1:\"5\";s:7:\"showimg\";s:3:\"yes\";s:12:\"showimgchild\";s:2:\"no\";}', 'html', '', 'col-md-6 ver-img-1', 0, 0, 'no', '', 1, 0, 0, 0, 2, 5, 1),
(12, 1, 3, 'a:1:{s:8:\"category\";s:2:\"14\";}', 'category', '60.2%', 'box-cate', 0, 0, 'yes', '', 1, 0, 0, 0, 3, 0, 1),
(20, 1, 1, '', 'url', '', 'css_type blog', 1, 1, 'no', '180px', 0, 0, 0, 0, 4, 3, 1),
(21, 1, 1, 'a:1:{s:3:\"cms\";s:1:\"4\";}', 'cms', '', '', 1, 1, 'no', '', 0, 0, 0, 0, 4, 4, 1),
(22, 1, 1, 'a:1:{s:8:\"category\";s:1:\"1\";}', 'url', '', 'css_type3 contact', 1, 0, 'yes', '180px', 0, 0, 0, 0, 2, 5, 1),
(43, 1, 39, '', 'url', '', '', 1, 1, 'no', '', 1, 0, 0, 0, 3, 11, 1),
(55, 0, 1, '', 'url', '', '', 1, 1, 'yes', '', 1, 0, 0, 0, 2, 23, 1),
(56, 1, 2, 'a:4:{s:6:\"limit1\";s:1:\"5\";s:6:\"limit2\";s:1:\"0\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '25%', '', 0, 1, 'no', '', 1, 0, 0, 13, 2, 4, 1),
(57, 1, 3, 'a:2:{s:4:\"type\";s:8:\"featured\";s:5:\"limit\";s:1:\"1\";}', 'productlist', '39.8%', 'featured-product', 1, 1, 'no', '', 1, 0, 0, 0, 3, 3, 1),
(58, 1, 12, 'a:4:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '33.33333333%', '', 0, 0, 'yes', '', 1, 0, 0, 109, 4, 0, 1),
(59, 1, 12, 'a:4:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '33.33333333%', '', 1, 0, 'yes', '', 1, 0, 0, 110, 4, 1, 1),
(112, 1, 2, 'a:5:{s:6:\"limit1\";s:1:\"5\";s:6:\"limit2\";s:1:\"5\";s:6:\"limit3\";s:1:\"5\";s:7:\"showimg\";s:3:\"yes\";s:12:\"showimgchild\";s:2:\"no\";}', 'html', '', 'col-md-6 ver-img-1', 0, 1, 'no', '', 1, 0, 0, 0, 2, 6, 1),
(113, 1, 12, 'a:4:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '33.33333333%', '', 1, 0, 'yes', '', 1, 0, 0, 111, 4, 24, 1),
(114, 1, 12, 'a:4:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '33.33333333%', '', 1, 0, 'yes', '', 1, 0, 0, 112, 4, 25, 1),
(115, 1, 12, 'a:4:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '33.33333333%', '', 1, 0, 'yes', '', 1, 0, 0, 113, 4, 26, 1),
(116, 1, 12, 'a:4:{s:6:\"limit1\";s:1:\"7\";s:6:\"limit2\";s:1:\"7\";s:7:\"showimg\";s:2:\"no\";s:12:\"showimgchild\";s:2:\"no\";}', 'subcategories', '33.33333333%', '', 1, 0, 'yes', '', 1, 0, 0, 114, 4, 27, 1);";

//spmegamenu_group
$samples['spmegamenu_group'] = 
	"INSERT INTO `"._DB_PREFIX_."spmegamenu_group` (`id_spmegamenu_group`, `hook`, `params`, `status`, `position`) VALUES
(1, 'displayMenu', '', 1, 1); ";

//spmegamenu_group_lang
$samples['spmegamenu_group_lang'] = 
	"INSERT INTO `"._DB_PREFIX_."spmegamenu_group_lang` (`id_spmegamenu_group`, `id_lang`, `title`, `content`) VALUES
(1, _ID_LANG_, 'Sp Mega Menu', NULL),
(3, _ID_LANG_, 'Sp Mega Menu', NULL),
(4, _ID_LANG_, 'Sp Mega Menu', NULL),
(5, _ID_LANG_, 'Sp Mega Menu', NULL),
(6, _ID_LANG_, 'Sp Mega Menu', NULL),
(7, _ID_LANG_, 'Sp Mega Menu', NULL),
(8, _ID_LANG_, 'Sp Mega Menu', NULL);";

//spmegamenu_group_shop
$samples['spmegamenu_group_shop'] = 
	"INSERT INTO `"._DB_PREFIX_."spmegamenu_group_shop` (`id_spmegamenu_group`, `id_shop`) VALUES
(1, _ID_SHOP_),
(2, _ID_SHOP_);";
	
//spmegamenu_lang
$samples['spmegamenu_lang'] =  
	"INSERT INTO `"._DB_PREFIX_."spmegamenu_lang` (`id_spmegamenu`, `id_lang`, `title`, `label`, `short_description`, `sub_title`, `html`, `url`) VALUES
(1, _ID_LANG_, 'Root', '', '', '', '', ''),
(2, _ID_LANG_, 'Shop', '<p class=\"icon-menu\"><img src=\"".$ps_root_dir."/themes/sp_revo17/assets/img/cms/hot-icon.png\" alt=\"\" /></p>', '', '', '', '#'),
(3, _ID_LANG_, 'Our Brands', '<p class=\"icon-menu\"><img src=\"".$ps_root_dir."/themes/sp_revo17/assets/img/cms/new-icon.png\" alt=\"\" /></p>', '', '', '', '#'),
(7, _ID_LANG_, 'Accessories', '', '', '', '', ''),
(8, _ID_LANG_, 'Our Brand', '', '', '', '', ''),
(9, _ID_LANG_, 'Gifts', '', '', '', '', ''),
(10, _ID_LANG_, 'Image 1', '', '', '', '<p><img src=\"".$ps_root_dir."/themes/sp_revo17/assets/img/cms/image-thum-1.jpg\" alt=\"\" /></p>', ''),
(12, _ID_LANG_, 'Box Cate', '', '', '', '', ''),
(20, _ID_LANG_, 'Blog', NULL, NULL, NULL, '', 'index.php?fc=module&module=smartblog&controller=category'),
(21, _ID_LANG_, 'About us', NULL, NULL, NULL, '', 'index.php?controller=contact'),
(22, _ID_LANG_, 'Contact', '', '', '', '', 'index.php?controller=contact'),
(43, _ID_LANG_, 'Blog Listing Large Image', NULL, NULL, NULL, '', 'index.php?fc=module&module=smartblog&controller=category?SP_blogStyle=blog-large_image'),
(55, _ID_LANG_, 'alo', NULL, NULL, NULL, '', '#'),
(56, _ID_LANG_, 'Health & Beauty', '', '', '', '', ''),
(57, _ID_LANG_, 'Featured product', '', '', 'Featured product', '', ''),
(58, _ID_LANG_, 'Category Html Image', '', '', '', '', ''),
(59, _ID_LANG_, 'Headphone', '', '', '', '', ''),
(79, _ID_LANG_, 'Cras imperdiet', '', '', '', '', ''),
(80, _ID_LANG_, 'Aenean id nunc', '', '', '', '', ''),
(81, _ID_LANG_, 'Cras auctor quam', '', '', '', '', ''),
(112, _ID_LANG_, 'Image 2', '', '', '', '<p><img src=\"".$ps_root_dir."/themes/sp_revo17/assets/img/cms/image-thum-2.jpg\" alt=\"\" /></p>', ''),
(113, _ID_LANG_, 'Fusce Mollis', '', '', '', '', ''),
(114, _ID_LANG_, 'Camera', '', '', '', '', ''),
(115, _ID_LANG_, 'Toys', '', '', '', '', ''),
(116, _ID_LANG_, 'Headphone', '', '', '', '', ''),
(117, _ID_LANG_, 'Phasellus ut nisi', '', '', '', '', '');";

//spmegamenu_shop
$samples['spmegamenu_shop'] =
	"INSERT INTO `"._DB_PREFIX_."spmegamenu_shop` (`id_spmegamenu`, `id_shop`) VALUES
(1, _ID_SHOP_),
(2, _ID_SHOP_),
(3, _ID_SHOP_),
(7, _ID_SHOP_),
(8, _ID_SHOP_),
(9, _ID_SHOP_),
(10, _ID_SHOP_),
(12, _ID_SHOP_),
(20, _ID_SHOP_),
(21, _ID_SHOP_),
(22, _ID_SHOP_),
(43, _ID_SHOP_),
(55, _ID_SHOP_),
(56, _ID_SHOP_),
(57, _ID_SHOP_),
(58, _ID_SHOP_),
(59, _ID_SHOP_),
(79, _ID_SHOP_),
(80, _ID_SHOP_),
(81, _ID_SHOP_),
(112, _ID_SHOP_),
(113, _ID_SHOP_),
(114, _ID_SHOP_),
(115, _ID_SHOP_),
(116, _ID_SHOP_),
(117, _ID_SHOP_);zzzzz";
	
foreach ($samples as $sample){
	if($sample){
		$datas = str_replace( '_ID_SHOP_', (int)Context::getContext()->shop->id, $sample );	
		$datas = preg_split('#;\s*[\r\n]+#', $datas);	
		foreach ($datas as $sql) {
			if($sql){
				if( strstr($sql,"_ID_LANG_") ){	
					$languages = Language::getLanguages(true, Context::getContext()->shop->id);
					foreach ($languages as $lang) {	
						$str = str_replace( '_ID_LANG_', (int) $lang["id_lang"], $sql );
						Db::getInstance()->execute(($str));
					}
				}
				else
					Db::getInstance()->execute($sql);
			}
		}
	}
}	


