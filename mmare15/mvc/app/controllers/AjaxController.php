<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 09/05/2019
 * Time: 12.12
 */

namespace controllers;
use core\Controller;
use models\AjaxModel;



class AjaxController
{

    public function ajax_call($q){
        $ajaxModelobj = new AjaxModel();
        $city = $ajaxModelobj->getCitys();

        // get the q parameter from URL
        //$q = $_REQUEST["q"];

        $hint = "";

// lookup all hints from array if $q is different from ""

        if ($q !== "") {
            $q = strtolower($q);
            $len=strlen($q);
            foreach($city as $name) {
                if (stristr($q, substr($name, 0, $len))) {
                    if ($hint === "") {
                        $hint = $name;
                    } else {
                        $hint .= ", $name";
                    }
                }
            }
        }

// Output "no suggestion" if no hint was found or output correct values
        echo $hint === "" ? "no suggestion" : $hint;
    }
}