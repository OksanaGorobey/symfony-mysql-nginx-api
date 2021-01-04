<?php declare(strict_types=1);
/**
 * @package     App
 * @category    lib
 * @version     1.2
 */
namespace App\lib
{
    /**
     * consts Class
     *
     */
    class consts
    {
        const JSON_UNESCAPED_UNICODE                                = 256;

        // HTTP CODES //////////////////////////////////////////////////////////

        const HTTP_CODE_OK                                          = 200;
        const HTTP_CODE_CREATED                                     = 201;
        const HTTP_CODE_FOUND                                       = 302;
        const HTTP_CODE_UNAUTHORIZED                                = 401;
        const HTTP_CODE_FORBIDDEN                                   = 403;
        const HTTP_CODE_NOT_FOUND                                   = 404;
        const HTTP_CODE_INTERNAL_SERVER_ERROR                       = 500;

        // APPLICATION CODES ///////////////////////////////////////////////////

        const APPLICATION_CODE_OK                                   = 200;
        const APPLICATION_CODE_FOUND                                = 302;
        const APPLICATION_CODE_FORBIDDEN                            = 403;
        const APPLICATION_CODE_NOT_FOUND                            = 404;
        const APPLICATION_CODE_INTERNAL_SERVER_ERROR                = 500;

        /////// login //////////////////////////////////////////////////////////

        const ERROR_CODE_USER_LOGIN_FIELDS_INCORRECT                = 10101;
        const ERROR_CODE_USER_LOGIN_USER_NOT_FOUND                  = 10102;

        /////// registration ///////////////////////////////////////////////////

        const ERROR_CODE_USER_REGISTRATION_FIELDS_INCORRECT         = 10201;
        const ERROR_CODE_USER_REGISTRATION_DUPLICATE_NICKNAME       = 10202;
        const ERROR_CODE_USER_REGISTRATION_DUPLICATE_EMAIL          = 10203;

        /////// list //////////////////////////////////////////////////////////

        const ERROR_CODE_USER_LIST_PARAMS_INCORRECT                 = 10301;

        /////// view /////////////////////////////////////////////////////////

        const ERROR_ERROR_CODE_USER_GET_ID_INVALID_RANGE            = 10401;

        ////// validation //////////////////////////////////////////////////////

        const PATTERN_EMAIL                                         = '#^[-a-zA-Z0-9!\#$%&\'*+/=?_`{|}~]+(\.[-a-zA-Z0-9!\#$%&\'*+/=?_`{|}~]+)*@([a-zA-ZАаБбВвГгҐґДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЮюЯяЬь0-9_][-a-zA-ZАаБбВвГгҐґДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЮюЯяЬь0-9_]*(\.[-a-zA-ZАаБбВвГгҐґДдЕеЄєЖжЗзИиІіЇїЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЮюЯяЬь0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|укр|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$#';
        const PATTERN_NICKNAME                                      = '#^[A-Za-z0-9_\-]+$#';
        const PATTERN_NAME                                          = '#^[A-Za-z]+$#';

        const AGE_MAX                                               = 115;
        const AGE_MIN                                               = 16;

        const PASSWORD_MINLENGTH                                    = 6;
        const PASSWORD_MAXLENGTH                                    = 64;

        const NAME_MINLENGTH                                        = 2;
        const NAME_MAXLENGTH                                        = 50;

        ////////////////////////////////////////////////////////////////////////

        const INT_MAX                                               = 2147483647;
        const INT_MIN                                               = 1;

        const JWT_SALT                                              = 'HS256';
        const DATETIME_FORMAT_ESCAPED                               = 'd.m.Y H:i';

        ////////////////////////////////////////////////////////////////////////
    }
}