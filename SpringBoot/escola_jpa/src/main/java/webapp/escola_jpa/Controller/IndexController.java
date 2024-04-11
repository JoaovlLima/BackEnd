package webapp.escola_jpa.Controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;

@Controller
public class IndexController {

    @GetMapping("/")
    public String acessoHome() {
        return "index";
    }

    @GetMapping("/home")
    public String acessoHome2() {
        return "index";
    }

    @GetMapping("/login-adm")
    public String acessoLoginAdm() {
        return "login/login-adm";
    }

    @GetMapping("/login-docente")
    public String acessoLoginDoc() {
        return "login/login-docente";
    }
    
    @GetMapping("/cad-adm")
    public String acessoCadAdm() {
        return "cadastro/cad-adm";
    }
    @GetMapping("/cad-docente")
    public String acessoCadDoc() {
        return "interna/docente/cad-docente";
    }
    @GetMapping("/cad-aluno")
    public String acessoCadaluno() {
        return "interna/aluno/cad-aluno";
    }
    @GetMapping("/lancarNotas")
    public String acessoLancarNotas() {
        return "areaProf/lancarNotas";
    }
    
    
    


}
