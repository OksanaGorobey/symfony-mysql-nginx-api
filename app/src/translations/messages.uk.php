<?php

namespace App\translations;

return
[
    'errors_' . \App\lib\consts::ERROR_CODE_USER_LOGIN_FIELDS_INCORRECT             => 'Помилка. Не вірно заповнені поля авторизації.',
    'errors_' . \App\lib\consts::ERROR_CODE_USER_LOGIN_USER_NOT_FOUND               => 'Помилка. Користувача не знайдено. Перевірте логін чи пароль.',

    'errors_' . \App\lib\consts::ERROR_CODE_USER_REGISTRATION_FIELDS_INCORRECT      => 'Помилка. Не вірно заповнені поля реєстрації.',
    'errors_' . \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_NICKNAME    => 'Помилка. Користувач із таким NICKNAME вже зараєстрований в системі.',
    'errors_' . \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_EMAIL       => 'Помилка. Користувач із такою поштою вже зараєстрований в системі.',

    'errors_' . \App\lib\consts::ERROR_CODE_USER_LIST_PARAMS_INCORRECT              => 'Помилка. Не вірно заповнені параметри.',

    'errors_' . \App\lib\consts::ERROR_ERROR_CODE_USER_GET_ID_INVALID_RANGE         => 'Помилка. Користувача не знайдено.',

    'error_403'                  => '403 помилка. Доступ заборонено. У вас відсутній доступ до цієї сторінки.',
    'error_404'                  => '404 помилка. Сторінку не знайдено. Схоже, ви опинилися тут випадково?',
    'general_page'               => 'Привіт, тестуй! )',

    'admins_edit_form_passwd_is_required'                    => 'Поле "Пароль" обов\'язкове',
    'admins_edit_form_passwd_is_invalid'                     => 'Помилка заповнення поля "Пароль"',
];