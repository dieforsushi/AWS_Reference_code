<?php
    ini_set('error_reporting',E_ALL);
    ini_set('display_errors','on');   
    include 'beer.php';
    include'functions.dat';
//To change this license header, choose License Headers in Project Properties.
//To change this template file, choose Tools | Templates
//and open the template in the editor.
//Author: Wenrui Sun & Maggie Hinshaw 

    //check if the user press submit, if pressed then it would check for validation
    if (array_key_exists("submit_button",
                    $_POST)) {
        $has_erros = FALSE;
        $all_total_is0 = TRUE;
        for ($i = 0;
                $i < count($types_of_beers);
                $i++) {
            $quantity_string = $_POST["quantity"][$i];
            $quantity_error[$i] = validate_quantity($quantity_string);

            if (!empty($quantity_error[$i])) {
                $has_erros = TRUE;
            }
            if ($quantity_string != 0) {
                $all_total_is0 = FALSE;
            }
        }
//check if the total amount is 0 if so then show error to user
        if ($all_total_is0) {
            print "Brah, pls buy somethin";
            display_products($types_of_beers);
        }
//redirect the user to login.php
        else if ($has_erros == FALSE) {
            $qstring = http_build_query(array('quantity' => $_POST['quantity']));
            header("location: user_login.php?$qstring");
            exit('There was an error loading login.php');

        } else {

            display_products($types_of_beers,
                    $quantity_error);
        }
    } else {
        display_products($types_of_beers);
    }
    ?> 

