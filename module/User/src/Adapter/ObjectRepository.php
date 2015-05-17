<?php

namespace User\Adapter;

use DoctrineModule\Authentication\Adapter\ObjectRepository as BaseObjectRepository;
use Zend\Authentication\Result as AuthenticationResult;

/**
 * Class ObjectRepository
 * @package User\Adapter
 */
class ObjectRepository extends BaseObjectRepository
{
    /**
     * {@inheritDoc}
     */
    public function authenticate()
    {
        $this->setup();
        $options  = $this->options;

        $identity = $options
            ->getObjectRepository()
            ->findOneBy(array(
                $options->getIdentityProperty() => $this->identity,
                'isEnable' => 1
            ));

        if (!$identity) {
            $this->authenticationResultInfo['code'] = AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND;
            $this->authenticationResultInfo['messages'][] = 'A record not be found or disable';

            return $this->createAuthenticationResult();
        }

        $authResult = $this->validateIdentity($identity);

        return $authResult;
    }
}