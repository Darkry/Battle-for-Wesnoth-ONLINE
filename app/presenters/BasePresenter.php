<?php

/**
 * Base class for all application presenters.
 *
 * @author     John Doe
 * @package    MyApplication
 */
    
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    public $db;

    protected function startup() {
        parent::startup();
    }

    protected function beforeRender() {
    }
}
