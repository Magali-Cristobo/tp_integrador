package app.web;

import java.util.HashMap;

public class Producto {
    private String codigoDeBarra;
    private String nombre;
    private String categoria;
    private String marca;
    private String imagen;

    public Producto(String codigoDeBarra, String nombre, String categoria, String imagen, String marca) {
        this.codigoDeBarra = codigoDeBarra;
        this.nombre = nombre;
        this.categoria = categoria;
        this.marca=marca;
        this.imagen=imagen;
    }
    public Producto() {
        this.codigoDeBarra = new String("0");
        this.nombre = "";
        this.categoria = "";
        this.marca="";
        this.categoria="";
    }


    public String getImagen() {
        return imagen;
    }

    public String getMarca() {
        return marca;
    }

    public String getCodigoDeBarra() {
        return codigoDeBarra;
    }

    public void setCodigoDeBarra(String codigoDeBarra) {
        this.codigoDeBarra = codigoDeBarra;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getCategoria() {
        return categoria;
    }

    public void setCategoria(String categoria) {
        this.categoria = categoria;
    }

}