<?php

class M3_Restapi_Model_Api2_Createcart_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Createcart_Rest {

    public function _retrieve() {
        $result= array();
        try {
            $quote = Mage::getModel('sales/quote');
            $quote->setStoreId(1)
                    ->setIsActive(true)
                    ->setIsMultiShipping(false)
                    ->save();
            
            $result['id'] = (int) $quote->getId();
            $result['message'] = "cart create successfully";
        } catch (Mage_Core_Exception $e) {
            $result['id'] = 0;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

}

?>