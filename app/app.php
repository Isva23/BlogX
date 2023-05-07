<?php

namespace app;

require_once 'autoloader.php';

use Controllers\auth\LoginController as LoginController;
use Controllers\PostController as PostController;

if(!empty($_POST)){


    //******LOGIN */

    $login = in_array('_login',array_keys(filter_input_array(INPUT_POST)));
    if($login){
        $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $userLogin = new LoginController();
        print_r($userLogin->userAuth($datos));
    }

    //******GUARDAR NUEVA PUBLICACION */
    $gp = in_array('_gp',array_keys(filter_input_array(INPUT_POST)));
    if($gp){
        $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $post = new PostController();
        $post->newPost($datos);
        header('Location: /resources/views/autores/myposts.php');
    }
            //***EDITAR PUBLICACION */
    $ep = in_array('_ep',array_keys(filter_input_array(INPUT_POST)));
        if($ep){
            $datos = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $editPost = new PostController();
            $editPost->editPost($datos);
            header('Location: /resources/views/autores/myposts.php');
        }
}

if(!empty($_GET)){
    $logout = in_array('_logout',array_keys(filter_input_array(INPUT_GET)));
    if($logout){
        $userLogout = new LoginController();
        $userLogout->logout();
        header('Location: /resources/views/home.php');
    }
    //******CARGAR PUBLICACIONES PREVIAS */
    $pp = in_array('_pp',array_keys(filter_input_array(INPUT_GET)));
    if($pp){
        $post = new PostController();
        print_r($post->getPosts());
    } 
    $lp = in_array('_lp', array_keys(filter_input_array(INPUT_GET)));
	if($lp){
		$l = filter_input_array(INPUT_GET)["limit"];
		$lastpost = new PostController();
		print_r($lastpost->getPosts($l));
	}
    //********************************CARGAR PUBLICACIONES */
    $op = in_array('_op', array_keys(filter_input_array(INPUT_GET)));
	if($op){
		$pid = filter_input_array(INPUT_GET)["pid"];
        $l = 1;
		$openpost = new PostController();
		print_r($openpost->getPosts($l, $pid));
	}
    //********************************CARGAR MIS PUBLICACIONES */
    $mp = in_array('_mp', array_keys(filter_input_array(INPUT_GET)));
    if($mp){
        $uid = filter_input_array(INPUT_GET)["uid"];
        $post = new PostController();
        print_r($post->getMyPosts($uid));
    }

    $del = in_array('_del', array_keys(filter_input_array(INPUT_GET)));
    if($del){
        $id = filter_input_array(INPUT_GET)["id"];
        if (isset($id)) {
            $deletePost = new PostController();
            print_r($deletePost->deleteP($id));
        }
    }
    $vp = in_array('_vp', array_keys(filter_input_array(INPUT_GET)));
	if($vp){
		$id = filter_input_array(INPUT_GET)["id"];
        $l = 1;
		$openpost = new PostController();
		print_r($openpost->getPosts($l, $id));
	}

    
}