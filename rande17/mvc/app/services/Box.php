<?php

class Box
{

    function getLeftBox($content)
    {
        return "<div class='left-content'>" . $content . "</div>";
    }

    function getMainBox($content, $type = "", $id = "")
    {
        // var_dump($content);
        if ($type == "image" || $type == "imgnodiv") {
            $con = "";
            var_dump($content);
            for ($i = 0; $i < count($content); $i++) {
                $con .= "<div id='image' class='imgdiv'><img class='imgpage' src='" . base64_decode($content[$i]['blob']) . "' alt='" . $content[$i]['name'] . "'></img></div>";
            }
            $content = $con;
        } elseif ($type == "string") {
            $con = "<table><th>ID</th><th>name</th>";
            for ($i = 0; $i < count($content); $i++) {
                $con .= "<tr><td>" . $content[$i]['id'] . "</td><td>" . $content[$i]['name'] . "</td></tr>";
            }
            $con .= "</table>";
            $content = $con;
        }
        if ($type != "imgnodiv") {
            return "<div class='main-content' id='" . $id . "'>" . $content . "</div>";
        } else {
            return $content;
        }
    }

    function getRightBox($content)
    {
        return "<div class='right-content'>" . $content . "</div>";
    }

    function getTitle($name)
    {
        return "<div class='title'>" . $name . "</div>";
    }
}