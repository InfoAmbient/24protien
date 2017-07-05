<?php

class M3_Restapi_Model_Api2_Homemenu_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Homemenu_Rest {

    public function _retrieveCollection() {
        $result['menu'] = array();

        $brand = array();
        $brand['id'] = 0;
        $brand['name'] = "Brands";
        $result['menu'][] = $brand;

        $cat_id = Mage::app()->getStore(1)->getRootCategoryId();
        $defaultcat = Mage::getModel('catalog/category')->load($cat_id);
        $subcats = $defaultcat->getChildrenCategories();
        foreach ($subcats as $subcatdet) {
            $subcat = Mage::getModel('catalog/category')->load($subcatdet->getId());
            $cat = array();
            $cat['id'] = $subcat->getId();
            $cat['name'] = $subcat->getName();
            $result['menu'][] = $cat;
        }

        return $result;
    }

}

?>