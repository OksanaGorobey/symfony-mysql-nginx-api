<?php declare(strict_types=1);

/**
 * @package     general
 * @category    lib
 * @version     2.0
 */
namespace App\lib
{
    class core
    {
        ///////////////////////////////////////////////////////////////////////

        private \Symfony\Contracts\Translation\TranslatorInterface $_l10n_obj;

        ///////////////////////////////////////////////////////////////////////

        /**
         * Конструктор core
         *
         */
        public function __construct()
        {
            $this->_l10n_obj        = new \Symfony\Component\Translation\Translator('uk');

            $this->_l10n_obj->addLoader('php', new \Symfony\Component\Translation\Loader\PhpFileLoader());
            $this->_l10n_obj->addResource('php',  __DIR__.'/../translations/messages.uk.php', 'uk');

        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Отримання l10n через обʼєкт l10n
         *
         * @param           string          $l10n_rule
         * @param           array           $params
         * @return          string
         */
        public function l10n( string $l10n_rule, array $params = [] ) : string
        {
            return $this->_l10n_obj->trans( $l10n_rule, $params );
        }

        ///////////////////////////////////////////////////////////////////////
    }
}