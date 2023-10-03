<?php

namespace App\Common;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EventAuth implements EventSubscriberInterface{


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'validateToken'
        ];
    }


    public function validateToken(ControllerEvent $controllerEvent){
        $request = $controllerEvent->getRequest();
        if( stristr($request->getRequestUri(),'auth') !== false){
                $token =  $request->headers->has('autorizzation')  && !is_null($request->headers->get('autorizzation'));
                if(!$token){
                    return new JsonResponse(array(
                        "status"=>401,
                        "msg"=>"Utente non autorizzato ad effettuare la chiamata",
                        "timeRequest" => date('d/m/Y H:i:s',time())
                    ),401);
                }
                

        }
        
    }
}