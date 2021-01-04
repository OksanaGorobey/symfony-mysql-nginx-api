<?php declare(strict_types=1);
namespace App\Controller
{
    /**
     * Class BaseController
     * @package App\Controller
     */
    class BaseController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
    {
        ///////////////////////////////////////////////////////////////////////

        /**
         * Повертаємо JSON response
         *
         * @param array $data
         * @param int   $status
         * @param array $headers
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         */
        public function response( array $data, int $status = \App\lib\consts::HTTP_CODE_OK, array $headers = [] ) : \Symfony\Component\HttpFoundation\JsonResponse
        {
            return ( new \Symfony\Component\HttpFoundation\JsonResponse( $data ) )
                ->setEncodingOptions( \App\lib\consts::JSON_UNESCAPED_UNICODE );
        }

        ///////////////////////////////////////////////////////////////////////
    }
}
