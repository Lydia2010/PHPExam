<?php
 class Pages extends Controller {
    public function __construct(){
    }

    public function index(){
        $data = [
            'title' => 'SharePosts',
            'description'=>'Simple social network build on TraversyMVC PHP framework'
        ];
        $this->view('../views/pages/index', $data);
    }

    public function about(){
        $data = [
            'title' => 'About Us',
            'description'=>'App to share posts with other users'
        ];

        $this->view('../views/pages/about', $data);
    }
}
