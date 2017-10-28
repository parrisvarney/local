<?php

namespace Questions;

class Parser {
    private $_dbh = null;

    function __construct($dbh) {
        $this->_dbh = $dbh;
    }

    function parseProducts() {
        $products   = [];
        $fileHandle = fopen("input/products.tab", "r");

        $preparedQuery = $this->_dbh->prepare("INSERT INTO products (product, category) VALUES (?, ?)");
        
        while (($data = fgetcsv($fileHandle, 1000, "\t")) !== FALSE) {
            $preparedQuery->execute($data);
        }
    }

    function parseSales() {
        $sales      = [];
        $fileHandle = fopen("input/sales.tab", "r");

        $preparedQuery = $this->_dbh->prepare("INSERT INTO sales (product, sales) VALUES (?, ?)");
        
        while (($data = fgetcsv($fileHandle, 1000, "\t")) !== FALSE) {
            $preparedQuery->execute($data);
        }
    }
}