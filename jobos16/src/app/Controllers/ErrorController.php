<?php

namespace App\Controllers;

use App\Core\ViewRenderer\View;

class ErrorController extends Controller
{

    public function notFound()
    {
        return View::create('errors.404');
    }

}