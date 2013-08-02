<?php
/**
 * Quafzi_CustomerTypes_Block_Adminhtml_Customer_Grid
 *
 * @category Customer
 * @package  Quafzi_CustomerTypes
 * @author   Thomas Birke <tbirke@netextreme.de>
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Quafzi_CustomerTypes_Block_Adminhtml_Customer_Grid
    /*
    extends Mage_Adminhtml_Block_Customer_Grid
    */
    extends Netzarbeiter_CustomerActivation_Block_Adminhtml_Customer_Grid
{
	public function setCollection($collection)
	{
        $collection->addAttributeToSelect('type');
		return parent::setCollection($collection);
	}
    
	public function addColumn($name, $params)
	{
        if ($name == 'action')
        {
            self::addColumn('type', array(
                'header'    => Mage::helper('customer')->__('Customer Type'),
                'align'     => 'center',
                'width'     => '80px',
                'index'     => 'type'
            ));
        }

		return parent::addColumn($name, $params);
	}
}
