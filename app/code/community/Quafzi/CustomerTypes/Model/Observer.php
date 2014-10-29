<?php
/**
 * @package    Quafzi_CustomerTypes
 * @copyright  Copyright (c) 2013 Thomas Birke
 * @author     Thomas Birke <tbirke@netextreme.de>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Quafzi_CustomerTypes_Model_Observer
{
    public function beforeBlockToHtml(Varien_Event_Observer $observer) {
        $block = $observer->getEvent()->getBlock();
        if ($block instanceof Mage_Adminhtml_Block_Customer_Grid) {
            $this->_modifyCustomerGrid($block);
        }
    }

    protected function _modifyCustomerGrid(Mage_Adminhtml_Block_Customer_Grid $grid)
    {
        $this->_addTypeColumn($grid);

        // reinitialisiert die Spaltensortierung
        $grid->sortColumnsByOrder();
        // reinitialisiert die Sortierung und Filter der Collection
        $this->_callProtectedMethod($grid, '_prepareCollection');
    }

    /**
     * dirty hack...
     * @see http://www.webguys.de/magento/turchen-23-pimp-my-produktgrid/
     */
    protected function _callProtectedMethod($object, $methodName)
    {
        $reflection = new ReflectionClass($object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invoke($object);
    }

    protected function _addTypeColumn($grid)
    {
        $grid->addColumnAfter('type', array(
            'header'    => Mage::helper('customertypes')->__('Customer Type'),
            'width'     => '80px',
            'type'      => 'text',
            'index'     => 'type'
        ), 'customer_since');
    }

    public function beforeCustomerCollectionLoad(Varien_Event_Observer $observer)
    {
        $collection = $observer->getEvent()->getCollection();
        if ($collection instanceof Mage_Customer_Model_Resource_Customer_Collection) {
            $collection->addAttributeToSelect('type');
        }
    }
}
