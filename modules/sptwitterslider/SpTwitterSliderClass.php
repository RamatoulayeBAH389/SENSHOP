<?php
/**
 * package SP Twitter Slider
 *
 * @version 2.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2018 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
 
if (!defined ('_PS_VERSION_'))
    exit;

class SpTwitterSliderClass extends ObjectModel
{
    public $id_sptwitterslider;
    public $title_module;
    public $short_desc;
    public $identifier_block;
    public $active = 1;
    public $hook;
    public $params;
    public $position;
    public static $definition = [
        'table' => 'sptwitterslider',
        'primary' => 'id_sptwitterslider',
        'multilang' => true,
        'fields' => [
			'hook' => ['type' => self::TYPE_INT, 'validate' => 'isunsignedInt' ],
            'title_module' => ['type' => self::TYPE_STRING, 'lang' => true, 'required' => true,'validate' => 'isCleanHtml','size' => 255 ],
			'active' => ['type' => self::TYPE_INT, 'shop' => true, 'validate' => 'isunsignedInt'],
            'params' => ['type' => self::TYPE_HTML, 'validate' => 'isString'],
            'position' => ['type' => self::TYPE_INT, 'validate' => 'isInt'] 
			]
		];

    public function __construct($id_tab = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation ('sptwitterslider', array('type' => 'shop'));
        parent::__construct ($id_tab, $id_lang, $id_shop);
    }

    public function add($autodate = true, $null_values = false)
    {
        if ($this->position <= 0) {
            $this->position = $this->getHigherPosition() + 1;
        }
        $res = parent::add($autodate, $null_values);
        return $res;
    }

    public function duplicate($autodate = true)
    {
        $this->position = $this->getHigherPosition() + 1;
        $return = parent::add ($autodate, true);
        return $return;
    }

    public function delete()
    {
        $res = true;
        $res &= $this->cleanPositions();
        $res &= parent::delete();
        return $res;
    }

    public function getHigherPosition()
    {
        $sql = 'SELECT MAX(`position`)
				FROM `'._DB_PREFIX_.'sptwitterslider`';
        $position = DB::getInstance ()->getValue ($sql);
        return (is_numeric($position)) ? $position : -1;
    }

    public function getHigherModuleID()
    {
        $sql = 'SELECT MAX(`id_sptwitterslider`)
				FROM `'._DB_PREFIX_.'sptwitterslider`';
        $id_sptwitterslider = DB::getInstance ()->getValue ($sql);
        return ( is_numeric ($id_sptwitterslider) )?$id_sptwitterslider:1;
    }

    public static function getAssociatedIdsShop($id_module)
    {
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT css.`id_shop`
			FROM `'._DB_PREFIX_.'sptwitterslider` cs
			LEFT JOIN `'._DB_PREFIX_.'sptwitterslider_shop` css ON (css.`id_sptwitterslider` = cs.`id_sptwitterslider`)
			WHERE cs.`id_sptwitterslider` = '.(int)$id_module
        );

        if (!is_array($result))
            return false;

        $return = array();

        foreach ($result as $id_shop)
            $return[] = (int)$id_shop['id_shop'];
        return $return;
    }

    /**
     * Reorder group attribute position
     * Call it after deleting a group attribute.
     *
     * @return bool $return
     */
    public  function cleanPositions()
    {
        $id_sptwitterslider = $this->id;
        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $max = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT MAX(cs.`position`) as position
			FROM `'._DB_PREFIX_.'sptwitterslider` cs, `'._DB_PREFIX_.'sptwitterslider_shop` css
			WHERE css.`id_sptwitterslider` = cs.`id_sptwitterslider` AND css.`id_shop` = '.(int)$id_shop
        );

        if ((int)$max == (int)$id_sptwitterslider)
            return true;
        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT cs.`position` as position, cs.`id_sptwitterslider` as id_sptwitterslider
			FROM `'._DB_PREFIX_.'sptwitterslider` cs
			LEFT JOIN `'._DB_PREFIX_.'sptwitterslider_shop` css ON (css.`id_sptwitterslider` = cs.`id_sptwitterslider`)
			WHERE css.`id_shop` = '.(int)$id_shop.' AND cs.`position` > '.(int)$this->position
        );
        foreach ($rows as $row)
        {
            $customs = new SpTwitterSliderClass($row['id_sptwitterslider']);
            --$customs->position;
            $customs->update();
            unset($customs);
        }

        return true;
    }

    public static function  getGridModules($id_lang, $id_shop)
    {
        if (!$result = Db::getInstance ()->ExecuteS ('
			SELECT b.`id_sptwitterslider`, b.`hook`, b.`position`, bs.`active`, bl.`title_module`
			FROM `'._DB_PREFIX_.'sptwitterslider` b
			LEFT JOIN `'._DB_PREFIX_.'sptwitterslider_shop` bs ON (b.`id_sptwitterslider` = bs.`id_sptwitterslider`)
			LEFT JOIN `'._DB_PREFIX_.'sptwitterslider_lang` bl ON (b.`id_sptwitterslider` = bl.`id_sptwitterslider`'
            .( $id_shop?'AND bs.`id_shop` = '.$id_shop:' ' ).')
			WHERE bl.`id_lang` = '.(int)$id_lang.( $id_shop?' AND bs.`id_shop` = '.$id_shop:' ' ).'
			ORDER BY b.`position`'))
            return false;
        return $result;
    }


}