(function ($) {
    function ajaxCall(datam){
        $.ajax({
            url:ajax_object_admin.ajax_url_admin,
            data: datam,
            method: "POST",
            success: function (response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your Data has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })},
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    $('#sundaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#sundayopen').val();
        let close = $('#sundayclose').val();
        let dayid = 1;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#mondaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#mondayopen').val();
        let close = $('#mondayclose').val();
        let dayid = 2;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#tuesdaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#tuesdayopen').val();
        let close = $('#tuesdayclose').val();
        let dayid = 3;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#wednesdaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#wednesdayopen').val();
        let close = $('#wednesdayclose').val();
        let dayid = 4;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#thursdaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#thursdayopen').val();
        let close = $('#thursdayclose').val();
        let dayid = 5;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#fridaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#fridayopen').val();
        let close = $('#fridayclose').val();
        let dayid = 6;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#saturdaysubmit').on('click', function () {
        console.log('asif');
        let open = $('#saturdayopen').val();
        let close = $('#saturdayclose').val();
        let dayid = 7;
        var data = {
            'action': 'update_open_close',
            'day': dayid,
            'opentime': open,
            'closetime': close
        }
        ajaxCall(data);
    });
    $('#ordertypeform').on('submit', function (){
        var name=$('.name').val();
        var amount=$('.amount').val();
        var type=$('.type').val();
        var data = {
            'action': 'add_order_type',
            'name': name,
            'amount': amount,
            'type': type
        }
        $.ajax({
            url:ajax_object_admin.ajax_url_admin,
            data: data,
            method: "POST",
            success: function (response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your Data has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })},
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
        console.log(name,amount,type);
        return false;
    });
})(jQuery);