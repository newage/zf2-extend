<?php
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'User',
                'route' => 'user',
                'pages' => array(
                    array(
                        'label' => 'Registration',
                        'route' => 'user/create'
                    ),
                    array(
                        'label' => 'Login',
                        'route' => 'user.login'
                    )
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        )
    )
);

