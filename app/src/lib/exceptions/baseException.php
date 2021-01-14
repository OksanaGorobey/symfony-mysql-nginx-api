<?php declare(strict_types=1);
/**
 * @package     lib
 * @category    exceptions
 * @version     1.5
 */
namespace App\lib\exceptions
{
    /**
     * baseException
     */
    class baseException extends \Exception
    {
        ///////////////////////////////////////////////////////////////////////

        /**
         * @var array|array[]|string[]
         */
        protected $additional_data  = [];

        ///////////////////////////////////////////////////////////////////////

        /**
         * baseException constructor.
         * @param int $code
         * @param string $message
         * @param null $additional_data
         */
        public function __construct(int $code = 500, string $message = '', $additional_data = null )
        {
            $this->code     = $code;

            if( strlen( $message ) > 1 )
            {
                $this->message  = $message;
            }
            else
            {
                $this->message  = ( new \App\lib\core() )->l10n( 'errors_' . $code );
            }

            if( !is_null( $additional_data ) )
            {
                if( $additional_data instanceof \Exception )
                {
                    $this->additional_data =
                    [
                        'message'       => $additional_data->getMessage(),
                        'class'         => get_class( $additional_data ),
                        'fileline'      => $additional_data->getFile().':'.$additional_data->getLine(),
                        'trace'         => $additional_data->getTrace(),
                    ];
                }
                elseif( is_string($additional_data) || is_array($additional_data) )
                {
                    $this->additional_data =
                    [
                        'message'       => $additional_data,
                    ];
                }
            }
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Отримання даних для масиву $this->response_data з об'єкту Exception
         * Має виконуватись з блоку try{} catch( \lib\exceptions\baseExceptionInterface $e ) в action
         *
         * @return      array
         */
        public function getData() : array
        {
            $data =
            [
                'code'          => 500,
                'content'       => []
            ];

            if(
                $this instanceof baseException ||
                $this instanceof \App\lib\exceptions\actionException ||
                $this instanceof \App\lib\exceptions\odmException
            )
            {
                if( $this->getCode() > 0 )
                {
                    $data['code']   = $this->getCode();
                }

                if( !empty( $this->getMessage() ) )
                {
                    $data['content']['message'] = $this->getMessage();
                }
            }

            $data['content']['exception_message']   = $this->getMessage();
            $data['content']['exception_class']     = get_class( $this );
            $data['content']['exception_fileline']  = $this->getFile().':'.$this->getLine();
            $data['content']['exception_trace']     = $this->getTrace();

            if( !is_null($this->additional_data) )
            {
                $data['content']['additional_data']   = $this->additional_data;
            }


            return $data;
        }

        ///////////////////////////////////////////////////////////////////////
    }
}