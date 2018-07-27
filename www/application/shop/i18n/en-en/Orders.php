<?php
/**
 * File Language
 *
 * model =
 * model prop Status =
 * model prop Status validate key1 =
 * model prop Status validate key2 =
 * model prop Status option cold =
 * model prop Status option hot =
 *
 * controller Zero_Users_Grid =
 * controller Zero_Users_Grid action name1 =
 * controller Zero_Users_Grid action name2 =
 * controller Zero_Users_Grid message name1 =
 * controller Zero_Users_Grid message name2 =
 *
 * 'translation Key' => 'Translation Value'
 */
return [
    'model' => [
        'Property all' => 'Все свойства',
        'ID' => 'ID',
        'Zero_Users_ID' => 'Клиент',
        'Name' => 'Заказ',
        'DateCreate' => 'Дата создания',
        'Address' => 'Адресс доставки',
        'Comment' => 'Комментарий',
        'Status' => 'Статус заказа',
        'Status options' => ['complete' => 'Выполнен', 'work' => 'В обработке', 'create' => 'Новый'],
    ],
    'view' => [

    ],
    'controller' => [
        'Action_Order' => 'оформить заказ',
    ],
];
