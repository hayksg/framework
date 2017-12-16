<?php

namespace Application\Components;

class View
{
    const VIEW_PATH = ROOT . 'Application/View/';
    public $data = [];

    public function __construct(array $viewData)
    {
        $this->data = $viewData;
    }

    public function display($template)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }

        $file = self::VIEW_PATH . $template . '.phtml';
        if (is_file($file)) {
            include_once($file);
        }
    }
}
