<?php

namespace Bermuda\Hasher;

use Psr\Container\ContainerInterface;

class ConfigProvider extends \Bermuda\Config\ConfigProvider
{
    public const configKey = 'hasher';

    protected function getFactories(): array
    {
        return [
            HasherInterface::class => static function(ContainerInterface $c) {
                $config = $c->get(self::containerConfigKey)[self::configKey];
                return new PasswordHasher($config[PasswordHasher::algorithm], $config[PasswordHasher::options]);
            }
        ];
    }
  
    protected function getAliases(): array
    {
        return [
            HashValidator::class => HasherInterface::class,
            HashGenerator::class => HasherInterface::class
        ];
    }

    protected function getConfig(): array
    {
        return [
            self::configKey => [
                PasswordHasher::algorithm => PASSWORD_ARGON2ID,
                PasswordHasher::options => []
            ],

            self::bootstrap => [static function($app) {
                Hash::hasher($app->get(HasherInterface::class));
            }]
        ];
    }
}
