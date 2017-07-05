<?php

class M3_Restapi_Model_Api2_Searchproduct_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Searchproduct_Rest {

    public function _retrieveCollection() {
        $result['products'] = array();

        $name = $this->getRequest()->getParam('name');

        $collection = Mage::getModel('catalog/product')->getCollection();
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

        $collection->addStoreFilter(1)
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('status', array('eq' => 1))
                ->addAttributeToFilter('visibility', 4)
                ->addAttributeToFilter(
                        array(
                            array('attribute' => 'name', 'like' => '%' . $name . '%'),
                            array('attribute' => 'sku', 'like' => '%' . $name . '%'),
                        )
        );


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

}

?>