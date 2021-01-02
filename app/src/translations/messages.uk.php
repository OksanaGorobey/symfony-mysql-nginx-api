<?php

namespace App\translations;

return
[

    'error_403'                  => '403 помилка. Доступ заборонено. У вас відсутній доступ до цієї сторінки.',
    'error_404'                  => '404 помилка. Сторінку не знайдено. Схоже, ви опинилися тут випадково?',
    'general_page'               => 'Привіт, тестуй! )',

    'form_password_is_required'             => 'Поле "Пароль" обов\'язкове.',
    'form_password_is_invalid_minlength'    => 'Помилка заповнення поля "Пароль". Необхідно ввести не менше %limit% символів.',
    'form_password_is_invalid_maxlength'    => 'Помилка заповнення поля "Пароль". Необхідно ввести не більше %limit% символів.',

    'form_nickname_is_required'             => 'Поле "Кличка" обов\'язкове.',
    'form_nickname_is_invalid'              => 'Помилка заповнення поля "Кличка".',
    'form_nickname_is_invalid_minlength'    => 'Помилка заповнення поля "Кличка". Необхідно ввести не менше %limit% символів.',
    'form_nickname_is_invalid_maxlength'    => 'Помилка заповнення поля "Кличка". Необхідно ввести не більше %limit% символів.',

    'form_firstname_is_required'            => 'Поле "Ім\'я" обов\'язкове.',
    'form_firstname_is_invalid'             => 'Помилка заповнення поля "Ім\'я".',
    'form_firstname_is_invalid_minlength'   => 'Помилка заповнення поля "Ім\'я". Необхідно ввести не менше %limit% символів.',
    'form_firstname_is_invalid_maxlength'   => 'Помилка заповнення поля "Ім\'я". Необхідно ввести не більше %limit% символів.',

    'form_lastname_is_required'             => 'Поле "Прізвище" обов\'язкове.',
    'form_lastname_is_invalid'              => 'Помилка заповнення поля "Прізвище".',
    'form_lastname_is_invalid_minlength'    => 'Помилка заповнення поля "Прізвище". Необхідно ввести не менше %limit% символів.',
    'form_lastname_is_invalid_maxlength'    => 'Помилка заповнення поля "Прізвище". Необхідно ввести не більше %limit% символів.',

    'form_age_is_required'                  => 'Поле "Вік" обов\'язкове',
    'form_age_is_invalid_range'             => 'Помилка заповнення поля "Вік". Ваш вік має бути від %min% років та не більше %max%.',

    'form_email_is_required'                => 'Поле "E-mail" обов\'язкове.',
    'form_email_is_invalid'                 => 'Помилка заповнення поля "E-mail".',

    'form_params_is_required'               => 'Поле "Параметр" обов\'язкове.',
    'form_params_is_invalid'                => 'Помилка заповнення поля "Параметр". Дозволено лише "email" або "nickname".',

    'errors_' . \App\lib\consts::ERROR_CODE_USER_LOGIN_FIELDS_INCORRECT             => 'Помилка. Не вірно заповнені поля авторизації.',
    'errors_' . \App\lib\consts::ERROR_CODE_USER_LOGIN_USER_NOT_FOUND               => 'Помилка. Користувача не знайдено. Перевірте логін чи пароль.',

    'errors_' . \App\lib\consts::ERROR_CODE_USER_REGISTRATION_FIELDS_INCORRECT      => 'Помилка. Не вірно заповнені поля реєстрації.',
    'errors_' . \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_NICKNAME    => 'Помилка. Користувач із таким NICKNAME вже зараєстрований в системі.',
    'errors_' . \App\lib\consts::ERROR_CODE_USER_REGISTRATION_DUPLICATE_EMAIL       => 'Помилка. Користувач із такою поштою вже зараєстрований в системі.',

    'errors_' . \App\lib\consts::ERROR_CODE_USER_LIST_PARAMS_INCORRECT              => 'Помилка. Не вірно заповнені параметри.',

    'errors_' . \App\lib\consts::ERROR_ERROR_CODE_USER_GET_ID_INVALID_RANGE         => 'Помилка. Користувача не знайдено.',

];