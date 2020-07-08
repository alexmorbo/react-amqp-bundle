<?php

declare(strict_types=1);

namespace Morbo\React\Redis;

use Bunny\Async\Client;
use Morbo\React\Amqp\DependencyInjection\ReactAmqpExtension;
use Morbo\React\Amqp\Service\Amqp;
use Morbo\React\Loop\DependencyInjection\ReactLoopExtension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ReactAmqpTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel();
        self::$container = self::$kernel->getContainer();
    }

    public function testDependencyInjection()
    {
        $this->assertTrue(self::$container->has('react.amqp'), '"react.amqp" is loaded');
        $this->assertTrue(self::$container->has(Amqp::class), '"Amqp::class" is loaded');
    }

    public function testClient()
    {
        $container = new ContainerBuilder();

        $extension = new ReactAmqpExtension();
        $extension->load([], $container);

        /** @var Amqp $amqp */
        $amqp = $container->get('react.amqp');
        $this->assertTrue($amqp->getClient() instanceof Client);
    }
}
