<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class M3_Ismsshipment_Model_Observer {

    public function SendSmsOrderShipment(Varien_Event_Observer $observer) {    
			$shipment = $observer->getEvent()->getShipment();
            $order = $shipment->getOrder();
            //do something with order - get the increment id:
            $orderID=$order->getIncrementId();
			$shippingMethod = $order->getShippingMethod();
			$msisdn =$order->getBillingAddress()->getTelephone();	// Customer Mobile No		

   			//START SMS API Code here your code
			//$msisdn2='0171767xxxx'; // Store Admin Mobile No
			$msgtxt = 'Your OrderID #'.$orderID.' Processing to shippingMethod '.$shippingMethod.' Thank You @myroyalcart.com'; //May Change SMS Body here
			$user ="7878151111";
			$pass = "crackjack@123"; //if change login password isms.sslwireless.com then change new here
			$sid = "SEAFIS";//Stake Holder Name here
                        $senderid ="SMSWEB";                        
                       
			$ch = curl_init();
                        curl_setopt($ch,CURLOPT_URL, "http://smsidea.co.in/sendsms.aspx?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "mobile=7878151111&pass=$pass&senderid=$senderid&to=$msisdn&msg=$msgtxt");
			//curl_setopt($ch, CURLOPT_POSTFIELDS, "UserName=$user&password=sea123&MobileNo=$msisdn&SenderID=$sid&CDMAHeader=&Message=$msgtxt");
			$buffer = curl_exec($ch);
                        curl_close($ch);     
         
         
    }

}
?>
