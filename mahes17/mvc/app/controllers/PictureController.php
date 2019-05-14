<?php

class PictureController extends Controller
{

	public function index()
	{
		$viewbag = $this->model('Picture')->getAllPictures();
		$this->view('picture/index', $viewbag);
	}
}
