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
        /////////////////////////////////////////////////////////////////////

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
                $user = new \App\Entity\User();

                $form = $this->createForm(\App\Form\RegistrationFormType::class, $user);

                $form->submit( $request->request->all(), false);

                // валідація форми
                if( !$form->isValid() )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_REGISTRATION_FIELDS_INCORRECT, \App\lib\common::buildErrorArray( $form )[0] );
                }

                $user_find = $this->getDoctrine()->getRepository(\App\Entity\User::class);

                // перевірка чи не був зареєстрованний раніше nickname
                if( $user_find->findOneBy( [ 'nickname' => $form[ 'nickname' ]->getData() ] ) )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_NICKNAME );
                }

                // перевірка чи не був зареєстрованний раніше email
                if( $user_find->findOneBy( [ 'email' => $form[ 'email' ]->getData() ] )  )
                {
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_EMAIL);
                }

                // ініціалізуємо обьект
                $user->setFirstname( $form['firstname']->getData() );
                $user->setLastname( $form['lastname']->getData() );
                $user->setNickname( $form['nickname']->getData() );
                $user->setPassword( $form['password']->getData() );
                $user->setEmail( $form['email']->getData() );
                $user->setAge( $form['age']->getData() );

                //додаємо до бд запис
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();


                return $this->response(
                    [
                        'code'          => \App\lib\consts::APPLICATION_CODE_OK,
                        'content'       => 'Зареєстровано успішно. Тепер можете увійти!'
                    ]
                );
            }
            catch( \App\lib\exceptions\baseException $e )
            {
                return $this->response( $e->getData() );
            }
        }

        ///////////////////////////////////////////////////////////////////////
    }
}