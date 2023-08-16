	<div class="wrap-login100" >
        <div class="col-md-5"> 
            <form class="validate-form" id="frm">
		    	<div class="containers">
		    	  <div class="top"></div>
		    	  <div class="bottom"></div>
		    	  <div class="centers">
                  <h1 class="text-center">Inicio de Sesión</h1>
                  <br>
                    <label>Usuario:</label>
                    <input name="usuario" type="email">
                    <br>
                    <label>Contraseña:</label>
                    <input name="password" type="password">
                    <br><br>
                    <button type="button" class="btn btx_send btn-secondary btn-lg">Entrar</button>
                    <br><br>
		    	  </div>
		    	</div>
		    </form>
        </div>
        <div class="col-md-7 login100-more"  style="background-image: url('assets/login/images/bg.jpg');padding-right:0px !important">
        <section class="layout">
            <div class=""></div>
            <div class=""></div>
            <div class=""></div>
            <div class=""></div>
            <div class=""></div>
            <div class="bg-white pl-4 pt-2 pb-2">
                <div class="row">
                    <div class="col-md-6"><img  class="img-fluid cinta_logo" src="assets/img/conafor.png" alt=""></div>
                    <div class="col-md-6 mt-4 text-center"><h1>SIPSA - 2023</h1></div>
                </div>
                
            </div>
        </section>
			
        </div>
    </div>
<!--===============================================================================================-->
    <script>

        $('body').on('click','.btx_send',function(){
            let forms = $('#frm');
            if(forms[0].reportValidity() === false){
                forms[0].classList.add('was-validated');
            }
            else{
                let formData = new FormData(forms[0]);
                api.post('<?=base_url()?>/login/validar',formData,true,false)
                .done(function(data){
                    let res = JSON.parse(data);
                    if(res.status == 201){
                        location.href = 'inicio'
                    }
                    else if(res.status == 203){
                        location.href = 'login/previos';
                    }
                    else{
                        console.log(res.msg);
                        alert('Error',res.msg,'error');
                    }
                })
                .fail(function(res){
                    console.log(res)
                })
            }
        })
    </script>



