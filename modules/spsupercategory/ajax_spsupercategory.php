<?php
/**
 * package   SP Super Category
 *
 * @version 1.0.2
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

include_once ( '../../config/config.inc.php' );
include_once ( '../../init.php' );
include_once ( 'spsupercategory.php' );
$context = Context::getContext ();
$spsupercategory = new SpSuperCategory();
$items = array();
if (!Tools::isSubmit ('secure_key') || Tools::getValue ('secure_key') != $spsupercategory->secure_key || !Tools::getValue ('action'))
	die( 1 );

if (Tools::getValue ('action') == 'updateSlidesPosition' && Tools::getValue ('item'))
{
	$items = Tools::getValue ('item');
	$pos = array();
	$success = true;

	foreach ($items as $position => $item)
	{
		$success = Db::getInstance ()->execute ('
			UPDATE `'._DB_PREFIX_.'spsupercategory` SET `ordering` = '.(int)$position.'
			WHERE `spsupercategory` = '.(int)$item);
		$pos[] = $position;
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