<?php
/**
 * package SP Deal
 *
 * @version 1.0.1
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2015 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined ('_PS_VERSION_'))
	exit;

class SpDealClass extends ObjectModel
{
	public $id_spdeal;
	public $title_module;
	public $short_desc;
	public $identifier_block;
	public $active = 1;
	public $hook;
	public $params;
	public $ordering;
	public static $definition = array(
		'table' => 'spdeal',
		'primary' => 'id_spdeal',
		'multilang' => true,
		'fields' => array( 'hook' => array( 'type' => self::TYPE_INT, 'validate' => 'isunsignedInt' ),
		'title_module' => array( 'type' => self::TYPE_STRING, 'lang' => true, 'required' => true,'validate' => 'isCleanHtml',
		'size' => 255 ), 'active' => array( 'type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isunsignedInt' ),
		'params' => array( 'type' => self::TYPE_HTML, 'validate' => 'isString' ),
		'ordering' => array( 'type' => self::TYPE_INT, 'validate' => 'isInt' ) ) );

	public function __construct($id_tab = null, $id_lang = null, $id_shop = null)
	{
		Shop::addTableAssociation ('spdeal', array('type' => 'shop'));
		parent::__construct ($id_tab, $id_lang, $id_shop);
	}

	public function add($autodate = true, $null_values = false)
	{
		$this->ordering = $this->getHigherPosition () + 1;
		$res = parent::add($autodate, $null_values);
		return $res;
	}

	public function duplicate($autodate = true)
	{
		$this->ordering = $this->getHigherPosition () + 1;
		$return = parent::add ($autodate, true);
		return $return;
	}

	public function delete()
	{
		$res = true;
		$res &= $this->reOrderPositions();
		$res &= parent::delete();
		return $res;
	}

	public function getHigherPosition()
	{
		$sql = 'SELECT MAX(`ordering`)
				FROM `'._DB_PREFIX_.'spdeal`';
		$ordering = DB::getInstance ()->getValue ($sql);
		return ( is_numeric ($ordering) )?$ordering:0;
	}

	public function getHigherModuleID()
	{
		$sql = 'SELECT MAX(`id_spdeal`)
				FROM `'._DB_PREFIX_.'spdeal`';
		$id_spdeal = DB::getInstance ()->getValue ($sql);
		return ( is_numeric ($id_spdeal) )?$id_spdeal:1;
	}

	public static function getAssociatedIdsShop($id_module)
	{
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT css.`id_shop`
			FROM `'._DB_PREFIX_.'spdeal` cs
			LEFT JOIN `'._DB_PREFIX_.'spdeal_shop` css ON (css.`id_spdeal` = cs.`id_spdeal`)
			WHERE cs.`id_spdeal` = '.(int)$id_module
		);

		if (!is_array($result))
			return false;

		$return = array();

		foreach ($result as $id_shop)
			$return[] = (int)$id_shop['id_shop'];
		return $return;
	}

	public function reOrderPositions()
	{
		$id_spdeal = $this->id;
		$context = Context::getContext();
		$id_shop = $context->shop->id;

		$max = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT MAX(cs.`ordering`) as ordering
			FROM `'._DB_PREFIX_.'spdeal` cs, `'._DB_PREFIX_.'spdeal_shop` css
			WHERE css.`id_spdeal` = cs.`id_spdeal` AND css.`id_shop` = '.(int)$id_shop
		);

		if ((int)$max == (int)$id_spdeal)
			return true;
		$rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT cs.`ordering` as ordering, cs.`id_spdeal` as id_spdeal
			FROM `'._DB_PREFIX_.'spdeal` cs
			LEFT JOIN `'._DB_PREFIX_.'spdeal_shop` css ON (css.`id_spdeal` = cs.`id_spdeal`)
			WHERE css.`id_shop` = '.(int)$id_shop.' AND cs.`ordering` > '.(int)$this->ordering
		);

		foreach ($rows as $row)
		{
			$customs = new spdealClass($row['id_spdeal']);
			--$customs->ordering;
			$customs->update();
			unset($customs);
		}

		return true;
	}
}
