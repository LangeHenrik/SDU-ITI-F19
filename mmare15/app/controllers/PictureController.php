<?php
/**
 * Created by PhpStorm.
 * User: matiasmarek
 * Date: 02/05/2019
 * Time: 11.03
 */

namespace controllers;

class PictureController extends Controller {

    // private $amountOfPictures = 20;

    public function index ($param) {

    }

    public function all(){
        $viewbag['pictures'] = $this->model('Picture')->getAllPictures();
        $this->view('picture/all', $viewbag);
    }

    /**
     * lets the controller handle the amount of pictures showed or retrieved from the model.
     * as of now it is handled by the model, however i don't believe this is the right way to do it.
     */
    public function getAmountOfPictures() {

    }
}