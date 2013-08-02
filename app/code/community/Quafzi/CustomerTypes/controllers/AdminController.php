<?php
/**
 * Quafzi_CustomerTypes_AdminController
 *
 * @category Customer
 * @package  Quafzi_CustomerTypes
 * @author   Thomas Birke <tbirke@netextreme.de>
 * @license  http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Quafzi_CustomerTypes_AdminController extends Mage_Adminhtml_Controller_Action
{
    public function massChangeAction()
    {
		$customerIds = $this->getRequest()->getParam('customer');

		if(false == is_array($customerIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('adminhtml')->__('Please select item(s)')
            );
		} else {
			$customer = Mage::getModel('customer/customer');
			try {
				foreach($customerIds as $customerId) {
                    
					$customer->reset()->load($customerId);
                    $customer->setType($this->getRequest()->getParam('customer_type'));
                    $customer->getResource()->saveAttribute($customer, 'type');
                    
				}

				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('adminhtml')->__(
						'Total of %d record(s) were successfully saved', count($customerIds)
					)
				);
			}
			catch(Exception $e)
			{
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}
		$this->_redirect('adminhtml/customer');
    }
}
