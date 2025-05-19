<?php

namespace App\Controllers;

use App\Core\Container\Container;
use App\Core\Controller\Controller;
use App\Core\Database\Database;
use Symfony\Component\VarDumper\Cloner\Data;

class PostController extends Controller
{
    public function index(): void
    {
        $db = Container::getInstance()->get(Database::class);

        $posts = $db->findAll('posts', ['user_id' => $this->request()->session->get('user_id')]);
        $this->view('posts/index', [
            'posts' => $posts
        ]);
    }

    public function show($postId)
    {
        $db = Container::getInstance()->get(Database::class);
        $post = $db->find('posts', ['id' => $postId]);

        if(!$post){
            $this->redirect('/posts');
        }
        if($post['user_id'] != $this->request()->session->get('user_id')){
            $this->abort(403);
            return;
        }

        $this->view("posts/show", [
            'post' => $post,
        ]);
    }

    public function create(): void
    {
        $this->view('posts/create');
    }

    public function store(): void
    {
        $validation = $this->request()->validate(['title' => ['min:5', 'required'], 'body' => ['min:5', 'required']]);
        if (!$validation) {
            $this->validationError('/posts/create');
        }
        $db = Container::getInstance()->get(Database::class);
        $data = $this->request()->validated();
        $data['user_id'] = $this->request()->session->get('user_id');
        $db->insert('posts', $data);
        $this->redirect('/posts');
    }

    public function destroy($postId): void
    {
        $db = Container::getInstance()->get(Database::class);
        $post = $db->delete('posts', ['id' => $postId]);
        $this->redirect('/posts');
    }

    public function edit($postId)
    {
        $db = Container::getInstance()->get(Database::class);
        $post = $db->find('posts', ['id' => $postId]);

        if(!$post){
            $this->redirect('/posts');
        }
        if($post['user_id'] != $this->request()->session->get('user_id')){
            $this->abort(403);
            return;
        }

        $this->view("posts/edit", [
            'post' => $post,
        ]);
    }

    public function update($postId)
    {
        $validation = $this->request()->validate(['title' => ['min:5', 'required'], 'body' => ['min:5', 'required']]);
        if (!$validation) {
            $this->validationError('/posts/create');
        }
        /** @var Database $db */
        $db = Container::getInstance()->get(Database::class);
        $post = $db->find('posts', ['id' => $postId]);

        if(!$post){
            $this->redirect('/posts');
        }
        if($post['user_id'] != $this->request()->session->get('user_id')){
            $this->abort(403);
            return;
        }
        $data = $this->request()->validated();

        $db->update('posts', $data, ['id' => $postId]);
        $this->redirect('/posts/' . $postId);
    }
}