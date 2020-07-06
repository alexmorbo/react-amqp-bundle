<?php

declare(strict_types=1);

namespace Morbo\React\Amqp\Tests;

use Morbo\React\Amqp\ReactAmqpBundle;
use Morbo\React\Loop\ReactLoopBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestingKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    public function registerBundles()
    {
        return [
            new ReactAmqpBundle(),
            new ReactLoopBundle(),
        ];
    }

    public function getCacheDir()
    {
        return __DIR__.'/cache/'.spl_object_hash($this);
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }
}