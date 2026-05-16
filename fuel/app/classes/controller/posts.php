<?php

class Controller_Posts extends Controller_Template {
    
    public function action_index() {
        if (Input::method() == 'POST' && Input::post('email')) {
            $correo_usuario = Input::post('email');
            $subscriber = new Model_Subscriber();
            $subscriber->email = $correo_usuario;
            $subscriber->save();

            Package::load('email'); 
            $email = Email::forge();
            $email->from('mariana@codeandtonic.com', 'Mariana de Code&Tonic'); 
            $email->to($correo_usuario);
            $email->subject('¡Bienvenido/a a Code&Tonic! 🍹✨');

            $mensaje = "¡Hola!\n\nMuchísimas gracias por conectar conmigo...";
            $email->body($mensaje);

            try {
                $email->send();
                Session::set_flash('success', '¡Gracias por conectar!');
            } catch (\Exception $e) {
                Session::set_flash('success', '¡Tu correo se ha guardado! (Localhost mode)');
            }
            
            return Response::redirect('posts');
        }

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
            $post->content = Input::post('content');

            $config = array(
                'path' => DOCROOT.'assets/img',
                'randomize' => false,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );
            Upload::process($config);

            if (Upload::is_valid()) {
                Upload::save();
                $file = Upload::get_files(0);
                $post->image_url = '/myblog/public/assets/img/' . $file['saved_as'];
            } else {
                $post->image_url = '/myblog/public/assets/img/coding.jpg'; // Imagen por defecto si falla
            }

            $post->save();
            
            Session::set_flash('success', '¡Post añadido!');
            return Response::redirect('posts');
        }
        $this->template->content = View::forge('post/add');
    }

    public function action_add_topic() {
        if(Input::post('send_topic')){
            $name = ucwords(strtolower(trim(Input::post('topic_name'))));

            $config = array(
                'path' => DOCROOT.'assets/img',
                'randomize' => false,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );
            Upload::process($config);

            if (Upload::is_valid()) {
                Upload::save();
                $file = Upload::get_files(0);
                $image_path = '/myblog/public/assets/img/' . $file['saved_as'];
            } else {
                $image_path = '/myblog/public/assets/img/coding.jpg'; // Imagen por defecto
            }

            $custom_topics = Session::get('custom_topics', array());
            $custom_topics[$name] = $image_path;
            Session::set('custom_topics', $custom_topics);

            Session::set_flash('success', '¡Tópico "' . $name . '" añadido correctamente a la portada!');
            return Response::redirect('posts');
        }
    }

    public function action_view($id = null) {
        is_null($id) and Response::redirect('posts');
        $post = Model_Post::find($id);
        $data = array('post' => $post);
        $this->template->title = 'Ver Post';
        $this->template->content = View::forge('post/view', $data); 
    }

    public function action_edit($id) {
        if (!Session::get('logged_in')) { return Response::redirect('posts/login'); }

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
            return Response::redirect('posts');
        }
        $data = array('post' => $post);
        $this->template->title = 'Editar Post';
        $this->template->content = View::forge('post/edit', $data, false);
    }

   public function action_delete($id) {
        if (!Session::get('logged_in')) { return Response::redirect('posts/login'); }

        $post = Model_Post::find($id);
        if ($post) {
            $post->delete();
            Session::set_flash('success', '¡Post eliminado!');
        }
        return Response::redirect('posts'); 
    }

    public function action_login() {
        if (Session::get('logged_in')) { return Response::redirect('posts'); }
        if (Input::method() == 'POST') {
            $username = Input::post('username');
            $password = Input::post('password');
            if ($username === 'admin' && $password === '123') {
                Session::set('logged_in', true);
                Session::set_flash('success', '¡Bienvenida!');
                return Response::redirect('posts');
            } else {
                Session::set_flash('error', 'Datos incorrectos.');
                return Response::redirect('posts/login');
            }
        }
        $this->template->content = View::forge('post/login');
    }

    public function action_logout() {
        Session::delete('logged_in');
        Session::set_flash('success', '¡Has cerrado sesión correctamente!');
        return Response::redirect('posts/login');
    }
}