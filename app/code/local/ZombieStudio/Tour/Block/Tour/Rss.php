<?php

/**
 * Tour RSS block
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Tour_Rss extends Mage_Rss_Block_Abstract
{
    /**
     * Cache tag constant for feed reviews
     *
     * @var string
     */
    const CACHE_TAG = 'block_html_tour_tour_rss';

    /**
     * constructor
     *
     * @access protected
     * @return void
     * @author Ultimate Module Creator
     */
    protected function _construct()
    {
        $this->setCacheTags(array(self::CACHE_TAG));
        /*
         * setting cache to save the rss for 10 minutes
         */
        $this->setCacheKey('zombiestudio_tour_tour_rss');
        $this->setCacheLifetime(600);
    }

    /**
     * toHtml method
     *
     * @access protected
     * @return string
     * @author Ultimate Module Creator
     */
    protected function _toHtml()
    {
/*        $url    = Mage::helper('zombiestudio_tour/tour')->getToursUrl();
        $title  = Mage::helper('zombiestudio_tour')->__('Tours');
        $rssObj = Mage::getModel('rss/rss');
        $data  = array(
            'title'       => $title,
            'description' => $title,
            'link'        => $url,
            'charset'     => 'UTF-8',
        );
        $rssObj->_addHeader($data);*/
        $collection = Mage::getModel('zombiestudio_tour/tour')->getCollection()
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('in_rss', 1)
            ->setOrder('created_at');
        $collection->load();
		$izlaz=array();
        foreach ($collection as $item) {
			$stavka=array();
			array_push($stavka,$item->getAname(),$item->getBgcolor(),$item->getColor(),Mage::getSingleton('zombiestudio_tour/tour_attribute_source_position')->getOptionText($item->getPosition()),$item->getAtext(),$item->getAtime(),$item->getAlng());
			array_push($izlaz,$stavka);
/*            $description = '<p>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__('Class name').': 
                '.$item->getAname().
                '</div>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__('Background color').': 
                '.$item->getBgcolor().
                '</div>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__('Color').': 
                '.$item->getColor().
                '</div>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__("Position").': '
                .Mage::getSingleton('zombiestudio_tour/tour_attribute_source_position')->getOptionText($item->getPosition()).
                '</div>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__('Text').': 
                '.$item->getAtext().
                '</div>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__('Time in ms').': 
                '.$item->getAtime().
                '</div>';
            $description .= '<div>'.
                Mage::helper('zombiestudio_tour')->__('Language').': 
                '.$item->getAlng().
                '</div>';
            $description .= '</p>';
            $data = array(
                'title'       => $item->getAlng(),
                'link'        => $item->getTourUrl(),
                'description' => $description
            );*/
            //$rssObj->_addEntry($data);
        }
		echo json_encode($izlaz);
		die();
        return ;
        //return $rssObj->createRssXml();
    }
}
