<?php
require("model.php");

class Index{
        private $indexVal;
        
        function __construct(){       
            $this->indexVal = array(
            //Format is indexVal => function/page
                "home" => "homePage",
                "me" => "aboutPage",
                "projects" => "projectsPage",
                "blog" => "blogPage",
                "encode" => "encodePage",
                "rot" => "Rot13",
                "post" => "postNew",
                "postblog" => "postPage"
            );
        }
        
        public function searchIndex($query){
            return $this->indexVal[$query];
        }
}
class Controller{        
        private $index;
        private $model;
        function __construct(){
            $this->index = new Index();
            $this->model = new Model();              
            $multparams = false;
			$page = $_GET['page'];
            $loading = $this->index->searchIndex($page);
			$this->$loading($multparams);
        }        
 
		private function loadView($view, $data){
            if(is_array($data)){
                extract($data);
            }
            require("Views/" . $view . ".php");
        }

        private function loadPage($view, $data){
            $this->loadView("header", array());
			$this->loadView($view, $data);
		}

        private function redirect($url){
            header("Location: /" . $url);
        }

        private function homePage(){
            $this->loadPage("home", array());     
        }

        private function aboutPage(){
            $this->loadPage("aboutme", array());     
        }

        private function projectsPage(){
            $this->loadPage("projects", array());     
        }

        private function postPage(){
            $this->loadPage("postblog", array());     
        }

        private function blogPage(){
            $postfeed = $this->model->getBlogPosts();           
            $this->loadPage("blog", array("postfeed" => $postfeed));   
        }

        private function encodePage(){
            $encoded = "Placeholder";
            $this->loadPage("encode", array('encoded' => $encoded));     
        }

		private function Rot13(){
			$text = $_POST['text'];
			$encoded = 	$this->model->encode($text);
			$this->loadPage("encode", array('encoded' => $encoded));
		}

        private function postNew(){
            $post = $_POST['post'];
            $this->model->postBlog($post);
            $this->redirect("blog");
        }

}
