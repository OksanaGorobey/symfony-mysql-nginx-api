<?php declare(strict_types=1);

namespace App\Controller
{
    use Symfony\Component\Routing\Annotation\Route;

    /**
     * Class LoginController
     * @package App\Controller
     */

    class LoginController extends BaseController
    {
        /////////////////////////////////////////////////////////////////////

        /**
         * Метод реєстрації користувача
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route("/login", name="login", methods={"POST"})
         */
        public function loginAction( \Symfony\Component\HttpFoundation\Request $request ) : \Symfony\Component\HttpFoundation\JsonResponse
        {
            try
            {
                $form = $this->createForm( \App\Form\LoginFormType::class );

                $form->submit( $request->request->all(), false);

                // валідація форми
                if( !$form->isValid() )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_LOGIN_FIELDS_INCORRECT, \App\lib\common::buildErrorArray( $form )[0] );
                }

                $user_find = $this
                    ->getDoctrine()
                    ->getRepository(\App\Entity\User::class)
                    ->findOneBy(
                        [
                            'nickname' => $form[ 'nickname' ]->getData(),
                            'password' => \App\lib\common::createHash( $form[ 'password' ]->getData() )
                        ]
                    );

                // перевірка чи був зареєстрованний раніше
                if( !$user_find )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_LOGIN_USER_NOT_FOUND );
                }

                return \App\lib\responses\jsonResponse::response(
                    [
                        'code'          => \App\lib\consts::APPLICATION_CODE_OK,
                        'content'       =>
                        [
                            // генеруэмо токен і надсилаємо
                            'token' => sprintf(
                                \App\lib\consts::BAERER_FORMAT,
                                \Firebase\JWT\JWT::encode(
                                    [
                                        'user' => $user_find->getUsername(),
                                        'exp'  => ( new \DateTime() )->modify( '+5 minutes' )->getTimestamp(),
                                    ],
                                    $this->getParameter('jwt_secret'),
                                    \App\lib\consts::JWT_SALT
                                )
                            )
                        ]
                    ]
                );
            }
            catch( \App\lib\exceptions\baseException $e )
            {
                return \App\lib\responses\jsonResponse::response( $e->getData() );
            }
        }

        ///////////////////////////////////////////////////////////////////////
    }
}