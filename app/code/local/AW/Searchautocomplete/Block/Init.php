<?php

class AW_Searchautocomplete_Block_Init extends Mage_Core_Block_Template
{
    /**
     * @return string
     */
    public function getQueryParamKey()
    {
        $queryParamKey = Mage::helper("catalogSearch")->getQueryParamName();
        return Zend_Json::encode($queryParamKey);
    }

    /**
     * @return string
     */
    public function getSearchUrl()
    {
        $searchUrl = Mage::app()->getStore()->getUrl('searchautocomplete/ajax/suggest');
        if(Mage::app()->getStore()->isCurrentlySecure()) {
            $searchUrl = str_replace('http://', 'https://', $searchUrl);
        }
        return Zend_Json::encode($searchUrl);
    }

    /**
     * @return string
     */
    public function getQueryDelay()
    {
        $queryDelayInSec = Mage::helper("searchautocomplete/config")->getInterfaceQueryDelayInSec();
        return Zend_Json::encode($queryDelayInSec);
    }

    /**
     * @return string
     */
    public function getIsOpenInNewWindow()
    {
        $isOpenInNewWindow = Mage::helper("searchautocomplete/config")->getInterfaceOpenInNewWindow();
        return Zend_Json::encode($isOpenInNewWindow);
    }

    /**
     * @return string
     */
    public function getIndicatorImage()
    {
        $preloaderImage = Mage::helper("searchautocomplete/config")->getInterfacePreloaderImageUrl();
        return Zend_Json::encode($preloaderImage);
    }

    /**
     * @return string
     */
    public function getUpdateChoicesElementHeader()
    {
        $headerHtml = Mage::helper("searchautocomplete/config")->getInterfaceHeader();
        return is_null($headerHtml)?"":$headerHtml;
    }

    /**
     * @return string
     */
    public function getUpdateChoicesElementFooter()
    {
        $footerHtml = Mage::helper("searchautocomplete/config")->getInterfaceFooter();
        return is_null($footerHtml)?"":$footerHtml;
    }
}