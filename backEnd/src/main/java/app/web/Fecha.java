package app.web;

public class Fecha {
    int anio;
    int mes;
    int dia;

    public Fecha(int anio, int mes, int dia) {
        this.anio = anio;
        this.mes = mes;
        this.dia = dia;
    }
    public Fecha() {
        this.anio =0;
        this.mes = 0;
        this.dia = 0;
    }

    public int getAnio() {
        return anio;
    }

    public void setAnio(int anio) {
        this.anio = anio;
    }

    public int getMes() {
        return mes;
    }

    public void setMes(int mes) {
        this.mes = mes;
    }

    public int getDia() {
        return dia;
    }

    public void setDia(int dia) {
        this.dia = dia;
    }

    public int armarAnio(String fecha){
        int posActual=6;
        String anio="";
        while(posActual<fecha.length()){
           anio+=fecha.charAt(posActual);
           posActual++;
        }
        return Integer.parseInt(anio);
    }
    public int armarMes(String fecha){
        int posActual=3;
        String mes="";
        while(posActual<5){
            mes+=fecha.charAt(posActual);
            posActual++;
        }
        return Integer.parseInt(mes);
    }
    public int armarDia(String fecha){
        int posActual=0;
        String dia="";
        while(posActual<2){
            dia+=fecha.charAt(posActual);
            posActual++;
        }
        return Integer.parseInt(dia);
    }


}