<?php

class M3_CustomOptionImage_Block_Adminhtml_Product_Edit_Tab_Options_Type_Select
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Options_Type_Select
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('m3/customoptionimage/product/edit/options/type/select.phtml');
		 $this->setCanReadPrice(true);
        $this->setCanEditPrice(true);
    }
}

