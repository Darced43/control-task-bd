<?php
    require 'connectDB.php';
    function getRequest(PDO $dbn, int $id){
        try{
            $prod = $dbn->prepare("
                SELECT * 
                FROM products
                WHERE products.id = ?
                ;
            ");
            $prod->execute([$id]);
            $prod->setFetchMode(PDO::FETCH_ASSOC);
            return $row = $prod->fetch();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    };

$result = getRequest(connectBD(), 3);
$idProduct = $result['id'];
$idCategory = $result['category_id'];
$priceProd = $result['price'];
    function scanProd(PDO $dbn, $idConsist, $priceProd){
        try{
            $prod = $dbn->prepare("
                SELECT product, `products`.price as `price`
                FROM `products`
                WHERE `products`.category_id = ?
                GROUP BY `product`, `price`
                ORDER BY ABS(`products`.price - ?) ASC LIMIT 2
                ;
            ");
            $prod->execute([$idConsist, $priceProd]);
            $prod->setFetchMode(PDO::FETCH_ASSOC);
            while($row = $prod->fetch()){
                echo $row['product'] . " " . $row['price'] . "\n";
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

scanProd(connectBD(), $idCategory, $priceProd);