<?php
require 'connectDB.php';

$idCategory = 1;
$enterMinPrice = 0;
$enterMaxPrice = 3000000;

function filte_category_price(PDO $dbh, int $idCategory, int $minPrice, int $maxPrice){

    try {
        $dbh->query("
           ALTER TABLE `products` ADD INDEX `productsIndex` (`product`); 
        ");
        $query_result = $dbh->prepare("
        SELECT `products`.`product` as `product`
        FROM `products`
        JOIN
            `categories` ON  `products`.`category_id` = `categories`.`id`
        WHERE 
            `categories`.`id` = :idCategory
            AND
            `products`.`price` >= :min_price
            AND 
            `products`.`price` <= :max_price
");

        $query_result->execute(array(
            ':idCategory' => $idCategory,
            ':min_price' => $minPrice,
            ':max_price' => $maxPrice
        ));
        while ($row = $query_result->fetchColumn()){
            echo $row . "\n";
        }
    } catch (PDOException $e) {
        echo  $e->getMessage();
    }
}

filte_category_price(connectBD(), $idCategory, $enterMinPrice, $enterMaxPrice);