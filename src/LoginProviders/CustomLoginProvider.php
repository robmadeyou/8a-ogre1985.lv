<?php

namespace Your\WebApp\LoginProviders;

use Rhubarb\Crown\LoginProviders\Exceptions\NotLoggedInException;
use Rhubarb\Scaffolds\Authentication\LoginProvider;
use Rhubarb\Stem\Tests\Fixtures\User;

class CustomLoginProvider extends LoginProvider
{

    public function __construct($modelClassName = "CustomUser", $usernameColumnName = "Username", $passwordColumnName = "Password", $activeColumnName = "Enabled")
    {
        parent::__construct($modelClassName, $usernameColumnName, $passwordColumnName, $activeColumnName);
    }

    public static function isAdmin()
    {
        $loggedIn = self::getLoggedInUser();
        return $loggedIn->IsSuperuser;
    }

}