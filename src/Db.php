<?php

namespace Questions;

use \PDO;

class Db {
    private $_db = null;

    public function __construct($db = null) {
        $this->_db = $db ?? new PDO('sqlite::memory:');
        $this->_db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    
    public function init() {
        $this->_db->exec("CREATE TABLE products (id INTEGER, product varchar(256), category varchar(256), primary key (id))");
        $this->_db->exec("CREATE TABLE sales (id INTEGER, product varchar(256), sales number(10,2), primary key (id))");
    }

    public function getDbHandle() {
        return $this->_db;
    }
}