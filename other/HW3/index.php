<?php

require "DB.php";
require "./vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);


    $pictures = [];
    $one_picture = null;
    
    $result = DB::getInstance()->getAllRow(DB::GALERY_TABEL);
    foreach ($result as $row) {
        $pictures[] = $row;
    }


    if (isset($_GET['id'])) {
        foreach ($pictures as $picture){
            if ((int)$picture['id'] === (int)$_GET['id']) {
                $one_picture = $picture;
            }
        }
    }

    echo $twig->render('index.twig', [
            'pictures' => $pictures,
            'one_picture' => $one_picture,
        ]
    );
