function barraDeBusqueda(){
    var jsonRecetas;
    var opcionesAniadidas= [];
    document.querySelector('#barraDeBusqueda').addEventListener('keypress', function (e) {
        var elemento= document.getElementById("titulosReceta");
        if ($("#barraDeBusqueda").val().length ==2) {
            $.ajax({
                method: "POST",
                global: false,
                url: "filtrosRecetas.php",
                data: {palabraIngresada: $("#barraDeBusqueda").val(), operacion: "busqueda"}
            })
                .done(function (msg) {
                    if(msg.length!=0) {
                        $(".form-inline").append("<datalist id='titulosReceta'></datalist>");
                        jsonRecetas = JSON.parse(msg);
                        for (var jsonRecetasKey in jsonRecetas) {
                            var titulo= jsonRecetas[jsonRecetasKey]["titulo"];
                            if(!opcionesAniadidas.includes(titulo)) {
                                var id = jsonRecetas[jsonRecetasKey]["id"];
                                var nombreTituloAux = "'" + titulo + "'";
                                $("#titulosReceta").append('<option value=' + nombreTituloAux + '></option> ');
                                $('#titulosReceta').val('');
                                var opcionesPuestas=document.getElementById("titulosReceta").getElementsByTagName("option");
                                for (var opcionesPuestasKey in opcionesPuestas) {
                                    opcionesAniadidas.push(document.getElementsByTagName("option")[opcionesPuestasKey].value);

                                }
                            }

                        }
                    }
                });
        }
        if ($("#barraDeBusqueda").val().length ==0 && elemento!=null) {
            elemento.remove();
            opcionesAniadidas=[];
        }
    });
    document.querySelector('#barraDeBusqueda').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            for (var jsonRecetasKey in jsonRecetas) {
                if($("#barraDeBusqueda").val()==jsonRecetas[jsonRecetasKey]["titulo"]){
                    event.preventDefault();
                    var id = jsonRecetas[jsonRecetasKey]["id"];
                    location.href="recetaExplorar.php?idReceta="+id;

                }
            }

        }
    });
}