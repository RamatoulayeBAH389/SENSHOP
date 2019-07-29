<?php
/**
 * package SP Twitter Slider
 *
 * @version 2.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2018 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

include_once ( '../../config/config.inc.php' );
include_once ( '../../init.php' );
include_once ( 'sptwitterslider.php' );
$sptwitterslider = new SpFilterProducts();
$items = array();

if (Tools::getValue ('action') == 'updateSlidesPosition' && Tools::getValue ('item'))
{
	$items = Tools::getValue ('item');
	$pos = array();
	$success = true;
	foreach ($items as $position => $item)
	{
		$success &= Db::getInstance ()->execute ('
			UPDATE `'._DB_PREFIX_.'sptwitterslider` SET `position` = '.((int)$position+1).'
			WHERE `id_sptwitterslider` = '.(int)$item);
	}
	if (!$success)
		die( Tools::jsonEncode (array(
			'error' => 'Update Fail'
		)) );
	die( Tools::jsonEncode (array(
		'success' => 'Update Success !',
		'error'   => false
	)) );
}