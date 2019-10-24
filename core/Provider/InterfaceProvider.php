<?php
namespace Core\Provider;

class InterfaceProvider
{
    const LANGUAGE_EN = 0;
    const LANGUAGE_RU = 1;

    /**
     * @param string $rawValue
     * @return mixed
     */
    public static function getInterfaceMessages($rawValue)
    {
        return self::getMessagesList()[self::getLanguage($rawValue)];
    }

    /**
     * @return array
     */
    private static function getLanguageAlias()
    {
        return [
            "en" => self::LANGUAGE_EN,
            "ru" => self::LANGUAGE_RU
        ];
    }

    /**
     * @param string $rawValue
     * @return string
     */
    private static function getLanguage($rawValue)
    {
        if (array_key_exists(($rawValue), self::getLanguageAlias())) {
            return self::getLanguageAlias()[$rawValue];
        }
        return self::getLanguageAlias()["ru"];
    }

    /**
     * @return array
     */
    private static function getMessagesList()
    {
        return [
            self::LANGUAGE_EN => [
                'header.homepage_button' => 'Homepage',
                'header.sign_up_button' => 'Sign up',
                'header.sign_in_button' => 'Sign in',
                'header.about_button' => 'About',

                'footer.choose_language' => 'Choose language',

                'homepage_page.form_header' => 'Welcome!',
                'homepage_page.intro_text' => 'Here you can try to create account and log in to the project. Upload your image, use validation and edit your profile. Enjoy!',
                'homepage_page.sign_up_button' => 'Sign up',
                'homepage_page.sign_in_button' => 'Sign in',

                'registration_page.form_header' => 'Registration form',
                'registration_page.form_username_label' => 'Username',
                'registration_page.form_username_placeholder' => 'Enter your username ...',
                'registration_page.form_password_label' => 'Password',
                'registration_page.form_password_placeholder' => 'Enter your password ...',
                'registration_page.form_email_label' => 'Email',
                'registration_page.form_email_placeholder' => 'Enter your email ...',
                'registration_page.form_full_name_label' => 'Full name',
                'registration_page.form_full_name_placeholder' => 'Enter your full name ...',
                'registration_page.form_agree_with_terms' => 'I agree to the terms and conditions',

                'form_error.required_field' => 'The field must be filled',
                'form_error.no_cyrillic_letters' => 'Only Latin characters, numbers, and punctuation are allowed',
                'form_error.only_cyrillic_dash_space' => 'Only Cyrillic characters, dash and space are allowed',
                'form_error.min_length' => 'Minimum number of characters',
                'form_error.max_length' => 'Maximum number of characters',
                'form_error.incorrect_email' => 'Incorrect email',
            ],
            self::LANGUAGE_RU => [
                'header.homepage_button' => 'Домашняя страница',
                'header.sign_up_button' => 'Регистрация',
                'header.sign_in_button' => 'Авторизация',
                'header.about_button' => 'О проекте',

                'footer.choose_language' => 'Выберите язык',

                'homepage_page.form_header' => 'Добро пожаловать!',
                'homepage_page.intro_text' => 'Здесь вы можете попробовать создать учетную запись и войти в проект. Загрузите свое изображение, используйте проверку и отредактируйте свой профиль. Наслаждайтесь!',
                'homepage_page.sign_up_button' => 'Регистрация',
                'homepage_page.sign_in_button' => 'Авторизация',

                'registration_page.form_header' => 'Форма регистрации',
                'registration_page.form_username_label' => 'Логин',
                'registration_page.form_username_placeholder' => 'Введите ваш логин ...',
                'registration_page.form_password_label' => 'Пароль',
                'registration_page.form_password_placeholder' => 'Введите ваш пароль ...',
                'registration_page.form_email_label' => 'Email',
                'registration_page.form_email_placeholder' => 'Введите вашу электронную почту ...',
                'registration_page.form_full_name_label' => 'ФИО',
                'registration_page.form_full_name_placeholder' => 'Введите ваше полное имя ...',
                'registration_page.form_agree_with_terms' => 'Я согласен с пользовательским соглашением',

                'form_error.required_field' => 'Поле должно быть заполнено',
                'form_error.no_cyrillic_letters' => 'Допускаются только латиница, цифры и знаки препинания',
                'form_error.only_cyrillic_dash_space' => 'Допускаются только кирилица, тире и пробел',
                'form_error.min_length' => 'Минимальное количество символов',
                'form_error.max_length' => 'Максимальное количество символов',
            ]
        ];
    }
}