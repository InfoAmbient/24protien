<?php

/**
 * Tour admin controller
 *
 * @category    ZombieStudio
 * @package     ZombieStudio_Tour
 * @author      Ultimate Module Creator
 */
class ZombieStudio_Tour_Adminhtml_Tour_TourController extends ZombieStudio_Tour_Controller_Adminhtml_Tour
{
    /**
     * init the tour
     *
     * @access protected
     * @return ZombieStudio_Tour_Model_Tour
     */
    protected function _initTour()
    {
        $tourId  = (int) $this->getRequest()->getParam('id');
        $tour    = Mage::getModel('zombiestudio_tour/tour');
        if ($tourId) {
            $tour->load($tourId);
        }
        Mage::register('current_tour', $tour);
        return $tour;
    }

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
        $this->_title(Mage::helper('zombiestudio_tour')->__('ZS Tour'))
             ->_title(Mage::helper('zombiestudio_tour')->__('Tours'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit tour - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $tourId    = $this->getRequest()->getParam('id');
        $tour      = $this->_initTour();
        if ($tourId && !$tour->getId()) {
            $this->_getSession()->addError(
                Mage::helper('zombiestudio_tour')->__('This tour no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getTourData(true);
        if (!empty($data)) {
            $tour->setData($data);
        }
        Mage::register('tour_data', $tour);
        $this->loadLayout();
        $this->_title(Mage::helper('zombiestudio_tour')->__('ZS Tour'))
             ->_title(Mage::helper('zombiestudio_tour')->__('Tours'));
        if ($tour->getId()) {
            $this->_title($tour->getAlng());
        } else {
            $this->_title(Mage::helper('zombiestudio_tour')->__('Add tour'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new tour action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save tour - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('tour')) {
            try {
                $tour = $this->_initTour();
                $tour->addData($data);
                $tour->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('zombiestudio_tour')->__('Tour was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $tour->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setTourData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('zombiestudio_tour')->__('There was a problem saving the tour.')
                );
                Mage::getSingleton('adminhtml/session')->setTourData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('zombiestudio_tour')->__('Unable to find tour to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete tour - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $tour = Mage::getModel('zombiestudio_tour/tour');
                $tour->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('zombiestudio_tour')->__('Tour was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('zombiestudio_tour')->__('There was an error deleting tour.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('zombiestudio_tour')->__('Could not find tour to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete tour - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $tourIds = $this->getRequest()->getParam('tour');
        if (!is_array($tourIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('zombiestudio_tour')->__('Please select tours to delete.')
            );
        } else {
            try {
                foreach ($tourIds as $tourId) {
                    $tour = Mage::getModel('zombiestudio_tour/tour');
                    $tour->setId($tourId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('zombiestudio_tour')->__('Total of %d tours were successfully deleted.', count($tourIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('zombiestudio_tour')->__('There was an error deleting tours.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $tourIds = $this->getRequest()->getParam('tour');
        if (!is_array($tourIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('zombiestudio_tour')->__('Please select tours.')
            );
        } else {
            try {
                foreach ($tourIds as $tourId) {
                $tour = Mage::getSingleton('zombiestudio_tour/tour')->load($tourId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d tours were successfully updated.', count($tourIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('zombiestudio_tour')->__('There was an error updating tours.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass Position change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massPositionAction()
    {
        $tourIds = $this->getRequest()->getParam('tour');
        if (!is_array($tourIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('zombiestudio_tour')->__('Please select tours.')
            );
        } else {
            try {
                foreach ($tourIds as $tourId) {
                $tour = Mage::getSingleton('zombiestudio_tour/tour')->load($tourId)
                    ->setPosition($this->getRequest()->getParam('flag_position'))
                    ->setIsMassupdate(true)
                    ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d tours were successfully updated.', count($tourIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('zombiestudio_tour')->__('There was an error updating tours.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'tour.csv';
        $content    = $this->getLayout()->createBlock('zombiestudio_tour/adminhtml_tour_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'tour.xls';
        $content    = $this->getLayout()->createBlock('zombiestudio_tour/adminhtml_tour_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'tour.xml';
        $content    = $this->getLayout()->createBlock('zombiestudio_tour/adminhtml_tour_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('zombiestudio_tour/tour');
    }
}
