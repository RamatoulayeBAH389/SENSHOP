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
$spsupercategoy = new SpSuperCategory();
echo $spsupercategoy->loadproductajax();