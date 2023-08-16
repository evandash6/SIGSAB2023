<script>
    //Funcion de un simple alert con salida
    function alert(titulo,texto,icono,salida=null){
        Swal.fire({
        icon: icono,
        title: titulo,
        html: texto,
        allowOutsideClick: false,
        allowEscapeKey: false
        })
        .then(() => {
            if(salida != null)
                location.href = salida
        })
    }

    //Funcion  de un alert con funcion extra
    function alertf(titulo,texto,icono,fn=function(){}){
        Swal.fire({
        icon: icono,
        title: titulo,
        html: texto,
        allowOutsideClick: false,
        allowEscapeKey: false,
        onClose: () => {
            fn();
        }
        })
    }

    //Funcion para un modal de confirmacion
    function confirm(titulo,texto,icono,fn=function(){},fn2=function(){}){
        return new Promise(function(resolve, reject) {
        Swal.fire({
            icon: icono,
            title: titulo,
            html: texto,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar',
            allowOutsideClick: false,
            allowEscapeKey: false
        })
        .then(function(result){
            if(result.value){
                resolve(true);
                fn();
            }
            else{
                fn2();
            }
        })
        });
    }
    //Funcion para determinar el tiempo en la carga
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function pausa(tiempo,fn=function(){}) {
        await sleep(tiempo);
        fn();
    }

    //Funcion generica para mostrar o no un alert de carga
    async function cargando(t=0,fn=function(){},view=1){
        if(view==1){
            Swal.fire({
            html: '<div class="row"><div class="col-md-12 text-center"><div id="lottie-container"></div></div><div class="col-md-12"><p style="font-size:20px"><b id="mdl_txt_carga">Cargando..</b></p></div></div>',
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            width:300
            })
            lottie.loadAnimation({
                container: document.getElementById('lottie-container'), // the dom element that will contain the animation
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: '../assets/load.json' // the path to the animation json
            });
            if(t > 0){
            await sleep(t*1000);
            Swal.close();
            lottie.stop();
            fn();
            }
        }
        else{
            if(t > 0){
                await sleep(t*1000);
                fn();
            }
        }
    }

    function modal(titulo,codigo,ancho=750){
        Swal.fire({
        width: ancho,
        position: 'center',
        title: titulo,
        html:codigo,
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true,
        allowOutsideClick: false,
        allowEscapeKey: false
        })
    }

    var api = { 
        get: function (url,carga=true) {
            if(carga)
            cargando();
            return $.ajax({
                url: url,
                type : 'GET',
                contentType: false,
                processData: false,
                cache: false
            }).done(function(){ 
                swal.close()
            });
        },
        post: function (url,data,activo=false,load=true,espera=true,cierre=true){
            if(activo){
                if(load)
                    cargando();
                return $.ajax({
                    url: url,
                    type : 'POST',
                    data: data,
                    processData: false,
                    async:espera,
                    contentType: false,
                    cache: false,
                })
                .done(function(){ 
                    if(cierre)
                    swal.close()
                });
            }
            else{
                if(load)
                    cargando();
                return $.ajax({
                    url: url,
                    type : 'POST',
                    async:espera,
                    data: data
                }).done(function(){ 
                    if(cierre)
                    swal.close()
                });
            }
        }
    };
    
    //Funcion generica para el envio de datos de un formulario
    function sendform(id,url,e,fn1=function(){}){
        e.stopPropagation();
        let forms = $(id);
        if(forms[0].reportValidity() === false){
            forms[0].classList.add('was-validated');
        }
        else{
            let formData = new FormData(forms[0]);
            //console.log(forms[0]);
            api.post(url,formData,true)
            .done(function(data){
                let res = JSON.parse(data);
                console.log(res);
                if(res.status == 200)
                    alertf('',res.msg,'success',function(){ 
                        fn1();
                    })
                else
                alertf('',res.msg2,'error',function(){ 
                    console.error(res.msg)
                });
            })
            .fail(function(res){
                console.error(res);
            })
        }
    }

    //Funcion para hacer activaciones/inactivaciones a traves del boton de estatus
    function activaciones(ruta,obj,t,fn){
        let id = obj.attr('ide');
        let val = obj.attr('val');
        let datos = {t:t,id:id,val:val};

        api.post(ruta,datos)
        .done(function(rep){
            alertf(rep,'','success',function(){
                fn();
            })
        })
        .fail(function(res){
            console.error(res);
        })
    }

    $('body').on('click','#js-nav-menu li',function(){
        setlocal('titulo',$(this).attr('data-title')+'|'+$(this).attr('data-description')+'|'+$(this).attr('data-icon')+'|'+$(this).attr('data-id'));
    })


    /////////////////////////////////////// FUNCIONES PROPIAS EL APLICATIVO //////////////////////////////

    // Validacion de carga de los archivos
    function valida_carga(obj,e){
        let file = e.target.files[0];
        let fileName = obj.val().split("\\").pop();
        let type = obj.val().split(".").pop();
        if(file.size > 5500000){
            alert('','Archivo sobrepasa el tamaño permitido de 5Mb','error');
            return false;
        }
        else if(fileName.split('.').length > 2){
            alert('','El nombre de tu archivo contiene caracteres no permitidos como puntos, comas, espacios, <b>solo se permiten números, letras y/o guiones bajos</b>','error');
            return false;
        }
        else{
            return true;
        }
    }

    function crea_chose(){
        var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : { allow_single_deselect: true },
        '.chosen-select-no-single' : { disable_search_threshold: 10 },
        '.chosen-select-no-results': { no_results_text: 'Oops, no hay registros!' },
        '.chosen-select-rtl'       : { rtl: true },
        '.chosen-select-width'     : { width: '95%' }
        }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
            $(selector).trigger("chosen:updated");
            $(selector).attr('style','opacity:0;position:absolute');
        }
    }
    
</script>
