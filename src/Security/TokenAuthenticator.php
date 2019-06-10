<?php

namespace App\Security;

use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class TokenAuthenticator extends AbstractGuardAuthenticator
{

    private $token = 'viking-token';
    private $key = 'viking-76sdfg9';

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            'message' => 'Authentication Required'
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED, array(
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json'
        ));
    }

    public function supports(Request $request)
    {
        if($request->isMethod('OPTION'))
            return true;
        return $request->header->has($this->token);
    }

    public function getCredentials(Request $request)
    {
        if (strlen($request->header->get($this->token)) > 64) {
            $str = $request->header->get($this->token);
            try {
                $decoded = JWT::decode($str, $this->key);
                // decoded : id login email role
                return (array) $decoded;
            } catch (Exception $e) {
                return array('error' => $e->getMessage());
            }
        } else {
            return array(
                'api' => $request->header->get($this->token)
            );
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if(!isset($credentials['api']))
            $apiKey = null;
        else
            $apiKey = $credentials['api'];
        if(null === $apiKey) {
            return null;
        }
        return $userProvider->loadUserByUsername($apiKey);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if(isset($credentials['email']) && $credentials['email'] != $user->getLogin()) {
            return false;
        }

        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN, array(
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json'
        ));
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
