<?php

class M3_Restapi_Model_Api2_Regionlist_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Regionlist_Rest {

    public function _retrieveCollection() {
        $result['region'] = array();

        $countryName = $this->getRequest()->getParam('countryid');
        $countryCollection = Mage::getModel('directory/country')->getCollection();
        foreach ($countryCollection as $country) {
            if ($countryName == $country->getName()) {
                $countryId = $country->getCountryId();
                break;
            }
        }

        $country = Mage::getModel('directory/country')->loadByCode($countryId);

        if ($country->getId()) {
            $collection = Mage::getResourceModel('directory/region_collection');
            $collection->addCountryFilter($country->getId());
            foreach ($collection as $region) {
                $result1 = array();
                $result1['id'] = $region->getRegionId();
                $result1['name'] = $region->getName();
                $result['region'][] = $result1;
            }
        }
        return $result;
    }

}
