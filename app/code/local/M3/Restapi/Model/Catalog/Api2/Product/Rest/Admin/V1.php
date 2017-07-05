<?php

class M3_Restapi_Model_Catalog_Api2_Product_Rest_Admin_V1 extends Mage_Catalog_Model_Api2_Product_Rest_Admin_V1 {

    protected function _retrieveCollection() {
        $result['products'] = array();

        /** @var $collection Mage_Catalog_Model_Resource_Product_Collection */
        $collection = Mage::getResourceModel('catalog/product_collection');
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

        $store = $this->_getStore();
        $collection->setStoreId($store->getId());
        $collection->addAttributeToSelect(array_keys($this->getAvailableAttributes($this->getUserType(), Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)));
        $collection->addAttributeToSelect('small_image');
        $collection->addAttributeToFilter('status', array('eq' => 1))
                ->addAttributeToFilter('visibility', 4);
        $this->_applyCategoryFilter($collection);
        $this->_applyCollectionModifiers($collection);
        //$products = $collection->load()->toArray();
        foreach ($collection as $product) {
            if ($product->getSmallImage() != "" && $product->getSmallImage() != "no_selection") {
                $image = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "catalog/product" . $product->getSmallImage();
            } else {
                $image = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "catalog/product/placeholder/small_image.jpg";
            }

            $prd = array();
            $prd['id'] = $product->getId();
            $prd['name'] = $product->getName();
            $prd['sku'] = $product->getSku();
            $prd['price'] = number_format($product->getPrice(), 2);
            $prd['specialprice'] = number_format($product->getFinalPrice(), 2);
            $prd['image'] = $image;
            $prd['brand'] = $product->getAttributeText('vesbrand');
            $result['products'][] = $prd;
        }
        return $result;
    }

    protected function _retrieve() {
        $product = $this->_getProduct();

        $images = array();
        foreach ($product->getMediaGalleryImages() as $image) {
            $images[] = $image['url'];
        }

        $stockItem = $product->getStockItem();
        if (!$stockItem) {
            $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product);
        }

        if ($product->getHasOptions()) {
            $custoopt = array();
            foreach ($product->getOptions() as $option) {
                $optarr = array();
                $optarr['id'] = $option->getId();
                $optarr['title'] = $option->getTitle();
                $optarr['type'] = $option->getType();
                $valuesarr = array();
                foreach ($option->getValues() as $value) {
                    $values = array();
                    $values['valueid'] = $value->getId();
                    $values['title'] = $value->getTitle();
                    $values['price'] = $value->getPrice();
                    if($value->getImage()){
                        $image = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$value->getImage();
                    }else{
                        $image = "";
                    }
                    $values['image'] = $image;
                    $valuesarr[] = $values;
                }
                $optarr['values'] = $valuesarr;
                $custoopt[] = $optarr;
            }
        }

        $result = array();
        $result['product']['id'] = $product->getId();
        $result['product']['sku'] = $product->getSku();
        $result['product']['name'] = $product->getName();
        $result['product']['shortdescription'] = $product->getShortDescription();
        $result['product']['description'] = $product->getDescription();
        $result['product']['directions'] = $product->getDirections();
        $result['product']['supplementfacts'] = $product->getSupplementfacts();
        $result['product']['price'] = number_format($product->getPrice(), 2);
        $result['product']['specialprice'] = number_format($product->getFinalPrice(), 2);
        $result['product']['images'] = $product->getImageUrl();
        $result['product']['brand'] = $product->getAttributeText('vesbrand');
        $result['product']['status'] = $product->getStatus();
        $result['product']['visibility'] = $product->getVisibility();
        $result['product']['is_in_stock'] = $product->getIsInStock();
        $result['product']['qty'] = $stockItem->getQty();
        $result['product']['optres'] = $product->getHasOptions();
        $result['product']['options'] = $custoopt;
        return $result;
    }

}
