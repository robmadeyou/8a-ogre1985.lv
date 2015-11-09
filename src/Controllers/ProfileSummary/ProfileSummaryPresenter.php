<?php

namespace Your\WebApp\Controllers\ProfileSummary;

use Rhubarb\Patterns\Mvp\Crud\ModelForm\ModelFormPresenter;

class ProfileSummaryPresenter extends ModelFormPresenter
{
    private $userID;

    public function __construct( $userID, $name = "" )
    {
        parent::__construct( $name );
        $this->userID = $userID;
    }

    protected function createView()
    {
        return new ProfileSummaryView( $this->userID );
    }
}