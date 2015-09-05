<?php
namespace MyXing\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class HybridAuth implements ServiceProviderInterface
{
    /**
     * Module config
     * @var array
     */
    private $config = [];

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (empty($config)) {
            throw new \RuntimeException('Config for HybridAuthProvider can\'t be empty');
        }
        $this->config = $config;
    }

    /**
     * @param Container $app
     */
    public function register(Container $app)
    {
        $config = $this->config;

        $app['hybrid_auth'] = function () use ($config) {
            return new \Hybrid_Auth($config);
        };
    }
}
