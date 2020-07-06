<?php

declare(strict_types=1);

namespace Morbo\React\Amqp\Service;

use Bunny\Async\Client;
use Morbo\React\Loop\Service\Loop;
use Morbo\React\Loop\Service\LoopAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Amqp
{
    use LoopAwareTrait;

    protected ContainerInterface $container;

    private Client $client;

    public function __construct(ContainerInterface $container, Loop $loop)
    {
        $this->container = $container;
        $this->loop = $loop->getLoop();

        $this->client = new Client($this->loop, $container->getParameter('react.amqp.connection'));
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}