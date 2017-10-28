<?php

require 'vendor/autoload.php';

use Questions\Db;
use Questions\Parser;
use Questions\CodingQuestions;

$db = new Db();
$db->init();

$parser = new Parser($db->getDbHandle());
$parser->parseProducts();
$parser->parseSales();

$questions = new CodingQuestions($db->getDbHandle());
$question1 = $questions->whatCategoryHasTheHighestAverageSalesPrice();
$question2 = $questions->whatIsTheMinAndMaxSaleInBreakfastCategory();

echo "\n\n";
echo "What category has the highest average sales price? (Please include the average sale price)?\n";
echo "Category: {$question1['category']}\nPrice: {$question1['highestAvgSales']}\n\n\n";

echo "What is the minimum and maximum sale in the category 'Breakfast'?\n";
echo "Min: {$question2['minBreakfastSales']}\nMax: {$question2['maxBreakfastSales']}\n\n\n";