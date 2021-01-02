<?php

namespace App\Controller
{
    use Symfony\Component\Routing\Annotation\Route;

    /**
     * Class UsersController
     * @package App\Controller
     */
    class UsersController extends BaseController
    {
        ////////////////////////////////////////////////////////////////////////

        /**
         * Отримання списку користувачів
         *
         * @param \Symfony\Component\HttpFoundation\Request $request
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route("/api/users/list", name="users_list", methods={"GET"})
         */
        public function getListAction( \Symfony\Component\HttpFoundation\Request $request ): \Symfony\Component\HttpFoundation\JsonResponse
        {
            try
            {
                $form = $this->createForm(\App\Form\UsersListFiltersFormFormType::class);

                $form->submit( $request->query->all(), false);

                // валідація форми
                if( !$form->isValid() )
                {
                    //перехід до catch{}
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_CODE_USER_LIST_PARAMS_INCORRECT, \App\lib\common::buildErrorArray( $form )[0] );
                }

                // отримуємо список за параметрами
                $users_list = $this->getDoctrine()
                    ->getRepository(\App\Entity\User::class)
                    ->findAllByFields( $form['params']->getData() );

                return $this->response(
                    [
                        'code'      => \App\lib\consts::APPLICATION_CODE_OK,
                        'content'   =>
                        [
                            'type' => $form['params']->getData(),
                            'list' => $users_list
                        ]
                    ]
                );
            }
            catch( \App\lib\exceptions\actionException $e )
            {
                return $this->response( $e->getData() );
            }
        }

        ////////////////////////////////////////////////////////////////////////

        /**
         * Отримання запису одного користувача
         *
         * @param string $id
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route("/api/users/{id}", name="user_view", methods={"GET"})
         */
        public function getOneAction( string $id ): \Symfony\Component\HttpFoundation\JsonResponse
        {
            try
            {
                $id = intval($id);  // приводимо до int

                // перевірка на граничні умови int4 БД
                if( $id > \App\lib\consts::INT_MAX  || $id < \App\lib\consts::INT_MIN )
                {
                    throw new \App\lib\exceptions\actionException( \App\lib\consts::ERROR_ERROR_CODE_USER_GET_ID_INVALID_RANGE );
                }

                $user = $this
                    ->getDoctrine()
                    ->getRepository(\App\Entity\User::class)
                    ->find($id);

                return $this->response(
                    [
                        'code'      => \App\lib\consts::APPLICATION_CODE_OK,
                        'content'   =>
                        [
                            'id'            => $user->getId(),
                            'firstname'     => $user->getFirstName(),
                            'lastname'      => $user->getLastName(),
                            'email'         => $user->getEmail(),
                            'nickname'      => $user->getNickname(),
                            'age'           => $user->getAge(),
                            'created_date'  => $user->getCreateDate(),
                        ]
                    ]
                );
            }
            catch( \App\lib\exceptions\actionException $e )
            {
                return $this->response( $e->getData() );
            }
        }

        ////////////////////////////////////////////////////////////////////////
    }
}
