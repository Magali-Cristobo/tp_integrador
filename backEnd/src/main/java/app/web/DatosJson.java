package app.web;

import com.mongodb.client.FindIterable;
import com.mongodb.client.MongoCursor;
import com.mongodb.client.model.Filters;
import com.mongodb.client.model.Updates;
import com.mongodb.client.result.DeleteResult;
import com.mongodb.client.result.UpdateResult;
import org.bson.Document;
import org.bson.conversions.Bson;
import org.springframework.stereotype.Service;

import java.io.File;
import java.io.IOException;
import java.util.*;

import static com.mongodb.client.model.Filters.eq;

@Service
public class DatosJson extends AccesoMongoDB {
    public DatosJson() {
        super();
    }

    public int promedioCalificacion(Object calificaciones) {
        int calificacionPromedio;
        int suma = 0;
        for (Integer calificacion : (ArrayList<Integer>) calificaciones) {
            suma = suma + calificacion;
        }
        if (((ArrayList<Integer>) calificaciones).size() != 0) {
            calificacionPromedio = suma / ((ArrayList<Integer>) calificaciones).size();
        } else {
            calificacionPromedio = 0;
        }
        return calificacionPromedio;
    }

    public List<Receta> obtenerRecetasExplorar() {
        this.conectarABaseDeDatos("proyectoIntegrador");
        List<Receta> recetas = new ArrayList<>();
        this.conectarAColeccion("receta");
        FindIterable resultado = this.getColeccion().find();
        MongoCursor iterador = resultado.iterator();
        while (iterador.hasNext()) {
            int idAutoIncrementable = 0;
            HashMap<Integer, HashMap<String, Object>> ingredientes = new HashMap<>();
            HashMap<String, String> preparacion = new HashMap<>();

            Document documento = (Document) iterador.next();
            int clavePrimaria = documento.getInteger("id");
            String titulo = documento.getString("titulo");
            int dificultad = documento.getInteger("dificultad");
            String imagen = documento.getString("imagen");
            String autor = String.valueOf(documento.getInteger("usuario"));
            List<Document> ingredientesPreparacion = (List<Document>) documento.get("ingredientes");
            Object guardados = documento.get("calificacion");
            int calificacion = this.promedioCalificacion(guardados);
            for (Document document : ingredientesPreparacion) {
                HashMap<String, Object> auxiliar = new HashMap<>();
                String nombreIngrediente = document.getString("nombre");
                Object cantidadIngrediente = document.get("cantidad");
                String unidadIngrediente = document.getString("unidad");
                auxiliar.put("nombre", nombreIngrediente);
                auxiliar.put("unidad", unidadIngrediente);
                auxiliar.put("cantidad", cantidadIngrediente);
                ingredientes.put(idAutoIncrementable, auxiliar);
                idAutoIncrementable++;
            }
            List<Document> pasosPreparacion = (List<Document>) documento.get("pasos");
            for (Document document : pasosPreparacion) {
                String numeroPaso = document.getString("paso");
                String descripcionPaso = document.getString("descripcion");
                preparacion.put(numeroPaso, descripcionPaso);
            }
            Receta receta = new Receta(clavePrimaria, titulo, ingredientes, dificultad, preparacion, imagen, autor, calificacion);
            recetas.add(receta);
        }
        return recetas;
    }

    public HashMap<Integer, String> obtenerImagenesRecetas() {
        this.conectarABaseDeDatos("proyectoIntegrador");
        HashMap<Integer, String> imagenPlatos = new HashMap<>();
        this.conectarAColeccion("receta");
        FindIterable resultado = this.getColeccion().find();
        MongoCursor iterador = resultado.iterator();
        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            imagenPlatos.put(documento.getInteger("id"), documento.getString("imagen"));
        }

