<?php

namespace Questions;

class CodingQuestions {
    private $_dbh = null;

    public function __construct($dbh) {
        $this->_dbh = $dbh;
    }

    public function whatCategoryHasTheHighestAverageSalesPrice() {
        $answer = $this->_dbh->prepare("
            SELECT   p.category, AVG(s.sales) AS highestAvgSales 
            FROM     products p
            JOIN     sales s
            USING    (product)
            GROUP BY p.category
            ORDER BY highestAvgSales DESC
            LIMIT    1");
        $answer->execute();

        return $answer->fetch();
    }

    public function whatIsTheMinAndMaxSaleInBreakfastCategory() {
        $answer = $this->_dbh->prepare("
            SELECT   p.category, MIN(s.sales) AS minBreakfastSales, MAX(s.sales) AS maxBreakfastSales
            FROM     products p
            JOIN     sales s
            USING    (product)
            WHERE    p.category = 'Breakfast'
            GROUP BY p.category");
        $answer->execute();

        return $answer->fetch();
    }
}