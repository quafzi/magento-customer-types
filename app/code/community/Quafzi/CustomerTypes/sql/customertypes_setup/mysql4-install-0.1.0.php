<?php
$installer = $this;
$installer->startSetup();

$setup = Mage::getModel('customer/entity_setup', 'core_setup');

$setup->addAttribute('customer', 'type', array(
    'type'             => 'text',
    'input'            => 'select',
    'label'            => 'Customer Type',
    'global'           => 1,
    'visible'          => 1,
    'required'         => 0,
    'user_defined'     => 0,
    'default'          => '',
    'visible_on_front' => 0,
    'source'           => 'customertypes/system_config_source_customer_types',
    'sort_order'       => 70
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'type')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->save();

$installer->endSetup();

