<?php

namespace App\Controllers\Admin;

use App\ControllerAdmin;

class Edit extends ControllerAdmin
{

    protected function handle()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']){
            $params = $_POST;

            $article = \App\Models\Article::findById($params['id']);
            $article->title = $params['title'];
            $article->content = $params['content'];
            $article->author_id = (0 === (int)$params['author']) ? null : $params['author'];
            $article->save();
            header('Location: ' . '/admin/');

        }

        $params = $_GET;
        $id = (int)$params['id'];
        $this->view = new \App\View();
        $this->view->article = \App\Models\Article::findById($id);
        $this->view->authors = \App\Models\Author::findAll();
        $this->view->display( TEMPLATES . '/admin/edit.php' );
    }
}