<?php
namespace Wppool\Pizzapool\Core;
use Wppool\Pizzapool\Admin\Generators;

class Deactivator
{
    public static function deactivate(){
        global $wpdb;
        $generator=new Generators();
        $model= new PoolModel($wpdb);
        $model->delete_pool_schedule_table();
        $generator->CouponDeGenerator();
    }
}