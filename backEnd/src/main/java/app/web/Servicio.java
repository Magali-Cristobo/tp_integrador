package app.web;
import com.mongodb.gridfs.GridFS;
import com.mongodb.gridfs.GridFSInputFile;
import org.apache.commons.io.FileUtils;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;

import java.io.File;
import java.io.IOException;
//import java.nio.file.Files;
//import java.nio.file.Path;
//import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.*;

@Service
public class Servicio {
    private String ubicacionArchivo;
    public Servicio(){
        this.ubicacionArchivo = ".//src//main//resources//files//";
    }

    protected boolean doDelete( File fileToDelete) throws IOException {
        FileUtils.forceDelete(fileToDelete);
        System.out.println("borre");
        return true;
    }
    
    public void guardarImagenEnMongoDB(String imagenCodificado, String nombreObjetoFile ) throws IOException {

        byte[] decodedBytes = Base64.getDecoder().decode(imagenCodificado);
        FileUtils.writeByteArrayToFile(new File("C:\\xampp\\htdocs\\tpIntegrador\\DesarrolloWeb\\Maquetado\\PlatosComida\\"+nombreObjetoFile),decodedBytes);

    }

}