<?php

namespace App\Controllers;

use App\Controller;

class Index extends Controller
{
    function handle($method = 'GET', $params = [])
    {
        $this->view->news = \App\Models\Article::findN(3);
        $this->view->display(TEMPLATES . '/index.php');
    }

}
