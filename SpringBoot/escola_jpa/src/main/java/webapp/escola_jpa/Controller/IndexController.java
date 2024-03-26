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

    @GetMapping("/cad-adm")
    public String acessoCadAdm() {
        return "cadastro/cad-adm";
    }

}
