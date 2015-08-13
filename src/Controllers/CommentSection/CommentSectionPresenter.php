<?php

namespace Your\WebApp\Controllers\CommentSection;

use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class CommentSectionPresenter extends ModelFormPresenter
{
    public function __construct($name = "")
    {
        parent::__construct($name);
    }

    protected function createView()
    {
        return new CommentSectionView();
    }
}