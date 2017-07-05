<?php

/**
 * Tour list block
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Tour_List extends Mage_Core_Block_Template
{
    /**
     * initialize
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $tours = Mage::getResourceModel('zombiestudio_tour/tour_collection')
                         ->addFieldToFilter('status', 1);
        $tours->setOrder('alng', 'asc');
        $this->setTours($tours);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Tour_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'zombiestudio_tour.tour.html.pager'
        )
        ->setCollection($this->getTours());
        $this->setChild('pager', $pager);
        $this->getTours()->load();
        return $this;
    }

    /**
     * get the pager html
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
