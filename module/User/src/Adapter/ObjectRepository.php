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
                $options->getIdentityProperty() => $this->identity
            ));

        if (!$identity) {
            $this->authenticationResultInfo['code'] = AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND;
            $this->authenticationResultInfo['messages'][] = 'A record with the supplied identity could not be found.';

            return $this->createAuthenticationResult();
        }

        $authResult = $this->validateIdentity($identity);

        return $authResult;
    }
}