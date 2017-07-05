<?php

class AW_Searchautocomplete_Block_Suggest extends Mage_Catalog_Block_Product_List
{
    protected $_suggestItems = null;

    public function isCanShowSuggestedKeywords()
    {
        if (!Mage::helper('searchautocomplete/config')->getInterfaceShowSuggest()) {
            return false;
        }
        if (count($this->getSuggests()) < 1) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getSuggests()
    {
        if (null === $this->_suggestItems) {
            $suggestCollection = Mage::getResourceModel('catalogsearch/query_collection')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->setQueryFilter(
                    Mage::helper('searchautocomplete')->getSearchedQuery()
                )
                ->setCurPage(1)
                ->setPageSize(5)
            ;
            $this->_suggestItems = $suggestCollection->getItems();
        }
        return $this->_suggestItems;
    }

    /**
     * @param string $query
     * @return string
     */
    public function getResultUrl($query)
    {
        if (Mage::helper('searchautocomplete')->canUseADVSearch()) {
            return Mage::helper('awadvancedsearch/catalogsearch')->getResultUrl($query);
        }
        return Mage::helper('catalogsearch')->getResultUrl($query);
    }
}