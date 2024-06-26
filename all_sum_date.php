<?php

require 'connectDB.php';

function getAllSum(PDO $dbh){
    try {
            $allPrice = $dbh->query("
                SELECT 
                    YEAR(`positions`.date) as `year`, 
                    MONTH(`positions`.date) as `month`,
                    SUM(`positions`.count_prod * `products`.price) as `sum`
                FROM `positions`
                JOIN 
                    `products`ON `positions`.product_id = `products`.id
                GROUP BY `year`, `month`;
            ");
            $allPrice->setFetchMode(PDO::FETCH_ASSOC);
            $prices = $allPrice->fetchAll();
            foreach ($prices as $price) {
                echo $price['year'] . "-" . $price['month'] . " " . $price['sum'] . "\n";
            };
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

getAllSum(connectBD());



