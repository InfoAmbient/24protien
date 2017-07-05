<?php

class M3_Restapi_Model_Api2_Producttocart_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Producttocart_Rest {

    protected function _create(array $data) {
        Mage::log(print_r($data,true),null,"mycartlog.log");
        $result = array();
        try {
            $cartid = $this->getRequest()->getParam('cartid');
            $quote = Mage::getModel('sales/quote')->setStoreId(1)->load($cartid);

            $product = Mage::getModel("catalog/product")->load($data['product_id']);
            if (!$product->getId()) {
                $result['success'] = "0";
                $result['message'] = "product not exist";
            } else {
                if ($data instanceof Varien_Object) {
                    $request = $data;
                } elseif (is_numeric($data)) {
                    $request = new Varien_Object();
                    $request->setQty($data);
                } else {
                    $request = new Varien_Object($data);
                }

                if (!$request->hasQty()) {
                    $request->setQty(1);
                }
                $output = $quote->addProduct($product, $request);
                if (is_string($output)) {
                    Mage::throwException($output);
                }
                $quote->collectTotals()->save();
                $result['success'] = "1";
                $result['message'] = "product added to cart";
            }
        } catch (Mage_Core_Exception $e) {
            $result['success'] = $data;
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $result['success'] = "0";
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

}
