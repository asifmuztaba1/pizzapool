<?php
namespace Wppool\Pizzapool\Core;
class Helper
{
    public static function CheckOpenClose(){
        $model=new PoolModel();
        $open_days=[
            'Sunday'=>[$model->getOpenTime(1),$model->getCloseTime(1)],
            'Monday'=>[$model->getOpenTime(2),$model->getCloseTime(2)],
            'Tuesday'=>[$model->getOpenTime(3),$model->getCloseTime(3)],
            'Wednesday'=>[$model->getOpenTime(4),$model->getCloseTime(4)],
            'Thursday'=>[$model->getOpenTime(5),$model->getCloseTime(5)],
            'Friday'=>[$model->getOpenTime(6),$model->getCloseTime(6)],
            'Saturday'=>[$model->getOpenTime(7),$model->getCloseTime(7)],
        ];
        $day=date("l");
        $time=date('H:i');
        $closed=false;
        foreach ($open_days as $key=>$od){
            if($day===$key and empty($od)){
                $closed=true;
            }else{
                $st_time    =   strtotime($od[0]);
                $end_time   =   strtotime($od[1]);
                $cur_time   =   strtotime($time);
                if(($st_time < $cur_time && $end_time > $cur_time) and $day===$key)
                {
                    $closed=false;
                    break;
                }
                else{
                    $closed=true;
                }
            }
        }
        return $closed;
    }
    public static function pplfod_has_bought() {

        $count = 0;
        $bought = false;

        if(!get_current_user_id()) {
            return false;
        }
        $customer_orders = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'orderby' => 'date',
            'order' => 'DESC',
            'meta_value' => get_current_user_id(),
            'post_type' => wc_get_order_types(),
            'post_status' => array_keys(wc_get_order_statuses()), 'post_status' => array('wc-processing'),
        ));
        foreach ( $customer_orders as $customer_order ) {
            $count++;
        }

        if ( $count > 0 ) {
            $bought = true;
        }
        return $bought;
    }
}