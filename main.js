var url = "bd/crud.php";

var apppProduct = new Vue({    
el: "#appProduct",   
data:{     
  products:[],          
  nombre:"",
  descripcion:"",
  stock:"",
  total:0,       
  count:0,
  elementosporpagina:5,
  datosPaginados:[],
  paginaActual:1,
  gelder:"inicial"
 },
  // mounted(){
  // this.getDataPagina(1);
  // },    
methods:{  
//BOTONES 
//Para enviar datos con axios se pone antes de function async que significa asincrono       
  btnAlta:async function(){     
    //Inicia codigo de sweetalert2               
    const {value: formValues} = await Swal.fire({
    title: 'NUEVO',
    //Se define cualquier codigo para un formulario que van a aparecer dentro del sweet alert
    //HAce referencia al label y a los imput que estan en la ventana de sweet alert
    html:
    '<div class="row"><label class="col-sm-3 col-form-label">nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">descripcion</label><div class="col-sm-7"><input id="descripcion" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" type="number" min="0" class="form-control"></div></div>',              
    focusConfirm: false,
    showCancelButton: true,
    confirmButtonText: 'Guardar',          
    confirmButtonColor:'#1cc88a',          
    cancelButtonColor:'#3085d6',  
    preConfirm: () => {            
        return [
          this.nombre = document.getElementById('nombre').value,
          this.descripcion = document.getElementById('descripcion').value,
          this.stock = document.getElementById('stock').value                    
        ]
      }
    })        
    if(this.nombre == "" || this.descripcion == "" || this.stock == 0){
            Swal.fire({
              type: 'info',
              title: 'Datos incompletos',                                    
            }) 
    }       
    else{          
      this.altaProduct();          
      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        });
        Toast.fire({
          type: 'success',
          title: '¡Producto Agregado!'
        })                
    }
    //Fin sweetalert2
  },           
    btnEditar:async function(id, nombre, descripcion, stock){                            
        await Swal.fire({
        title: 'EDITAR',
        html:
        '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">nombre</label><div class="col-sm-7"><input id="nombre" value="'+nombre+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">descripcion</label><div class="col-sm-7"><input id="descripcion" value="'+descripcion+'" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Stock</label><div class="col-sm-7"><input id="stock" value="'+stock+'" type="number" min="0" class="form-control"></div></div></div>', 
        focusConfirm: false,
        showCancelButton: true,                         
        }).then((result) => {
          if (result.value) {                                             
            nombre = document.getElementById('nombre').value,    
            descripcion = document.getElementById('descripcion').value,
            stock = document.getElementById('stock').value,                    
            
            this.editarProduct(id,nombre,descripcion,stock);
            Swal.fire(
              '¡Actualizado!',
              'El registro ha sido actualizado.',
              'success'
            )                  
          }
        });
        
    },        
    btnBorrar:function(id){        
        Swal.fire({
          title: '¿Está seguro de borrar el registro: '+id+" ?",         
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor:'#d33',
          cancelButtonColor:'#3085d6',
          confirmButtonText: 'Borrar'
        }).then((result) => {
          if (result.value) {            
            this.borrarProduct(id);             
            //y mostramos un msj sobre la eliminación  
            Swal.fire(
              '¡Eliminado!',
              'El registro ha sido borrado.',
              'success'
            )
          }
        })                
    },       
    
    //PROCEDIMIENTOS para el CRUD     
    listarProducts:function(){
        axios.post(url, {opcion:4}).then(response =>{
           this.products = response.data;  
           this.getDataPagina(1);      
        });
    },    
    //Procedimiento CREAR.
    altaProduct:function(){
        axios.post(url, {opcion:1, nombre:this.nombre, descripcion:this.descripcion,stock:this.stock }).then(response =>{
          this.listarProducts();   
          this.getDataPagina(1);  
        });        
         this.nombre = "",
         this.descripcion = "",
         this.stock = 0
    },               
    //Procedimiento EDITAR.
    editarProduct:function(id,nombre,descripcion,stock){       
       axios.post(url, {opcion:2, id:id, nombre:nombre, descripcion: descripcion, stock:stock }).then(response =>{           
        this.listarProducts(); 
        this.getDataPagina(1);         
        });                              
    },    
    //Procedimiento BORRAR.
    borrarProduct:function(id){
        axios.post(url, {opcion:3, id:id}).then(response =>{           
            this.listarProducts();
            this.getDataPagina(1);  
            });
    },
    //Calculo de paginacion 
      totalPaginas(){
        return Math.ceil(this.products.length/this.elementosporpagina)
      },
      getDataPagina(noPagina){
        // if(noPagina==100){noPagina;this.gelder=noPagina+"-gelder"}
        // else {this.gelder="else"}
        this.gelder=noPagina;
        this.paginaActual=this.gelder;
        this.datosPaginados = [];
        let ini = (noPagina * this.elementosporpagina)-this.elementosporpagina;
        let fin = (noPagina * this.elementosporpagina);

        //Slice es un metodo de los array nos devuelve un nuevo array desde el numero de posicion que le indiquemos con una posicion inicial y una posicion final
        this.datosPaginados=this.products.slice(ini,fin);
        
      },
      getPreviousPage(){
        if(this.paginaActual>1){
          this.paginaActual--;
        }
        this.getDataPagina(this.paginaActual);
      },
      getNextPage(){
        if(this.paginaActual<this.totalPaginas()){
          this.paginaActual++;
        }
        this.getDataPagina(this.paginaActual);
      }
    //Fin Paginacion            
},      
created: function(){            
    this.listarProducts();  
             
},    
computed:{
    totalStock(){
        this.total = 0;
        for(product of this.products){
            this.total = this.total + parseInt(product.stock);
        }
        return this.total;   
    },
    countProduct(){
      this.count = 0;
      for(product of this.products){
          this.count = this.count + 1;
      }
      return this.count;   
    },
}
});