<?php

namespace Your\WebApp\Presenters\MyProfile;

use Rhubarb\Crown\Settings\HtmlPageSettings;

class MyProfileEditView extends MyProfileAddView
{

    protected function printViewContent()
    {
        $html = new HtmlPageSettings();
        $html->PageTitle = 'Manit profilu';
        ?>
            <div class="__container">
                <?=
                 $this->printFieldset( "",
                    [
                        'Bilde' => 'Image',
                        'Vards' => 'Forename',
                        'Uzvards' => 'Surname',
                        'E - pasts' => 'Email',
                        $this->presenters[ 'Save' ] . $this->presenters[ 'Cancel' ]
                    ]);
                ?>
            </div>
        <?php

    }

}