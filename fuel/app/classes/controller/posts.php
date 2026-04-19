<?php

class Controller_Posts extends Controller_Template {
    
    public function action_index() {
        $posts = Model_Post::find('all', array('order_by' => array('created_at' => 'desc')));
        $data = array('posts' => $posts);
        $this->template->title = 'Blog Code & Tonic';
        $this->template->content = View::forge('post/index', $data);
    }

    public function action_add() {
        if(Input::post('send')){
            $post = new Model_Post();
            $post->title = Input::post('title');
            $post->category = Input::post('category'); 
            $post->slug = Input::post('slug');
            $post->excerpt = Input::post('excerpt');
            $post->content = Input::post('content');
            $post->image_url = Input::post('image_url');
            $post->status = Input::post('status');
            $post->save();
            
            Session::set_flash('success', '¡Post añadido correctamente!');
            Response::redirect('/myblog/public/posts');
        }
        $this->template->title = 'Añadir Post';
        $this->template->content = View::forge('post/add');
    }

    // --- AQUÍ ESTÁ LA VERSIÓN CORREGIDA Y ÚNICA DE action_view ---
    public function action_view($id = null) {
        // Si no mandan ID, lo regresamos a la portada
        is_null($id) and Response::redirect('/myblog/public/posts');

        $post = Model_Post::find($id);
        $data = array('post' => $post);
        
        $this->template->title = 'Ver Post';
        $this->template->content = View::forge('post/view', $data); // Nota que dice 'post/view'
    }

    public function action_edit($id) {
        $post = Model_Post::find($id);
        if (Input::post('send')) {
            $post->title = Input::post('title');
            $post->category = Input::post('category'); 
            $post->slug = Input::post('slug');
            $post->excerpt = Input::post('excerpt');
            $post->content = Input::post('content');
            $post->image_url = Input::post('image_url');
            $post->status = Input::post('status');
            $post->save();
            
            Session::set_flash('success', '¡Post actualizado!');
            Response::redirect('/myblog/public/posts');
        }
        $data = array('post' => $post);
        $this->template->title = 'Editar Post';
        $this->template->content = View::forge('post/edit', $data, false);
    }

    public function action_delete($id) {
        $post = Model_Post::find($id);
        if ($post) {
            $post->delete();
            Session::set_flash('success', '¡Post eliminado!');
        }
        Response::redirect('/myblog/public/posts'); 
    } 

    // --- LÓGICA DE LOGIN ---
    public function action_login()
    {
        if (Session::get('logged_in')) {
            Response::redirect('/myblog/public/posts');
        }

        if (Input::method() == 'POST') {
            $username = Input::post('username');
            $password = Input::post('password');

            if ($username === 'admin' && $password === '123') {
                Session::set('logged_in', true);
                Session::set_flash('success', '¡Bienvenida de vuelta!');
                Response::redirect('/myblog/public/posts');
            } else {
                Session::set_flash('error', 'Usuario o contraseña incorrectos.');
                Response::redirect('/myblog/public/posts/login');
            }
        }

        $this->template->title = "Iniciar Sesión - Code & Tonic";
        $this->template->content = View::forge('post/login');
    }

    // --- LÓGICA DE LOGOUT ---
    public function action_logout()
    {
        Session::destroy();
        Response::redirect('/myblog/public/posts');
    }
}