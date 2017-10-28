<?php

use PHPUnit\Framework\TestCase;

use Questions\Db;
use Questions\Parser;

final class ParserTest extends TestCase {
    private $_dbh = null;

    public function setUp() {
        $db         = new Db();
        $this->_dbh = $db->getDbHandle();

        $db->init();
    }

    /**
     * Tests that the parsers are adding at least one record to the
     * appropriate tables.
     *
     * @dataProvider parserTestProvider
     */
    public function testParseProducts($parseMethod, $table) {
        $parser = new Parser($this->_dbh);

        $query = $this->_dbh->exec("DELETE FROM $table");

        $parser->$parseMethod();

        $query = $this->_dbh->prepare("SELECT COUNT(*) AS count FROM $table");
        $query->execute();
        $records = $query->fetch()['count'];

        $this->assertGreaterThan(0, $records); 
    }

    public function parserTestProvider() {
        return [
            ['parseProducts', 'products'],
            ['parseSales', 'sales']
        ];
    }
}