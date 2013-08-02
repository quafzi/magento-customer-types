<?php
/**
 * Quafzi_CustomerTypes_Model_System_Config_Source_Customer_Types
 *
 * @category Customer
 * @package  Quafzi_CustomerTypes
 * @author   Thomas Birke <tbirke@netextreme.de>
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Quafzi_CustomerTypes_Model_System_Config_Source_Customer_Types
    extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    protected function getHelper()
    {
        return Mage::helper('customertypes/data');
    }

    public function toOptionArray()
    {
        $config = explode("\n", Mage::getStoreConfig('customer/types/availableTypes'));
        $options = array('' => $this->getHelper()->__('- no type selected -'));
        foreach ($config as $line) {
            $line = trim($line);
            if (strlen($line)) {
                $options[$line] = $line;
            }
        }
        return $options;
    }

    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
