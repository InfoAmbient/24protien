<?php

class M3_Restapi_Model_Api2_Restapi_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Restapi {

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
                $valpwd = Mage::helper('core')->validateHash($this->getRequest()->getParam('password'), $customer1->getPasswordHash());
                if ($valpwd == 1) {
                    $customerdata['id'] = $customer1->getId();
                    $customerdata['message'] = "Login sucessfully";
                } else {
                    $customerdata['id'] = 0;
                    $customerdata['message'] = "Password not match";
                }
            } else {
                $customerdata['id'] = 0;
                $customerdata['message'] = "Email id not exist";
            }
        } catch (Exception $e) {
            $customerdata['id'] = 0;
            $customerdata['message'] = $e->getMessage();
        }

        return $customerdata;
    }

}

?>