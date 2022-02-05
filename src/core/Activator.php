<?php
namespace Wppool\Pizzapool\Core;
use Wppool\Pizzapool\Admin\Generators;

class Activator
{
    public static function activate(): void
    {
        global $wpdb;
        $generator=new Generators();
        $model= new PoolModel($wpdb);
        $model->create_pool_schedule_table();
        $model->create_order_type_table();
        $generator->CouponGenerator();
    }
}