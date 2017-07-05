<?php
set_time_limit(0);
ini_set('error_reporting', E_ERROR);
register_shutdown_function("fatal_handler");
function fatal_handler() {
    $error = error_get_last();
    echo("<pre>");
    print_r($error);
}

/*echo dirname(__FILE__);
die("werwrwe");*/


if(!file_exists("app/Mage.php")) {

	exit('<HTML><HEAD><TITLE>404 Not Found</TITLE></HEAD><BODY><H1>Not Found</H1>Please ensure that this file is in the root directory, or make sure the path to the directory where the configure.php file is located is defined corectly above in $path_include variable</BODY></HTML>');

}

else {

	require_once 'app/Mage.php';

	Mage::app();

}
$fx = fopen('options.csv', 'w');
$read = "sku,name,price,options,options,";
fputcsv($fx,explode(",",$read));

$products = Mage::getModel('catalog/product')->getCollection()->addAttributeToFilter('status', array('eq' => 1));

foreach($products as $product){
	$i = 1;
	
	$product = Mage::getModel("catalog/product")->load($product->getId()); //product id
	$onp = '';
	if(count($product->getOptions())){
		foreach ($product->getOptions() as $o) {
			
				$values = $o->getValues();
				$optn = $o->getTitle().':';
				foreach ($values as $v) {
					//print_r($v->getData());
					$optn = $optn.$v->getData('title')."=>".number_format($v->getData('price'), 2, '.', ',').";";
				}
				$onp = $onp.$optn."##";
				$i++;
				//echo "<br/>";
			
	}
	$read_admin = $product->getSku()."##".$product->getName()."##".''."##".$onp;
	fputcsv($fx,explode("##",$read_admin));
	
	}else{
		$read_admin = $product->getSku()."##".$product->getName()."##".$product->getFinalPrice()."##".''."##".'';
		fputcsv($fx,explode("##",$read_admin));
	}
	
	
}
fclose($fx);
echo "Done";