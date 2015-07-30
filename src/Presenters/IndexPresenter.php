<?php

namespace Your\WebApp\Presenters;

use Rhubarb\Leaf\Presenters\HtmlPresenter;

class IndexPresenter extends HtmlPresenter
{
    protected function createView()
    {
        return new IndexView();
    }
}