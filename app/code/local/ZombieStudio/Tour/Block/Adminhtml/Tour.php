<?php

/**
 * Tour admin block
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Adminhtml_Tour extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        $this->_controller         = 'adminhtml_tour';
        $this->_blockGroup         = 'zombiestudio_tour';
        parent::__construct();
        $this->_headerText         = Mage::helper('zombiestudio_tour')->__('Tour');
        $this->_updateButton('add', 'label', Mage::helper('zombiestudio_tour')->__('Add Tour'));

    }
}
