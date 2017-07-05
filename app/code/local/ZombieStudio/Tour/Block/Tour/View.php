<?php

/**
 * Tour view block
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Tour_View extends Mage_Core_Block_Template
{
    /**
     * get the current tour
     *
     * @access public
     * @return mixed (ZombieStudio_Tour_Model_Tour|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentTour()
    {
        return Mage::registry('current_tour');
    }
}
