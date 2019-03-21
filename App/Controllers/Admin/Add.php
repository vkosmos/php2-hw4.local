<?php

namespace App\Controllers\Admin;

class Add extends \App\Controller
{

    protected function handle($method = 'GET', $params = [])
    {
        if ('GET' === $method){

            $this->view->authors = \App\Models\Author::findAll();
            $this->view->display( TEMPLATES . '/admin/add.php' );

        }elseif ('POST' === $method){

            $article = new \App\Models\Article();
            $article->title = $params['title'];
            $article->content = $params['content'];
            $article->author_id = (0 === (int)$params['author']) ? null : $params['author'];
            $article->save();
            header('Location: ' . '/admin/');

        }
    }

}