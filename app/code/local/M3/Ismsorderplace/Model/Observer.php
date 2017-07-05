<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class M3_Ismsorderplace_Model_Observer {

    public function SendSmsOrderPlace(Varien_Event_Observer $observer) {  
                       $incrementId = $observer->getEvent()->getOrder()->getIncrementId();
                       $orderId = $observer->getEvent()->getOrder()->getId();
                        
                        $order = Mage::getModel('sales/order')->loadByIncrementId($incrementId);
                        $customer_id = $order->getCustomerId();
                        
                        $orderdata = Mage::getModel('sales/order')->load($orderId);
                        
                        $customermobile =  Mage::getSingleton('core/session')->getCustomerMobile();
                        
                        $customeremail = Mage::getSingleton('core/session')->getCustomerEmail();
                        
                        $customerData = Mage::getModel('customer/customer')->load($customer_id); // then load customer by customer id
                        if($customermobile !=""){
                        $customerData->setEmail($customeremail);
                        $customerData->setMobile($customermobile);
                        try{
                        $customerData->save();
                        }
                        catch (Exception $e) {
                        Zend_Debug::dump($e->getMessage());
                        }
                        }else{
                            $customermobile = $customerData->getMobile();
                        }
			$grandTotal = $observer->getOrder()->getGrandTotal();
			$msgtxt = 'Your OrderID #'.$incrementId.' Thank You 24protein.com';//May Change SMS Body here
			$user ="nidal@24protein.com";
			$pass = "f6b7658ef7dfd44994e256485ab117fa"; //if change login password isms.sslwireless.com then change new here
			$from = "24Protein";//Stake Holder Name here
			$ch = curl_init();
                        curl_setopt($ch,CURLOPT_URL, "https://api.smsapi.com/sms.do?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$user&password=$pass&from=$from&to=$customermobile&message=$msgtxt");
			
			$buffer = curl_exec($ch);
                        $buffer;
                        Mage::getSingleton('core/session')->unsCustomerMobile();
                        Mage::getSingleton('core/session')->unsCustomerEmail();
                        curl_close($ch);
         
    }

}
?>
