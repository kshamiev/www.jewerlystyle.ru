<?php
/**
 * The basic configuration of the all application.
 */
return [
    //  site settings
    'Site' => [
        //  The path to the php Interpreter (see command: whereis php)
        'PathPhp' => '/usr/bin/php',
        //  General Authorization Application
        'AccessLogin' => '',
        'AccessPassword' => '',
        //  Site name (of the project)
        'Name' => "Стильная бижутерия",
        //  Email the site (by default)
        'Email' => "info@jewerlystyle.ru",
        //  Timeout online users status
        'UsersTimeoutOnline' => 600,
        //  Using a caching system
        'IsCache' => false,
        //  Parsing the templates view
        'TemplateParsing' => true,
        //  Language of the site by default
        'Language' => "ru-ru",
        //  Domain of the site by default
        'Domain' => 'jewerlystyle.ru',
        //  Static Data Domain Site (css, js, img - design)
        'DomainAssets' => '',
        //  Domain binary data (uploaded by users)
        'DomainUpload' => '',
    ],
    //  Access for DB (Mysql)
    'Db' => [
        //  Profiling
        'main' => [
            'Host' => "localhost", //  Host or Socket
            'Login' => "jewerlystyle", //  User
            'Password' => "jewerlystyle", //  Password
            'Name' => "jewerlystyle", //  Name DB
        ],
    ],
    //  The settings of the presentation of data
    'View' => [
        //  Number of items per page
        'PageItem' => "20",
        //  The range of visible pages
        'PageStep' => "11",
    ],
    //  Monitoring
    'Log' => [
        //  Profiling
        'Profile' => [
            //  Fatal errors
            'Error' => true,
            //  Warning
            'Warning' => true,
            //  Notice
            'Notice' => true,
            //  User action
            'Action' => true,
            //  Work the application as a whole
            'Application' => true,
        ],
        //  Output
        'Output' => [
            //  File
            'File' => true,
            //  Display
            'Display' => false,
        ],
    ],
    //  Languages
    'Language' => [
        'en-en' => 'English',
        'ru-ru' => 'Русский',
    ],
    //  Servers Memcache
    'Memcache' => [
        //  For Cache data
        'Cache' => [
            //  'localhost:11211'
        ],
        //  Session storage
        'Session' => [
            //  'localhost:11211'
        ],
    ],
];
