<?php
$config= array(
    'baseUrl' => 'mytodolist/',

    'database' => array(
        'host' => 'localhost',
        'port' => 3306,
        'username' => 'ana',
        'password' => 'ana',
        'database' => 'mytodolist',
        'driver' => 'mysql',
        'charset' => 'utf8'
    )
);

class App{
    protected static $instance;
    public $config;

    protected function __construct($config){
        $this->config= $config;
        define('ROOT_PATH', realpath(dirname(__FILE__)) . '/');
    }

    public static function createApp($config){
        App::$instance= new App($config);
    }
    /** 
     * @return App
     */
    public static function getInstance(){
        return App::$instance;
    }
}

App::createApp($config);