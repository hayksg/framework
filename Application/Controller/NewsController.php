<?php

namespace Application\Controller;

use Application\Model\News;

class NewsController
{
    public function indexAction()
    {
        $allNews = News::getAll();
        require_once(ROOT . 'Application/View/news/index.php');

        return true;
    }

    public function viewAction($id)
    {
        $oneNews = News::getOneById((int)$id);
        require_once(ROOT . 'Application/View/news/view.php');

        return true;
    }
}