<?php
namespace Wppool\Pizzapool\Core;


use Wppool\Pizzapool\Admin\HooksDao;

class BootLoader
{
    protected $pluginName;
    protected $pluginVersion;
    protected $pluginLoader;

    public function __construct()
    {
        $hooksDao=new HooksDao();
        $poolModel=new PoolModel();
        //var_dump($poolModel->getOrderTypes(true));
    }

    public function PizzaPoolOrderCustomActivator(): void
    {
        Activator::activate();
    }
    public function PizzaPoolOrderCustomDeActivator(): void
    {
        Deactivator::deactivate();
    }
    public function add_custom_scripts(){
        add_action( 'wp_enqueue_scripts', array($this->constants,'setScripts') );
    }
}