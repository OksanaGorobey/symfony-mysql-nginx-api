<?php

namespace App\Form;

/**
 * Class BaseFormType
 * @package App\Form
 */
class BaseFormType extends \Symfony\Component\Form\AbstractType
{
    ///////////////////////////////////////////////////////////////////////

    protected \App\lib\core $_core;

    ///////////////////////////////////////////////////////////////////////

    /**
     *
     */
    public function __construct()
    {
        $this->_core = new \App\lib\core();
    }

    ///////////////////////////////////////////////////////////////////////
}
