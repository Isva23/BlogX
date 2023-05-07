<?php

    namespace Controllers;

    use Models\posts;
    use Controllers\auth\LoginController as LoginController;

    class PostController{
        private $userId;
        private $title;
        private $body;
        public function __construct(){
            $ua = new LoginController();
            $ua->sessionValidate();
            $this->userId = $ua->id;
        }
        public function getPosts($limit="", $pid = ""){
            $posts = new posts();
            $result = $posts->select(['a.id','a.title','a.body','date_format(a.created_at, "%d/%m/%y") as fecha', 'b.name']) ->join('user b','a.userId=b.id')
            ->where( $pid != "" ? [['a.id', $pid]] : [] )
            ->orderBy([['a.created_at', 'DESC']])
            ->limit($limit)
            ->get();

            return $result;
        }
        public function newPost($datos){
            $post = new posts();
            $post->valores=[$this->userId,$datos['title'],$datos['body']];
            $result = $post->create();
            return;
            die;
        }
        public function getMyPosts($uid){
            $posts = new posts();
            $result = $posts->where([['userId', $this->userId]])->get();
            return $result;
        }
        
        public function deleteP($id){
            $post = new posts();
            $result = $post->delete($id);
            return $result;
		}
        public function editPost($datos){
            $post = new posts();
            $id = $datos['id'];
            $uid = $this->userId;
            $titulo = $datos['title'];
            $body = $datos['body'];
            $result = $post->update($id,$uid,$titulo,$body);
            return;
            die;
        }
        /*public function editPost($datos){
            $post = new posts();
            $id = $datos['id'];
            $post->valores=[$this->userId,$datos['title'],$datos['body']];
            $result = $post->update($id);
            return;
            die;
        }*/

    }
    