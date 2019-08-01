<?php

namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class Headers implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'addHeaders'
        ];
    }

    public function addHeaders(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $response->headers->add([
            'Content-Type' => 'application/json'
        ]);
    }
}
