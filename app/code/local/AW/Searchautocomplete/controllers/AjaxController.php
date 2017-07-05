<?php

class AW_Searchautocomplete_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function suggestAction()
    {
        $this->loadLayout();
        $result = array(
            'suggest_list' => $this->getLayout()->getBlock('aw.saas.suggest.list')->toHtml(),
            'product_list' => $this->getLayout()->getBlock('aw.saas.product.list')->toHtml(),
        );
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
    }
}