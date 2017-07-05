<?php 

/**
 * Tour helper
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Helper_Tour extends Mage_Core_Helper_Abstract
{

    /**
     * get the url to the tours list page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getToursUrl()
    {
        if ($listKey = Mage::getStoreConfig('zombiestudio_tour/tour/url_rewrite_list')) {
            return Mage::getUrl('', array('_direct'=>$listKey));
        }
        return Mage::getUrl('zombiestudio_tour/tour/index');
    }

    /**
     * check if breadcrumbs can be used
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('zombiestudio_tour/tour/breadcrumbs');
    }

    /**
     * check if the rss for tour is enabled
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function isRssEnabled()
    {
        return  Mage::getStoreConfigFlag('rss/config/active') &&
            Mage::getStoreConfigFlag('zombiestudio_tour/tour/rss');
    }

    /**
     * get the link to the tour rss list
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRssUrl()
    {
        return Mage::getUrl('zombiestudio_tour/tour/rss');
    }
}
