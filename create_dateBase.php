<?php
    try{
        $createdDbh = new PDO(
            'mysql:host=localhost',
            'root',
            '123456',
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
        $createdDbh->query("CREATE DATABASE IF NOT EXISTS `control task 2`");
    }
    catch (PDOException $e){
        echo $e->getMessage();
        die();
    }


try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=control task 2',
        'root',
        '123456',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
    $dbh->query("

        CREATE TABLE IF NOT EXISTS `categories`(
            `id` int(11) unsigned NOT NULL auto_increment,
            `category` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
        INSERT INTO `categories` (`id`, `category`) 
        VALUES
            (1, 'резиновые'),
            (2,'шерстяные'),
            (3,'каучуковые'),
            (4,'бархатные'),
            (5,'кожаные');
    

        CREATE TABLE IF NOT EXISTS `products`(
            `id` int(11) unsigned NOT NULL auto_increment,
            `product` varchar(255) NOT NULL,
            `category_id` int(11) unsigned NOT NULL,
            `price` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
                ON UPDATE CASCADE
                ON DELETE RESTRICT 
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO `products` (`id`, `product`, `price`, `category_id`)
        VALUES 
            (1, 'шлёпки', 250, 3 ),
            (2, 'тапки', 1500, 2 ),
            (3, 'сапоги', 9500, 1 ),
            (4, 'тяги', 3000000, 4 ),
            (5, 'кроксы', 4000, 1 ),
            (6, 'ботинки', 7000, 5 ),
            (7, 'валенки', 10000, 2 ),
            (8, 'кросовки', 3000, 3 );


        CREATE TABLE IF NOT EXISTS `stock` (
            `id` int(11) unsigned NOT NULL auto_increment,
            `product_id` int(11) unsigned NOT NULL,
            `count` int(11) unsigned DEFAULT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
                ON UPDATE CASCADE
                ON DELETE RESTRICT 
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO `stock` (`id`, `product_id`, `count`)
        VALUES 
            (1,1,100),
            (2,2,50),
            (3,3,100),
            (4,4,3),
            (5,5,404),
            (6,6,301),
            (7,7,500),
            (8,8,1000);
        

        CREATE TABLE IF NOT EXISTS `clients` (
            `id` int(11) unsigned NOT NULL auto_increment,
            `name` varchar(255) NOT NULL,
            `mail` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO `clients` (`id`, `name`, `mail`)
        VALUES 
            (1, 'Вася', 'vasia@mail.ru'),
            (2, 'Игорь', 'igor@gmail.com'),
            (3, 'Саша', 'sasha@mail.ru'),
            (4, 'Люда', 'lyada@yandex.ru'),
            (5, 'Гера', 'gera@mail.ru'),
            (6, 'Боря', 'bor@mail.ru'),
            (7, 'Абубакар', 'abrakadabra@gmail.com');


        CREATE TABLE IF NOT EXISTS `orders_clients` (
            `id` int(11) unsigned NOT NULL auto_increment,
            `name_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`name_id`) REFERENCES `clients` (`id`)
                ON UPDATE CASCADE
                ON DELETE RESTRICT 
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO `orders_clients` (`name_id`)
        VALUES 
            (7),
            (6),
            (2),
            (1),
            (1),
            (6),
            (3),
            (5),
            (4);


        CREATE TABLE IF NOT EXISTS `positions` (
            `id` int(11) unsigned NOT NULL auto_increment,
            `product_id` int(11) unsigned NOT NULL,
            `count_prod` int(11) unsigned DEFAULT NULL,
            `date` DATE DEFAULT NULL,
            `order_id` int(11) unsigned NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
                ON UPDATE RESTRICT
                ON DELETE RESTRICT,
            FOREIGN KEY (`order_id`) REFERENCES `orders_clients` (`id`)
                ON UPDATE CASCADE
                ON DELETE RESTRICT 
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;

        INSERT INTO `positions` (`id`, `product_id`, `count_prod`, `date`, `order_id`)
        VALUES 
            (1, 3, 1, '2024-01-10', 1),
            (2, 2, 1, '2024-01-10', 1),
            (3, 1, 10, '2024-01-17', 2),
            (4, 1, 3, '2024-01-17', 2),
            (5, 1, 2, '2024-01-17', 2),
            (6, 3, 20, '2024-01-25', 3),
            (7, 4, 1, '2024-01-25', 3),
            (8, 3, 9, '2024-01-25', 3),
            (9, 2, 3, '2024-01-25', 3),
            (10, 8, 11, '2024-01-25', 3),
            (11, 5, 5, '2024-02-11', 4),
            (12, 6, 8, '2024-02-11', 4),
            (13, 7, 10, '2024-02-11', 4),
            (14, 8, 4, '2024-02-16', 5),
            (15, 7, 5, '2024-02-16', 5),
            (17, 5, 3, '2024-02-16', 5),
            (18, 8, 2, '2024-02-22', 6),
            (19, 3, 2, '2024-02-22', 6),
            (20, 1, 1, '2024-02-22', 6),
            (21, 2, 11, '2024-03-11', 7),
            (22, 2, 9, '2024-03-11', 7),
            (23, 1, 4, '2024-03-11', 7),
            (24, 8, 8, '2024-03-21', 8),
            (25, 7, 1, '2024-03-21', 8),
            (26, 6, 11, '2024-04-22', 9),
            (27, 5, 28, '2024-04-22', 9),
            (28, 8, 1, '2024-04-22', 9);
    ");

} catch (PDOException $e) {
    echo $e->getMessage();
}