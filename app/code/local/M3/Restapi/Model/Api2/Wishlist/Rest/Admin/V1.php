<?php

class M3_Restapi_Model_Api2_Wishlist_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Wishlist_Rest {

    protected function _create(array $data) {
        $result = array();
        try {
            $wishlistId = 0;

            $product = Mage::getModel('catalog/product')->load($data['prdid']);
            if (!$product) {
                $result['success'] = 0;
                $result['message'] = "Product not exist";
                return $result;
            }

            $customer = Mage::getModel('customer/customer')->setWebsiteId(1);
            $customer->load($data['userid']);
            $wishlist = Mage::getModel('wishlist/wishlist');
            $wishlist->loadByCustomer($customer, true);

            $request = array();
            $request['product'] = $data['prdid'];
            $request['qty'] = 1;
//            $request['store_id'] = 1;
            $buyRequest = new Varien_Object($request);
            $res = $wishlist->addNewItem($product, $buyRequest);
            $wishlist->save();
            $res->setStore(1);
            $res->save();
            Mage::dispatchEvent(
                    'wishlist_add_product', array(
                'wishlist' => $wishlist,
                'product' => $product,
                'item' => $res
                    )
            );

            //Mage::helper('wishlist')->calculate();

            $result['success'] = 1;
            $result['message'] = "product added to wishlist";
        } catch (Mage_Core_Exception $e) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();
        } catch (Exception $e) {
            $result['success'] = 0;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function _retrieveCollection() {
        $wishlistdata['product'] = array();

        $id = $this->getRequest()->getParam('userid');
        $customer = Mage::getModel("customer/customer")->load($id);
        $wishList = Mage::getSingleton('wishlist/wishlist')->loadByCustomer($customer);
        $wishListItemCollection = $wishList->getItemCollection();

        if (count($wishListItemCollection)) {
            foreach ($wishListItemCollection as $item) {
                $proddata = array();
                $product = $item->getProduct();
                $options = $item->getBuyRequest()->getOptions();
                $optarray = array();
                foreach ($options as $key => $option) {
                    $optarr = array();

                    $resource = Mage::getSingleton('core/resource');
                    $readConnection = $resource->getConnection('core_read');
                    $query = 'SELECT title FROM ' . $resource->getTableName('catalog/product_option_title') . ' where option_id = ' . $key . ' AND store_id = 0';
                    $title = $readConnection->fetchCol($query);
                    $query1 = 'SELECT title FROM ' . $resource->getTableName('catalog/product_option_type_title') . ' where option_type_id = ' . $option . ' AND store_id = 0';
                    $value_title = $readConnection->fetchCol($query1);

                    $optarr['option_id'] = $key;
                    $optarr['option_id_label'] = $title[0];
                    $optarr['option_value'] = $option;
                    $optarr['option_value_label'] = $value_title[0];
                    $optarray[] = $optarr;
                }
                if ($product->getSmallImage() != "" && $product->getSmallImage() != "no_selection") {
                    $image = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "catalog/product" . $product->getSmallImage();
                } else {
                    $image = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "catalog/product/placeholder/small_image.jpg";
                }

                $proddata['id'] = $product->getId();
                $proddata['name'] = $product->getName();
                $proddata['brand'] = $product->getAttributeText('vesbrand');
                $proddata['sku'] = $product->getSku();
                $proddata['price'] = number_format($product->getPrice(), 2);
                $proddata['specialprice'] = number_format($product->getFinalPrice(), 2);
                $proddata['image'] = $image;
                $proddata['qty'] = $item->getQty();
                $proddata['options'] = $optarray;

                $wishlistdata['product'][] = $proddata;
            }
        }
        return $wishlistdata;
    }

}

?>