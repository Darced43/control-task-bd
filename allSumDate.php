<?php
    require 'connectDB.php';

    $year = '2024';
    $month = '03';

    try {
        function getAllSum(PDO $dbh, string $year, string $month, ){
            $allPrice = $dbh->prepare("
                SELECT 
                    `product` as `prod`, (SUM(`positions`.count_prod) * `products`.price )as `sum`
                FROM `positions`
                JOIN 
                    `products` ON `positions`.product_id = `products`.id
                WHERE YEAR(`date`) = ? AND MONTH(`date`) = ?
                GROUP BY `positions`.product_id;
        ");
            $allPrice->execute([$year, $month]);
            $allPrice->setFetchMode(PDO::FETCH_ASSOC);
            $prices = $allPrice->fetchAll();
            foreach ($prices as $price){
                echo $price['prod'] . "\n";
                echo $price['sum'] . "\n";
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }

getAllSum(connectBD(), $year, $month);



