<?php

class M3_Restapi_Model_Customer_Api2_Customer_Rest_Admin_V1 extends Mage_Customer_Model_Api2_Customer_Rest_Admin_V1 {

    protected function _create(array $data) {
        $result = array();

        $reqkkk = $this->getRequest()->getBodyParams();
        $password = $reqkkk['password'];
        /** @var $validator Mage_Api2_Model_Resource_Validator_Eav */
        $validator = Mage::getResourceModel('api2/validator_eav', array('resource' => $this));

        $data = $validator->filter($data);
        $data['password'] = $password;
        if (!$validator->isValidData($data)) {
            foreach ($validator->getErrors() as $error) {
                $result['id'] = "0";
                $result['message'] = $error;
            }
        }

        /** @var $customer Mage_Customer_Model_Customer */
        $customer = Mage::getModel('customer/customer');
        $customer->setData($data);

        if (isset($data['password'])) {
            $customer->setPassword($data['password']);
        }

        try {
            $customer->save();
            $result['id'] = $customer->getId();
            $result['message'] = "Register Sucessfully";
        } catch (Mage_Core_Exception $e) {
            $result['id'] = "0";
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $result['id'] = "0";
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

}
