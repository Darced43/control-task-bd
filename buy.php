<?php
require 'connectDB.php';

$idClient = NULL;
$mail = 'igor@gmail.com';
$idOrder = NULL;

function getId($dbh, string $mail, &$idClient){
    $dbh->beginTransaction();
    try{
        $getIdClient = $dbh->prepare("
            SELECT id FROM clients WHERE `clients`.mail = ? FOR SHARE;
        ");
        $getIdClient->execute([$mail]);
        $getIdClient->setFetchMode(PDO::FETCH_ASSOC);
        if ($row = $getIdClient->fetch()) {
            $idClient = $row['id'];
        }
        $dbh->commit();
    }catch (PDOException $e){
        echo $e->getMessage();
    }
};

function createOrderClient($dbh, &$idClient){
    $dbh->beginTransaction();
    try{
        $newOrder = $dbh->prepare("
            
            INSERT INTO `orders_clients` (`name_id`)
            VALUES (?);
            
        ");
        $newOrder->execute([$idClient]);
        $dbh->commit();
    }catch (PDOException $e){
        echo $e->getMessage();
    }
};

function getIdOrderId($dbh, &$idOrder){
    $dbh->beginTransaction();
    try {
        $newOrder = $dbh->query("   
            SELECT  id 
            FROM `orders_clients`
            ORDER BY `id` DESC LIMIT 1
            FOR SHARE;
        ");
        $newOrder->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $newOrder->fetch()) {
            $idOrder = $row['id'];
        }
        $dbh->commit();
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

function createOrder($dbh, int $enterProd, int $enterCount, $idOrder){
    $dbh->beginTransaction();
    try{
        $newPosition = $dbh->prepare("
            INSERT INTO `positions` (`product_id`, `count_prod`,`date`, `order_id`)
            VALUES (:product, :count, NOW(), :order);
        ");
        $newPosition->execute(array(
            ':product' => $enterProd,
            ':count' => $enterCount,
            ':order' => $idOrder
        ));
        $updateStock = $dbh->prepare("
            UPDATE `stock`
            SET `count` = `count` - :count
            WHERE `product_id` = :product
        ");
        $updateStock->execute(array(
            ':count' => $enterCount,
            ':product' => $enterProd
        ));
        $dbh->commit();
    }catch (PDOException $e){
        echo $e->getMessage();
        $dbh->query("
            ROLLBACK;
        ");
    }
};


getId(connectBD(), $mail, $idClient);
createOrderClient(connectBD(),$idClient);
getIdOrderId(connectBD(),$idOrder);
createOrder(connectBD(), 1, 1, $idOrder);
createOrder(connectBD(), 2, 1, $idOrder);
createOrder(connectBD(), 3, 1, $idOrder);
createOrder(connectBD(), 4, 1, $idOrder);
createOrder(connectBD(), 5, 1, $idOrder);
createOrder(connectBD(), 6, 1, $idOrder);
createOrder(connectBD(), 7, 1, $idOrder);
createOrder(connectBD(), 8, 1, $idOrder);