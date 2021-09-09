package app.web;

public class Ingrediente{
    String nombre;
    String unidad;

    public Ingrediente(String nombre, String unidad) {
        this.nombre = nombre;
        this.unidad = unidad;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getUnidad() {
        return unidad;
    }

    public void setUnidad(String unidad) {
        this.unidad = unidad;
    }

}
