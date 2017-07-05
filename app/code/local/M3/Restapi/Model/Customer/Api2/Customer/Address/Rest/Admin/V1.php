<?php

class M3_Restapi_Model_Customer_Api2_Customer_Address_Rest_Admin_V1 extends Mage_Customer_Model_Api2_Customer_Address_Rest_Admin_V1 {

    protected function _create(array $data) {
        /* @var $customer Mage_Customer_Model_Customer */
        $customer = $this->_loadCustomerById($this->getRequest()->getParam('customer_id'));
        $validator = $this->_getValidator();
        $result = array();

        $data = $validator->filter($data);
        if (!$validator->isValidData($data) || !$validator->isValidDataForCreateAssociationWithCountry($data)) {
            foreach ($validator->getErrors() as $error) {
                $result['id'] = 0;
                $result['message'] = $error;
            }
            $this->_critical(self::RESOURCE_DATA_PRE_VALIDATION_ERROR);
        }

        if (isset($data['region']) && isset($data['country_id'])) {
            $data['region'] = $this->_getRegionIdByNameOrCode($data['region'], $data['country_id']);
        }

        /* @var $address Mage_Customer_Model_Address */
        $address = Mage::getModel('customer/address');
        $address->setData($data);
        $address->setCustomer($customer);

        try {
            $address->save();
            $result['id'] = $address->getId();
            $result['message'] = "Address save sucessfully";
        } catch (Mage_Core_Exception $e) {
            $result['id'] = 0;
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $result['id'] = 0;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    protected function _retrieveCollection() {
        $data['address'] = array();
        
        /* @var $address Mage_Customer_Model_Address */
        foreach ($this->_getCollectionForRetrieve() as $address) {
            $addressData = $address->getData();
            $addressData['street'] = $address->getStreet();
            $data['address'][] = array_merge($addressData, $this->_getDefaultAddressesInfo($address));
        }
        return $data;
    }

    protected function _update(array $data) {
        /* @var $address Mage_Customer_Model_Address */
        $address = $this->_loadCustomerAddressById($this->getRequest()->getParam('id'));
        $validator = $this->_getValidator();
        $result = array();

//        $data = $validator->filter($data);
//        if (!$validator->isValidData($data, true) || !$validator->isValidDataForChangeAssociationWithCountry($address, $data)) {
//            foreach ($validator->getErrors() as $error) {
//                $this->_error($error, Mage_Api2_Model_Server::HTTP_BAD_REQUEST);
//            }
//            $this->_critical(self::RESOURCE_DATA_PRE_VALIDATION_ERROR);
//        }
//        if (isset($data['region'])) {
//            $data['region'] = $this->_getRegionIdByNameOrCode(
//                    $data['region'], isset($data['country_id']) ? $data['country_id'] : $address->getCountryId()
//            );
//            $data['region_id'] = null; // to avoid overwrite region during update in address model _beforeSave()
//        }
        $address->addData($data);

        try {
            $address->save();
            $result['message'] = "Address updated sucessfully";
        } catch (Mage_Core_Exception $e) {
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $this->_critical(self::RESOURCE_INTERNAL_ERROR);
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    protected function _delete() {
        /* @var $address Mage_Customer_Model_Address */
        $address = $this->_loadCustomerAddressById($this->getRequest()->getParam('id'));

        if ($this->_isDefaultBillingAddress($address) || $this->_isDefaultShippingAddress($address)) {
            $this->_critical(
                    'Address is default for customer so is not allowed to be deleted', Mage_Api2_Model_Server::HTTP_BAD_REQUEST
            );
        }
        try {
            $address->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_critical($e->getMessage(), Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
        } catch (Exception $e) {
            $this->_critical(self::RESOURCE_INTERNAL_ERROR);
        }
    }

}
