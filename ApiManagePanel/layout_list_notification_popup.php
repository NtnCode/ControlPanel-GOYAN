<?php

    include('../apiConnect/connect.php');
    date_default_timezone_set("America/Bogota");

    $sql = "UPDATE notifications as n
        INNER JOIN detail_notifications as d ON d.id_detnotifications  = n.id_notifications
        SET n.stateview_notifications = 1
        WHERE n.stateview_notifications = 0 AND d.destination_detnotif = 'system'";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo 'error';
    }
    $sqlsq = "SELECT n.id_notifications, n.id_reservation, 
        c.id_customer, c.firstname_customer, c.lastname_customer, r.timecollect_reservation,
        d.detail_detnotif,  r.date_reservation, r.time_reservation, r.state_reservation, d.destination_detnotif,
        tl.id_timelinereserv, tl.name_timelinereserv
        FROM notifications n
        INNER JOIN detail_notifications d ON d.id_detnotifications  = n.id_notifications 
        INNER JOIN customer c ON c.id_customer = n.id_customer
        INNER JOIN reservation r ON r.id_reservation = n.id_reservation
        INNER JOIN timeline_reservation tl ON tl.id_timelinereserv = r.id_timelinereserv
        WHERE d.destination_detnotif = 'system'  
        ORDER BY r.date_reservation DESC, r.time_reservation DESC
        LIMIT 5";
    $resultsq = mysqli_query($conn, $sqlsq);
    $response='';
    if (mysqli_num_rows($resultsq)>0) {

        while ($row=mysqli_fetch_array($resultsq)) {        
            $response = $response . 
            "<a class='dropdown-item d-flex align-items-center' href='reservation-detail.php?cdg=".$row["id_reservation"]."'>".
                "<div class='mr-3'>".                    
                    "<div class='icon-circle bg-primary'>".                    
                    "<i class='fas fa-bullhorn text-white'></i>".
                    "</div>".                    
                "</div>".
                "<div>".                    
                    "<div class='small text-gray-500'>".$row["date_reservation"]." - ".$row["time_reservation"]."</div>".
                    "<span class='font-weight-bold'>".$row["firstname_customer"]." ".$row["lastname_customer"]."</span><div></div>".
                    "<span >".$row["detail_detnotif"]."</span>".
                "</div>".
            "</a>";
        } 
    } else {
        $response = $response . "<a class='dropdown-item d-flex align-items-center' >".
        "<div class='mr-3'>".
            "<div class='icon-circle bg-primary'>".
            "<i class='fas fa-bell-slash text-white'></i>".
            "</div>".
        "</div>".
        "<div>".                
            "<span class='font-weight-bold'>Sin notificaciones</span><div></div>".                
        "</div>".
        "</a>";
    }
    if (!empty($response)) {
        print $response;
    }
    mysqli_close($conn);
