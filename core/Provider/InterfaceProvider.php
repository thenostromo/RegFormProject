<?php
namespace Core\Provider;

class InterfaceProvider
{
    const LANGUAGE_EN = 0;
    const LANGUAGE_RU = 1;

    /**
     * @return array
     */
    public static function getInterfaceMessages()
    {
        $userLang = self::getUserDefaultLanguage();
        return self::getMessagesList()[self::getLanguage($userLang)];
    }

    /**
     * @param string $id
     * @return string
     */
    public static function getInterfaceMessage($id)
    {
        return self::getInterfaceMessages()[$id];
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
     * @return string|null
     */
    private static function getUserDefaultLanguage()
    {
        return isset($_COOKIE["defaultLanguage"]) ? $_COOKIE["defaultLanguage"] : null;
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

                'homepage_page.title' => 'Homepage',
                'homepage_page.form_header' => 'Welcome!',
                'homepage_page.intro_text' => 'Here you can try to create account and log in to the project. Upload your image, use validation and edit your profile. Enjoy!',
                'homepage_page.sign_up_button' => 'Sign up',
                'homepage_page.sign_in_button' => 'Sign in',

                'registration_page.title' => 'Registration',
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
                'registration_page.form_image_plugin_placeholder' => 'Drag the image into this field or click here. Allowed file size up to 5 mb.',

                'login_page.title' => 'Authorization',
                'login_page.form_header' => 'Authorization form',
                'login_page.form_username_label' => 'Username',
                'login_page.form_username_placeholder' => 'Enter your username ...',
                'login_page.form_password_label' => 'Password',
                'login_page.form_password_placeholder' => 'Enter your password ...',

                'profile_page.title' => 'Profile',
                'profile_page.form_header' => 'Your profile!',
                'profile_page.username_label' => 'Username',
                'profile_page.email_label' => 'Email',
                'profile_page.fullname_label' => 'Full name',
                'profile_page.avatar_label' => 'Avatar',

                'about_page.title' => 'About',
                'about_page.form_header' => "About project",

                'error_page.title' => 'Error',
                'error_page.form_header_404' => 'Error 404. Page not found.',

                'form_error.required_field' => 'The field must be filled',
                'form_error.eng_chars_number_and_punct' => "The field can contain only latin letters, numbers and signs (_.-)",
                'form_error.only_cyrillic_dash_space' => 'Only Cyrillic characters, dash and space are allowed',
                'form_error.min_length' => 'Minimum number of characters',
                'form_error.max_length' => 'Maximum number of characters',
                'form_error.incorrect_email' => 'Incorrect email',

                'form_error_api.empty_required_parameters' => 'Empty required parameters',
                'form_error_api.user_already_exist' => 'User already exist',
                'form_error_api.wrong_credentials' => 'Wrong credentials',
                'form_error_api.invalid_data' => 'Check the correctness of the entered data',

                'form_button.submit' => 'Submit',
                'form_button.cancel' => 'Reset',
                'form_button.logout' => 'Log out'
            ],
            self::LANGUAGE_RU => [
                'header.homepage_button' => 'Домашняя страница',
                'header.sign_up_button' => 'Регистрация',
                'header.sign_in_button' => 'Авторизация',
                'header.about_button' => 'О проекте',

                'footer.choose_language' => 'Выберите язык',

                'homepage_page.title' => 'Домашная страница',
                'homepage_page.form_header' => 'Добро пожаловать!',
                'homepage_page.intro_text' => 'Здесь вы можете попробовать создать учетную запись и войти в проект. Загрузите свое изображение, используйте проверку и отредактируйте свой профиль. Наслаждайтесь!',
                'homepage_page.sign_up_button' => 'Регистрация',
                'homepage_page.sign_in_button' => 'Авторизация',

                'registration_page.title' => 'Регистрация',
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
                'registration_page.form_image_plugin_placeholder' => 'Перетащите изображение в это поле или нажмите здесь. Допустимый размер файлов до 5 мб.',

                'login_page.title' => 'Авторизация',
                'login_page.form_header' => 'Форма авторизации',
                'login_page.form_username_label' => 'Логин',
                'login_page.form_username_placeholder' => 'Введите ваш логин ...',
                'login_page.form_password_label' => 'Пароль',
                'login_page.form_password_placeholder' => 'Введите ваш пароль ...',

                'profile_page.title' => 'Профиль',
                'profile_page.form_header' => 'Ваш профиль!',
                'profile_page.username_label' => 'Логин',
                'profile_page.email_label' => 'Электронная почта',
                'profile_page.fullname_label' => 'ФИО',
                'profile_page.avatar_label' => 'Аватар',

                'about_page.title' => 'О проекте',
                'about_page.form_header' => "О проекте",

                'error_page.title' => 'Ошибка',
                'error_page.form_header_404' => 'Ошибка 404. Страница не найдена.',

                'form_error.required_field' => 'Поле должно быть заполнено',
                'form_error.eng_chars_number_and_punct' => "Поле может содержать только латинские буквы, цифры и знаки (_.-)",
                'form_error.only_cyrillic_dash_space' => 'Допускаются только кирилица, тире и пробел',
                'form_error.min_length' => 'Минимальное количество символов',
                'form_error.max_length' => 'Максимальное количество символов',
                'form_error.incorrect_email' => 'Некорректный email',

                'form_error_api.empty_required_parameters' => 'Не все поля заполнены',
                'form_error_api.user_already_exist' => 'Пользователь с таким логином/электронной почтой уже существует',
                'form_error_api.wrong_credentials' => 'Неправильный логин или пароль',
                'form_error_api.invalid_data' => 'Проверьте корректность введенных данных',

                'form_button.submit' => 'Отправить',
                'form_button.cancel' => 'Очистить',
                'form_button.logout' => 'Выйти из профиля'
            ]
        ];
    }
}