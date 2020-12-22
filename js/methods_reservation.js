//CONFIRMA MEDIANTE UNA NOTIFICACION LA RESEVACION Y PROCEDE A ACTUALIZAR
function reservationConfirmed(id_cus, id_res) {
    var id = id_cus;
    var title = "Estado de su reservación";
    var msg = "¡Su reservación fue confirmada!";
    $("#btn-conf").addClass('disabled');
    $("#btn-deny").addClass('disabled');

    console.log("asda");

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
                //console.log(""+id_res + "\n" + id_cus  + "\n" + msg);
                if (succ == 1) {

                    $('#ConfirmResModal').modal('hide');
                    $('#toastDone').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = 2;

                    updateRes(id_res, id_cus, type, title, msg);

                } else if (err == 1) {

                    $("#btn-conf").removeClass('disabled');
                    $("#btn-deny").removeClass('disabled');

                    $('#ConfirmResModal').modal('hide');
                    $('#toastError').toast('show');

                }
            }

        },
        error: function (req, err) {
            console.log('my message' + err);
            $('#ConfirmResModal').modal('hide');
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
    var title = "Estado de su reservación";
    var msg = "Se rechazo su solicitud de reservación";

    $("#btn-con").addClass('disabled');

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

                    $('#NegativeModal').modal('hide');
                    $('#toastRechazed').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = 3;
                    updateRes(id_res, id_cus, type, title, msg);

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


function actionPreparationRes(id_cus, id_res) {
    var id = id_cus;
    var title = "Estado de su reservación";
    var msg = "¡Su reservación está en preparación!";
    $("#btn-conf").addClass('disabled');
    $("#btn-deny").addClass('disabled');

    console.log("asda");

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
                //console.log(""+id_res + "\n" + id_cus  + "\n" + msg);
                if (succ == 1) {

                    $('#PreparationResModal').modal('hide');
                    $('#toastDone').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = 4;

                    updateRes(id_res, id_cus, type, title, msg);

                } else if (err == 1) {

                    $("#btn-conf").removeClass('disabled');
                    $("#btn-deny").removeClass('disabled');

                    $('#PreparationResModal').modal('hide');
                    $('#toastError').toast('show');

                }
            }

        },
        error: function (req, err) {
            console.log('my message' + err);
            $('#PreparationResModal').modal('hide');
            $('#toastError').toast('show');
            $("#btn-conf").removeClass('disabled');
            $("#btn-deny").removeClass('disabled');
            console.log("no se logro enviar la notificacion");
        }
    });
}

function actionCollectRes(id_cus, id_res) {
    var id = id_cus;
    var title = "Estado de su reservación";
    var msg = "¡Su reservación está lista para que lo recoja!";
    $("#btn-conf").addClass('disabled');
    $("#btn-deny").addClass('disabled');

    console.log("asda");

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

                succ = result['success'];
                err = result['failure'];

                if (succ == 1) {

                    $('#CollectResModal').modal('hide');
                    $('#toastDone').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = 5;

                    updateRes(id_res, id_cus, type, title, msg);

                } else if (err == 1) {

                    $("#btn-conf").removeClass('disabled');
                    $("#btn-deny").removeClass('disabled');

                    $('#CollectResModal').modal('hide');
                    $('#toastError').toast('show');

                }
            }

        },
        error: function (req, err) {
            console.log('my message' + err);
            $('#CollectResModal').modal('hide');
            $('#toastError').toast('show');
            $("#btn-conf").removeClass('disabled');
            $("#btn-deny").removeClass('disabled');
            console.log("no se logro enviar la notificacion");
        }
    });
}

function actionReceivedRes(id_cus, id_res) {
    var id = id_cus;
    var title = "Reservación entregada";
    var msg = "¡Gracias por su preferencia!";
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

                succ = result['success'];
                err = result['failure'];

                if (succ == 1) {

                    $('#ReceivedResModal').modal('hide');
                    $('#toastDone').toast('show');
                    $("#gr-buttons").addClass('d-none');
                    $("#gr-refresh").removeClass('d-none');
                    var type = 6;

                    updateRes(id_res, id_cus, type, title, msg);

                } else if (err == 1) {

                    $("#btn-conf").removeClass('disabled');
                    $("#btn-deny").removeClass('disabled');

                    $('#ReceivedResModal').modal('hide');
                    $('#toastError').toast('show');

                }
            }

        },
        error: function (req, err) {
            console.log('my message' + err);
            $('#ReceivedResModal').modal('hide');
            $('#toastError').toast('show');
            $("#btn-conf").removeClass('disabled');
            $("#btn-deny").removeClass('disabled');
            console.log("no se logro enviar la notificacion");
        }
    });
}

//ACTUALIZA EL ESTADO DE LA RESERVACION
function updateRes(id, idc, typ, title, message) {
    var id_res = id;
    var id_cus = idc;
    var type = typ;

    //console.log(id_res + "\n" + id_cus + "\n" + type + "\n" + "\n" + message);

    $.ajax({
        url: "ApiManagePanel/set_update_notification_reservation.php",
        method: "POST",
        data: {
            'id_res': id_res,
            'id_cus': id_cus,
            'type': type,
            'title': title,
            'msg': message
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