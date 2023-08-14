<link rel="stylesheet" media="screen, print" href="<?=base_url()?>assets/css/tabulator.css">
<link href="<?=base_url()?>assets/css/tabulator.min.css" rel="stylesheet" />
<script src="<?=base_url()?>assets/js/tabulator.min.js"></script>
<div class="panel panel-inverse">
	<div class="panel-heading"></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
                <div class="" id="tabla_usuarios"></div>
			</div>
		</div>
	</div>
</div>
<script>

    let columnas = [];
    let icons = function(cell, formatterParams){
        let color = (cell.getRow().getData().activo == 1)?'btn-success':'bg-gray';
        return '' +
        '<button ide="'+cell.getRow().getData().id+'" val="'+cell.getRow().getData().activo+'" class="btx_activar btn btn-sm '+color+' mr-1"><i class="fa fa-power-off"></i></button>' + 
        '<button ide="'+cell.getRow().getData().id+'" per_id="'+cell.getRow().getData().perfil_id+'" class="btx_editar btn btn-sm bg-orange mr-1"><i class="fa fa-edit"></i></button>';
    };
    columnas.push({title:'Acciones',hozAlign:'center',headerHozAlign:'center',formatter:icons,width:120},
        {title:"Nombre", field:"nombre", sorter:"string",headerHozAlign:'center',width:350,headerFilter:"input"},
        {title:"Email", field:"email", sorter:"string",headerHozAlign:'center',width:350,headerFilter:"input"},
        {title:"Perfil", field:"perfil", sorter:"string",headerHozAlign:'center',headerFilter:"input"}
    );
    
    let table = new Tabulator("#tabla_usuarios", {
        layout:"fitColumns",
        reactiveData:true,
        // data:<=json_encode($usuarios->resultado)?>,
        // data: [{id:12,nombre:"Manuel Peralta",puesto:'Administrador',email:'drive@hotmail.com',gerencia:'GTIC',activo:1}],
        pagination:"local", //enable local pagination.
        paginationSize:15, // this option can take any positive integer value
        columns:columnas
    });

    //Metodo de muestra modal para editar usuario
    $('body').on('click','.btx_editar',function(){
        let ide = $(this).attr('ide');
        modal('Asignar Perfil de Usuario','<form id="frm_save_perfil" class="text-left"><input type="hidden" name="id" value="'+ide+'"> <div class="row"> <div class="col-md-12"> <label for="">Elegir perfil:</label> <select name="perfil" required class="form-control"><=$perfiles_opc?></select> </div> </div> <div class="row mt-2"> <div class="col-md-12 text-right"> <button class="btn btn-success btx_save_perfil"><i class="fa fa-save mr-2"></i> Asignar Perfil</button> </div> </div> </form>',600)
    })

    //Metodo para guardar los datos del nuevo perfil
    $('body').on('click','.btx_save_perfil',function(){
        let forms = $('#frm_save_perfil');
        let datatype = true;
        if(forms[0].reportValidity() === false){
            forms[0].classList.add('was-validated');
        }
        else{
            let formData = new FormData(forms[0]);
            api.post('<?=base_url()?>/administracion/act_perfil',formData,true)
            .done(function(data){
                console.log(data)
                let res = JSON.parse(data);
                console.log(res);
                if(res.status == 200)
                    alertf('','Se actualizo el perfil','success',function(){ 
                        location.reload();
                    })
                else
                    alertf('','Hubo un error al actualizar el perfil de usuario','error',function(){ 
                        console.error(res.messages)
                    });
            })
            .fail(function(res){
                console.error(JSON.parse(res));
            })
        }
    })

    //Metodo para activar/inactira al usuario
    $('body').on('click','.btx_activar',function(){
        let dato = ($(this).attr('val')==1)?0:1;
        let id = $(this).attr('ide');
        let formData = new FormData();
    
        formData.append('id',id);
        formData.append('activo',dato);
        api.post('<?=base_url()?>/administracion/activa_usuario',formData,true)
        .done(function(data){
            let res = JSON.parse(data);
            console.log(res);
            if(res.status == 200)
                alertf('','Se actualizo correctamente al usuario','success',function(){ 
                    location.reload();
                })
            else
                alertf('','Hubo un error al actualizar al usuario','error',function(){ 
                    console.error(res.messages)
                });
        })
        .fail(function(res){
            console.error(JSON.parse(res).messages);
        })
    })

</script>