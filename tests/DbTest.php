<?php

use PHPUnit\Framework\TestCase;

use Questions\Db;

final class DbTest extends TestCase {
    private $_pdoMock = null;

    public function setUp() {
        $this->_pdoMock = $this
            ->getMockBuilder('PDO')
            ->disableOriginalConstructor()
            ->setMethods(['setAttribute', 'exec'])
            ->getMock();
    }

    /**
     * Tests that the products table is created on init()
     */
    public function testProductTableCreatedOnInit() {
        $this->_pdoMock
            ->expects($this->at(1))
            ->method('exec')
            ->with($this->stringContains('CREATE TABLE products'));

        $db = new Db($this->_pdoMock);
        $db->init();
    }

    /**
     * Tests that the sales table is created on init()
     */
    public function testSalesTableCreatedOnInit() {
        $this->_pdoMock
            ->expects($this->at(2))
            ->method('exec')
            ->with($this->stringContains('CREATE TABLE sales'));

        $db = new Db($this->_pdoMock);
        $db->init();
    }

    /**
     * Tests that the correct Db handle is returned
     */
    public function testDbHandleIsReturned() {
        $db = new Db($this->_pdoMock);

        $expected = $db->getDbHandle();

        $this->assertSame($this->_pdoMock, $expected, 'Db::getDbHandle does not return the expected DB handle.');
    }
}