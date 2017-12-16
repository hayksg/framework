<?php

namespace Application\Controller;

use Application\Model\News;
use Application\Components\View;
use Application\Components\FunctionsLibrary as FL;

class NewsController
{
    public function indexAction()
    {
        echo __METHOD__;
        return true;
    }

    public function viewAction()
    {
        echo __METHOD__;
        return true;
    }
}