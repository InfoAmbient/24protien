<?php

$this->startSetup();

// Custom Option Image - Custom Options Images
$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'image', 'TEXT NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option_title'), 'class', 'TEXT NULL');
$this->getConnection()->addColumn($this->getTable('catalog/product_option_type_value'), 'class', 'TEXT NULL');


$this->endSetup();