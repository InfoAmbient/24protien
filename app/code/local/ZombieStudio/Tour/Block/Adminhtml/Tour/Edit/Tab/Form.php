<?php

/**
 * Tour edit form tab
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Adminhtml_Tour_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Adminhtml_Tour_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('tour_');
        $form->setFieldNameSuffix('tour');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'tour_form',
            array('legend' => Mage::helper('zombiestudio_tour')->__('Tour'))
        );

        $fieldset->addField(
            'aname',
            'text',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Class name'),
                'name'  => 'aname',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'bgcolor',
            'text',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Background color'),
                'name'  => 'bgcolor',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'color',
            'text',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Color'),
                'name'  => 'color',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'position',
            'select',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Position'),
                'name'  => 'position',
                'required'  => true,
                'class' => 'required-entry',

                'values'=> Mage::getModel('zombiestudio_tour/tour_attribute_source_position')->getAllOptions(true),
           )
        );

        $fieldset->addField(
            'atext',
            'text',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Text'),
                'name'  => 'atext',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'atime',
            'text',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Time in ms'),
                'name'  => 'atime',
                'required'  => true,
                'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'alng',
            'text',
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('Language'),
                'name'  => 'alng',
                'required'  => true,
                'class' => 'required-entry',

           )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('zombiestudio_tour')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('zombiestudio_tour')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('zombiestudio_tour')->__('Disabled'),
                    ),
                ),
            )
        );
        $fieldset->addField(
            'in_rss',
            'select',
            array(
                'label'  => Mage::helper('zombiestudio_tour')->__('Show in rss'),
                'name'   => 'in_rss',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('zombiestudio_tour')->__('Yes'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('zombiestudio_tour')->__('No'),
                    ),
                ),
            )
        );
        $formValues = Mage::registry('current_tour')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getTourData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getTourData());
            Mage::getSingleton('adminhtml/session')->setTourData(null);
        } elseif (Mage::registry('current_tour')) {
            $formValues = array_merge($formValues, Mage::registry('current_tour')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
