<?php

/**
 * Tour widget block
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Tour_Widget_View extends Mage_Core_Block_Template implements
    Mage_Widget_Block_Interface
{
    protected $_htmlTemplate = 'zombiestudio_tour/tour/widget/view.phtml';

    /**
     * Prepare a for widget
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Tour_Widget_View
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        parent::_beforeToHtml();
        $tourId = $this->getData('tour_id');
        if ($tourId) {
            $tour = Mage::getModel('zombiestudio_tour/tour')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($tourId);
            if ($tour->getStatus()) {
                $this->setCurrentTour($tour);
                $this->setTemplate($this->_htmlTemplate);
            }
        }
        return $this;
    }
}
