package webapp.escola_jpa.Controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

import webapp.escola_jpa.Model.Materias;
import webapp.escola_jpa.Repository.MateriasRepository;

@Controller
public class IndexController {
    @Autowired
    private MateriasRepository materiasRepository;

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
    @GetMapping("/login-aluno")
    public String acessoLoginAluno() {
        return "login/login-aluno";
    }
    
    @GetMapping("/cad-adm")
    public String acessoCadAdm() {
        return "cadastro/cad-adm";
    }
   
   
    
  
    
    
    


}
