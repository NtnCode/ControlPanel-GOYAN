<?php
    if (isset($_POST["id_prod"])) {
        # code...
        include('../apiConnect/connect.php');
        date_default_timezone_set("America/Bogota");

        
        $id =$_POST["id_prod"];

        $response ='';

        $sql="SELECT p.id_product, p.name_product, p.state_product, p.image_product, 
            p.description_product, p.target_item,
            b.id_brandprod, b.name_brandprod, c.id_catprod, c.name_catprod, 
            d.priceunit_detprod, d.stock_detprod, d.stockmin_detprod, 
            d.qtyperunit_detprod
            FROM product p
            INNER JOIN brand_product b on p.id_brandprod   = b.id_brandprod 
            INNER JOIN category_product c on p.id_catprod   = c.id_catprod 
            INNER JOIN detail_product d on p.id_product  = d.id_product 
            WHERE p.id_product = $id";

        $result=mysqli_query($conn, $sql);
        
            while ($row = mysqli_fetch_array($result)) {

                $state = $row["state_product"];
                if ($state==1) {

                    $sstate = "<span class='text-success'>Se encuentra disponible.</span>";
                    
                }elseif($state==0){

                    $sstate = "<span class='text-danger'>Se encuentra deshabilitado.</span>";

                }

                $response .= '
                
                <p class="font-weight-bold"><i class="fas faw fa-angle-right text-primary"></i>&nbsp;Detalles del Producto`</p>
                
                    
                    <div class="row">
                    
                        <div class="col-md-6 col-12 mb-2 p-0">                                
                            <div class="">
                                <div class="card-body  text-center "style="width:100%; max-width: 100%;  display:block; ">                                        
                                    <img class="card-hover-style" src="' .$row["image_product"].'" alt="Imagen del producto" style="width:50%; max-width: auto; ">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mt-2 text-left">
                            <h3 class="mt-1 h3" style="font-family:Lato; color: #000">'. $row["name_product"] . '</h3>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Código del producto: '. $row["id_product"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Precio:&nbsp;S/. '. $row["priceunit_detprod"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Marca: '. $row["name_brandprod"] . '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Categoria: '. $row["name_catprod"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Cantidad por Unidad: '. $row["qtyperunit_detprod"]. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Estado del Producto: '. $sstate. '</h6>
                            <h6 class="mt-3" style="font-family:Lato; color: #000">Descripcion:</h6>
                            <h6 class="mt-2 small" style="font-family:Lato; color: #000">'. $row["description_product"] .'</h6>
                        </div>
            

                    </div>
                ';
        }
    print $response;
    }