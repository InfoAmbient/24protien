<?php

class M3_Restapi_Model_Api2_Categorysort_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Categorysort_Rest {

    public function _retrieveCollection() {
        $result['sort'] = array();

        $categoryId = $this->getRequest()->getParam('catid');
        $_category = Mage::getModel('catalog/category')->load($categoryId);
        foreach($_category->getAvailableSortByOptions() as $key=>$value){
            $sort = array();
            $sort['key'] = $key;
            $sort['value'] = $value;
            $result['sort'][] = $sort;
        }
        //$result['sort'] = $_category->getAvailableSortByOptions();
        
        return $result;
    }

}

?>