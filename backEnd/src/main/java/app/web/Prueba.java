package app.web;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

import java.io.File;
import java.io.IOException;
import java.util.HashMap;
import java.util.List;

public class Prueba {

    public static void main(String[] args) {
        DatosJson datos = new DatosJson();
        HashMap<String, Object> valoresRequeridos= new HashMap<>();

        valoresRequeridos.put("idUsuario",2);
        valoresRequeridos.put("idReceta",21);

    }
}
