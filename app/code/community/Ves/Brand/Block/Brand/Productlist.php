<?php
 /*------------------------------------------------------------------------
  # VenusTheme Brand Module 
  # ------------------------------------------------------------------------
  # author:    VenusTheme.Com
  # copyright: Copyright (C) 2012 http://www.venustheme.com. All Rights Reserved.
  # @license: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Websites: http://www.venustheme.com
  # Technical Support:  http://www.venustheme.com/
-------------------------------------------------------------------------*/

class Ves_Brand_Block_Brand_Productlist extends Mage_Catalog_Block_Product_List {
	
    

    protected function _getProductCollection()    {
        if (is_null($this->_productCollection)) {
			$collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
	        	->addFieldToFilter(array(
			        				array('attribute'=>'vesbrand','eq'=>(int) $this->getRequest()->getParam('id', false)),
					))
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->addMinimalPrice()
                ->addUrlRewrite();
            $this->_productCollection = $collection;
            Mage::getSingleton('catalog/product_status')->addSaleableFilterToCollection($this->_productCollection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInSiteFilterToCollection($this->_productCollection);
        }

        return $this->_productCollection;
    }

	public function getLoadedProductCollection() {
		return $this->_getProductCollection();
	}

}
?>