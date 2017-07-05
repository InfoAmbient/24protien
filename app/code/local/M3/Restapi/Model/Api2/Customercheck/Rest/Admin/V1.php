<?php

class M3_Restapi_Model_Api2_Customercheck_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Customercheck_Rest {

    public function _retrieve() {
        $customerdata = array();

        $websiteId = 1;
        $store = Mage::getModel('core/store')->load(1);
        $customer1 = Mage::getModel("customer/customer");
        $customer1->website_id = $websiteId;
        $customer1->setStore($store);

        try {
            $customer1->loadByEmail($this->getRequest()->getParam('email'));
            if ($customer1->getId()) {
                $customerdata['id'] = $customer1->getId();
            } else {
                $customerdata['id'] = 0;
            }
        } catch (Exception $e) {
            $customerdata['id'] = 0;
        }

        return $customerdata;
    }

}

?>