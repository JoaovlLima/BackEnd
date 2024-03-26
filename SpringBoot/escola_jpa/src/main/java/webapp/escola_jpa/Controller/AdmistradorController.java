package webapp.escola_jpa.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;

import webapp.escola_jpa.Model.Administrador;
import webapp.escola_jpa.Model.PreCadAdm;
import webapp.escola_jpa.Repository.AdministradorRepository;
import webapp.escola_jpa.Repository.PreCadAdmRepository;


@Controller
public class AdmistradorController {

    @Autowired
    private AdministradorRepository ar;
    @Autowired
    private PreCadAdmRepository pcar;

    @PostMapping("cadastro-adm")
    public String postCadastroAdm(Administrador adm) {
        String cpfVerificacao = pcar.findByCpf(adm.getCpf()).getCpf();

        if(cpfVerificacao.equals(adm.getCpf()))
        ar.save(adm);
        System.out.println("Cadastro Realizado com Sucesso");
        
        return "login/login-adm";
    }
    
}
