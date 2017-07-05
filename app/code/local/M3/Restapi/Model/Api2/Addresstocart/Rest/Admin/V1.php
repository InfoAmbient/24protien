<?php

class M3_Restapi_Model_Api2_Addresstocart_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Addresstocart_Rest {

    protected function _create(array $data) {
        $result = array();
        try {
            $cartid = $this->getRequest()->getParam('cartid');
            $quote = Mage::getModel('sales/quote')->setStoreId(1)->load($cartid);

            if ($data['country_id'] != "") {
                $countryId = "";
                $countryName = $data['country_id'];
                $countryCollection = Mage::getModel('directory/country')->getCollection();
                foreach ($countryCollection as $country) {
                    if ($countryName == $country->getName()) {
                        $countryId = $country->getCountryId();
                        break;
                    }
                }
                $data['country_id'] = $countryId;
            }

            $address = Mage::getModel("sales/quote_address");
            if ($data['addressid']) {
                $customeraddr = Mage::getModel('customer/address')->load($data['addressid']);
                if ($customeraddr->getCustomerId() != $quote->getCustomerId()) {
                    $result['success'] = "0";
                    $result['message'] = "address not belong to customer";
                    return $result;
                }
                $address->importCustomerAddress($customeraddr);
            } else {
                $address->setData($data);
            }
            $address->implodeStreetAddress();


            if ($data['mode'] == "billing") {
                $address->setEmail($quote->getCustomer()->getEmail());

                if (!$quote->isVirtual()) {
                    $usingCase = isset($data['use_for_shipping']) ? (int) $data['use_for_shipping'] : 0;
                    switch ($usingCase) {
                        case 0:
                            $shippingAddress = $quote->getShippingAddress();
                            $shippingAddress->setSameAsBilling(0);
                            break;
                        case 1:
                            $billingAddress = clone $address;
                            $billingAddress->unsAddressId()->unsAddressType();

                            $shippingAddress = $quote->getShippingAddress();
                            $shippingMethod = $shippingAddress->getShippingMethod();
                            $shippingAddress->addData($billingAddress->getData())
                                    ->setSameAsBilling(1)
                                    ->setShippingMethod($shippingMethod)
                                    ->setCollectShippingRates(true);
                            break;
                    }
                }
                $quote->setBillingAddress($address);
            } else if ($data['mode'] == "shipping") {
                $address->setCollectShippingRates(true)
                        ->setSameAsBilling(0);
                $quote->setShippingAddress($address);
            }
            $quote->collectTotals()->save();
            $result['success'] = "1";
            $result['message'] = "address added to cart";
        } catch (Mage_Core_Exception $e) {
            $result['success'] = "0";
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $result['success'] = "0";
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

//    public function _retrieve() {
//        $result = array();
//
//        $userid = $this->getRequest()->getParam('userid');
//        if ($userid == "") {
//            $result['id'] = 0;
//            $result['message'] = "customer not exist";
//        } else {
//            $quote = Mage::getModel('sales/quote')->getCollection();
//            $quote->addFieldToFilter('customer_id', $userid);
//            $quote->addFieldToFilter('is_active', 1);
//            $quote->addFieldToFilter('store_id', 1);
//            $quote->addFieldToFilter('reserved_order_id', array('null' => true));
//            $quote->getFirstItem();
//            if ($quote->count()) {
//                foreach ($quote as $qte) {
//                    $result['id'] = $qte->getId();
//                    $result['message'] = "cart found";
//                }
//            } else {
//                $result['id'] = 0;
//                $result['message'] = "cart not found";
//            }
//        }
//        return $result;
//    }
}
