package webapp.escola_jpa.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;

import webapp.escola_jpa.Model.Administrador;
import webapp.escola_jpa.Model.Docente;
import webapp.escola_jpa.Model.PreCadAdm;
import webapp.escola_jpa.Repository.AdministradorRepository;
import webapp.escola_jpa.Repository.DocenteRepository;
import webapp.escola_jpa.Repository.PreCadAdmRepository;


@Controller
public class AdmistradorController {

    @Autowired
    private AdministradorRepository ar;
    @Autowired
    private DocenteRepository dr;
    @Autowired
    private PreCadAdmRepository pcar;

    boolean acessoAdm = false;

    @PostMapping("cadastro-adm")
    public String postCadastroAdm(Administrador adm) {
        String cpfVerificacao = pcar.findByCpf(adm.getCpf()).getCpf();

        if(cpfVerificacao.equals(adm.getCpf()))
        ar.save(adm);
        System.out.println("Cadastro Realizado com Sucesso");
        
        return "login/login-adm";
    }
     @GetMapping("/interna-adm")
    public String acessoPageInternaAdm() {
        String vaiPara = "";
        if (acessoAdm) {
            vaiPara = "interna/interna-adm";
        } else {
            vaiPara = "login/login-adm";
        }
        return vaiPara;
    }

    @PostMapping("acesso-adm")
    public String acessoAdm(@RequestParam String cpf,
            @RequestParam String senha) {
        try {
            boolean verificaCpf = ar.existsById(cpf);
            boolean verificaSenha = ar.findByCpf(cpf).getSenha().equals(senha);
            String url = "";
            if (verificaCpf && verificaSenha) {
                acessoAdm = true;
                url = "redirect:/interna-adm";
            } else {
                url = "redirect:/login-adm";
            }
            return url;
        } catch (Exception e) {
            return "redirect:/login-adm";
        }

    }
    @PostMapping("cadastro-docente")
    public String postCadastroDoc(Docente doc) {
       
        dr.save(doc);
        System.out.println("Cadastro Realizado com Sucesso");
        
        return "interna/interna-adm";
    }
    
    }
    


