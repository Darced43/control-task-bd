<?php
    function connectBD ()
    {
        try{
            return new PDO(
                'mysql:host=localhost;dbname=control task 2',
                'root',
                '123456',
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    };