<?php

namespace App\Controllers\Admin;

class Index extends \App\Controller
{

    protected function handle($method = 'GET', $params = [])
    {
        $this->view->news = \App\Models\Article::findAll();
        $this->view->display( TEMPLATES . '/admin/index.php' );
    }
}
