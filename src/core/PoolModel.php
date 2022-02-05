<?php

namespace Wppool\Pizzapool\Core;

class PoolModel
{
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        add_action('wp_ajax_update_open_close', array($this, 'update_open_close'));
        add_action('wp_ajax_nopriv_update_open_close', array($this, 'update_open_close'));
        add_action('wp_ajax_add_order_type', array($this, 'add_order_type'));
        add_action('wp_ajax_nopriv_add_order_type', array($this, 'add_order_type'));
    }

    public function create_pool_schedule_table(): void
    {
        $create_table_query = "
            CREATE TABLE IF NOT EXISTS `{$this->wpdb->prefix}pizza_pool_schedule` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `day` int(11)  NOT NULL,
              `open` text  NULL,
              `close` text  NULL,
                `status` bit
            )";
        dbDelta($create_table_query);
    }

    public function create_order_type_table(): void
    {
        $create_table_query = "
            CREATE TABLE IF NOT EXISTS `{$this->wpdb->prefix}pizza_pool_order_type_table` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
              `name` text NULL,
              `amount` text  NULL,
              `type` text  NULL
            )";
        dbDelta($create_table_query);
    }

    public function delete_pool_schedule_table()
    {
        $table_name = $this->wpdb->prefix . 'pizza_pool_schedule';
        $sql = "DROP TABLE IF EXISTS `$table_name`";
        $this->wpdb->query($sql);
        delete_option("my_plugin_db_version");
    }

    public function delete_pool_order_type_table()
    {
        $table_name = $this->wpdb->prefix . 'pizza_pool_order_type_table';
        $sql = "DROP TABLE IF EXISTS `$table_name`";
        $this->wpdb->query($sql);
        delete_option("my_plugin_db_version");
    }

    public function getOpenTime($id)
    {

        $tableName = $this->wpdb->prefix . 'pizza_pool_schedule';
        $result = $this->wpdb->get_results(
            "SELECT * 
        FROM  `$tableName`
        WHERE `day` = $id"
        );
        if (count($result) < 1):
            return '';
        else:
            return $result[0]->open;
        endif;
    }

    public function getCloseTime($id)
    {
        $tableName = $this->wpdb->prefix . 'pizza_pool_schedule';
        $result = $this->wpdb->get_results(
            "SELECT * 
        FROM  `$tableName`
        WHERE `day` = $id"
        );
        if (count($result) < 1):
            return '';
        else:
            return $result[0]->close;
        endif;
    }

    public function getStatusTime($id)
    {
        $tableName = $this->wpdb->prefix . 'pizza_pool_schedule';
        $result = $this->wpdb->get_results(
            "SELECT * 
        FROM  `$tableName`
        WHERE `day` = $id"
        );
        if (count($result) < 1):
            return '';
        else:
            return $result['status'];
        endif;
    }

    public function add_order_type()
    {
        $tableName = $this->wpdb->prefix . 'pizza_pool_order_type_table';
        $this->wpdb->insert($tableName, array(
            "name" => $_POST['name'],
            "amount" => $_POST['amount'],
            "type" => $_POST['type'],
        ));
        die();
    }

    public function getOrderTypes($op=false)
    {

        $tableName = $this->wpdb->prefix . 'pizza_pool_order_type_table';
        $result = $this->wpdb->get_results(
            "SELECT * 
        FROM  `$tableName`"
        );
        $options=[];
        foreach ($result as $res){
            $options[]=array($res->name.'--'.$res->type.'--'.$res->amount => $res->name);
        }
        if($op){
            return array_reduce($options, 'array_merge', array());
        }
        return $result;
    }

    public function update_open_close()
    {
        $tableName = $this->wpdb->prefix . 'pizza_pool_schedule';
        $result = $this->wpdb->get_results(
            "SELECT * 
        FROM  `$tableName`
        WHERE `day` = $_POST[day]"
        );
        if (count($result) < 1):
            $this->wpdb->insert($tableName, array(
                "day" => $_POST['day'],
                "open" => $_POST['opentime'],
                "close" => $_POST['closetime'],
            ));
        else:
            $this->wpdb->update($tableName, array(
                "open" => $_POST['opentime'],
                "close" => $_POST['closetime'],
            ), array('day' => $_POST['day']));
        endif;
        die();
    }
}