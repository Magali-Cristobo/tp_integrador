package app.web;

import java.util.HashMap;

public class Receta {
    int clavePrimaria;
    String titulo;
    HashMap<Integer, HashMap<String, Object>> ingredientes;
    int dificultad;
    int personas;
    int puntaje;
    String autor;
    String imagen;
    HashMap<String, String> preparacion;

    public Receta() {
        this.clavePrimaria = -1;
        this.titulo = "";
        this.ingredientes = new HashMap<>();
        this.dificultad = 0;
        this.personas = 0;
        this.puntaje = 0;
        this.autor = "";
        this.preparacion = new HashMap<>();
        this.imagen="";
    }
    public Receta(int clavePrimaria, String titulo, HashMap<Integer, HashMap<String, Object>> ingredientes, int dificultad,HashMap<String, String> preparacion, String imagen, String autor, int puntaje) {
        this.clavePrimaria = clavePrimaria;
        this.titulo = titulo;
        this.ingredientes = ingredientes;
        this.dificultad = dificultad;
        this.puntaje = puntaje;
        this.autor = autor;
        this.preparacion = preparacion;
        this.imagen=imagen;
    }

    public int getClavePrimaria() {
        return clavePrimaria;
    }

    public void setClavePrimaria(int clavePrimaria) {
        this.clavePrimaria = clavePrimaria;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public HashMap<Integer, HashMap<String, Object>> getIngredientes() {
        return ingredientes;
    }

    public void setIngredientes(HashMap<Integer, HashMap<String, Object>> ingredientes) {
        this.ingredientes = ingredientes;
    }

    public int getDificultad() {
        return dificultad;
    }

    public void setDificultad(int dificultad) {
        this.dificultad = dificultad;
    }

    public int getPersonas() {
        return personas;
    }

    public void setPersonas(int personas) {
        this.personas = personas;
    }

    public int getPuntaje() {
        return puntaje;
    }

    public void setPuntaje(int puntaje) {
        this.puntaje = puntaje;
    }

    public String getAutor() {
        return autor;
    }

    public void setAutor(String autor) {
        this.autor = autor;
    }

    public HashMap<String, String> getPreparacion() {
        return preparacion;
    }

    public void setPreparacion(HashMap<String, String>  preparacion) {
        this.preparacion = preparacion;
    }

    public String getImagen() {
        return imagen;
    }

    public void setImagen(String imagen) {
        this.imagen = imagen;
    }

}
