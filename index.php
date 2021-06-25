<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS --> <!--<link rel="stylesheet" href="bootstrap/css/bootstraps.min.css">-->  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- FontAwesom CSS --><!--Pagina oficial para ver mas opciones-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">        
        <!--CSS custom -->  
        <link rel="stylesheet" href="style.css">  
    </head>
    <body>
        <header>
            <h2 class="text-center text-dark"><span class="badge btn-success">CRUD PHP<i class="fab fa-php"></i> with VUE.JS<i class="fab fa-vuejs"></i></span></h2>
        </header>    
        <div id="appProduct">               
            <div class="container">                
                <div class="row">       
                    <div class="col text-center">        
                        <button @click="btnAlta" class="btn btn-success" title="Nuevo">NEW  <i class="fas fa-plus-circle"></i></button>
                       <!-- <button @click="btnAlta" class="btn btn-success" title="Nuevo">NEW  <i class="fas fa-plus-circle fa-2x"></i></button>-->
                    </div>
                    <div class="col text-center">                        
                        <h5>different Product: <span class="badge btn-success">{{countProduct}}</span></h5>
                    </div>  
                    <div class="col text-center">                        
                        <h5>Stock Total: <span class="badge btn-success">{{totalStock}}</span></h5>
                    </div>  
                </div>                
                <div class="row mt-5">
                    <div class="col-lg-12">                    
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-primary text-light">
                                    <th>ID</th>                                    
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Stock</th>    
                                    <th>Acciones</th>
                                </tr>    
                            </thead>
                            <tbody>
                                <tr v-for="(product,indice) of products">                                
                                    <td>{{product.id}}</td>                                
                                    <td>{{product.nombre}}</td>
                                    <td>{{product.descripcion}}</td>
                                    <td>
                                        <div class="col-md-8">
                                        <input type="number" v-model.number="product.stock" class="form-control text-right" disabled>      
                                        </div>    
                                    </td>
                                    <td>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-secondary" title="Editar" @click="btnEditar(product.id, product.nombre, product.descripcion, product.stock)"><i class="fas fa-pencil-alt"></i></button>    
                                        <button class="btn btn-danger" title="Eliminar" @click="btnBorrar(product.id)"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                    </td>
                                </tr>    
                            </tbody>
                        </table>                    
                    </div>
                </div>
            </div>        
        </div>   
        <!--Vue.JS -->    
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>  
            <!--Axios -->      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>   
        <!--Sweet Alert 2    
        <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    -->     
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
    <!--Código custom -->          
    <script src="main.js"></script>     

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>               
    </body>
</html>