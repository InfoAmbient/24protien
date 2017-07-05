<?php

class M3_Restapi_Model_Api2_Forgetpwd_Rest_Admin_V1 extends M3_Restapi_Model_Api2_Forgetpwd_Rest {

    public function _retrieve() {
        $result = array();
        $email = $this->getRequest()->getParam('email');

        if ($email) {
            $customer = Mage::getModel('customer/customer')->setWebsiteId(1)->loadByEmail($email);

            if ($customer->getId()) {
                try {
                    $newResetPasswordLinkToken = Mage::helper('customer')->generateResetPasswordLinkToken();
                    $customer->changeResetPasswordLinkToken($newResetPasswordLinkToken);
                    $customer->sendPasswordResetConfirmationEmail();
                    $result['message'] = "Email send Successfully";
                } catch (Exception $e) {
                    $result['message'] = $e->getMessage();
                }
            }
        } else {
            $result['message'] = "Please Fill email address";
        }
        return $result;
    }

}

?>