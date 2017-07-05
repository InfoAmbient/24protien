<?php

/**
 * Tour front contrller
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_TourController extends Mage_Core_Controller_Front_Action
{

    /**
      * default action
      *
      * @access public
      * @return void
      * @author Ultimate Module Creator
      */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('zombiestudio_tour/tour')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('zombiestudio_tour')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'tours',
                    array(
                        'label' => Mage::helper('zombiestudio_tour')->__('Tours'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', Mage::helper('zombiestudio_tour/tour')->getToursUrl());
        }
        $this->renderLayout();
    }

    /**
     * init Tour
     *
     * @access protected
     * @return ZombieStudio_Tour_Model_Tour
     * @author Ultimate Module Creator
     */
    protected function _initTour()
    {
        $tourId   = $this->getRequest()->getParam('id', 0);
        $tour     = Mage::getModel('zombiestudio_tour/tour')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($tourId);
        if (!$tour->getId()) {
            return false;
        } elseif (!$tour->getStatus()) {
            return false;
        }
        return $tour;
    }

    /**
     * view tour action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $tour = $this->_initTour();
        if (!$tour) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_tour', $tour);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('tour-tour tour-tour' . $tour->getId());
        }
        if (Mage::helper('zombiestudio_tour/tour')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('zombiestudio_tour')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'tours',
                    array(
                        'label' => Mage::helper('zombiestudio_tour')->__('Tours'),
                        'link'  => Mage::helper('zombiestudio_tour/tour')->getToursUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'tour',
                    array(
                        'label' => $tour->getAlng(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $tour->getTourUrl());
        }
        $this->renderLayout();
    }

    /**
     * tours rss list action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function rssAction()
    {
        if (Mage::helper('zombiestudio_tour/tour')->isRssEnabled()) {
            $this->getResponse()->setHeader('Content-type', 'text/xml; charset=UTF-8');
            $this->loadLayout(false);
            $this->renderLayout();
        } else {
            $this->getResponse()->setHeader('HTTP/1.1', '404 Not Found');
            $this->getResponse()->setHeader('Status', '404 File not found');
            $this->_forward('nofeed', 'index', 'rss');
        }
    }
}
