package app.web;

import com.mongodb.BasicDBObject;
import org.bson.Document;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.io.IOException;
import java.util.*;

@RequestMapping("/api")
@RestController
public class Controlador {
    @Autowired
    private DatosJson accesoABaseDeDatos;

    @Autowired
    private Servicio servicioParaSubirArchivos;

    public Controlador() {
        this.accesoABaseDeDatos = new DatosJson();
        this.servicioParaSubirArchivos = new Servicio();
    }

    public String cambiarGuionesPorEspacios(String nombre){
        return nombre.replace("_"," ");
    }
    @RequestMapping(value = "/traerImagenesPlatos",method = RequestMethod.GET)
    public ResponseEntity<Object> traerImagenesPlatos(){
        List<Receta> recetas=this.accesoABaseDeDatos.obtenerRecetasExplorar();
        HashMap<Integer, String> platosComida =this.accesoABaseDeDatos.obtenerImagenesRecetas();
        HashMap<String, HashMap<String,Object>> platosARetornar=new HashMap<>();
        int idAutoIncrementable=0;
        for (int i=0;i<5;i++){
            HashMap <String, Object> aux=new HashMap<>();
            Random r = new Random();
            int valorDado = r.nextInt(recetas.size());
            aux.put("id",recetas.get(valorDado).getClavePrimaria());
            aux.put("titulo",recetas.get(valorDado).getTitulo());
            aux.put("imagen",recetas.get(valorDado).getImagen());
            recetas.remove(recetas.get(valorDado));
            platosARetornar.put(String.valueOf(idAutoIncrementable),aux);
            idAutoIncrementable++;
        }

        return new ResponseEntity<>(platosARetornar,HttpStatus.OK);
    }

    @RequestMapping(value = "/datosUsuario/{nombreUsuario}/{clave}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerDatosUsuario(@PathVariable String nombreUsuario, @PathVariable String clave){
        HashMap<String, Object> valoresRequeridos=new HashMap<>();
        valoresRequeridos.put("mail",nombreUsuario);
        valoresRequeridos.put("clave",clave);
        int idUsuario=this.accesoABaseDeDatos.obtenerIdUsuario(valoresRequeridos);
        HashMap<String, Object> infoResponse=new HashMap<>();
        infoResponse.put("idUsuario",idUsuario);
        return new ResponseEntity<>(infoResponse,HttpStatus.OK);
    }

    @RequestMapping(value = "/ingresoUsuario",method = RequestMethod.POST)
    public ResponseEntity<Object> ingresarUsuario( @RequestBody HashMap infoUsuario){
        HashMap<String, String> usuario = (HashMap<String, String>) infoUsuario.get("usuario");
        HashMap<String, Object> filtro = new HashMap<>();
        HashMap<String, Object> infoResponse=new HashMap<>();
        filtro.put("mail",usuario.get("mail"));
        if(this.accesoABaseDeDatos.obtenerInfoUsuario(filtro)==null){
            filtro.clear();
            filtro.put("nombre",usuario.get("nombre"));
            if(this.accesoABaseDeDatos.obtenerInfoUsuario(filtro)==null){
                filtro.put("mail",usuario.get("mail"));
                filtro.put("clave",usuario.get("contrasenia"));
                infoResponse.put("usuarioCreadoExitosamente", this.accesoABaseDeDatos.insertarUsuario(filtro));
                return new ResponseEntity<>(infoResponse,HttpStatus.OK);
            }
            else{
                    infoResponse.put("nombreRepetido","ya fue usado");
                    return new ResponseEntity<>(infoResponse,HttpStatus.NOT_ACCEPTABLE);
                }
        }
        else{
            infoResponse.put("mailRepetido","ya fue usado");
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }

    }
    @RequestMapping(value = "/traerNombreUsuario/{idUsuario}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerNombreUsuario(@PathVariable int idUsuario){
        HashMap<String, Object> valoresRequeridos=new HashMap<>();
        valoresRequeridos.put("idUsuario",idUsuario);
        String nombreUsuario=this.accesoABaseDeDatos.obtenerInfoUsuario(valoresRequeridos);
        HashMap<String, Object> infoResponse=new HashMap<>();
        infoResponse.put("nombreUsuario",nombreUsuario);
        return new ResponseEntity<>(infoResponse,HttpStatus.OK);
    }

