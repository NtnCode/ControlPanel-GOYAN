<?php
    if (isset($_POST["id_notif"])) {
        
        include('../apiConnect/connect.php');
        date_default_timezone_set("America/Bogota");

        
        $id =$_POST["id_notif"];

        $response ='';

        $sql2="SELECT n.id_notifications, n.id_reservation, 
            c.id_customer, c.firstname_customer, c.lastname_customer, r.timecollect_reservation, d.title_detnotif,
            d.detail_detnotif,  r.date_reservation, r.time_reservation, r.state_reservation, d.destination_detnotif,
            tl.id_timelinereserv, tl.name_timelinereserv
            FROM notifications n
            INNER JOIN detail_notifications d ON d.id_detnotifications  = n.id_notifications 
            INNER JOIN customer c ON c.id_customer = n.id_customer
            INNER JOIN reservation r ON r.id_reservation = n.id_reservation
            INNER JOIN timeline_reservation tl ON tl.id_timelinereserv = r.id_timelinereserv
            WHERE n.id_notifications = '$id' ";
        $result=mysqli_query($conn, $sql2);
        
            while ($row = mysqli_fetch_array($result)) {
                $response .= '
                <h5 class="font-weight-bold">Cliente: '. $row["firstname_customer"] ." ". $row["lastname_customer"] . '</h5>
                <p class="small mb-1">Código Cliente: '. $row["id_customer"] . '</p>
                <hr class="sidebar-divider">
                <h5 class="font-weight-bold">'. $row["title_detnotif"] . '</h5>
                <h6 class="font-weight-bold">Detalle: '. $row["detail_detnotif"] . '</h6>
                <h6 class="font-weight-light">Fecha Solicitud: '. $row["date_reservation"]." / ". $row["time_reservation"] . '</h6>
                <h6 class="font-weight-light">Hora de recojo: '. $row["timecollect_reservation"]. '</h6>
                
            ';
        }
    print $response;
    }
    mysqli_close($conn);
