<?php
    if (isset($_POST["id_reservation"])) {
        # code...
        include('../apiConnect/connect.php');
        date_default_timezone_set("America/Bogota");

        
        $id =$_POST["id_reservation"];

        $response ='';

        $sql="SELECT r.id_reservation, r.time_reservation, r.date_reservation, r.state_reservation,
                tl.id_timelinereserv, tl.name_timelinereserv, tl.description_timelinereserv
                FROM reservation r 
                INNER JOIN timeline_reservation tl ON tl.id_timelinereserv = r.id_timelinereserv
                WHERE r.id_reservation ='$id'";

        $result=mysqli_query($conn, $sql);
        
            while ($row = mysqli_fetch_array($result)) {

                $state = $row["id_timelinereserv"];
                if ($state==1) {

                    $response .= '
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" >
                            <li class="timeline-item">
                                <div class="timeline-badge info"><i
                                        class="fa fa-clock"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            ' .$row["name_timelinereserv"]. '
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-row align-content-between align-self-center" id="gr-buttons">
                        <div class=" mb-1 col-md-2"></div>
                        <a class="align-content-between align-self-center btn btn-danger  card-hover-style mb-4 col-md-3 text-light" data-toggle="modal"
                            id="btn-conf" data-target="#NegativeModal">
                            <i class="fas faw fa-times-circle"></i>&nbsp; Rechazar
                        </a>
                        <div class=" mb-1 col-md-2"></div>
                        <a class="btn btn-success card-hover-style col-md-3 mb-4 text-light align-content-between align-self-center" data-toggle="modal"
                            id="btn-deny" data-target="#ConfirmResModal"><i
                                class="fas faw fa-check"></i>&nbsp; Confirmar</a>
                        <div class=" mb-1 col-md-2"></div>
                    </div>
                    <div class="form-row align-content-between align-self-center d-none" id="gr-refresh">
                        <div class=" mb-1 col-md-5"></div>
                        <input class="btn btn-info card-hover-style col-md-2 mb-4 text-light"
                                    onclick="refreshPage()"
                                    value="Refrescar estado">
                        <div class=" mb-1 col-md-5"></div>
                    </div>
                    ';
                    
                }elseif($state==2){
                    
                    $response .= '
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" id="retrieve-timeline">          
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            En espera
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge info"><i
                                        class="fa fa-clock"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            ' .$row["name_timelinereserv"]. '
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-row align-content-between align-self-center" id="gr-buttons">                        
                        <div class="mb-1 col-md-4"></div>
                        <a class="btn btn-success card-hover-style col-md-4 mb-4 text-light align-content-between align-self-center" data-toggle="modal"
                            id="btn-deny" data-target="#PreparationResModal"><i
                                class="fas faw fa-check"></i>&nbsp;&nbsp;Poner en preparación</a>
                        <div class="mb-1 col-md-4"></div>
                    </div>
                    <div class="form-row align-content-between align-self-center d-none" id="gr-refresh">
                        <div class=" mb-1 col-md-5"></div>
                        <input class="btn btn-info card-hover-style col-md-2 mb-4 text-light"
                                    onclick="refreshPage()"
                                    value="Refrescar estado">
                        <div class=" mb-1 col-md-5"></div>
                    </div>
                    ';

                }elseif($state==3){
                    
                    $response .= '
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" id="retrieve-timeline">
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            En espera
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge danger"><i
                                        class="fa fa-window-close"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            ' .$row["name_timelinereserv"]. '
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <h5 class="text-center font-weight-bold is-text-black">La reservación fue rechazada y se notificó al cliente.</h5>
                    ';

                }elseif($state==4){
                    
                    $response .= '
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" id="retrieve-timeline">
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            En espera
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            Confirmado
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge info"><i
                                        class="fa fa-clock"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            ' .$row["name_timelinereserv"]. '
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-row align-content-between align-self-center" id="gr-buttons">                        
                        <div class="mb-1 col-md-4"></div>
                        <a class="btn btn-success card-hover-style col-md-4 mb-4 text-light align-content-between align-self-center" data-toggle="modal"
                            id="btn-deny" data-target="#CollectResModal"><i
                                class="fas faw fa-check"></i>&nbsp;&nbsp; Terminar Preparación</a>
                        <div class="mb-1 col-md-4"></div>
                    </div>
                    <div class="form-row align-content-between align-self-center d-none" id="gr-refresh">
                        <div class=" mb-1 col-md-5"></div>
                        <input class="btn btn-info card-hover-style col-md-2 mb-4 text-light"
                                    onclick="refreshPage()"
                                    value="Refrescar estado">
                        <div class=" mb-1 col-md-5"></div>
                    </div>
                    ';

                }elseif($state==5){
                    
                    $response .= '
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" id="retrieve-timeline">
                            <li class="timeline-item">      
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            En espera
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            Confirmado
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            Preparado
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge info"><i
                                        class="fa fa-clock"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            ' .$row["name_timelinereserv"]. '
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-row align-content-between align-self-center" id="gr-buttons">                        
                        <div class="mb-1 col-md-4"></div>
                        <a class="btn btn-success card-hover-style col-md-4 mb-4 text-light align-content-between align-self-center" data-toggle="modal"
                            id="btn-deny" data-target="#ReceivedResModal"><i
                                class="fas faw fa-check"></i>&nbsp; Confirmar recepción</a>
                        <div class="mb-1 col-md-4"></div>
                    </div>
                    <div class="form-row align-content-between align-self-center d-none" id="gr-refresh">
                        <div class=" mb-1 col-md-5"></div>
                        <input class="btn btn-info card-hover-style col-md-2 mb-4 text-light"
                                    onclick="refreshPage()"
                                    value="Refrescar estado">
                        <div class=" mb-1 col-md-5"></div>
                    </div>
                    ';

                }elseif($state==6){
                    
                    $response .= '
                    <div style="display:inline-block;width:100%;overflow-y:auto;">
                        <ul class="timeline timeline-horizontal" id="retrieve-timeline">
                            <li class="timeline-item">      
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            En espera
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            Confirmado
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            Preparado
                                        </h6>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            Recepcionado
                                        </h6>
                                    </div>
                                </div>
                            </li>
                             <li class="timeline-item">
                                <div class="timeline-badge success"><i
                                        class="fa fa-check-double"></i></div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h6 class="timeline-title">
                                            ' .$row["name_timelinereserv"]. '
                                        </h6>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    ';

                }

                
        }
    print $response;
    }
    mysqli_close($conn);
