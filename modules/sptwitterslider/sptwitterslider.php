<?php
/**
 * package SP Twitter Slider
 *
 * @version 2.0.0
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2018 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

include_once _PS_MODULE_DIR_.'sptwitterslider/SpTwitterSliderClass.php';

class SpTwitterSlider extends Module implements WidgetInterface
{
    private $_html = '';
    private $templateFile;
    private $defaultHook = [
        'displayHome',
		'displayTwitter',
        'displayTop',
        'displayLeftColumn',
        'displayRightColumn',
        'displayFooter'
    ];

    /**
     * SpTwitterSlider constructor.
     */
    public function __construct()
    {
        $this->name = 'sptwitterslider';
        $this->author = 'MagenTech';
        $this->version = '1.0.0';
        $this->need_instance = 0;
		$this->context = Context::getContext();
        $this->ps_versions_compliancy = [
            'min' => '1.7.1.0',
            'max' => _PS_VERSION_,
        ];

        $this->bootstrap = true;

        parent::__construct();
        $this->displayName = $this->l('Sp Twitter Slider');
        $this->description = $this->l('Sp Twitter Slider Module');

        $this->templateFile = 'module:sptwitterslider/views/templates/hook/sptwitterslider.tpl';
    }

    /**
     * @return bool
     */
    public function install()
    {
        if (parent::install() == false
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayBackOfficeHeader')
            || !$this->registerHook('actionShopDataDuplication')
        ) {
            return false;
        }
        foreach ($this->defaultHook as $hook) {
            if (!$this->registerHook ($hook))
                return false;
        }
        $this->createTables();
        $this->installFixtures();
        return true;
    }

    /**
     * @return bool
     */
    public function uninstall()
    {
        $this->_clearCache('*');

        if (parent::uninstall()) {
            $res = $this->deleteTables();
            return (bool)$res;
        }

        return false;
    }

    /**
     * Creates tables
     */
    protected function createTables()
    {
        $res =  (bool)Db::getInstance ()->execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'sptwitterslider`')
            && Db::getInstance ()->execute ('
			CREATE TABLE '._DB_PREFIX_.'sptwitterslider (
				`id_sptwitterslider` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`hook` int(10) unsigned,
				`params` text NOT NULL DEFAULT \'\' ,
				`active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
				`position` int(10) unsigned NOT NULL DEFAULT \'0\',
				PRIMARY KEY (`id_sptwitterslider`)) ENGINE=InnoDB default CHARSET=utf8');
        $res &= Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'sptwitterslider_shop`')
            && Db::getInstance ()->Execute ('
				CREATE TABLE '._DB_PREFIX_.'sptwitterslider_shop (
				`id_sptwitterslider` int(10) unsigned NOT NULL,
				`id_shop` int(10) unsigned NOT NULL,
				`active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
				 PRIMARY KEY (`id_sptwitterslider`,`id_shop`)) ENGINE=InnoDB default CHARSET=utf8');
        $res &= Db::getInstance ()->Execute ('DROP TABLE IF EXISTS `'._DB_PREFIX_.'sptwitterslider_lang`')
            && Db::getInstance ()->Execute ('CREATE TABLE '._DB_PREFIX_.'sptwitterslider_lang (
				`id_sptwitterslider` int(10) unsigned NOT NULL,
				`id_lang` int(10) unsigned NOT NULL,
				`title_module` varchar(255) NOT NULL DEFAULT \'\',
				PRIMARY KEY (`id_sptwitterslider`,`id_lang`)) ENGINE=InnoDB default CHARSET=utf8');
        return $res;
    }

    /**
     * @return bool
     */
    protected function deleteTables()
    {
        return Db::getInstance()->execute('
            DROP TABLE IF EXISTS `'._DB_PREFIX_.'sptwitterslider`, `'._DB_PREFIX_.'sptwitterslider_shop`, `'._DB_PREFIX_.'sptwitterslider_lang`;
        ');
    }

    /**
     * @return bool
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */
    public function installFixtures()
    {
		$lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $datas = [
            [
				'SPTS_TITLE_MODULE' => 'Sp Twitter Slider',
				'SPTS_DISPLAY_TITLE' => 0,
				'SPTS_CLS_SFX' => '',
				'SPTS_STATUS' => 1,
				'SPTS_HOOK_INTO' => Hook::getIdByName('displayTwitter'),
				'SPTS_SCREEN_NAME' => 'magentech',
				'SPTS_ID_USER' => '886370977',
				'SPTS_DISPLAY_AVATAR' => 'featured_products',
				'SPTS_DISPLAY_FOLLOW_BUTTON' => 1,
				'SPTS_LIMIT' => 6
            ]
        ];

        $return = true;
		$categories = Category::getSimpleCategories($lang->id);
        foreach ($datas as $i => $data)
        {
            $sptwitterslider = new SpTwitterSliderClass();
            $sptwitterslider->hook = $data['SPTS_HOOK_INTO'];
            $sptwitterslider->active = $data['SPTS_STATUS'];
            $sptwitterslider->position = $i+1;
            $sptwitterslider->params = serialize($data);
            foreach (Language::getLanguages(false) as $lang)
                $sptwitterslider->title_module[$lang['id_lang']] = $data['SPTS_TITLE_MODULE'];
            $return &= $sptwitterslider->add();
        }
        return $return;
    }

    /**
     * @return string
     */
    public function renderList()
    {
        $modules = SpTwitterSliderClass::getGridModules($this->context->language->id, $this->context->shop->id);
        foreach ($modules as $key => $module) {
			$name_hook = $this->getHookTitle ($module['hook']);
			$modules[$key]['hook_name'] = $name_hook;
            $associated_shop_ids = SpTwitterSliderClass::getAssociatedIdsShop((int)$module['id_sptwitterslider']);
            if ($associated_shop_ids && count($associated_shop_ids) > 1) {
                $modules[$key]['is_shared'] = true;
            } else {
                $modules[$key]['is_shared'] = false;
            }
        }

        $this->context->smarty->assign(
            array(
                'link' => $this->context->link,
                'modules' => $modules,
            )
        );

        return $this->display(__FILE__, 'views/templates/admin/grid_modules.tpl');
    }

    /**
     *
     */
    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('controller') == 'AdminModules' && Tools::getValue('configure') == $this->name)
        {
            $this->context->controller->addJquery();
            $this->context->controller->addJqueryUI('ui.sortable');
            $this->context->controller->addJS($this->_path.'views/js/admin/spfp.js');
			$this->context->controller->addCSS($this->_path.'views/css/admin/spfp.css');
        }
    }

    /**
     * @param string $template
     * @param null $cache_id
     * @param null $compile_id
     * @return int|void
     */
    public function _clearCache($template, $cache_id = null, $compile_id = null)
    {
        parent::_clearCache($this->templateFile);
    }

    /**
     * @return bool
     */
	private function postValidation()
	{
		$errors = array();
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (!Validate::isInt(Tools::getValue('active')) || (Tools::getValue('active') != 0
					&& Tools::getValue('active') != 1))
				$errors[] = $this->l('Invalid module state.');

			if (!Validate::isInt(Tools::getValue('SPTS_LIMIT')) || floor (Tools::getValue('SPTS_LIMIT')) < 0)
				$errors[] = $this->l('Invalid Count Number.');
            if (Tools::getValue('SPTS_SCREEN_NAME') && empty(Tools::getValue('SPTS_SCREEN_NAME')))
				$errors[] = $this->l('Invalid Screen Name');
            if (Tools::getValue('SPTS_ID_USER') && empty(Tools::getValue('SPTS_ID_USER')))
				$errors[] = $this->l('Invalid Id User');
			if (Tools::isSubmit('id_sptwitterslider'))
			{
				if (!Validate::isInt(Tools::getValue('id_sptwitterslider'))
					&& !$this->moduleExists(Tools::getValue('id_sptwitterslider')))
					$errors[] = $this->l('Invalid module ID');
			}
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
			{
				if (Tools::strlen(Tools::getValue('SPTS_TITLE_MODULE_'.$language['id_lang'])) > 255)
					$errors[] = $this->l('The title is too long.');
			}
			$id_lang_default = (int)Configuration::get('PS_LANG_DEFAULT');
			if (Tools::strlen(Tools::getValue('SPTS_TITLE_MODULE_'.$id_lang_default)) == 0)
				$errors[] = $this->l('The title module is not set.');
			
		}
		elseif (Tools::isSubmit('id_sptwitterslider') && (!Validate::isInt(Tools::getValue('id_sptwitterslider'))
				|| !$this->moduleExists((int)Tools::getValue('id_sptwitterslider'))))
			$errors[] = $this->l('Invalid module ID');

		if (count($errors))
		{
			$this->_html .= $this->displayError(implode('<br />', $errors));

			return false;
		}
		return true;
	}
    /**
     * @return string
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */
    public function getContent()
    {
		if (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay') )
		{
			if ($this->postValidation())
			{
				$this->_html .= $this->postProcess();	
				$this->_html .= $this->renderList();
				$this->_html .= $this->getFormConfig();
			}
			else
				$this->_html .= $this->getFormConfig();
		}elseif (Tools::isSubmit ('updateItemConfirmationRedirect')){
			$this->_html .= $this->displayConfirmation ($this->l('Module successfully updated!'));
			$this->_html .= $this->renderList();	
		}elseif (Tools::isSubmit ('updateItemConfirmation')){
			$this->_html .= $this->displayConfirmation ($this->l('Module successfully updated!'));
			$this->_html .= $this->getFormConfig();		
		}elseif (Tools::isSubmit ('statusConfirmation')){
			$this->_html = $this->displayConfirmation($this->l('Module successfully change status!'));
			$this->_html .= $this->renderList();
		}
		elseif (Tools::isSubmit ('duplicateItemConfirmation')){
			$this->_html = $this->displayConfirmation($this->l('Module successfully duplicated!'));
			$this->_html .= $this->renderList();
		}
		elseif (Tools::isSubmit ('deleteItemConfirmation')){
			$this->_html = $this->displayConfirmation($this->l('Module successfully deleted!'));
			$this->_html .= $this->renderList();
		}
		elseif (Tools::isSubmit ('saveItemConfirmation')){
			$this->_html = $this->displayConfirmation ($this->l('Module created successfully!'));
			$this->_html .= $this->renderList();
		}
		elseif (Tools::isSubmit ('addModule') || (Tools::isSubmit('editModule')
				&& $this->moduleExists((int)Tools::getValue('id_sptwitterslider'))) || Tools::isSubmit ('saveItem'))
		{
			if (Tools::isSubmit('addModule'))
				$mode = 'add';
			else
				$mode = 'edit';
			if ($mode == 'add')
			{
				if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL)
					$this->_html .= $this->getFormConfig ();
				else
					$this->_html .= $this->getShopContextError(null, $mode);
			}
			else
			{
				$associated_shop_ids = SpTwitterSliderClass::getAssociatedIdsShop((int)Tools::getValue('id_sptwitterslider'));
				$context_shop_id = (int)Shop::getContextShopID();
				if ($associated_shop_ids === false)
					$this->_html .= $this->getShopAssociationError((int)Tools::getValue('id_sptwitterslider'));
				else if (Shop::getContext() != Shop::CONTEXT_GROUP && Shop::getContext() != Shop::CONTEXT_ALL
					&& in_array($context_shop_id, $associated_shop_ids))
				{
					if (count($associated_shop_ids) > 1)
						$this->_html = $this->getSharedSlideWarning();
					$this->_html .= $this->getFormConfig();
				}
				else
				{
					$shops_name_list = array();
					foreach ($associated_shop_ids as $shop_id)
					{
						$associated_shop = new Shop((int)$shop_id);
						$shops_name_list[] = $associated_shop->name;
					}
					$this->_html .= $this->getShopContextError($shops_name_list, $mode);
				}
			}
		}
		else
		{
			if ($this->postValidation())
			{
				$this->_html .= $this->postProcess();
				$this->_html .= $this->renderList();
			}
			else
				$this->_html .= $this->getFormConfig();
		}
		return $this->_html;
	}
	
	

	private function postProcess()
	{		
        $currentIndex = AdminController::$currentIndex;
        $output = '';
        $errors = array();
        if(Tools::isSubmit ('duplicateModule') && Tools::getValue ('id_sptwitterslider')) {
            $sptwitterslider = new SpTwitterSliderClass(Tools::getValue('id_sptwitterslider'));
            foreach (Language::getLanguages(false) as $lang)
                $sptwitterslider->title_module[(int)$lang['id_lang']] = $sptwitterslider->title_module[(int)$lang['id_lang']] . $this->l(' (Copy)');
            $sptwitterslider->duplicate();
            $this->_clearCache('*');
            Tools::redirectAdmin($currentIndex . '&configure=' . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules') . '&duplicateItemConfirmation');
        }elseif (Tools::isSubmit ('deleteModule') && Tools::getValue ('id_sptwitterslider'))
        {
            $sptwitterslider = new SpTwitterSliderClass(Tools::getValue('id_sptwitterslider'));
            $sptwitterslider->delete ();
            $this->_clearCache('*');
            Tools::redirectAdmin ($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules')
                .'&deleteItemConfirmation');
		}elseif (Tools::isSubmit ('statusModule') && Tools::getValue ('id_sptwitterslider'))
		{
			$sptwitterslider = new SpTwitterSliderClass(Tools::getValue('id_sptwitterslider'));
			if ($sptwitterslider->active == 0)
				$sptwitterslider->active = 1;
			else
				$sptwitterslider->active = 0;
			$sptwitterslider->update();
			$this->_clearCache('*');
			Tools::redirectAdmin($currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&statusConfirmation');
		}elseif (Tools::isSubmit ('saveItem') || Tools::isSubmit ('saveAndStay'))
		{
			if (Tools::getValue('id_sptwitterslider'))
			{
				$sptwitterslider = new SpTwitterSliderClass((int)Tools::getValue ('id_sptwitterslider'));
				if (!Validate::isLoadedObject($sptwitterslider))
				{
					$this->_html = $this->displayError($this->l('Invalid module ID'));
					return false;
				}
			}
			else
				$sptwitterslider = new SpTwitterSliderClass();
			$next_ps = $sptwitterslider->getHigherPosition() + 1;
			$sptwitterslider->position = (!empty($sptwitterslider->position)) ? (int)$sptwitterslider->position : $next_ps;
			$sptwitterslider->active = (int)Tools::getValue('SPTS_STATUS');
			$sptwitterslider->hook	= (int)Tools::getValue('SPTS_HOOK_INTO');
			$tmp_data = array();
			
			$tmp_data['SPTS_DISPLAY_TITLE'] = (int)Tools::getValue('SPTS_DISPLAY_TITLE');
			$tmp_data['SPTS_CLS_SFX'] = (string)Tools::getValue('SPTS_CLS_SFX');
			$tmp_data['SPTS_STATUS'] = (int)Tools::getValue('SPTS_STATUS');
			$tmp_data['SPTS_HOOK_INTO'] = (int)Tools::getValue('SPTS_HOOK_INTO');
			$tmp_data['SPTS_SCREEN_NAME'] = (string)Tools::getValue('SPTS_SCREEN_NAME');
			$tmp_data['SPTS_ID_USER'] = (string)Tools::getValue('SPTS_ID_USER');
			$tmp_data['SPTS_DISPLAY_FOLLOW_BUTTON'] = (int)Tools::getValue('SPTS_DISPLAY_FOLLOW_BUTTON');
			$tmp_data['SPTS_DISPLAY_AVATAR'] = (int)Tools::getValue('SPTS_DISPLAY_AVATAR');
			$tmp_data['SPTS_LIMIT'] = (int)Tools::getValue('SPTS_LIMIT');
			
			$languages = Language::getLanguages(false);
			foreach ($languages as $language)
				$sptwitterslider->title_module[$language['id_lang']] = Tools::getValue('SPTS_TITLE_MODULE_'.$language['id_lang']);
			$sptwitterslider->params = serialize($tmp_data);
			$get_id = Tools::getValue ('id_sptwitterslider');
			($get_id && $this->moduleExists($get_id) )? $sptwitterslider->update() : $sptwitterslider->add ();
			$this->_clearCache('*');
			if (Tools::isSubmit ('saveAndStay'))
			{
				
				$id_sptwitterslider = Tools::getValue ('id_sptwitterslider')?
					(int)Tools::getValue ('id_sptwitterslider'):(int)$sptwitterslider->getHigherModuleID ();

				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&editModule&id_sptwitterslider='
					.$id_sptwitterslider.'&updateItemConfirmation');
			}
			else
				Tools::redirectAdmin ($currentIndex.'&configure='
					.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules').'&updateItemConfirmationRedirect');
        }
        return $this->_html;

    }
	
	 protected function getMultiLanguageInfoMsg()
    {
        return '<p class="alert alert-warning">'.
                    $this->getTranslator()->trans('Since multiple languages are activated on your shop, please mind to upload your image for each one of them', array(), 'Modules.Filterproducts.Admin').
                '</p>';
    }

    protected function getWarningMultishopHtml()
    {
        if (Shop::getContext() == Shop::CONTEXT_GROUP || Shop::getContext() == Shop::CONTEXT_ALL) {
            return '<p class="alert alert-warning">' .
            $this->getTranslator()->trans('You cannot manage modules items from a "All Shops" or a "Group Shop" context, select directly the shop you want to edit', array(), 'Modules.Filterproducts.Admin') .
            '</p>';
        } else {
            return '';
        }
    }

    protected function getShopContextError($shop_contextualized_name, $mode)
    {
        if (is_array($shop_contextualized_name)) {
            $shop_contextualized_name = implode('<br/>', $shop_contextualized_name);
        }

        if ($mode == 'edit') {
            return '<p class="alert alert-danger">' .
            $this->trans('You can only edit this module from the shop(s) context: %s', array($shop_contextualized_name), 'Modules.Filterproducts.Admin') .
            '</p>';
        } else {
            return '<p class="alert alert-danger">' .
            $this->trans('You cannot add modules from a "All Shops" or a "Group Shop" context', array(), 'Modules.Filterproducts.Admin') .
            '</p>';
        }
    }

    protected function getShopAssociationError($id_slide)
    {
        return '<p class="alert alert-danger">'.
                        $this->trans('Unable to get slide shop association information (id_slide: %d)', array((int)$id_slide), 'Modules.Filterproducts.Admin') .
                '</p>';
    }


    protected function getCurrentShopInfoMsg()
    {
        $shop_info = null;

        if (Shop::isFeatureActive()) {
            if (Shop::getContext() == Shop::CONTEXT_SHOP) {
                $shop_info = $this->trans('The modifications will be applied to shop: %s', array($this->context->shop->name),'Modules.Filterproducts.Admin');
            } else if (Shop::getContext() == Shop::CONTEXT_GROUP) {
                $shop_info = $this->trans('The modifications will be applied to this group: %s', array(Shop::getContextShopGroup()->name), 'Modules.Filterproducts.Admin');
            } else {
                $shop_info = $this->trans('The modifications will be applied to all shops and shop groups', array(), 'Modules.Filterproducts.Admin');
            }

            return '<div class="alert alert-info">'.
                        $shop_info.
                    '</div>';
        } else {
            return '';
        }
    }

    protected function getSharedSlideWarning()
    {
        return '<p class="alert alert-warning">'.
                    $this->trans('This module is shared with other shops! All shops associated to this module will apply modifications made here', array(), 'Modules.Filterproducts.Admin').
                '</p>';
    }
	
	private function getFormConfig(){
		$template_vars = [
            'tabs' => $this->getConfigTabs(),
			'content' => $this->getConfigContent(),
            'active_tab' => 'general_setting',
        ];

        $this->context->smarty->assign($template_vars);
        return $this->display(__FILE__, 'views/templates/admin/tabs.tpl');
	}
	
	/**
     * @return array
     */
	private function getConfigTabs()
    {
        $tabs = [];
        $tabs[] = array(
            'id' => 'general_setting',
            'title' => $this->l('General Setting'),
			'data_tabs' => 'general_setting',
			'icon' => 'icon-cog',
        );
		
		$tabs[] = array(
            'id' => 'source_option',
            'title' => $this->l('Source Options'),
            'data_tabs' => 'source_option_1',
			'icon' => 'icon-user',
        );
        return $tabs;
    }
	
	    /**
     * @return string
     */
	protected function getConfigContent(){
		$field_values = $this->getConfigFieldsValues();
		$hooks = $this->getHookList ();
        $fields_form["general_setting"] = array(
            'form' => array(
                'input' => array(
					array(
                        'type' => 'text',
						'class' => ' fixed-width-xxl',
                        'label' => $this->l('Title Module'),
                        'name' => 'SPTS_TITLE_MODULE',
                        'required' => true,
						'lang' => true
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display Title '),
                        'hint'  => $this->l('A suffix to be applied to the CSS class of the module. This allows for individual module styling.'),
                        'name' => 'SPTS_DISPLAY_TITLE',
                        'required' => false,
                        'is_bool' => true,
                        'values' => array(
                           array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->getTranslator()->trans('Yes', array(), 'Admin.Global'),
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->getTranslator()->trans('No', array(), 'Admin.Global'),
							),
                        )
                    ),
					array(
						'type'  => 'text',
						'label' => $this->l('Module Class Suffix'),
						'name'  => 'SPTS_CLS_SFX',
						'hint'  => $this->l('A suffix to be applied to the CSS class of the module.
						This allows for individual module styling.'),
						'class' => 'fixed-width-xl'
					),
					array(
						'type'   => 'switch',
						'label'  => $this->l('Status'),
						'name'   => 'SPTS_STATUS',
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
						'label'   => $this->l('Hook Into'),
						'name'    => 'SPTS_HOOK_INTO',
						'options' => array(
							'query' => $hooks,
							'id'    => 'key',
							'name'  => 'name'
						)
					),
                ),
                'buttons' => array(
                    array(
						'title' => $this->l('Save and stay'),
						'name'  => 'saveAndStay',
						'type'  => 'submit',
						'class' => 'btn btn-default pull-right',
						'icon'  => 'process-icon-save'
					)
                ),
                'submit' => array(
					'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
				),
            ),
        );
		
		$fields_form['source_option'] = array(
            'form' => array(
                'input' => array(
                    array(
                        'type' => 'text',
						'class' => ' fixed-width-xxl',
                        'label' => $this->l('Screen Name'),
                        'name' => 'SPTS_SCREEN_NAME',
                        'required' => true,
						'lang' => false
					),
                    array(
                        'type' => 'text',
						'class' => ' fixed-width-xxl',
                        'label' => $this->l('Id User'),
                        'name' => 'SPTS_ID_USER',
                        'required' => true,
						'lang' => false
					),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display Avatar'),
                        'name' => 'SPTS_DISPLAY_AVATAR',
                        'required' => false,
                        'is_bool' => true,
                        'values' => array(
                           array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->getTranslator()->trans('Yes', array(), 'Admin.Global'),
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->getTranslator()->trans('No', array(), 'Admin.Global'),
							),
                        )
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Display Follow Button'),
                        'name' => 'SPTS_DISPLAY_FOLLOW_BUTTON',
                        'required' => false,
                        'is_bool' => true,
                        'values' => array(
                           array(
								'id' => 'active_on',
								'value' => 1,
								'label' => $this->getTranslator()->trans('Yes', array(), 'Admin.Global'),
							),
							array(
								'id' => 'active_off',
								'value' => 0,
								'label' => $this->getTranslator()->trans('No', array(), 'Admin.Global'),
							),
                        )
                    ),
					array(
                        'type' => 'text',
						'class' => ' fixed-width-xxl',
                        'label' => $this->l('Product Limitation'),
                        'name' => 'SPTS_LIMIT',
                        'required' => true,
                    ),
                ),
                'buttons' => array(
                    array(
						'title' => $this->l('Save and stay'),
						'name'  => 'saveAndStay',
						'type'  => 'submit',
						'class' => 'btn btn-default pull-right',
						'icon'  => 'process-icon-save'
					)
                ),
                'submit' => array(
					'title' => $this->getTranslator()->trans('Save', array(), 'Admin.Actions'),
				),
            ),
        );
		
		if (Tools::isSubmit('id_sptwitterslider') && $this->moduleExists((int)Tools::getValue('id_sptwitterslider'))) {
            $fields_form["general_setting"]['form']['input'][] = array('type' => 'hidden', 'name' => 'id_sptwitterslider');
        }
		
        $helper = new HelperForm();
        $helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int) Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->id = (int) Tools::getValue('id_carrier');
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'saveItem';
		$helper->show_cancel_button = true;
		$helper->back_url = AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite ('AdminModules');
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
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $field_values,
			'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );
		
        return $helper->generateForm($fields_form);
	}
	
	public function getHookList()
	{
		$hooks = array();
		foreach ($this->defaultHook as $key => $hook)
		{
			$id_hook = Hook::getIdByName ($hook);
			$name_hook = $this->getHookTitle ($id_hook);
			$hooks[$key]['key'] = $id_hook;
			$hooks[$key]['name'] = $name_hook;
		}
		return $hooks;
	}
	
	private function getHookTitle($id_hook, $name = false)
	{
		if (!$result = Db::getInstance ()->getRow ('
			SELECT `name`,`title` FROM `'._DB_PREFIX_.'hook` WHERE `id_hook` = '.( $id_hook )))
			return false;
		return (( $result['title'] != '' && $name ) ? $result['title'] : $result['name']);
	}

    /**
     * @return string
     * @throws PrestaShopDatabaseException
     * @throws PrestaShopException
     */

    public function getConfigFieldsValues()
    {
        $fields = array();
        if (Tools::isSubmit('id_sptwitterslider') && $this->moduleExists((int)Tools::getValue('id_sptwitterslider'))) {
            $sptwitterslider = new SpTwitterSliderClass((int)Tools::getValue('id_sptwitterslider'));
            $fields['id_sptwitterslider'] = (int)Tools::getValue('id_sptwitterslider', $sptwitterslider->id);
			$params = unserialize($sptwitterslider->params);
        } else {
            $sptwitterslider = new SpTwitterSliderClass();
			$params = [];
        }
        $fields['SPTS_DISPLAY_TITLE'] = (int)Tools::getValue ('SPTS_DISPLAY_TITLE', isset( $params['SPTS_DISPLAY_TITLE'] ) ? $params['SPTS_DISPLAY_TITLE'] : 1);
		$fields['SPTS_CLS_SFX'] 	  = (string)Tools::getValue ('SPTS_CLS_SFX', isset( $params['SPTS_CLS_SFX'] ) ? $params['SPTS_CLS_SFX'] : '');
		$fields['SPTS_STATUS'] 		  = (int)Tools::getValue ('SPTS_STATUS',  $sptwitterslider->active);
		$fields['SPTS_HOOK_INTO'] 	  = (int)Tools::getValue ('SPTS_HOOK_INTO', isset( $params['SPTS_HOOK_INTO'] ) ? $params['SPTS_HOOK_INTO'] : 1);
		$fields['SPTS_SCREEN_NAME'] 	  = (string)Tools::getValue ('SPTS_SCREEN_NAME', isset( $params['SPTS_SCREEN_NAME'] ) ? $params['SPTS_SCREEN_NAME'] : 2);
		$fields['SPTS_ID_USER'] = (string)Tools::getValue ('SPTS_ID_USER', isset( $params['SPTS_ID_USER'] ) ? $params['SPTS_ID_USER'] : 0);
		$fields['SPTS_DISPLAY_FOLLOW_BUTTON'] = (int)Tools::getValue ('SPTS_DISPLAY_FOLLOW_BUTTON', isset( $params['SPTS_DISPLAY_FOLLOW_BUTTON'] ) ? $params['SPTS_DISPLAY_FOLLOW_BUTTON'] : 0);
		$fields['SPTS_DISPLAY_AVATAR'] = (string)Tools::getValue ('SPTS_DISPLAY_AVATAR', isset( $params['SPTS_DISPLAY_AVATAR'] ) ? $params['SPTS_DISPLAY_AVATAR'] : 'featured_products');
		$fields['SPTS_LIMIT']         = (int)Tools::getValue ('SPTS_LIMIT', isset( $params['SPTS_LIMIT'] ) ? $params['SPTS_LIMIT'] : 6);
        $languages = Language::getLanguages(false);
        foreach ($languages as $lang) {
            $fields['SPTS_TITLE_MODULE'][$lang['id_lang']] = Tools::getValue('SPTS_TITLE_MODULE_'.(int)$lang['id_lang'], $sptwitterslider->title_module[$lang['id_lang']]);
        }

        return $fields;
    }
	
	public function moduleExists($id_sptwitterslider)
    {
        $req = 'SELECT hs.`id_sptwitterslider`
                FROM `'._DB_PREFIX_.'sptwitterslider` hs
                WHERE hs.`id_sptwitterslider` = '.(int)$id_sptwitterslider;
        $row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
        return ($row);
    }
	
	public function renderWidget($hookName = null, array $configuration = [])
    {
		if (!$this->isCached($this->templateFile, $this->getCacheId())) {
			$variables = $this->getWidgetVariables($hookName, $configuration);
			if (empty($variables)) {
				return false;
			}
			$this->smarty->assign($variables);
		}
		return $this->fetch($this->templateFile, $this->getCacheId());
    }

    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
		$list = $this->getItemInHook($hookName);
        if (!empty($list)) {
            return array(
                'list' => $list,
				'id_lang' => $this->context->language->id,
				'base_dir'            => _PS_BASE_URL_.__PS_BASE_URI__,
            );
        }
        return false;
    }
	
	private function getItemInHook($hookName)
	{
		$list = [];
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_hook = Hook::getIdByName ($hookName);
		
		if ($id_hook)
		{
			$results = Db::getInstance ()->ExecuteS ('
			SELECT b.`id_sptwitterslider`
			FROM `'._DB_PREFIX_.'sptwitterslider` b
			LEFT JOIN `'._DB_PREFIX_.'sptwitterslider_shop` bs ON (b.`id_sptwitterslider` = bs.`id_sptwitterslider`)
			WHERE bs.`active` = 1 AND (bs.`id_shop` = '.$id_shop.') AND b.`hook` = '.( $id_hook ).'
			ORDER BY b.`position`');
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
				$data = new SpTwitterSliderClass($row['id_sptwitterslider']);
				$tmp = [];
				$tmp['params'] = unserialize($data->params);
				$tmp['params']['SPTS_TITLE_MODULE'] = $data->title_module;
				$tmp['params']['SPTS_IDMODULE'] = $row['id_sptwitterslider'];
				$tmp['language_site'] = $language_site;
				$list[] = $tmp;
			}
		}
		if (empty( $list ))
			return;
		return $list;
	}
	
	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance ()->execute ('
		INSERT IGNORE INTO `'._DB_PREFIX_.'sptwitterslider_shop` (`id_sptwitterslider`, `id_shop`)
		SELECT `id_sptwitterslider`, '.(int)$params['new_id_shop'].'
		FROM `'._DB_PREFIX_.'sptwitterslider_shop`
		WHERE `id_shop` = '.(int)$params['old_id_shop']);
	}
	
	public function hookdisplayHeader($params)
    {
		if (!defined('OWLCAROUSEL')){
			//$this->context->controller->registerStylesheet('modules-owlcarousel', 'modules/'.$this->name.'/views/css/front/owl.carousel.css', ['media' => 'all', 'priority' => 150]);
			//$this->context->controller->registerJavascript('modules-owlcarousel', 'modules/'.$this->name.'/views/js/front/owl.carousel.min.js', ['position' => 'bottom', 'priority' => 150]);
			define('OWLCAROUSEL',1);
		}
		$this->context->controller->registerJavascript('modules-sptwitterslider-twitterFetcher', 'modules/'.$this->name.'/views/js/front/twitterFetcher.js', ['position' => 'bottom', 'priority' => 150]);
		$this->context->controller->registerStylesheet('modules-sptwitterslider', 'modules/'.$this->name.'/views/css/front/sptwitterslider.css', ['media' => 'all', 'priority' => 150]);
        $this->context->controller->registerJavascript('modules-sptwitterslider', 'modules/'.$this->name.'/views/js/front/sptwitterslider.js', ['position' => 'bottom', 'priority' => 150]);
    }
}
