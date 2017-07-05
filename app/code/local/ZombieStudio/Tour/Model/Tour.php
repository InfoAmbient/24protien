<?php

/**
 * Tour model
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Model_Tour extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'zombiestudio_tour_tour';
    const CACHE_TAG = 'zombiestudio_tour_tour';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'zombiestudio_tour_tour';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'tour';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('zombiestudio_tour/tour');
    }

    /**
     * before save tour
     *
     * @access protected
     * @return ZombieStudio_Tour_Model_Tour
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * get the url to the tour details page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getTourUrl()
    {
        return Mage::getUrl('zombiestudio_tour/tour/view', array('id'=>$this->getId()));
    }

    /**
     * save tour relation
     *
     * @access public
     * @return ZombieStudio_Tour_Model_Tour
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        $values['in_rss'] = 1;
        $values['aname'] = '.someclass';
        $values['bgcolor'] = 'black';
        $values['color'] = 'white';
        $values['position'] = '9';
        $values['atext'] = 'Some text';
        $values['atime'] = '5000';
        $values['alng'] = 'en';

        return $values;
    }
    
}
