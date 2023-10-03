<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class EntryPoint implements AuthenticationEntryPointInterface
{

    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function start(Request $request, ?AuthenticationException $authException = null)
    {
        try{
        if (stristr($request->getRequestUri(), 'api') === false && stristr($request->getRequestUri(), 'auth') === false)
            return new RedirectResponse('app_login');
        else{
            return $request;
        }
        }catch(AuthenticationException $exception){
            return new RedirectResponse('/error-cust?exception='.$exception->getMessage(),503 );
        }
    }
}
