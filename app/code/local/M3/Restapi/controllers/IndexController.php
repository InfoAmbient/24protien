<?php

class M3_Restapi_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $apiUrl = 'https://www.24protein.com/api/rest/';
        $consumerKey = '6c614abd769bdcbe6be4b3853c7dea92';
        $consumerSecret = 'b7a98e3f5d502750627c5d01dfbc5408';

        $oauthaa = Mage::getModel('oauth/token')->getCollection()
                ->addFieldToFilter('verifier', array('neq' => 'NULL'))
                ->addFieldToFilter('admin_id', array('neq' => 'NULL'))
                ->getFirstItem();

//        echo "<pre>";
//        print_r($oauthaa->getData());
//        die;

        try {
            $oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_AUTHORIZATION);
            $oauthClient->enableDebug();
            $oauthClient->setToken($oauthaa->getToken(), $oauthaa->getSecret());

            //check customer login
            //$oauthClient->fetch($apiUrl . "customerlogin/testambient123@gmail.com/123456", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //register a customer
//            $resgistercus = json_encode(array(
//                'firstname' => 'test',
//                'lastname' => 'ambient',
//                'email' => 'test@gmail.com',
//                'password' => '123456',
//                'website_id' => '1',
//                'group_id' => '1',
//                'dob' => '05/16/1988',
//                'gender' => '1',
//            ));
//            $oauthClient->fetch($apiUrl . "customers", $resgistercus, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //load wishlist items
            //$oauthClient->fetch($apiUrl."wishlist/34", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //product search api
            //$oauthClient->fetch($apiUrl."searchproduct/test", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //home menu list
            //$oauthClient->fetch($apiUrl . "homemenu", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //check customer exist
            //$oauthClient->fetch($apiUrl."customercheck/testambient123@gmail.com", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //check forget password
            //$oauthClient->fetch($apiUrl . "forgetpwd/testambient123@gmail.com", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //get category sort options
            //$oauthClient->fetch($apiUrl . "categorysort/141", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //get product from category id
            //$oauthClient->fetch($apiUrl . "products?category_id=141&order=name&dir=asc&page=2", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //get product details
            //$oauthClient->fetch($apiUrl . "products/341", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //get a cart
//            $oauthClient->fetch($apiUrl . "createcart", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
//            $cartarr = json_decode($oauthClient->getLastResponse());
//            $cartid = $cartarr->id;
            //set customer to cart 
//            $cartcust = json_encode(array(
//                'userid' => 107,
//                'cartid' => $cartid,
//            ));
//            $oauthClient->fetch($apiUrl . "customercart", $cartcust, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //get previous cart
//            $oauthClient->fetch($apiUrl . "customercart/107", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
//            $cartarr = json_decode($oauthClient->getLastResponse());
//            $cartid = $cartarr->id;

            //register a address to customer
//            $regaddr = json_encode(array(
//                'firstname' => 'test',
//                'lastname' => 'ambient',
//                'street' => array('Safoot P. O. Box 10','test1'),
//                'city' => 'Amman',
//                'country_id' => 'IQ',
//                'region' => 'Al-Anbar',
//                'postcode' => '19278',
//                'telephone' => '1234567890',
//                'is_default_billing' => '1',
//                'is_default_shipping' => '1',
//            ));
//            $oauthClient->fetch($apiUrl . "customers/107/addresses", $regaddr, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //get all address of a customer
            //$oauthClient->fetch($apiUrl . "customers/93/addresses", $regaddr, 'GET', array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //country list
            //$oauthClient->fetch($apiUrl . "countrylist", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //Region list
//            $oauthClient->fetch($apiUrl . "regionlist/IQ", array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => ' */*'));
            //register billing address to cart
//            $cartaddr = json_encode(
//                    array(
//                        'mode' => 'billing',
//                        //'addressid' => '29',
//                        'firstname' => 'test',
//                        'lastname' => 'ambient',
//                        'street' => array('Safoot P. O. Box 10', 'test1'),
//                        'city' => 'Amman',
//                        'country_id' => 'IQ',
//                        'region' => 'Al-Anbar',
//                        'postcode' => '19278',
//                        'telephone' => '1234567890',
//            ));
//            $oauthClient->fetch($apiUrl . "addresstocart/" . $cartid, $cartaddr, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //register shipping address to cart
//            $cartaddr = json_encode(
//                    array(
//                        'mode' => 'shipping',
//                        //'addressid' => '29',
//                        'firstname' => 'test',
//                        'lastname' => 'ambient',
//                        'street' => array('Safoot P. O. Box 10', 'test1'),
//                        'city' => 'Amman',
//                        'country_id' => 'IQ',
//                        'region' => 'Al-Anbar',
//                        'postcode' => '19278',
//                        'telephone' => '1234567890',
//            ));
//            $oauthClient->fetch($apiUrl . "addresstocart/" . $cartid, $cartaddr, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //add a product to cart
//            $prodcart = json_encode(
//                    array(
//                        'product_id' => "341",
//                        'qty' => '1',
//                        'options' => array('953' => '1633', '121' => '2979'),
//                    )
//            );
//            $oauthClient->fetch($apiUrl . "producttocart/" . $cartid, $prodcart, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => '*/*'));

            //update a address 
//            $updateaddr = json_encode(array(
//                'firstname' => 'test1',
//                'lastname' => 'ambient1',
//                'street' => array('Safoot1 P. O. Box 11','test2'),
//                'city' => 'Amman test',
//                'postcode' => '19279',
//                'telephone' => '1234567897',
//            ));
//            $oauthClient->fetch($apiUrl . "customers/addresses/21", $updateaddr, 'PUT', array('Content-Type' => 'application/json', 'Accept' => '*/*'));
            //add a product to wishlist
//            $wishlistreq = json_encode(array(
//                'userid' => 34,
//                'prdid' => 236,
//            ));
            //$oauthClient->fetch($apiUrl . "wishlist", $wishlistreq, OAUTH_HTTP_METHOD_POST, array('Content-Type' => 'application/json', 'Accept' => '*/*'));

            echo "<pre>";
            print_r(json_decode($oauthClient->getLastResponse()));
        } catch (OAuthException $e) {
            print_r($e);
        }
    }

}
