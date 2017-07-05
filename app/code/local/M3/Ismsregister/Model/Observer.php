<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class M3_Ismsregister_Model_Observer {

    public function SendSmsRegister(Varien_Event_Observer $observer) {  
		$event = $observer->getEvent();
			  $customer = $event->getCustomer();
                           $email = $customer->getEmail();
                           $name = $customer->getName();
                           $mobilecode = $customer->getMobilecode();
                           $msisdn = $customer->getMobile();
                           $msisd = ltrim($msisdn, '0');
                           $mobilelast = $mobilecode.$msisd;
			$msgtxt = "Dear ".$name." Welcome to 24protein.com. Your username is ".$email." , Thanks for registering. Happy shopping.";
			
			$user ="nidal@24protein.com";
			$pass = "f6b7658ef7dfd44994e256485ab117fa"; //if change login password isms.sslwireless.com then change new here
			$from = "24Protein";//Stake Holder Name here
                                              
                       
			$ch = curl_init();
                        curl_setopt($ch,CURLOPT_URL, "https://api.smsapi.com/sms.do?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$user&password=$pass&from=$from&to=$mobilelast&message=$msgtxt");
			
			$buffer = curl_exec($ch);
                        curl_close($ch);
          
        
         
    }

}
?>
