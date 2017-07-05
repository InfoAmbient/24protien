<?php

class M3_Restapi_Model_Api2_Countrylist_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Countrylist_Rest {

    public function _retrieveCollection() {
        $result['country'] = array();
        $collection = Mage::getModel('directory/country')->getCollection();
        foreach ($collection as $country) {
            $cat = array();
            $cat['id'] = $country->getCountryId();
            $cat['name'] = $country->getName();
            $result['country'][] = $cat;
        }
        return $result;
    }

}
