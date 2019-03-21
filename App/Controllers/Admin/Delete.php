<?php

namespace App\Controllers\Admin;

use App\Controller;

class Delete extends Controller
{

    protected function handle($method = 'GET', $params = [])
    {
        if (!empty($params['id'])){
            $article = \App\Models\Article::findById($params['id']);
            $article->delete();
            header('Location: /admin/');
        }
    }
}