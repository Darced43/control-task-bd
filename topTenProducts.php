<?php
    require 'connectDB.php';

    $enterNumTop = 10;
    function getTopProducts (PDO $dbh, int $numTop){
        try {
            $top_products = $dbh->prepare("
            SELECT `product` as `prod`, SUM(`positions`.`count_prod`) as `sum`
            FROM `positions` 
            JOIN 
            `products` ON `positions`.`product_id` = `products`.`id`
            GROUP BY `positions`.`product_id`
            ORDER BY `sum` DESC LIMIT :limit; 
        ");

            $top_products->bindValue(':limit', $numTop, PDO::PARAM_INT);
            $top_products->execute();
            $top_products->setFetchMode(PDO::FETCH_ASSOC);
            $tops = $top_products->fetchAll();
            foreach($tops as $top ){
                echo $top['prod'] . "\n";
                echo $top['sum'] . "\n";
            };
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    };

    getTopProducts( connectBD(),$enterNumTop);