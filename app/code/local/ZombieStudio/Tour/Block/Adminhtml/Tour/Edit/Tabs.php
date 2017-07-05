<?php

/**
 * Tour admin edit tabs
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Adminhtml_Tour_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('tour_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('zombiestudio_tour')->__('Tour'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Adminhtml_Tour_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_tour',
            array(
                'label'   => Mage::helper('zombiestudio_tour')->__('Tour'),
                'title'   => Mage::helper('zombiestudio_tour')->__('Tour'),
                'content' => $this->getLayout()->createBlock(
                    'zombiestudio_tour/adminhtml_tour_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve tour entity
     *
     * @access public
     * @return ZombieStudio_Tour_Model_Tour
     * @author Ultimate Module Creator
     */
    public function getTour()
    {
        return Mage::registry('current_tour');
    }
}
