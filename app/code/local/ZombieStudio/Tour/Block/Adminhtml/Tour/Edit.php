<?php

/**
 * Tour admin edit form
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Adminhtml_Tour_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
        parent::__construct();
        $this->_blockGroup = 'zombiestudio_tour';
        $this->_controller = 'adminhtml_tour';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('zombiestudio_tour')->__('Save Tour')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('zombiestudio_tour')->__('Delete Tour')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('zombiestudio_tour')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_tour') && Mage::registry('current_tour')->getId()) {
            return Mage::helper('zombiestudio_tour')->__(
                "Edit Tour '%s'",
                $this->escapeHtml(Mage::registry('current_tour')->getAlng())
            );
        } else {
            return Mage::helper('zombiestudio_tour')->__('Add Tour');
        }
    }
}
