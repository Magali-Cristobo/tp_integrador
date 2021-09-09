package app.web;

import java.util.ArrayList;
import java.util.HashMap;

public class MenuSemanal {
    private int clavePrimaria;
    private ArrayList<String> momentosDelDia;
    private ArrayList<Receta> recetas;
    private ArrayList<Fecha> fechas;
    private ArrayList<Integer> cantPersonas;

    public MenuSemanal(int clavePrimaria, ArrayList<String> momentosDelDia, ArrayList<Receta> recetas, ArrayList<Fecha> fechas, ArrayList<Integer> cantPersonas) {
        this.clavePrimaria = clavePrimaria;
        this.momentosDelDia = momentosDelDia;
        this.recetas = recetas;
        this.fechas = fechas;
        this.cantPersonas = cantPersonas;
    }

    public int getClavePrimaria() {
        return clavePrimaria;
    }

    public void setClavePrimaria(int clavePrimaria) {
        this.clavePrimaria = clavePrimaria;
    }

    public ArrayList<String> getMomentosDelDia() {
        return momentosDelDia;
    }

    public void setMomentosDelDia(ArrayList<String> momentosDelDia) {
        this.momentosDelDia = momentosDelDia;
    }

    public ArrayList<Receta> getRecetas() {
        return recetas;
    }

    public void setRecetas(ArrayList<Receta> recetas) {
        this.recetas = recetas;
    }

    public ArrayList<Fecha> getFechas() {
        return fechas;
    }

    public void setFechas(ArrayList<Fecha> fechas) {
        this.fechas = fechas;
    }

    public ArrayList<Integer> getCantPersonas() {
        return cantPersonas;
    }

    public void setCantPersonas(ArrayList<Integer> cantPersonas) {
        this.cantPersonas = cantPersonas;
    }

}