        return imagenPlatos;
    }

    public List<Lista> obtenerListasUsuario(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        List<Lista> listasUsuario = new ArrayList<>();
        Bson requisitosACumplir = null;

        for (Map.Entry<String, Object> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;


        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();

        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();

            List<Document> listas = (List<Document>) documento.get("listaDeCompras");
            for (Document document : listas) {
                int idAutoIncrementable = 0;
                HashMap<Integer, HashMap<String, Object>> items = new HashMap<>();
                int id = document.getInteger("idLista");
                String nombre = document.getString("nombreLista");
                List<Document> itemsListas = (List<Document>) document.get("items");
                if (itemsListas != null) {
                    for (Document document2 : itemsListas) {
                        HashMap<String, Object> auxiliar = new HashMap<>();
                        String descripcion = document2.getString("descripcion");
                        Boolean estado = document2.getBoolean("estado");
                        int clavePrimaria = document2.getInteger("id");
                        auxiliar.put("id", clavePrimaria);
                        auxiliar.put("estado", estado);
                        auxiliar.put("descripcion", descripcion);
                        items.put(idAutoIncrementable, auxiliar);
                        idAutoIncrementable++;
                    }
                }
                Lista lista = new Lista(id, items, nombre);
                listasUsuario.add(lista);
            }
        }
        return listasUsuario;
    }

    public HashMap<Integer, HashMap<String, Object>> obtenerMenuSemanalUsuario(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        MenuSemanal menu = null;
        HashMap<Integer, HashMap<String, Object>> menuSemanalUsuario = new HashMap<>();
        Bson requisitosACumplir = null;

        for (Map.Entry<String, Object> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;

        this.conectarAColeccion("usuario");
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();

        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            int idAutoIncremental = 0;

            List<Document> menuSemanal = (List<Document>) documento.get("menuSemanal");
            for (Document document : menuSemanal) {
                HashMap<String, Object> auxiliar = new HashMap<>();
                int idReceta = document.getInteger("idReceta");
                String momento = document.getString("momento");
                int cantidadPersonas = document.getInteger("cantidadPersonas");
                String fecha = document.getString("fecha");
                auxiliar.put("idReceta", idReceta);
                auxiliar.put("momento", momento);
                auxiliar.put("cantidadPersonas", cantidadPersonas);
                auxiliar.put("fecha", fecha);
                menuSemanalUsuario.put(idAutoIncremental, auxiliar);
                idAutoIncremental++;
            }
        }
        return menuSemanalUsuario;
    }

    public List<List<Receta>> obtenerRecetasGuardadasUsuario(HashMap<String, Integer> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        List<Integer> recetasGuardadasUsuario = new ArrayList<>();
        List<List<Receta>> recetasGuardadas = new ArrayList<>();
        HashMap<String, Object> auxiliar = new HashMap<>();
        HashMap<String, Object> filtro = new HashMap<>();

        Bson requisitosACumplir = null;

        for (Map.Entry<String, Integer> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;

        this.conectarAColeccion("usuario");
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();
        Object guardados = null;
        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            ArrayList<Integer> idRecetasGuardadas = (ArrayList<Integer>) documento.get("recetasGuardadas");
            for (Integer id : idRecetasGuardadas) {
                auxiliar.put("id", id);
                if (this.obtenerUnaReceta(auxiliar).size() == 0) {
                    HashMap<String, Object> aux2 = new HashMap<>();
                    aux2.put("idReceta", id);
                    aux2.put("idUsuario", valoresRequeridos.get("idUsuario"));
                    this.eliminarRecetaGuardada(aux2);
                    Receta recetaError = new Receta();
                    List<Receta> recetaLista = new ArrayList<>();
                    recetaLista.add(recetaError);
                    recetasGuardadas.add(recetaLista);
                } else {
                    recetasGuardadas.add(this.obtenerUnaReceta(auxiliar));
                }
            }
        }
        return recetasGuardadas;
    }

    public List<Integer> obtenerRecetasCalificadasUsuario(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        List<Integer> recetasGuardadasUsuario = new ArrayList<>();
        List<List<Receta>> recetasGuardadas = new ArrayList<>();
        HashMap<String, Object> auxiliar = new HashMap<>();
        Bson requisitosACumplir = null;
        for (Map.Entry<String, Object> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;
        this.conectarAColeccion("usuario");
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();
        Object guardados = null;
        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            ArrayList<Integer> idRecetasGuardadas = (ArrayList<Integer>) documento.get("recetasCalificadas");
            for (Integer id : idRecetasGuardadas) {
                recetasGuardadasUsuario.add(id);
            }
        }
        return recetasGuardadasUsuario;
    }

    public boolean calificoLaReceta(HashMap<String, Object> valoresRequeridos, int idReceta) {
        return obtenerRecetasCalificadasUsuario(valoresRequeridos).contains(idReceta);
    }

    public List<Receta> obtenerUnaReceta(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        List<Receta> recetasCreadasUsuario = new ArrayList<>();

        Bson requisitosACumplir = null;

        for (Map.Entry<String, Object> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;

        this.conectarAColeccion("receta");
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();
        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();

            int idAutoIncrementable = 0;
            HashMap<Integer, HashMap<String, Object>> ingredientes = new HashMap<>();
            HashMap<String, String> preparacion = new HashMap<>();

            int clavePrimaria = documento.getInteger("id");
            String titulo = documento.getString("titulo");
            int dificultad = documento.getInteger("dificultad");
            String imagen = documento.getString("imagen");
            String autor = String.valueOf(documento.getInteger("usuario"));
            Object guardados = documento.get("calificacion");
            int calificacion = this.promedioCalificacion(guardados);
            List<Document> ingredientesPreparacion = (List<Document>) documento.get("ingredientes");
            for (Document document : ingredientesPreparacion) {
                HashMap<String, Object> auxiliar = new HashMap<>();
                String nombreIngrediente = document.getString("nombre");
                Object cantidadIngrediente = document.get("cantidad");
                String unidadIngrediente = document.getString("unidad");
                Ingrediente ingrediente = new Ingrediente(nombreIngrediente, unidadIngrediente);
                auxiliar.put("nombre", nombreIngrediente);
                auxiliar.put("unidad", unidadIngrediente);
                auxiliar.put("cantidad", cantidadIngrediente);
                ingredientes.put(idAutoIncrementable, auxiliar);
                idAutoIncrementable++;
            }
            List<Document> pasosPreparacion = (List<Document>) documento.get("pasos");
            for (Document document : pasosPreparacion) {
                String numeroPaso = document.getString("paso");
                String descripcionPaso = document.getString("descripcion");
                preparacion.put(numeroPaso, descripcionPaso);
            }
            Receta receta = new Receta(clavePrimaria, titulo, ingredientes, dificultad, preparacion, imagen, autor, calificacion);
            recetasCreadasUsuario.add(receta);
        }
        return recetasCreadasUsuario;
    }

    public int insertarUsuario(HashMap<String, Object> datosUsuario) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        int idUsuario = this.contarElementos(null, "usuario");
        Document documento = new Document().append("idUsuario", idUsuario).append("nombre", datosUsuario.get("nombre")).append("mail", datosUsuario.get("mail")).append("clave", datosUsuario.get("clave")).append("despensa", new ArrayList<>()).append("listaDeCompras", new ArrayList<>()).append("recetasGuardadas", new ArrayList<>()).append("menuSemanal", new ArrayList<>()).append("recetasCalificadas", new ArrayList<>());

        this.getColeccion().insertOne(documento);
        return idUsuario;
    }

    public void insertarUnaReceta(HashMap<String, Object> datosReceta) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("receta");
        ArrayList<HashMap<String, Object>> ingredientesPreparacionArray = new ArrayList<>();
        ArrayList<HashMap<String, String>> pasosPreparacionArray = new ArrayList<>();
        HashMap<String, HashMap<String, Object>> ingredientesPreparacion = (HashMap<String, HashMap<String, Object>>) datosReceta.get("ingredientes");
        HashMap<String, HashMap<String, String>> pasosPreparacion = (HashMap<String, HashMap<String, String>>) datosReceta.get("pasos");

        for (Map.Entry<String, HashMap<String, Object>> ingr : ingredientesPreparacion.entrySet()) {
            ingredientesPreparacionArray.add(ingr.getValue());
        }
        for (Map.Entry<String, HashMap<String, String>> paso : pasosPreparacion.entrySet()) {
            pasosPreparacionArray.add(paso.getValue());
        }
        Document documento = new Document().append("id", this.contarElementos(null, "receta"));
        datosReceta.put("ingredientes", ingredientesPreparacionArray);
        datosReceta.put("pasos", pasosPreparacionArray);
        for (Map.Entry<String, Object> datoReceta : datosReceta.entrySet()) {
            documento.append(datoReceta.getKey(), datoReceta.getValue());
        }
        this.getColeccion().insertOne(documento);
    }

    public List<Document> obtenerDespensaUsuario(HashMap<String, Integer> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        List<Document> productos = new ArrayList<>();

        Bson requisitosACumplir = null;

        for (Map.Entry<String, Integer> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;

        this.conectarAColeccion("usuario");
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();

        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();

            List<Document> despensa = (List<Document>) documento.get("despensa");
            for (Document document : despensa) {
                int idAutoIncrementable = 0;
                HashMap<Integer, Object> items = new HashMap<>();
                Object producto = document.get("");
                productos = despensa;
            }
        }
        return productos;
    }

    public Producto obtenerProducto(HashMap<String, String> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        Producto producto = new Producto();
        Bson requisitosACumplir = null;

        for (Map.Entry<String, String> elemento : valoresRequeridos.entrySet()) {
            requisitosACumplir = eq(elemento.getKey(), elemento.getValue());
        }
        ;

        this.conectarAColeccion("producto");
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();

        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            String idProducto = documento.getString("id");
            String nombre = documento.getString("nombre");
            String marca = documento.getString("marca");
            String imagen = documento.getString("imagen");
            String categoria = documento.getString("categoria");
            producto = new Producto(idProducto, nombre, categoria, imagen, marca);
        }
        return producto;
    }

    public int contarElementos(HashMap<String, Object> valoresRequeridos, String coleccion) {
        int ultimoId = 0;
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion(coleccion);
        FindIterable resultado;
        List<Bson> filtros = new ArrayList<>();
        if (valoresRequeridos != null) {
            for (Map.Entry<String, Object> valor : valoresRequeridos.entrySet()) {
                Bson equivalencia = eq(valor.getKey(), valor.getValue());
                filtros.add(equivalencia);
            }
            Bson requisitosACumplir = Filters.and(filtros);
            resultado = this.getColeccion().find(requisitosACumplir);
        } else {
            resultado = this.getColeccion().find();
        }

        MongoCursor iterador = resultado.iterator();

        while (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            ultimoId++;
        }
        return ultimoId;
    }

    public int obtenerCantidadItems(HashMap<String, Object> valoresRequeridos, int idLista) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        List<Lista> listas = this.obtenerListasUsuario(valoresRequeridos);
        int contador = 0;
        for (Lista listaActual : listas) {
            if (listaActual.getClavePrimaria() == idLista) {
                for (Map.Entry<Integer, HashMap<String, Object>> itemActual : listaActual.getItems().entrySet()) {
                    contador++;
                }
            }
        }
        return contador;
    }

    public void agregarItem(HashMap<String, Object> valoresRequeridos, String nombreItem, boolean estado) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        HashMap<String, Object> auxiliar = new HashMap<>();
        HashMap<String, Object> infoItem = new HashMap<>();
        auxiliar.put("idUsuario", (Integer) valoresRequeridos.get("idUsuario"));
        infoItem.put("id", this.obtenerCantidadItems(auxiliar, (Integer) valoresRequeridos.get("listaDeCompras.idLista")));
        infoItem.put("descripcion", nombreItem);
        infoItem.put("estado", estado);
        String rutaDelElemento = "listaDeCompras.$.items";
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, infoItem);
        Document filtro = new Document(valoresRequeridos);
        Document operacionConInfo = new Document("$push", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void eliminarItem(HashMap<String, Object> valoresRequeridos, String nombreItem) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        HashMap<String, Integer> auxiliar = new HashMap<>();
        HashMap<String, Object> infoItem = new HashMap<>();
        auxiliar.put("idUsuario", (Integer) valoresRequeridos.get("idUsuario"));
        infoItem.put("descripcion", nombreItem);
        String rutaDelElemento = "listaDeCompras.$.items";
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, infoItem);
        Document filtro = new Document(valoresRequeridos);
        Document operacionConInfo = new Document("$pull", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void agregarLista(HashMap<String, Object> valoresRequeridos, String nombreLista) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        HashMap<String, Object> infoLista = new HashMap<>();
        List<Bson> filtros = new ArrayList<>();
        for (Map.Entry<String, Object> valor : valoresRequeridos.entrySet()) {
            Bson equivalencia = eq(valor.getKey(), valor.getValue());
            filtros.add(equivalencia);
        }
        Bson requisitosACumplir = Filters.and(filtros);
        infoLista.put("idLista", this.obtenerListasUsuario(valoresRequeridos).size());
        infoLista.put("nombreLista", nombreLista);
        infoLista.put("items", new ArrayList<>());
        Document informacionActualizar = new Document("listaDeCompras", infoLista);
        Document operacionConInfo = new Document("$push", informacionActualizar);
        UpdateResult resultado = this.getColeccion().updateOne(requisitosACumplir, operacionConInfo);
    }

    public void modificarNombreLista(HashMap<String, Integer> valoresRequeridos, String nuevoNombre) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        String rutaDelElemento = "listaDeCompras.$.nombreLista";
        Document infoConRutaYNuevoValor = new Document(rutaDelElemento, nuevoNombre);
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        filtro.append("listaDeCompras.idLista", valoresRequeridos.get("listaDeCompras.idLista"));
        Document operacionConInfo = new Document("$set", infoConRutaYNuevoValor);
        this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void modificarEstadoItem(HashMap<String, Object> valoresRequeridos, int idLista, boolean estado) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        Document filtro = new Document(valoresRequeridos);
        String rutaDelElemento = "listaDeCompras." + idLista + ".items." + valoresRequeridos.get("listaDeCompras.items.id") + ".estado";
        Document infoConRutaYNuevoValor = new Document(rutaDelElemento, !estado);
        Document operacionConInfo = new Document("$set", infoConRutaYNuevoValor);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void agregarRecetaGuardada(HashMap<String, Integer> valoresRequeridos, String rutaDelElemento) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, valoresRequeridos.get("idReceta"));
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        Document operacionConInfo = new Document("$push", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void agregarRecetaCalificada(HashMap<String, Object> valoresRequeridos, String rutaDelElemento) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, valoresRequeridos.get("id"));
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        Document operacionConInfo = new Document("$push", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void agregarCalificacion(HashMap<String, Object> valoresRequeridos, int calificacion) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("receta");

        String rutaDelElemento = "calificacion";
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, calificacion);
        Document filtro = new Document(valoresRequeridos);
        Document operacionConInfo = new Document("$push", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void eliminarRecetaGuardada(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");

        String rutaDelElemento = "recetasGuardadas";
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, valoresRequeridos.get("idReceta"));
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        Document operacionConInfo = new Document("$pull", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void reordenarIdsListas(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        HashMap<String, Object> filtroObtenerListas = new HashMap<>();
        filtroObtenerListas.put("idUsuario", valoresRequeridos.get("idUsuario"));
        List<Lista> listasUsuario = this.obtenerListasUsuario(filtroObtenerListas);
        String rutaDelElemento = "listaDeCompras.$.idLista";
        int idNuevo = 0;
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        for (Lista listaActual : listasUsuario) {
            Document infoConRutaYNuevoValor = new Document(rutaDelElemento, idNuevo);
            filtro.append("listaDeCompras.idLista", listaActual.getClavePrimaria());
            Document operacionConInfo = new Document("$set", infoConRutaYNuevoValor);
            this.getColeccion().updateOne(filtro, operacionConInfo);
            idNuevo++;
        }
    }

    public void eliminarLista(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        Bson filtro = eq("idUsuario", valoresRequeridos.get("idUsuario"));
        Bson delete = Updates.pull("listaDeCompras", new Document("idLista", valoresRequeridos.get("idLista")));
        UpdateResult resultado = this.getColeccion().updateOne(filtro, delete);
    }

    public void borrarImagen(String nombreImagen) {
        Servicio servicio = new Servicio();
        File imagen = new File("C:\\xampp\\htdocs\\tpIntegrador\\DesarrolloWeb\\Maquetado\\" + nombreImagen);
        try {
            servicio.doDelete(imagen);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void eliminarReceta(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("receta");
        Bson filtro = eq("id", valoresRequeridos.get("id"));
        List<Receta> receta = obtenerUnaReceta(valoresRequeridos);
        DeleteResult resultado = this.getColeccion().deleteOne(filtro);
        borrarImagen(receta.get(0).getImagen());
    }

    public boolean verificarUsuario(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");

        List<Bson> filtros = new ArrayList<>();
        for (Map.Entry<String, Object> valor : valoresRequeridos.entrySet()) {
            Bson equivalencia = eq(valor.getKey(), valor.getValue());
            filtros.add(equivalencia);
        }
        Bson requisitosACumplir = Filters.and(filtros);
        FindIterable resultado = this.getColeccion().find(requisitosACumplir);
        MongoCursor iterador = resultado.iterator();

        if (iterador.hasNext()) {
            Document documento = (Document) iterador.next();
            int idUsuario = documento.getInteger("idUsuario");
            return true;
        }
        return false;
    }

    public int obtenerIdUsuario(HashMap<String, Object> valoresRequeridos) {
        if (this.verificarUsuario(valoresRequeridos)) {
            this.conectarABaseDeDatos("proyectoIntegrador");
            this.conectarAColeccion("usuario");

            List<Bson> filtros = new ArrayList<>();
            for (Map.Entry<String, Object> valor : valoresRequeridos.entrySet()) {
                Bson equivalencia = eq(valor.getKey(), valor.getValue());
                filtros.add(equivalencia);
            }
            Bson requisitosACumplir = Filters.and(filtros);
            FindIterable resultado = this.getColeccion().find(requisitosACumplir);
            MongoCursor iterador = resultado.iterator();

            Document documento = (Document) iterador.next();
            int idUsuario = documento.getInteger("idUsuario");
            return idUsuario;

        }
        return -1;
    }

    public void agregarRecetaMenuSemanal(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        HashMap<String, Integer> auxiliar = new HashMap<>();
        HashMap<String, Object> infoItem = new HashMap<>();
        auxiliar.put("idUsuario", (int) valoresRequeridos.get("idUsuario"));
        infoItem.put("idReceta", valoresRequeridos.get("idReceta"));
        infoItem.put("momento", valoresRequeridos.get("momento"));
        infoItem.put("cantidadPersonas", valoresRequeridos.get("cantidadPersonas"));
        infoItem.put("fecha", valoresRequeridos.get("fecha"));
        String rutaDelElemento = "menuSemanal";
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, infoItem);
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        Document operacionConInfo = new Document("$push", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public void eliminarRecetaMenuSemanal(HashMap<String, Object> valoresRequeridos) {
        this.conectarABaseDeDatos("proyectoIntegrador");
        this.conectarAColeccion("usuario");
        HashMap<String, Integer> auxiliar = new HashMap<>();
        HashMap<String, Object> infoItem = new HashMap<>();
        auxiliar.put("idUsuario", (int) valoresRequeridos.get("idUsuario"));
        infoItem.put("idReceta", valoresRequeridos.get("idReceta"));
        infoItem.put("momento", valoresRequeridos.get("momento"));
        infoItem.put("cantPersonas", valoresRequeridos.get("cantPersonas"));
        infoItem.put("fecha", valoresRequeridos.get("fecha"));
        String rutaDelElemento = "menuSemanal";
        Document infoConRutaYObjetoAInsertar = new Document(rutaDelElemento, infoItem);
        Document filtro = new Document();
        filtro.append("idUsuario", valoresRequeridos.get("idUsuario"));
        Document operacionConInfo = new Document("$pull", infoConRutaYObjetoAInsertar);
        UpdateResult resultado = this.getColeccion().updateOne(filtro, operacionConInfo);
    }

    public Lista obtenerUnaLista(HashMap<String, Object> valoresRequeridos) {
        Lista listaElegida = new Lista();
        for (Lista lista : obtenerListasUsuario(valoresRequeridos)) {
            if (lista.getClavePrimaria() == (Integer) valoresRequeridos.get("listaDeCompras.idLista")) {
                listaElegida = lista;
                break;
            }
        }
        return listaElegida;
    }

    public ArrayList<Item> itemsListaDeterminada(HashMap<String, Object> valoresRequeridos) {
        Lista lista = obtenerUnaLista(valoresRequeridos);
        ArrayList<Item> itemsArray = new ArrayList<>();
        for (Map.Entry<Integer, HashMap<String, Object>> item : lista.getItems().entrySet()) {
            Item itemAAgregar = new Item();
            for (Map.Entry<String, Object> items : item.getValue().entrySet()) {
                if (items.getKey().equals("id")) {
                    itemAAgregar.setClavePrimaria((Integer) items.getValue());
                } else if (items.getKey().equals("estado")) {
                    itemAAgregar.setEstado((Boolean) items.getValue());
                } else if (items.getKey().equals("descripcion")) {
                    itemAAgregar.setDescripcion((String) items.getValue());
                }

            }
            itemsArray.add(itemAAgregar);
        }
        return itemsArray;
    }

    public void insertarItemsConNuevosId(HashMap<String, Object> valoresRequeridos) {
        ArrayList<Item> itemsAInsertar = itemsListaDeterminada(valoresRequeridos);
        for (int i = 0; i < itemsAInsertar.size(); i++) {
            eliminarItem(valoresRequeridos, itemsAInsertar.get(i).getDescripcion());
        }
        for (int i = 0; i < itemsAInsertar.size(); i++) {
            agregarItem(valoresRequeridos, itemsAInsertar.get(i).getDescripcion(), itemsAInsertar.get(i).isEstado());
        }


    }

    public String obtenerInfoUsuario(HashMap<String, Object> valoresRequeridos) {
        if (this.verificarUsuario(valoresRequeridos)) {
            this.conectarABaseDeDatos("proyectoIntegrador");
            this.conectarAColeccion("usuario");

            List<Bson> filtros = new ArrayList<>();
            for (Map.Entry<String, Object> valor : valoresRequeridos.entrySet()) {
                Bson equivalencia = eq(valor.getKey(), valor.getValue());
                filtros.add(equivalencia);
            }
            Bson requisitosACumplir = Filters.and(filtros);
            FindIterable resultado = this.getColeccion().find(requisitosACumplir);
            MongoCursor iterador = resultado.iterator();

            Document documento = (Document) iterador.next();
            String nombreUsuario = documento.getString("nombre");
            return nombreUsuario;

        }
        return null;
    }

}
