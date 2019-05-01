<?php

class ContactController extends Controller {
	
	public function index () {
		//This is a proof of concept - we do NOT want HTML in the controllers!
		
		$this->view('contact/contact');
	}

}