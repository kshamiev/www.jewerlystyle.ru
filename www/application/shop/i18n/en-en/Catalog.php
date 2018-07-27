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
        'IsAuthorized' => 'Раздел авторизованный',
        'IsAuthorized options' => ['no' => 'нет', 'yes' => 'да'],
        'IsVisible' => 'Видимость в навигации',
        'IsVisible options' => ['no' => 'нет', 'yes' => 'да'],
        'IsEnable' => 'Раздел включен',
        'IsEnable options' => ['no' => 'нет', 'yes' => 'да'],
        'Name' => 'Название',
        'Sort' => 'Сортировка',
        'Url' => 'Абсолютная ссылка',
        'UrlRedirect' => 'Редирект',
        'UrlThis' => 'Относительная ссылка',
        'Zero_Section_ID' => 'Родительский раздел',
        'Description' => 'Описание',
        'Content' => 'Контент',
        'Keywords' => 'Ключи',
        'Title' => 'Титул',
        'Layout' => 'Шаблон',
        'Controller' => 'Контроллер',
    ],
    'view' => [

    ],
    'controller' => [
        'Action_CatalogMove' => 'переместить',
        'Zero_Section_Edit' => 'Изменение разделов',
        'Action_Add' => 'добавить',
        'Action_Save' => 'сохранить',
        'Zero_Section_Grid' => 'Список разделов сайты постранично',
        'Action_Edit' => 'изменить',
        'Action_Remove' => 'удалить',
        'Action_UpdateUrl' => 'обновить роутинг',
        'Action_Default' => 'контроллер по умолчанию',
        'Action_FilterSet' => 'утановка фильтра',
        'Action_FilterReset' => 'сброс фильтра',
        'Action_Export' => 'Экспорт'
    ],
];
