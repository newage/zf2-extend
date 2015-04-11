<?php

namespace User\Service;

use Core\Service\AbstractService;

/**
 * Class RestoreService
 * @package User\Service
 */
class RestoreService extends AbstractService
{

    /**
     * Get user form and set validation group
     */
    public function getForm()
    {
        $form = parent::getForm();
        $form->setValidationGroup(['identity' => ['password', 'identical']]);
        $form->get('send')->setValue('change password');
        return $form;
    }

    /**
     *
     */
    public function restore()
    {

    }
}
