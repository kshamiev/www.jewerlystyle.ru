<?php
/**
 * Created by PhpStorm.
 * User: Константин
 * Date: 12.05.14
 * Time: 0:34
 */
return [
    'model' => [
        'Date' => 'Дата регистрации',
        'DateOnline' => 'Дата посещения',
        'Email' => 'Email',
        'Error_ValidEmail' => 'Электронный адрес неправильный',
        'Error_NotValid' => 'Поле заполнено не корректно',
        'Error_NotRegistration' => 'Адрес не зарегистрирован',
        'Error_Registration' => 'Адрес уже занят',
        'ID' => 'Идентификатор',
        'ImgAvatar' => 'Фото - Аватар',
        'ImgAvatar validate Error Upload File' => 'Ошибка загрузки файла',
        'ImgAvatar validate Error Image Resize' => 'Ошибка обработки картинки',
        'IsAccess' => 'Статус доступа',
        'IsAccess options' => ['close' => 'закрыт', 'open' => 'открыт'],
        'IsCondition' => 'Условие пользователя',
        'IsCondition options' => ['no' => 'нет', 'yes' => 'да'],
        'IsOnline' => 'Статус присутствия',
        'IsOnline options' => ['no' => 'нет', 'yes' => 'да'],
        'IsNews' => 'Подписка на новости',
        'IsNews options' => ['no' => 'нет', 'yes' => 'да'],
        'Keystring' => 'Контрольная строка',
        'Keystring validate Error_Keystring' => 'Контрольная строка не совпадает',
        'Login' => 'Логин',
        'Login validate Error_Exists' => 'Логин уже занят',
        'Name' => 'ФИО',
        'Password' => 'Пароль',
        'PasswordR' => 'Пароль еще раз',
        'Password validate Error_PasswordValid' => 'Пароли не совпадают',
        'PasswordR validate Error_PasswordValid' => 'Пароли не совпадают',
        'Phone' => 'Телефон',
        'Skype' => 'Скайп',
        'Zero_Groups_ID' => 'Группа',
        'Zero_Users_ID' => 'Пользователь',
        'Address' => 'Адрес доставки по умолчанию',

    ],
    'view' => [

    ],
    'controller' => [
        'Action_Login' => 'вход',
        'Action_Reminder' => 'напоминание',
        'Action_Logout' => 'выход',
        'Action_Registration' => 'регистрация',
        'Action_Profile' => 'изменить профиль',

    ],
];