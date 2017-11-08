<?php
// Ingest products file
$products = [];
$fileHandle = fopen("input/products.tab", "r");

while (($data = fgetcsv($fileHandle, 1000, "\t")) !== FALSE) {
    $products[$data[0]] = $data[1];
}

// Ingest sales file
$sales = [];
$fileHandle = fopen("input/sales.tab", "r");

while (($data = fgetcsv($fileHandle, 1000, "\t")) !== FALSE) {
    $sales[$data[0]] = $data[1];
}

// Calculate average sales prices
$salesByCategory = [];
foreach ($sales as $product => $sale) {
    if (isset($products[$product])) { // Looks like we've got some uncategorised sales
        $category = $products[$product];
    
        $salesByCategory[$category][] = $sale;
    }
}

// Get the max from the $salesByCategory array
$maxAvgSalesByCategory = null;
foreach ($salesByCategory as $category => $sales) {
    $avgSales = array_sum($sales) / count($sales);
    
    if (is_null($maxAvgSalesByCategory) or $maxAvgSalesByCategory['avgSales'] < $avgSales) {
        $maxAvgSalesByCategory = [
            'category' => $category,
            'avgSales' => $avgSales,
        ];
    }
}

// Find the min and max sales in the breakfast category
$breakfastSales = [
    'min' => min($salesByCategory['Breakfast']),
    'max' => max($salesByCategory['Breakfast']),
];

// Echo the results
echo "\n\n";
echo "What category has the highest average sales price? (Please include the average sale price)?\n";
echo "Category: {$maxAvgSalesByCategory['category']}\nPrice: {$maxAvgSalesByCategory['avgSales']}\n\n\n";

echo "What is the minimum and maximum sale in the category 'Breakfast'?\n";
echo "Min: {$breakfastSales['min']}\nMax: {$breakfastSales['max']}\n\n\n";