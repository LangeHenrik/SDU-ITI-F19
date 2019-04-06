<?php


namespace app\service;


interface IPictureService
{
    function uploadImage($image): int;
}