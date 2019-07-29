<?php
/**
 * package Sp Step Checkout
 *
 * @version 1.0.2
 * @author    MagenTech http://www.magentech.com
 * @copyright (c) 2016 YouTech Company. All Rights Reserved.
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

if (!defined('_PS_VERSION_'))
	exit;

$fsetup = [
			[	
				'options' => [],
				'id_control' => 'customer_id',
				'name_control' => 'customer_id',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer',
				'id' =>  1,
				'name' => 'id',
				'object' => 'customer',
				'description' => 'Customer',
				'lang'  => $this->l('Customer'),
				'type' => 'number',
				'size' => '0',
				'type_control' => 'textbox',
				'default_value' => '',
				'group' => 'customer',
				'row' => '0',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'customer_firstname',
				'name_control' => 'customer_firstname',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer required',
				'id' =>  2,
				'name' => 'firstname',
				'object' => 'customer',
				'description' => 'First name',
				'lang'  => $this->l('First name'),
				'type' => 'isName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' => '',
				'group' => 'customer',
				'row' => '1',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],	
			[
				'options' => [],
				'id_control' => 'customer_lastname',
				'name_control' => 'customer_lastname',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer required',
				'id' =>  3,
				'name' => 'lastname',
				'object' => 'customer',
				'description' => 'Last name',
				'lang' => $this->l('Last name'),
				'type' => 'isName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' => '',
				'group' => 'customer',
				'row' => '2',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],	
			[
				'options' => [],
				'id_control' => 'customer_email',
				'name_control' => 'customer_email',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer required',
				'id' =>  4,
				'name' => 'email',
				'object' => 'customer',
				'description' => 'Email',
				'lang' => $this->l('Email'),
				'type' => 'isEmail',
				'size' => '128',
				'type_control' => 'textbox',
				'default_value' => '',
				'group' => 'customer',
				'row' => '3',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],							
			[
				'options' => [],
				'id_control' => 'customer_id_gender',
				'name_control' => 'customer_id_gender',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer',
				'id' =>  5,
				'name' => 'id_gender',
				'object' => 'customer',
				'description' => 'Social title',
				'lang' => $this->l('Social title'),
				'type' => 'number',
				'size' => '0',
				'type_control' => 'radio',
				'default_value' => '',
				'group' => 'customer',
				'row' => '4',
				'col' => '0',
				'required' => '0',
				'active' => '0',
			],
			[
				'options' => [],
				'id_control' => 'customer_birthday',
				'name_control' => 'customer_birthday',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer',
				'id' =>  6,
				'name' => 'birthday',
				'object' => 'customer',
				'description' => 'Birthdate',
				'lang' => $this->l('Birthdate'),
				'type' => 'isBirthDate',
				'size' => '0',
				'type_control' => 'textbox',
				'default_value' => '',
				'group' => 'customer',
				'row' => '5',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			
			[
				'options' => [],
				'id_control' => 'customer_newsletter',
				'name_control' => 'customer_newsletter',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer required',
				'id' =>  7,
				'name' => 'newsletter',
				'object' => 'customer',
				'description' => 'Sign up for our newsletter',
				'lang' => $this->l('Sign up for our newsletter'),
				'type' => 'isBool',
				'size' => '32',
				'type_control' => 'checkbox',
				'default_value' => '0',
				'group' => 'customer',
				'row' => '6',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'customer_optin',
				'name_control' => 'customer_optin',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer required',
				'id' =>  8,
				'name' => 'optin',
				'object' => 'customer',
				'description' => 'Receive special offers from our partners',
				'lang' => $this->l('Receive special offers from our partners'),
				'type' => 'isBool',
				'size' => '0',
				'type_control' => 'checkbox',
				'default_value' => '0',
				'group' => 'customer',
				'row' => '7',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'customer_passwd',
				'name_control' => 'passwd',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'customer',
				'id' =>  9,
				'name' => 'passwd',
				'object' => 'customer',
				'description' => 'Password',
				'lang' => $this->l('Password'),
				'type' => 'isPasswd',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' => '0',
				'group' => 'customer',
				'row' => '8',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' => ['empty_option' => true, 'value' => 'id_address' , 'description' => 'alias', 'data' => []],
				'id_control' => 'delivery_id',
				'name_control' => 'delivery_id',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  10,
				'name' => 'id',
				'object' => 'delivery',
				'description' => 'Address delivery',
				'lang' => $this->l('Address delivery'),
				'type' => 'number',
				'size' => '0',
				'type_control' => 'select',
				'default_value' => '0',
				'group' => 'delivery',
				'row' => '9',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'delivery_dni',
				'name_control' => 'delivery_dni',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  11,
				'name' => 'dni',
				'object' => 'delivery',
				'description' => 'Identification',
				'lang' => $this->l('Identification'),
				'type' => 'isDniLite',
				'size' => '16',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'delivery',
				'row' => '10',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],							
			[
				'options' => [],
				'id_control' => 'delivery_firstname',
				'name_control' => 'delivery_firstname',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery required',
				'id' =>  12,
				'name' => 'firstname',
				'object' => 'delivery',
				'description' => $this->l('First name'),
				'lang' => $this->l('First name'),
				'type' => 'isName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' => '.',
				'group' => 'delivery',
				'row' => '11',
				'col' => '0',
				'required' => '1',
				'active' =>  '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_lastname',
				'name_control' => 'delivery_lastname',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery required',
				'id' =>  13,
				'name' => 'lastname',
				'object' => 'delivery',
				'description' => 'Last name',
				'lang' => $this->l('Last name'),
				'type' => 'isName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' => '.',
				'group' => 'delivery',
				'row' => '12',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_company',
				'name_control' => 'delivery_company',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  14,
				'name' => 'company',
				'object' => 'delivery',
				'description' => 'Company',
				'lang' => $this->l('Company'),
				'type' => 'isGenericName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' => '0',
				'group' => 'delivery',
				'row' => '13',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_address1',
				'name_control' => 'delivery_address1',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery required',
				'id' =>  15,
				'name' => 'address1',
				'object' => 'delivery',
				'description' => 'Address',
				'lang' => $this->l('Address'),
				'type' => 'isAddress',
				'size' => '128',
				'type_control' => 'textbox',
				'default_value' => '.',
				'group' => 'delivery',
				'row' => '14',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_address2',
				'name_control' => 'delivery_address2',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  16,
				'name' => 'address2',
				'object' => 'delivery',
				'description' => 'Address Complement',
				'lang' => $this->l('Address Complement'),
				'type' => 'isAddress',
				'size' => '128',
				'type_control' => 'textbox',
				'default_value' => '0',
				'group' => 'delivery',
				'row' => '15',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_city',
				'name_control' => 'delivery_city',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery required',
				'id' =>  17,
				'name' => 'city',
				'object' => 'delivery',
				'description' => 'City',
				'lang' => $this->l('City'),
				'type' => 'isCityName',
				'size' => '64',
				'type_control' => 'textbox',
				'default_value' => '.',
				'group' => 'delivery',
				'row' => '16',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_id_state',
				'name_control' => 'delivery_id_state',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  18,
				'name' => 'id_state',
				'object' => 'delivery',
				'description' => 'State',
				'lang' => $this->l('State'),
				'type' => 'number',
				'size' => '0',
				'type_control' => 'select',
				'default_value' => '1',
				'group' => 'delivery',
				'row' => '17',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' => [],
				'id_control' => 'delivery_postcode',
				'name_control' => 'delivery_postcode',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  19,
				'name' => 'postcode',
				'object' => 'delivery',
				'description' => 'Zip/Postal Code',
				'lang' => $this->l('Zip/Postal Code'),
				'type' => 'isPostCode',
				'size' => '12',
				'type_control' => 'textbox',
				'default_value' => '0',
				'group' => 'delivery',
				'row' => '18',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'delivery_id_country',
				'name_control' => 'delivery_id_country',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery required',
				'id' =>  20,
				'name' => 'id_country',
				'object' => 'delivery',
				'description' => 'Country',
				'lang' => $this->l('Country'),
				'type' => 'number',
				'size' => '0',
				'type_control' => 'select',
				'default_value' =>  Configuration::get('PS_COUNTRY_DEFAULT'),
				'group' => 'delivery',
				'row' => '19',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'delivery_phone',
				'name_control' => 'delivery_phone',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  21,
				'name' => 'phone',
				'object' => 'delivery',
				'description' => 'Phone',
				'lang' => $this->l('Phone'),
				'type' => 'isPhoneNumber',
				'size' => '16',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'delivery',
				'row' => '20',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'delivery_phone_mobile',
				'name_control' => 'delivery_phone_mobile',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery required',
				'id' =>  22,
				'name' => 'phone_mobile',
				'object' => 'delivery',
				'description' => 'Mobile phone',
				'lang' => $this->l('Mobile phone'),
				'type' => 'isPhoneNumber',
				'size' => '16',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'delivery',
				'row' => '21',
				'col' => '0',
				'required' => '0',
				'active' => '0',
			],
			[
				'options' =>  [],
				'id_control' => 'delivery_other',
				'name_control' => 'delivery_other',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  23,
				'name' => 'other',
				'object' => 'delivery',
				'description' => 'Additional information',
				'lang' => $this->l('Additional information'),
				'type' => 'isMessage',
				'size' => '300',
				'type_control' => 'textarea',
				'default_value' =>  '.',
				'group' => 'delivery',
				'row' => '22',
				'col' => '0',
				'required' => '0',
				'active' => '0',
			],						
			[
				'options' =>  [],
				'id_control' => 'delivery_alias',
				'name_control' => 'delivery_alias',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  24,
				'name' => 'alias',
				'object' => 'delivery',
				'description' => 'Assign an address title for future reference',
				'lang' => $this->l('Assign an address title for future reference'),
				'type' => 'isGenericName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  'My delivery address',
				'lang_value' =>  $this->l('My delivery address'),
				'group' => 'delivery',
				'row' => '23',
				'col' => '0',
				'required' => '0',
				'active' => '0',
			],	
			[
				'options' =>  [],
				'id_control' => 'delivery_vat_number',
				'name_control' => 'delivery_vat_number',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'delivery',
				'id' =>  25,
				'name' => 'vat_number',
				'object' => 'delivery',
				'description' => 'VAT number',
				'lang' => $this->l('VAT number'),
				'type' => 'isGenericName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'delivery',
				'row' => '24',
				'col' => '0',
				'required' => '0',
				'active' => '0',
			],										
			[
				'options' => ['empty_option' => true, 'value' => 'id_address' , 'description' => 'alias', 'data' => []],
				'id_control' => 'invoice_id',
				'name_control' => 'invoice_id',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  26,
				'name' => 'id',
				'object' => 'invoice',
				'description' => 'Address invoice',
				'lang' => $this->l('Address invoice'),
				'type' => 'number',
				'size' => '0',
				'type_control' => 'select',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '25',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_dni',
				'name_control' => 'invoice_dni',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  27,
				'name' => 'dni',
				'object' => 'invoice',
				'description' => 'Identification',
				'lang' => $this->l('Identification'),
				'type' => 'isDniLite',
				'size' => '16',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '26',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],						
			[
				'options' =>  [],
				'id_control' => 'invoice_firstname',
				'name_control' => 'invoice_firstname',
				'error_message' => '.',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  28,
				'name' => 'firstname',
				'object' => 'invoice',
				'description' => 'First name',
				'lang' => $this->l('First name'),
				'type' => 'isName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '27',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_lastname',
				'name_control' => 'invoice_lastname',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  29,
				'name' => 'lastname',
				'object' => 'invoice',
				'description' => 'Last name',
				'lang' => $this->l('Last name'),
				'type' => 'isName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  '.',
				'group' => 'invoice',
				'row' => '28',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_company',
				'name_control' => 'invoice_company',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  30,
				'name' => 'company',
				'object' => 'invoice',
				'description' => 'Company',
				'lang' => $this->l('Company'),
				'type' => 'isGenericName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '29',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_address1',
				'name_control' => 'invoice_address1',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  31,
				'name' => 'address1',
				'object' => 'invoice',
				'description' => 'Address',
				'lang' => $this->l('Address'),
				'type' => 'isAddress',
				'size' => '128',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '30',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_address2',
				'name_control' => 'invoice_address2',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  32,
				'name' => 'address2',
				'object' => 'invoice',
				'description' => 'Address Complement',
				'lang' => $this->l('Address Complement'),
				'type' => 'isAddress',
				'size' => '128',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '31',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_city',
				'name_control' => 'invoice_city',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  33,
				'name' => 'city',
				'object' => 'invoice',
				'description' => 'City',
				'lang' => $this->l('City'),
				'type' => 'isCityName',
				'size' => '64',
				'type_control' => 'textbox',
				'default_value' =>  '.',
				'group' => 'invoice',
				'row' => '32',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_id_state',
				'name_control' => 'invoice_id_state',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  34,
				'name' => 'id_state',
				'object' => 'invoice',
				'description' => 'State',
				'lang' => $this->l('State'),
				'type' => 'number',
				'size' => '64',
				'type_control' => 'select',
				'default_value' =>  '1',
				'group' => 'invoice',
				'row' => '33',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],	
			[
				'options' =>  [],
				'id_control' => 'invoice_postcode',
				'name_control' => 'invoice_postcode',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  35,
				'name' => 'postcode',
				'object' => 'invoice',
				'description' => 'Zip/Postal Code',
				'lang' => $this->l('Zip/Postal Code'),
				'type' => 'isPostCode',
				'size' => '12',
				'type_control' => 'textbox',
				'default_value' =>  '1',
				'group' => 'invoice',
				'row' => '34',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],	
			[
				'options' =>  [],
				'id_control' => 'invoice_id_country',
				'name_control' => 'invoice_id_country',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice required',
				'id' =>  36,
				'name' => 'id_country',
				'object' => 'invoice',
				'description' => 'Country',
				'lang' => $this->l('Country'),
				'type' => 'isPostCode',
				'size' => '0',
				'type_control' => 'select',
				'default_value' =>  Configuration::get('PS_COUNTRY_DEFAULT'),
				'group' => 'invoice',
				'row' => '35',
				'col' => '0',
				'required' => '1',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_phone',
				'name_control' => 'invoice_phone',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  37,
				'name' => 'phone',
				'object' => 'invoice',
				'description' => 'Phone',
				'lang' => $this->l('Phone'),
				'type' => 'isPhoneNumber',
				'size' => '16',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '36',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_phone_mobile',
				'name_control' => 'invoice_phone_mobile',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  38,
				'name' => 'phone_mobile',
				'object' => 'invoice',
				'description' => 'Mobile phone',
				'lang' => $this->l('Mobile phone'),
				'type' => 'isPhoneNumber',
				'size' => '16',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '37',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_other',
				'name_control' => 'invoice_other',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  39,
				'name' => 'other',
				'object' => 'invoice',
				'description' => 'Additional information',
				'lang' => $this->l('Additional information'),
				'type' => 'isMessage',
				'size' => '300',
				'type_control' => 'textarea',
				'default_value' =>  '.',
				'group' => 'invoice',
				'row' => '38',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],						
			[
				'options' =>  [],
				'id_control' => 'invoice_alias',
				'name_control' => 'invoice_alias',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  40,
				'name' => 'alias',
				'object' => 'invoice',
				'description' => 'Assign an address title for future reference',
				'lang' => $this->l('Assign an address title for future reference'),
				'type' => 'isGenericName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  'My invoice address',
				'lang_value' =>  $this->l('My delivery address'),
				'group' => 'invoice',
				'row' => '39',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],
			[
				'options' =>  [],
				'id_control' => 'invoice_vat_number',
				'name_control' => 'invoice_vat_number',
				'error_message' => '',
				'help_message'=> '',
				'classes' => 'invoice',
				'id' =>  41,
				'name' => 'vat_number',
				'object' => 'invoice',
				'description' => 'VAT number',
				'lang' => $this->l('VAT number'),
				'type' => 'isGenericName',
				'size' => '32',
				'type_control' => 'textbox',
				'default_value' =>  '0',
				'group' => 'invoice',
				'row' => '40',
				'col' => '0',
				'required' => '0',
				'active' => '1',
			],							
		];
$fields = [];		
foreach($fsetup as &$fl){
	if (isset($fl['lang'])){
		unset($fl['lang']);
	}
	$fields[] = $fl;
}		