    @RequestMapping(value = "/datos",method = RequestMethod.GET)
    public ResponseEntity<Object> traerRecetasExplorar(){
        List<Receta> recetasExplorar=this.accesoABaseDeDatos.obtenerRecetasExplorar();
        HashMap<String, Object> infoResponse=new HashMap<>();
        infoResponse.put("recetas",recetasExplorar);
        return new ResponseEntity<>(infoResponse,HttpStatus.OK);
    }

    @RequestMapping(value = "/menuSemanal/{idUsuario}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerMenuSemanal(@PathVariable int idUsuario){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        HashMap<Integer,HashMap<String,Object>> menuSemanalUsuario=this.accesoABaseDeDatos.obtenerMenuSemanalUsuario(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        int pos=0;
        ArrayList<Integer> recetas=new ArrayList<>();
        for (Map.Entry<Integer,HashMap<String,Object>> claveRecetaMenu:menuSemanalUsuario.entrySet()) {
            for (Map.Entry<String, Object> recetaMenu:claveRecetaMenu.getValue().entrySet()) {
                if (recetaMenu.getKey().equals("idReceta")){
                    recetas.add((Integer) recetaMenu.getValue());
                }
            }
        }
        HashMap<String,Object> filtroEliminarReceta=new HashMap<>();
        for (Integer receta:recetas) {
            filtro.put("idReceta",receta);
            filtroEliminarReceta.put("id",receta);
            for(Map.Entry<String,Object> atributos:menuSemanalUsuario.get(pos).entrySet()){
                filtro.put(atributos.getKey(),atributos.getValue());
            }
            if(this.accesoABaseDeDatos.obtenerUnaReceta(filtroEliminarReceta).size()==0){
                this.accesoABaseDeDatos.eliminarRecetaMenuSemanal(filtro);
                menuSemanalUsuario.remove(pos);
                HashMap<String, Object> error=new HashMap<>();
                error.put("error", "error");
                menuSemanalUsuario.put(-1,error);
            }
            pos++;
        }

        if (!menuSemanalUsuario.isEmpty()){
            infoResponse.put("Menu semanal",menuSemanalUsuario);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        return new ResponseEntity<>(HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaExplorar/{idReceta}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerUnaReceta(@PathVariable int idReceta){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("id",idReceta);
        List<Receta> receta=this.accesoABaseDeDatos.obtenerUnaReceta(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!receta.isEmpty()){
            infoResponse.put("Receta",receta);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no se encontro la receta");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaExplorar/filtrarBusqueda/{palabraIngresada}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerRecetaFiltroBusqueda(@PathVariable String palabraIngresada){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("titulo", java.util.regex.Pattern.compile(palabraIngresada));
        List<Receta> recetas=this.accesoABaseDeDatos.obtenerUnaReceta(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        int contador=0;
        if (!recetas.isEmpty()){
            for (Receta receta: recetas) {
                HashMap<String, String> auxiliar =  new HashMap<>();
                auxiliar.put("id",String.valueOf(receta.getClavePrimaria()));
                auxiliar.put("titulo",receta.getTitulo());
                infoResponse.put(String.valueOf(contador),auxiliar);
                contador++;
            }
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        return new ResponseEntity<>(HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaExplorar/filtrarDificultad/{dificultad}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerRecetaFiltroDificultad(@PathVariable int dificultad){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("dificultad",dificultad);
        List<Receta> receta=this.accesoABaseDeDatos.obtenerUnaReceta(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!receta.isEmpty()){
            infoResponse.put("Receta",receta);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no se encontro la receta");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaExplorar/filtrarCalificacion/{calificacion}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerRecetaFiltroCalificacion(@PathVariable int calificacion){
        List<Receta> recetas=this.accesoABaseDeDatos.obtenerRecetasExplorar();
        List<Receta> recetasConDeterminadaCalificacion = new ArrayList<>();
        for (Receta receta: recetas) {
            if(receta.getPuntaje()==calificacion){
                recetasConDeterminadaCalificacion.add(receta);
            }
        }
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!recetasConDeterminadaCalificacion.isEmpty()){
            infoResponse.put("Receta",recetasConDeterminadaCalificacion);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no se encontro la receta");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaExplorar/filtrarUsuario/{nombre}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerRecetaFiltroUsuario(@PathVariable String nombre){
        HashMap<String, Object> filtroObtenerId= new HashMap<>();
        filtroObtenerId.put("nombre", nombre);
        int idUsuario=this.accesoABaseDeDatos.obtenerIdUsuario(filtroObtenerId);
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("usuario",idUsuario);
        List<Receta> receta=this.accesoABaseDeDatos.obtenerUnaReceta(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!receta.isEmpty()){
            infoResponse.put("Receta",receta);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no se encontro la receta");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaExplorar/filtrarIngredientes",method = RequestMethod.POST)
    public ResponseEntity<Object> traerRecetaFiltroIngredientes( @RequestBody HashMap ingredientesArray){
        List<Receta> recetas=this.accesoABaseDeDatos.obtenerRecetasExplorar();
        List<Receta> recetasConDeterminadosIngredientes = new ArrayList<>();
        ArrayList<String> ingredientes= (ArrayList<String>) ingredientesArray.get("ingredientes");
            for (Receta receta: recetas) {
                for (Map.Entry<Integer, HashMap<String, Object>> ingredienteActual:receta.getIngredientes().entrySet()) {
                    for(Map.Entry<String, Object> ingrediente: ingredienteActual.getValue().entrySet()){
                        if(ingrediente.getKey().equals("nombre") && ingredientes.contains(ingrediente.getValue()) && !recetasConDeterminadosIngredientes.contains(receta) ){
                            recetasConDeterminadosIngredientes.add(receta);
                        }

                    }
                }
        }

        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!recetasConDeterminadosIngredientes.isEmpty()){
            infoResponse.put("Receta",recetasConDeterminadosIngredientes);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no se encontro la receta");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/recetaMisRecetas/{idUsuario}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerRecetasUsuario(@PathVariable int idUsuario){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("usuario",idUsuario);
        List<Receta> receta=this.accesoABaseDeDatos.obtenerUnaReceta(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!receta.isEmpty()){
            infoResponse.put("Receta",receta);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no hay recetas creadas por ese usuario");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/listaExpandida/{idUsuario}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerListasUsuario(@PathVariable int idUsuario){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        List<Lista> listas=this.accesoABaseDeDatos.obtenerListasUsuario(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!listas.isEmpty()){
            infoResponse.put("Listas",listas);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no hay listas creadas por ese usuario");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/miDespensa/{idUsuario}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerDespensa(@PathVariable int idUsuario){
        HashMap<String, Integer> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        List<Document> despensa=this.accesoABaseDeDatos.obtenerDespensaUsuario(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!despensa.isEmpty()){
            infoResponse.put("Despensa",despensa);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no tiene nada en la despensa o no existe el usuario");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/productos/{idProducto}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerProducto(@PathVariable String idProducto){
        HashMap<String, String> filtro = new HashMap<>();
        filtro.put("id",idProducto);
        Producto producto=this.accesoABaseDeDatos.obtenerProducto(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (!producto.getNombre().equals("")){
            infoResponse.put("Producto",producto);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no se encontro el producto");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/guardados/{idUsuario}",method = RequestMethod.GET)
    public ResponseEntity<Object> traerGuardados(@PathVariable int idUsuario){
        HashMap<String, Integer> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        List<List<Receta>> guardados=this.accesoABaseDeDatos.obtenerRecetasGuardadasUsuario(filtro);
        HashMap<String, Object> infoResponse=new HashMap<>();
        if (guardados!=null){
            infoResponse.put("Recetas",guardados);
            return new ResponseEntity<>(infoResponse,HttpStatus.OK);
        }
        infoResponse.put("error","no tiene recetas guardadas o el usuario no existe");
        return new ResponseEntity<>(infoResponse,HttpStatus.NOT_FOUND);
    }

    @RequestMapping(value = "/agregarItem/{idUsuario}/{idLista}/{nombreItem}",method = RequestMethod.GET)
    public void insertarItem(@PathVariable int idUsuario,@PathVariable int idLista, @PathVariable String nombreItem){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("listaDeCompras.idLista",idLista);
        this.accesoABaseDeDatos.agregarItem(filtro,cambiarGuionesPorEspacios(nombreItem),false);
    }

    @RequestMapping(value = "/actualizarItem/{idUsuario}/{idLista}/{descripcionItem}/{estado}",method = RequestMethod.GET)
    public void actualizarItem(@PathVariable int idUsuario,@PathVariable int idLista, @PathVariable String descripcionItem, @PathVariable boolean estado){
        HashMap<String, Object> filtroObtenerListasUsuario = new HashMap<>();
        HashMap<String, Object> filtro = new HashMap<>();
        int idItem= 0;
        String nombreItem=cambiarGuionesPorEspacios(descripcionItem);
        filtroObtenerListasUsuario.put("idUsuario",idUsuario);
        filtro.put("idUsuario",idUsuario);
        List<Lista> listasUsuario = this.accesoABaseDeDatos.obtenerListasUsuario(filtroObtenerListasUsuario);
        for (Lista lista : listasUsuario) {
            if (lista.getClavePrimaria()==idLista){
                for (Map.Entry<Integer, HashMap<String, Object>> item : lista.getItems().entrySet()) {
                    boolean esElItem=false;
                    for (Map.Entry<String, Object> datosItem : item.getValue().entrySet()) {
                        if (datosItem.getKey().equals("descripcion") && datosItem.getValue().equals(nombreItem)) {
                            esElItem=true;
                        }
                        if(esElItem && datosItem.getKey().equals("id") ){
                            idItem= (int) datosItem.getValue();
                        }
                    }
                }
            }
        }
        filtro.put("listaDeCompras.items.id",idItem);
        this.accesoABaseDeDatos.modificarEstadoItem(filtro,idLista,estado); //Le mandamos el estado que tiene el item
    }

    @RequestMapping(value = "/agregarCalificacion",method = RequestMethod.POST)
    public void insertarCalificacion(@RequestBody HashMap datosJSON){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("id",datosJSON.get("id"));
        this.accesoABaseDeDatos.agregarCalificacion(filtro, (Integer) datosJSON.get("calificacion"));
        filtro.put("idUsuario",datosJSON.get("idUsuario"));
        this.accesoABaseDeDatos.agregarRecetaCalificada(filtro,"recetasCalificadas");
    }

    @RequestMapping(value = "/eliminarItem/{idUsuario}/{idLista}/{nombreItem}",method = RequestMethod.GET)
    public void eliminarItem(@PathVariable int idUsuario,@PathVariable int idLista, @PathVariable String nombreItem){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("listaDeCompras.idLista",idLista);
        this.accesoABaseDeDatos.eliminarItem(filtro,cambiarGuionesPorEspacios(nombreItem));
        this.accesoABaseDeDatos.insertarItemsConNuevosId(filtro);
    }

    @RequestMapping(value = "/eliminarReceta/{idReceta}",method = RequestMethod.GET)
    public void eliminarReceta(@PathVariable int idReceta){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("id",idReceta);
        this.accesoABaseDeDatos.eliminarReceta(filtro);
    }
    @RequestMapping(value = "/comprobarCalificacion/{idReceta}/{idUsuario}",method = RequestMethod.GET)
    public boolean comprobarCalificacionReceta(@PathVariable int idReceta, @PathVariable int idUsuario){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        return this.accesoABaseDeDatos.calificoLaReceta(filtro, idReceta);
    }

    @RequestMapping(value = "/agregarAlMenu/{idUsuario}/{idReceta}/{momento}/{fecha}/{cantPersonas}",method = RequestMethod.GET)
    public void agregarEntradaMenu(@PathVariable int idUsuario,@PathVariable int idReceta, @PathVariable String momento, @PathVariable String fecha,@PathVariable int cantPersonas){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("idReceta",idReceta);
        filtro.put("momento",momento);
        filtro.put("cantidadPersonas", cantPersonas);
        filtro.put("fecha",fecha);
        this.accesoABaseDeDatos.agregarRecetaMenuSemanal(filtro);
    }

    @RequestMapping(value = "/eliminarAlMenu/{idUsuario}/{idReceta}/{momento}/{fecha}/{cantPersonas}",method = RequestMethod.GET)
    public void eliminarEntradaMenu(@PathVariable int idUsuario,@PathVariable int idReceta, @PathVariable String momento, @PathVariable String fecha,@PathVariable int cantPersonas){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("idReceta",idReceta);
        filtro.put("momento",momento);
        filtro.put("cantidadPersonas", cantPersonas);
        filtro.put("fecha",fecha);
        this.accesoABaseDeDatos.eliminarRecetaMenuSemanal(filtro);
    }

    @RequestMapping(value = "/agregarGuardados/{idUsuario}/{idReceta}",method = RequestMethod.GET)
    public void agregarRecetaGuardada(@PathVariable int idUsuario,@PathVariable int idReceta){
        HashMap<String, Integer> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("idReceta",idReceta);
        this.accesoABaseDeDatos.agregarRecetaGuardada(filtro,"recetasGuardadas");
    }

    @RequestMapping(value = "/eliminarGuardados/{idUsuario}/{idReceta}",method = RequestMethod.GET)
    public void eliminarRecetaGuardada(@PathVariable int idUsuario,@PathVariable int idReceta){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("idReceta",idReceta);
        this.accesoABaseDeDatos.eliminarRecetaGuardada(filtro);
    }

    @RequestMapping(value = "/agregarLista/{idUsuario}/{nombre}",method = RequestMethod.GET)
    public void agregarLista(@PathVariable int idUsuario, @PathVariable String nombre){
        HashMap<String, Object> filtro = new HashMap<>();
        String nombreAInsertar= nombre.replace("_"," ");
        filtro.put("idUsuario",idUsuario);
        this.accesoABaseDeDatos.agregarLista(filtro,nombreAInsertar);
    }

    @RequestMapping(value = "/eliminarLista/{idUsuario}/{idLista}",method = RequestMethod.GET)
    public void eliminarLista(@PathVariable int idUsuario, @PathVariable int idLista){
        HashMap<String, Object> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("idLista",idLista);
        this.accesoABaseDeDatos.eliminarLista(filtro);
        this.accesoABaseDeDatos.reordenarIdsListas(filtro);
    }

    @RequestMapping(value = "/renombrarLista/{idUsuario}/{idLista}/{nuevoNombre}",method = RequestMethod.GET)
    public void renombrarLista(@PathVariable int idUsuario, @PathVariable int idLista, @PathVariable String nuevoNombre){
        HashMap<String, Integer> filtro = new HashMap<>();
        filtro.put("idUsuario",idUsuario);
        filtro.put("listaDeCompras.idLista",idLista);
        this.accesoABaseDeDatos.modificarNombreLista(filtro,cambiarGuionesPorEspacios(nuevoNombre));
    }


    @RequestMapping(value = "/insertarReceta",method = RequestMethod.POST)
    public  ResponseEntity<Object> insertarReceta(@RequestBody  HashMap datosJSON) {
        HashMap<String,Object> datosReceta=new HashMap<>();
        HashMap<String, Object> infoResponse =new HashMap<>();
        HashMap<String, Object> filtro = new HashMap<>();

        filtro.put("imagen",new BasicDBObject("$regex", "PlatosComida/"+ datosJSON.get("titulo") +".*"));

        String nombreNuevoImagen = datosJSON.get("titulo") + "(" + this.accesoABaseDeDatos.contarElementos(filtro, "receta") + ")";
        String imagenEnBase64=(String) datosJSON.get("imagen");

        switch (imagenEnBase64.charAt(0)){
            case '/':
                nombreNuevoImagen += ".jpg";
                break;
            case 'i':
                nombreNuevoImagen += ".png";
                break;
        }

        datosReceta.put("usuario",Integer.parseInt((String)datosJSON.get("idUsuario")));
        datosReceta.put("titulo",datosJSON.get("titulo"));
        datosReceta.put("dificultad",Integer.parseInt((String) datosJSON.get("dificultad")));
        datosReceta.put("imagen","PlatosComida/"+nombreNuevoImagen);
        datosReceta.put("calificacion",new ArrayList<Integer>());

        try {
            this.servicioParaSubirArchivos.guardarImagenEnMongoDB((String) datosJSON.get("imagen"),nombreNuevoImagen);
        } catch (IOException e) {
            e.printStackTrace();
        }
        datosReceta.put("ingredientes",datosJSON.get("ingredientesIngresados"));
        datosReceta.put("pasos",datosJSON.get("pasosIngresados"));
        ArrayList<HashMap<String, HashMap<String, Object>>> ingredientes= (ArrayList<HashMap<String, HashMap<String, Object>>>) datosJSON.get("ingredientesIngresados");
        ArrayList<HashMap<String, HashMap<String, String>>> pasos= (ArrayList<HashMap<String, HashMap<String, String>>>) datosJSON.get("pasosIngresados");
        HashMap<String, HashMap<String,Object>>ingredientesPreparacion=new HashMap<>();
        HashMap<String, HashMap<String, Object>> pasosPreparacion=new HashMap<>();

        int idAutoIncrementable=0;
        for(HashMap<String, HashMap<String, Object>> ingrediente: ingredientes ) {
            HashMap<String, Object> ingredienteAux = new HashMap<>();
            for (Map.Entry<String, HashMap<String, Object>> ingr : ingrediente.entrySet()) {

                ingredienteAux.put(ingr.getKey(), ingr.getValue());

            }
            ingredientesPreparacion.put(String.valueOf(idAutoIncrementable), ingredienteAux);
            idAutoIncrementable++;

        }
        idAutoIncrementable = 0;
        for (HashMap<String, HashMap<String, String>> paso : pasos) {
            HashMap<String, Object> pasosAux = new HashMap<>();
            for (Map.Entry<String, HashMap<String, String>> pasoDeterminado : paso.entrySet()) {
                pasosAux.put(pasoDeterminado.getKey(),pasoDeterminado.getValue());


            }
            pasosPreparacion.put(String.valueOf(idAutoIncrementable), pasosAux);
            idAutoIncrementable++;
        }
        datosReceta.put("pasos",pasosPreparacion);
        datosReceta.put("ingredientes",ingredientesPreparacion);
        this.accesoABaseDeDatos.insertarUnaReceta(datosReceta);
        infoResponse.put("OK", "Receta añadida");
        return new ResponseEntity<>(infoResponse,HttpStatus.OK);
    }
}

