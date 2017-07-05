<?php 
class Mage_Catalog_Block_Product_Mylist extends Mage_Catalog_Block_Product_List
{
    /**
     * Retrieve loaded category collection
     *
     * @return Mage_Eav_Model_Entity_Collection_Abstract
     */
    protected function _getProductCollection()
    {
        $collection = parent::_getProductCollection();
        $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

        $collection->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $todayDate))
        ->addAttributeToFilter('special_to_date', array('or'=> array(
            0 => array('date' => true, 'from' => $todayDate),
            1 => array('is' => new Zend_Db_Expr('null')))
        ), 'left')
        ->addAttributeToSort('special_from_date', 'desc');

        return $collection;
    }
}
 ?>