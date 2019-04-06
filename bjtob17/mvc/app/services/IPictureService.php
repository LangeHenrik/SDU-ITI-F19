<?php


namespace app\services;


interface IPictureService
{
    function uploadImage($image): int;
}