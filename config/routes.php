<?php

return [
    ''  => 'article/index',   // indexAction in ArticleController

    'article/add'  => 'article/add',    // addAction in ArticleController
    'article/edit/([0-9]+)'  => 'article/edit/$1',    // editAction in ArticleController
    'article/delete/([0-9]+)'  => 'article/delete/$1',    // deleteAction in ArticleController
    'article/([0-9]+)'  => 'article/view/$1',    // viewAction in ArticleController
    'article'     => 'article/index',   // indexAction in ArticleController

    'news/([0-9]+)'  => 'news/view/$1',    // viewAction in NewsController
    'news'     => 'news/index',   // indexAction in NewsController

    'products' => 'product/list', // listAction in ProductController
];
