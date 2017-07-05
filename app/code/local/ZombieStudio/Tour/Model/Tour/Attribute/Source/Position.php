<?php

/**
 * Admin source model for Position
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Model_Tour_Attribute_Source_Position extends Mage_Eav_Model_Entity_Attribute_Source_Table
{
    /**
     * get possible values
     *
     * @access public
     * @param bool $withEmpty
     * @param bool $defaultValues
     * @return array
     * @author Ultimate Module Creator
     */
    public function getAllOptions($withEmpty = true, $defaultValues = false)
    {
        $options =  array(
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('TL'),
                'value' => 1
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('TR'),
                'value' => 2
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('BL'),
                'value' => 3
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('BR'),
                'value' => 4
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('LT'),
                'value' => 5
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('LB'),
                'value' => 6
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('RT'),
                'value' => 7
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('RB'),
                'value' => 8
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('T'),
                'value' => 9
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('R'),
                'value' => 10
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('B'),
                'value' => 11
            ),
            array(
                'label' => Mage::helper('zombiestudio_tour')->__('L'),
                'value' => 12
            ),
        );
        if ($withEmpty) {
            array_unshift($options, array('label'=>'', 'value'=>''));
        }
        return $options;

    }

    /**
     * get options as array
     *
     * @access public
     * @param bool $withEmpty
     * @return string
     * @author Ultimate Module Creator
     */
    public function getOptionsArray($withEmpty = true)
    {
        $options = array();
        foreach ($this->getAllOptions($withEmpty) as $option) {
            $options[$option['value']] = $option['label'];
        }
        return $options;
    }

    /**
     * get option text
     *
     * @access public
     * @param mixed $value
     * @return string
     * @author Ultimate Module Creator
     */
    public function getOptionText($value)
    {
        $options = $this->getOptionsArray();
        if (!is_array($value)) {
            $value = explode(',', $value);
        }
        $texts = array();
        foreach ($value as $v) {
            if (isset($options[$v])) {
                $texts[] = $options[$v];
            }
        }
        return implode(', ', $texts);
    }
}
