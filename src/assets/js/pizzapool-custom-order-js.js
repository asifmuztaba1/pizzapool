jQuery('#order_type_checkout_field').on('change', function(){
    var order_id=jQuery(this).val()
    var order_name=order_id.split('--')[0];
    var order_per=order_id.split('--')[1];
    var order_am=order_id.split('--')[2];
    console.log(
        order_id,order_name,order_per,order_am

    );
    var order_fee=0;
    if(order_per=='Percentage'){
        order_fee=order_am/100;
    }else{
        order_fee=order_am;
    }
    var data = {
        'action': 'change_total',
        'order_name': order_name,
        'order_fee':order_fee,
        'order_id':order_id
    };
    jQuery.post(ajax_object.ajax_url, data, function(response) {
        location.reload();
    });
});