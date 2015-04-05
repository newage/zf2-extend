<?php

namespace User\Factory\Authentication;

use DoctrineModule\Service\Authentication\AdapterFactory as BaseAdapterFactory;
use User\Adapter\ObjectRepository;
use User\Entity\User;
use Zend\ServiceManager\ServiceLocatorInterface;


/**
 * Class AuthenticateAdapter
 * @package User\Factory
 */
class Adapter extends BaseAdapterFactory
{
    /**
     * {@inheritDoc}
     *
     * @return ObjectRepository
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $options \DoctrineModule\Options\Authentication */
        $options = $this->getOptions($serviceLocator, 'authentication');
        $verifyCredential = function(User $user, $passwordGiven) {
            return password_verify($passwordGiven, $user->getPassword());
        };
        $options->setCredentialCallable($verifyCredential);

        if (is_string($objectManager = $options->getObjectManager())) {
            $options->setObjectManager($serviceLocator->get($objectManager));
        }

        return new ObjectRepository($options);
    }
}