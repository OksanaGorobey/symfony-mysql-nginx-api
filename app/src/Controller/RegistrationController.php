<?php declare(strict_types=1);
namespace App\Controller
{

    use Symfony\Component\Routing\Annotation\Route;
    
    /**
     * Class RegistrationController
     * @package App\Controller
     */

    class RegistrationController extends BaseController
    {
        /**
         * Метод реєстрації користувача
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route("/registration", name="registration", methods={"POST"})
         */
        public function registrationAction( \Symfony\Component\HttpFoundation\Request $request ): \Symfony\Component\HttpFoundation\JsonResponse
        {
            try
            {
                $form = $this->createForm( \App\Form\RegistrationFormType::class );

                $form->submit( $request->request->all(), false);

                // валідація форми
                if( !$form->isValid() )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_REGISTRATION_FIELDS_INCORRECT, \App\lib\common::buildErrorArray( $form )[0] );
                }

                $user_repository = $this->getDoctrine()->getRepository(\App\Entity\User::class);

                // перевірка чи не був зареєстрованний раніше nickname
                if( !empty( $user_repository->findUserRegistration( $form[ 'nickname' ]->getData(), $form[ 'email' ]->getData() ) ) )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_NICKNAME_OR_EMAIL );
                }

                // додаємо користувача
                $user_repository->addUser( $form );

                return \App\lib\responses\jsonResponse::response(
                    [
                        'code'          => \App\lib\consts::APPLICATION_CODE_OK,
                        'content'       => ( new \App\lib\core() )->l10n('general_registration' )
                    ]
                );
            }
            catch( \App\lib\exceptions\baseException $e )
            {
                return \App\lib\responses\jsonResponse::response( $e->getData() );
            }
        }
    }
}