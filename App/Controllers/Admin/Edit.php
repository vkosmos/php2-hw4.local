<?php

namespace App\Controllers\Admin;

use App\Controller;

class Edit extends Controller
{

    protected function handle($method = 'GET', $params = [])
    {
        if ('POST' === $method){

            $article = \App\Models\Article::findById($params['id']);
            $article->title = $params['title'];
            $article->content = $params['content'];
            $article->author_id = (0 === (int)$params['author']) ? null : $params['author'];
            $article->save();
            header('Location: ' . '/admin/');

        }

        $id = (int)$params['id'];
        $view = new \App\View();
        $view->article = \App\Models\Article::findById($id);
        $view->authors = \App\Models\Author::findAll();
        $view->display( TEMPLATES . '/admin/edit.php' );
    }
}