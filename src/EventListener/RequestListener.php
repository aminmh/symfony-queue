<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class RequestListener
{

    #[AsEventListener(event: KernelEvents::REQUEST)]
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if ('json' === $request->getContentTypeFormat() && !empty($request->getContent())) {
            $request->request->replace($request->toArray());
        }
    }
}
