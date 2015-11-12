<?php

namespace Your\WebApp\Controllers\TableColumns;

use Rhubarb\Leaf\Presenters\Application\Table\Columns\ModelColumn;
use Rhubarb\Leaf\Presenters\Application\Table\Columns\PresenterColumn;
use Rhubarb\Leaf\Presenters\Application\Table\Columns\TableColumn;
use Rhubarb\Leaf\Presenters\Presenter;
use Rhubarb\Stem\Models\Model;

class FixedWidthColumn extends PresenterColumn
{
    private $value;

    public function __construct( $presenter, $label = "" )
    {
        if( $presenter instanceof Presenter )
        {
            parent::__construct( $presenter, $label );
        }
        else
        {
            $this->value = $presenter;
        }

        $this->addCssClass( 'fixed-width-column-75' );
    }

    protected function getCellValue( Model $row, $decorator )
    {
        if( !$this->value )
        {
            return parent::getCellValue( $row, $decorator );
        }
        else
        {
            return $this->value;
        }
    }


}