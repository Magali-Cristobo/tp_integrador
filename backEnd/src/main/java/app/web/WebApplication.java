package app.web;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
@SpringBootApplication
public class WebApplication {

    @GetMapping("/")
    public String index() {
        return "home";
    }

    @GetMapping("/explorar")
    public String explorar() {
        return "explorar";
    }

    public static void main(String[] args) {
        SpringApplication.run(WebApplication.class, args);
    }

}
