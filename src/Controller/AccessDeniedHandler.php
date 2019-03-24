<?php
/**
 * Created by PhpStorm.
 * User: khatt
 * Date: 23/03/2019
 * Time: 19:48
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{

    /**
     * Handles an access denied failure.
     *
     * @return Response may return null
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        return new Response("Vous n'avez pas l'accès à cette page");
    }
}