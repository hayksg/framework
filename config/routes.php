<?php

return [
    'news/([0-9]+)'  => 'news/view/$1',    // viewAction in NewsController
    'news'     => 'news/index',   // indexAction in NewsController
    'products' => 'product/list', // listAction in ProductController
];
