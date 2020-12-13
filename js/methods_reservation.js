//CONFIRMA MEDIANTE UNA NOTIFICACION LA RESEVACION Y PROCEDE A ACTUALIZAR
function reservationConfirmed(id_cus, id_res, message) {
    var id = id_cus;
    var title = "Estado de su reservación";
    var msg = "¡Su reservación fue confirmado!";
    $("#btn-conf").addClass('disabled');
    $("#btn-deny").addClass('disabled');

    $.ajax({
        url: "pushNotifications/sendSinglePush.php",
        method: "POST",
        data: {
            'username': id,
            'title': title,
            'message': msg
        },
        success: function (data) {

            let succ = 0;
            let err = 0;

            if (data) {
                var result = $.parseJSON(data);
                //console.log("" + result['multicast_id'] + "\nsucc: " + result['success']);

                succ = result['success'];
                err = result['failure'];

                if (succ == 1) {

                    $('#PositiveModal').modal('hide');
                    $('#toastDone').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = "yes";
                    //updateRes(id_res, id_cus, type);

                } else if (err == 1) {

                    $("#btn-conf").removeClass('disabled');
                    $("#btn-deny").removeClass('disabled');

                    $('#PositiveModal').modal('hide');
                    $('#toastError').toast('show');

                }
            }

        },
        error: function (req, err) {
            console.log('my message' + err);
            $('#PositiveModal').modal('hide');
            $('#toastError').toast('show');
            $("#btn-conf").removeClass('disabled');
            $("#btn-deny").removeClass('disabled');
            console.log("no se logro enviar la notificacion");
        }
    });
}

//CONFIRMA MEDIANTE UNA NOTIFICACION LA RESEVACION Y PROCEDE A ACTUALIZAR
function reservationRechazed(id_cus, id_res) {
    var id = id_cus;
    var title = "¡Su Reservación fue rechazada!";
    var message = "En unos minutos puede intentarlo nuevamente.";

    $("#btn-con").addClass('disabled');

    $.ajax({
        url: "pushNotifications/sendSinglePush.php",
        method: "POST",
        data: {
            'username': id,
            'title': title,

            'message': message
        },
        success: function (data) {

            let succ = 0;
            let err = 0;

            if (data) {
                var result = $.parseJSON(data);
                //console.log("" + result['multicast_id'] + "\nsucc: " + result['success']);

                succ = result['success'];
                err = result['failure'];

                if (succ == 1) {

                    $('#NegativeModal').modal('hide');
                    $('#toastRechazed').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = "no";
                    //updateRes(id_res, id_cus, type);

                } else if (err == 1) {

                    console.log('my message' + err);
                    $('#NegativeModal').modal('hide');
                    $('#toastError').toast('show');
                    $("#btn-conf").removeClass('disabled');
                    $("#btn-deny").removeClass('disabled');
                    console.log("no se logro enviar la notificacion");

                }
            }
        },
        error: function (req, err) {
            //console.log('my message' + err);
            $('#NegativeModal').modal('hide');
            $('#toastError').toast('show');
            console.log("no se logro enviar la notificacion");

        }
    });
}



//ACTUALIZA EL ESTADO DE LA RESERVACION
function updateRes(id, idc, typ) {
    var btns = document.getElementById("gr-buttons");
    var id_res = id;
    var id_cus = idc;
    var type = typ;

    $.ajax({
        url: "apiManagePanel/query_update_state_reservations.php",
        method: "POST",
        data: {
            'id_res': id_res,
            'id_cus': id_cus,
            'type': type
        },
        success: function (data) {
            //window.location.replace("reservation.php");
            console.log(" update");
            //changeButtons();

        },
        error: function (req, err) {

            console.log("no update");

        }
    });
}

function refreshPage() {
    location.reload();
    return false;
}