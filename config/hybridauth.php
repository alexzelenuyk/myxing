<?php
return $config = array(
    'base_url' => 'http://localhost:8888/auth/endpoint',
    'providers' => array(
        'XING' => array(
            'keys' => array(
                'key' => '',
                'secret' => ''
            ),
            'enabled' => true,
            'wrapper' => array(
                'path' => getcwd() . '/../vendor/hybridauth/hybridauth/additional-providers/hybridauth-xing/Providers/XING.php',
                'class' => 'Hybrid_Providers_XING'
            ),
        )
    )
);