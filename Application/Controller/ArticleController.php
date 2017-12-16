<?php

namespace Application\Controller;

use Application\Model\Article;
use Application\Components\View;
use Application\Components\FunctionsLibrary as FL;

class ArticleController
{
    public function indexAction()
    {
        $articles = Article::getAll();

        $view = new View([
            'articles' => $articles,
        ]);
        $view->display('article/index');

        return true;
    }

    public function viewAction($id)
    {
        $article = Article::getOneById((int)$id);

        $view = new View([
            'article' => $article,
        ]);
        $view->display('article/view');

        return true;
    }

    public function addAction()
    {
        $article = new Article();
        $article->category_id = 6;
        $article->title = 'NEW TITLE 2';
        $article->short_content = 'SHORT CONTENT 2';
        $article->content = 'CONTENT 2';

        if ($article->save()) {
            FL::redirectTo('/article');
        }

    }

    public function editAction($id)
    {

        $article = Article::getOneById((int)$id);

        $article->fieldsForUpdate(['content', 'short_content', 'title']);
        $article->short_content = 'SHORT FOOOO1';
        $article->content = 'FOOOO1';
        $article->title = 'FOOOO111';

        if ($article->save()) {
            FL::redirectTo('/article');
        }
    }
}
