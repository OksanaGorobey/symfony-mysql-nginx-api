<?php declare(strict_types=1);

/**
 * @package     general
 * @category    lib/responses
 * @version     2.0
 */
namespace App\lib\responses
{
    /**
     * Простий response для JSON
     *
     */
    class jsonResponse
    {
        ///////////////////////////////////////////////////////////////////////


        /**
         * Повертаємо JSON response
         *
         * @param array $data
         * @param int $status
         * @param array $headers
         * @return \Symfony\Component\HttpFoundation\JsonResponse
         */
        public static function response(array $data, int $status = \App\lib\consts::HTTP_CODE_OK, array $headers = [] ) : \Symfony\Component\HttpFoundation\JsonResponse
        {
            return ( new \Symfony\Component\HttpFoundation\JsonResponse( $data ) )
                ->setEncodingOptions( \App\lib\consts::JSON_UNESCAPED_UNICODE );
        }

        ///////////////////////////////////////////////////////////////////////
    }
}