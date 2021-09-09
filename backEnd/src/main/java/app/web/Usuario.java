package app.web;

import java.util.HashMap;
import java.util.HashSet;

public class Usuario{
    private int clavePrimaria;
    private String nombre;
    private String clave;
    private String mail;
    private HashSet<Lista> listasDeCompras;
    private HashSet<Receta> recetasGuardadas;
    private MenuSemanal menuSemanal;
    private HashSet<Receta> recetasCreadas;
    private HashMap<Producto, Integer> despensa;

    public Usuario(int clavePrimaria, String nombre, String clave, String mail, MenuSemanal menuSemanal) {
        this.clavePrimaria = clavePrimaria;
        this.nombre = nombre;
        this.clave = clave;
        this.mail = mail;
        this.listasDeCompras = new HashSet<>();
        this.menuSemanal = menuSemanal;
        this.recetasGuardadas = new HashSet<>();
        this.recetasCreadas = new HashSet<>();
        this.despensa = new HashMap<>();
    }


    public HashMap<Producto, Integer> getDespensa() {
        return despensa;
    }

    public void setDespensa(HashMap<Producto, Integer> despensa) {
        this.despensa = despensa;
    }

    public HashSet<Receta> getRecetasCreadas() {
        return recetasCreadas;
    }

    public void setRecetasCreadas(HashSet<Receta> recetasCreadas) {
        this.recetasCreadas = recetasCreadas;
    }

    public HashSet<Receta> getRecetasGuardadas() {
        return recetasGuardadas;
    }

    public void setRecetasGuardadas(HashSet<Receta> recetasGuardadas) {
        this.recetasGuardadas = recetasGuardadas;
    }

    public int getClavePrimaria() {
        return clavePrimaria;
    }

    public void setClavePrimaria(int clavePrimaria) {
        this.clavePrimaria = clavePrimaria;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getClave() {
        return clave;
    }

    public void setClave(String clave) {
        this.clave = clave;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public HashSet<Lista> getListasDeCompras() {
        return listasDeCompras;
    }

    public void setListasDeCompras(HashSet<Lista> listasDeCompras) {
        this.listasDeCompras = listasDeCompras;
    }

    public MenuSemanal getMenuSemanal() {
        return menuSemanal;
    }

    public void setMenuSemanal(MenuSemanal menuSemanal) {
        this.menuSemanal = menuSemanal;
    }

}
