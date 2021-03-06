<?php declare(strict_types=1);

namespace App\Security;

/**
 * Class JwtAuthenticator
 * @package App\Security
 */
class JwtAuthenticator extends \Symfony\Component\Security\Guard\AbstractGuardAuthenticator
{
    private $em;
    private $params;

    public function __construct(
        \Doctrine\ORM\EntityManagerInterface $em,
        \Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface $params
    )
    {
        $this->em = $em;
        $this->params = $params;
    }

    /**
     * Whenever a user wants to access a URL or resources that need authentication,
     * but the authentication details were not sent, this method will run.
     * In return, we must return a Response object with a 401 status code.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\Security\Core\Exception\AuthenticationException|null $authException
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function start(
        \Symfony\Component\HttpFoundation\Request $request,
        \Symfony\Component\Security\Core\Exception\AuthenticationException $authException = null
    ): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return \App\lib\responses\jsonResponse::response(
            [
                'code'          => \App\lib\consts::APPLICATION_CODE_UNAUTHORIZED,
                'content'       =>
                [
                    'message'   =>  ( new \App\lib\core() )->l10n('error_401' ),
                ],
            ],
            \App\lib\consts::HTTP_CODE_UNAUTHORIZED
        );
    }

    /**
     * This method checks whether the current request supports the authentication or not.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return bool
     */
    public function supports(\Symfony\Component\HttpFoundation\Request  $request ): bool
    {
        return $request->headers->has( 'Authorization' );
    }

    /**
     * This method returns the value of the Authorization header which is the token we return when user login.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     */
    public function getCredentials(\Symfony\Component\HttpFoundation\Request $request )
    {
        if( $this->supports( $request ) )
        {
            return false;
        }

        $authorizationHeader = $request->headers->get( 'Authorization' );

        $headerParts = explode( ' ', $authorizationHeader );

        if( !( 2 === count( $headerParts ) && 0 === strcasecmp( $headerParts[0], 'Bearer' ) ) )
        {
            return false;
        }

        return $headerParts[1];
    }

    /**
     * This method is responsible to validate JWT Token and authenticate the user by the credentials’ value
     * which is returned from the getCredential method and it must return
     * a User entity object or AuthenticationException.
     *
     * @param mixed $credentials
     * @param \Symfony\Component\Security\Core\User\UserProviderInterface $userProvider
     *
     * @return \App\Entity\User
     */

    public function getUser(
        $credentials,
        \Symfony\Component\Security\Core\User\UserProviderInterface $userProvider
    ): \App\Entity\User
    {
        try
        {
            $credentials = str_replace( 'Bearer ', '', $credentials );

            $jwt = (array) \Firebase\JWT\JWT::decode(
                $credentials,
                $this->params->get( 'jwt_secret' ),
                [ \App\lib\consts::JWT_SALT ]
            );
            var_dump($jwt);
            return $this
                ->em
                ->getRepository( \App\Entity\User::class )
                ->findOneByNickname( $jwt[ 'user' ] );
        }
        catch ( \Exception $e )
        {
            throw new \Symfony\Component\Security\Core\Exception\AuthenticationException( $e->getMessage() );
        }
    }


    /**
     * Check credentials - e.g. make sure the password is valid.In case of an API token,
     * no credential check is needed.
     * Return `true` to cause authentication success
     *
     * @param mixed $credentials
     * @param \Symfony\Component\Security\Core\User\UserInterface $user
     *
     * @return bool
     */
    public function checkCredentials(
        $credentials,
        \Symfony\Component\Security\Core\User\UserInterface $user
    ): bool
    {
        return true;
    }

    /**
     * This method will be called if we throw an AuthenticationException from the getUser method.
     * This must return a Response object.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\Security\Core\Exception\AuthenticationException $exception
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function onAuthenticationFailure(
        \Symfony\Component\HttpFoundation\Request $request,
        \Symfony\Component\Security\Core\Exception\AuthenticationException $exception
    ): \Symfony\Component\HttpFoundation\JsonResponse
    {
        return \App\lib\responses\jsonResponse::response(
            [
                'code'          => \App\lib\consts::APPLICATION_CODE_UNAUTHORIZED,
                'content'       =>
                [
                    'message'   =>  ( new \App\lib\core() )->l10n('error_401' ),
                ],
            ],
            \App\lib\consts::HTTP_CODE_UNAUTHORIZED
        );
    }

    /**
     * This method will call if the authentication were successful.
     * However, in our example we don’t need to return anything.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     * @param string $providerKey
     */
    public function onAuthenticationSuccess(
        \Symfony\Component\HttpFoundation\Request $request,
        \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token,
        string $providerKey
    ): void
    {
        return;
    }

    /**
     * Since this is a stateless API we don’t need “remember me” functionality.
     *
     * @return bool
     */
    public function supportsRememberMe(): bool
    {
        return false;
    }
}