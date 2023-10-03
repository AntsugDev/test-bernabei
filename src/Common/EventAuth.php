<?php

namespace App\Common;

use App\Client\ConsumerClient;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EventAuth implements EventSubscriberInterface
{


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'validateToken'
        ];
    }


    public function validateToken(RequestEvent $requestEvent)
    {

        $request  = $requestEvent->getRequest();
        if (stristr($request->getRequestUri(), 'auth') !== false) {
            $token =  $request->headers->has('autorizzation')  && !is_null($request->headers->get('autorizzation'));
            if (!$token) {
                $requestEvent->setResponse(new RedirectResponse('/error-cust?status=404&msg=' . base64_encode('Richiesta errata, token non presente')));
            } 
        }
    }
}
