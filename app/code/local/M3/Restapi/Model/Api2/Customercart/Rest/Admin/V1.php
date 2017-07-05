<?php

class M3_Restapi_Model_Api2_Customercart_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Customercart_Rest {

    protected function _create(array $data) {
        $result = array();
        try {
            $quote = Mage::getModel('sales/quote')->setStoreId(1)->load($data['cartid']);
            $customer = Mage::getModel('customer/customer')->load($data['userid']);
            $customer->setMode(Mage_Checkout_Model_Type_Onepage::METHOD_CUSTOMER);
            $quote->setCustomer($customer)
                    ->setCheckoutMethod($customer->getMode())
                    ->setPasswordHash($customer->encryptPassword($customer->getPassword()))
                    ->save();

            $result['success'] = 1;
            $result['message'] = "customer added to cart";
        } catch (Mage_Core_Exception $e) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function _retrieve() {
        $result = array();

        $userid = $this->getRequest()->getParam('userid');
        if ($userid == "") {
            $result['id'] = 0;
            $result['message'] = "customer not exist";
        } else {
            $quote = Mage::getModel('sales/quote')->getCollection();
            $quote->addFieldToFilter('customer_id', $userid);
            $quote->addFieldToFilter('is_active', 1);
            $quote->addFieldToFilter('store_id', 1);
            $quote->addFieldToFilter('reserved_order_id', array('null' => true));
            $quote->getFirstItem();
            if ($quote->count()) {
                foreach ($quote as $qte) {
                    $result['id'] = $qte->getId();
                    $result['message'] = "cart found";
                }
            } else {
                $result['id'] = 0;
                $result['message'] = "cart not found";
            }
        }
        return $result;
    }

}
