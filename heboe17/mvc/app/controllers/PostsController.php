<?php
class PostsController extends Controller {
	
	private $amount=20;
	
	public function index () {
		$post = $this->model('Post');
		
		$viewbag['Posts'] = $post->getPosts($this->amount,0);
		
		$this->view('home/Posts', $viewbag);
	}
	
	public function ajaxPostLoader($offset){
		$offset = filter_var($offset, FILTER_SANITIZE_NUMBER_INT);
		
		$post = $this->model('Post');
		
		$viewbag['Posts'] = $post->getPosts($this->amount, $offset*$this->amount);
	
		$this->view('partials/Posts', $viewbag);	
	}
}