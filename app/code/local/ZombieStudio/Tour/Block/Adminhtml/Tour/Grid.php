<?php

/**
 * Tour admin grid block
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Block_Adminhtml_Tour_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('tourGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Adminhtml_Tour_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('zombiestudio_tour/tour')
            ->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Adminhtml_Tour_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Id'),
                'index'  => 'entity_id',
                'type'   => 'number'
            )
        );
        $this->addColumn(
            'alng',
            array(
                'header'    => Mage::helper('zombiestudio_tour')->__('Language'),
                'align'     => 'left',
                'index'     => 'alng',
            )
        );
        
        $this->addColumn(
            'status',
            array(
                'header'  => Mage::helper('zombiestudio_tour')->__('Status'),
                'index'   => 'status',
                'type'    => 'options',
                'options' => array(
                    '1' => Mage::helper('zombiestudio_tour')->__('Enabled'),
                    '0' => Mage::helper('zombiestudio_tour')->__('Disabled'),
                )
            )
        );
        $this->addColumn(
            'aname',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Class name'),
                'index'  => 'aname',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'bgcolor',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Background color'),
                'index'  => 'bgcolor',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'color',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Color'),
                'index'  => 'color',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'position',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Position'),
                'index'  => 'position',
                'type'  => 'options',
                'options' => Mage::helper('zombiestudio_tour')->convertOptions(
                    Mage::getModel('zombiestudio_tour/tour_attribute_source_position')->getAllOptions(false)
                )

            )
        );
        $this->addColumn(
            'atext',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Text'),
                'index'  => 'atext',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'atime',
            array(
                'header' => Mage::helper('zombiestudio_tour')->__('Time in ms'),
                'index'  => 'atime',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'action',
            array(
                'header'  =>  Mage::helper('zombiestudio_tour')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('zombiestudio_tour')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('zombiestudio_tour')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('zombiestudio_tour')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('zombiestudio_tour')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Adminhtml_Tour_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('tour');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('zombiestudio_tour')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('zombiestudio_tour')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'      => Mage::helper('zombiestudio_tour')->__('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('zombiestudio_tour')->__('Status'),
                        'values' => array(
                            '1' => Mage::helper('zombiestudio_tour')->__('Enabled'),
                            '0' => Mage::helper('zombiestudio_tour')->__('Disabled'),
                        )
                    )
                )
            )
        );
        $this->getMassactionBlock()->addItem(
            'position',
            array(
                'label'      => Mage::helper('zombiestudio_tour')->__('Change Position'),
                'url'        => $this->getUrl('*/*/massPosition', array('_current'=>true)),
                'additional' => array(
                    'flag_position' => array(
                        'name'   => 'flag_position',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('zombiestudio_tour')->__('Position'),
                        'values' => Mage::getModel('zombiestudio_tour/tour_attribute_source_position')
                            ->getAllOptions(true),

                    )
                )
            )
        );
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param ZombieStudio_Tour_Model_Tour
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * after collection load
     *
     * @access protected
     * @return ZombieStudio_Tour_Block_Adminhtml_Tour_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
