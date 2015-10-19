<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Settings\HtmlPageSettings;

class MyProfileEditView extends MyProfileAddView
{

    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Mainīt profilu';
        ?>
            <div class="__container">
                <?=
                 $this->printFieldset( "",
                    [
                        'Bilde' => 'Image',
                        'Vārds' => 'Forename',
                        'Uzvārds' => 'Surname',
                        'Parole' => 'PasswordPlace',
                        'E - pasts' => 'Email',
                        $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
                    ]);
                ?>
            </div>
        <?php

    }

}