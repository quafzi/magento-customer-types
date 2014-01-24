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
    extends Mage_Adminhtml_Block_Customer_Grid
{
    public function setCollection(Mage_Customer_Model_Resource_Customer_Collection $collection)
    {
        $collection->addAttributeToSelect('type');
        return parent::setCollection($collection);
    }

    public function addColumn($name, $params)
    {
        if ($name == 'action')
        {
            $types = Mage::getModel('customertypes/system_config_source_customer_types')
                ->toOptionArray();
            unset($types['']);
            self::addColumn('type', array(
                'header'    => Mage::helper('customertypes')->__('Customer Type'),
                'align'     => 'center',
                'width'     => '80px',
                'index'     => 'type',
                'type'      => 'options',
                'options'   => $types
            ));
        }

        return parent::addColumn($name, $params);
    }

    protected function _prepareMassaction()
    {
        parent::_prepareMassaction();

        $types = Mage::getModel('customertypes/system_config_source_customer_types')
            ->toOptionArray();
        unset($types['']);

        $this->getMassactionBlock()->addItem('change_customer_type', array(
            'label'      => Mage::helper('customertypes')->__('Change Customer Type'),
            'url'        => $this->getUrl('customertypes/admin/massChange'),
            'additional' => array(
                'customer_type' => array(
                    'name'   => 'customer_type',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('customertypes') -> __('Customer Type'),
                    'values' => $types
                )
            )
        ));

        return $this;
    }
}
