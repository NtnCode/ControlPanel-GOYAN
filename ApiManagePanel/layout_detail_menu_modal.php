<?php
    if (isset($_POST["id_menu"])) {
        # code...
        include('../apiConnect/connect.php');
        date_default_timezone_set("America/Bogota");

        
        $id =$_POST["id_menu"];

        $response ='';

        $sql="SELECT m.id_menu , m.name_menu, m.description_menu, m.image_menu, 
            m.state_menu, m.target_item,
            c.id_catmenu , c.name_catmenu , t.id_typemenu, t.name_typemenu,
            d.price_detmenu
            FROM menu m
            INNER JOIN type_menu t on t.id_typemenu  = m.id_typemenu
            INNER JOIN category_menu c on c.id_catmenu  = m.id_category
            INNER JOIN detail_menu d on m.id_menu = d.id_menu
            WHERE m.id_menu = '$id'";

        $result=mysqli_query($conn, $sql);
        
            while ($row = mysqli_fetch_array($result)) {

                $state = $row["state_menu"];
                if ($state==1) {

                    $sstate = "<span class='text-success'>Se encuentra disponible.</span>";
                    
                }elseif($state==0){
                    $sstate = "<span class='text-danger'>Se encuentra deshabilitado.</span>";
                }

                $response .= '
                
                <p class="font-weight-bold"><i class="fas faw fa-angle-right text-primary"></i>&nbsp;Detalles del Menú</p>
                
                    
                    <div class="row">
                    
                        <div class="col-md-6 col-12 mb-2 p-0">                                
                            <div class="">
                                <div class="card-body  text-center "style="width:100%; max-width: 100%;  display:block; ">                                        
                                    <img class="card-hover-style" src="' .$row["image_menu"].'" alt="Imagen del menu" style="width:50%; max-width: auto; ">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-2 text-left">
                            <h3 class="mt-1 h3" style="font-family:Lato; color: #000">'. $row["name_menu"] . '</h3>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Código del menú: '. $row["id_menu"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Precio:&nbsp;S/. '. $row["price_detmenu"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Tipo: '. $row["name_typemenu"] . '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Categoria: '. $row["name_catmenu"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Estado del Menú: '. $sstate. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Descripcion:</h6>
                            <h6 class="mt-2 small" style="font-family:Lato; color: #000">'. $row["description_menu"] .'</h6>
                        </div>
            

                    </div>
                ';
        }
    print $response;
    }