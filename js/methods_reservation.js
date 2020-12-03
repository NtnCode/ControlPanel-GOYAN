//CONFIRMA MEDIANTE UNA NOTIFICACION LA RESEVACION Y PROCEDE A ACTUALIZAR
function reservationConfirmed(id_cus, id_res) {
    var id = id_cus;
    var title = "¡Su Reservación está confirmada!";
    var message = "Acerquese a la ferreteria para su recojo.";
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
            //var datax = JSON.stringify(data);
            /*json = JSON.parse(JSON.stringify(data));
            console.log("" + json[0]);*/
            /*data = JSON.parse(JSON.stringify(data));
            alert(data.success);
            alert(data.multicast_id);*/
            $('#PositiveModal').modal('hide');

            $('#toastDone').toast('show');

            var type = "yes";
            updateRes(id_res, id_cus, type);
        },
        error: function (req, err) {
            //console.log('my message' + err);
            $('#PositiveModal').modal('hide');
            $('#toastError').toast('show');
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
            //var datax = JSON.stringify(data);
            /*json = JSON.parse(JSON.stringify(data));
            console.log("" + json[0]);*/
            /*data = JSON.parse(JSON.stringify(data));
            alert(data.success);
            alert(data.multicast_id);*/
            $('#NegativeModal').modal('hide');
            $('#toastRechazed').toast('show');
            var type = "no";
            updateRes(id_res, id_cus, type);
            //window.location(reservation.php);
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
            changeButtons();
            
        },
        error: function (req, err) {

            console.log("no update");

        }
    });
}
// CONFIGURA LOS BOTONES SEGUN EL ESTADO
function verifyStatesButtons(sta) {
    var st = sta;
    var btns = document.getElementById("gr-buttons");
    if (st == 1) {
        btns.style.display = "none";
    } else if (st == 0) {
        btns.style.display = "flex";
    }else if (st == 2) {
        btns.style.display = "none";
    }

}
function DisableStatesButtons() {
    
    $("#btn-con").addClass('disabled');
    
}

function changeButtons() {
    var btns = document.getElementById("gr-buttons");
    btns.style.display = "none";
}