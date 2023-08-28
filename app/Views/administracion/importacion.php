<link rel="stylesheet" media="screen, print" href="/assets/css/tabulator.css">
<link href="/assets/css/tabulator.min.css" rel="stylesheet" />
<script src="/assets/js/tabulator.min.js"></script>
<div class="panel panel-inverse">
	<div class="panel-heading"></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
                <div  class="row col-md-auto">
                    <button type="button" id="importarDatos" class="btn btn-success" onclick="triggerInputEsp()"><i class="fas fa-file-excel"></i> Importar Excel </button> &nbsp; &nbsp;
                    <input type="file" name="excelImportar" id="excelImportar" accept=".csv, .xls, .xlsx" hidden>
                </div>
			</div>
		</div>
        <br><br>
        <div class="row">
			<div class="col-md-12">
                <div class="" id="tabla_importacion"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
$(document).ready(function() {
    var fileSelector;
   
    fileSelector = document.getElementById('excelImportar');
    fileSelector.addEventListener('change', (event) => {
        if(fileSelector.files[0].size > 2000000) {
            alert("Tamaño de Archivo NO Válido");
            $(this).val('');
        }else{
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var fileData = reader.result;
                var wb = XLSX.read(fileData, { type: 'binary' });
                var rowObj = XLSX.utils.sheet_to_json(wb.Sheets[wb['SheetNames'][0]]);
                var jsonObj = JSON.stringify(rowObj);
                var table = new Tabulator("#tabla_importacion", {
                    data:JSON.parse(jsonObj) ,
                    height:311,
                    layout:"fitColumns",
                    autoColumns:true,
                });
                cargarExcel(jsonObj,fileSelector);
            };
            reader.readAsBinaryString(input.files[0]);
        }
    });
});


function triggerInputEsp() {
    document.getElementById('excelImportar').click();
}

function cargarExcel(json, archivo) {
    let jsonObj = JSON.parse(json);
    let claves = Object.keys(jsonObj[0]);
    console.log(claves);
    for ( var x=0 ; x < jsonObj.length; x++ ){
        //console.log(jsonObj[x]);
    }
}


</script>