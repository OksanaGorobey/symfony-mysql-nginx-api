<?php


namespace App\Controller
{
    use Symfony\Component\Routing\Annotation\Route;

    /**
     * Class DefaultController
     * @package App\Controller
     */

    class DefaultController extends BaseController
    {
        ///////////////////////////////////////////////////////////////////////

        /**
         * Base index
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route( "/", name="index_api", methods={"GET"} )
         */
        public function indexAction( \Symfony\Contracts\Translation\TranslatorInterface $translator ) : \Symfony\Component\HttpFoundation\JsonResponse
        {
            $translator = new \Symfony\Component\Translation\Translator('uk_UK');
            $translator->addLoader('array', new \Symfony\Component\Translation\Loader\ArrayLoader());
//            $translator->addResource('array', 'messages.uk.php', 'uk_UK');
//            var_dump($translator->trans( 'Symfony is great') );


                        $translator->addResource('array', [
                'Symfony is great' => "J'aime Symfony"
            ], 'uk_UK');

            return $this->response(
                [
                    'code'          => \App\lib\consts::APPLICATION_CODE_OK,
                    'content'       =>
                    [
                        'message'   => $translator->trans('Symfony is great'),
//                        'message'   => $translator->trans('Symfony is great',
//                            [],
//                            'messages',
//                            'uk_UK' ),
                    ],
                ],
                \App\lib\consts::HTTP_CODE_OK
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Метод перевірки доступності
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route( "/ping", name="ping_api", methods={"GET"} )
         */
        public function pingAction() : \Symfony\Component\HttpFoundation\JsonResponse
        {
            return $this->response(
                [
                    'code'          => \App\lib\consts::APPLICATION_CODE_OK,
                    'content'       =>
                    [
                        'message'   => 'pong',
                    ],
                ],
                \App\lib\consts::HTTP_CODE_OK
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Помилка 403
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route( "/error403", name="error404_api", methods={ "GET" } )
         */
        public function error403Action() : \Symfony\Component\HttpFoundation\JsonResponse
        {
            return $this->response(
                [
                    'code'          => \App\lib\consts::APPLICATION_CODE_FORBIDDEN,
                    'content'       =>
                    [
                        'message'   => 'Forbidden',
                    ],
                ],
                \App\lib\consts::HTTP_CODE_FORBIDDEN
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Помилка 404
         *
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         *
         * @Route( "/error404", name="error404_api", methods={"GET"} )
         */
        public function error404Action() : \Symfony\Component\HttpFoundation\JsonResponse
        {
            return $this->response(
                [
                    'code'          => \App\lib\consts::APPLICATION_CODE_NOT_FOUND,
                    'content'       =>
                    [
                        'message'   => 'Not Found',
                    ],
                ],
                \App\lib\consts::HTTP_CODE_NOT_FOUND
            );
        }

        ///////////////////////////////////////////////////////////////////////
    }
}