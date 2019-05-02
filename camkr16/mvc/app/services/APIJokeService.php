<?php
/**
 * Created by IntelliJ IDEA.
 * User: Ejer
 * Date: 25-04-2019
 * Time: 18:25
 */

namespace services;


class APIJokeService
{
    function getJoke()
    {
        $jokeJson = file_get_contents("http://api.icndb.com/jokes/random");
        $joke = json_decode($jokeJson, true);
        $jokeText = $joke["value"]["joke"];

        return $jokeText;
    }


}