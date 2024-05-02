
package webapp.escola_jpa.Controller;

import java.util.Collections;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import com.fasterxml.jackson.annotation.JsonCreator.Mode;

import ch.qos.logback.core.model.Model;
import jakarta.servlet.http.HttpSession;
import webapp.escola_jpa.Model.Aluno;
import webapp.escola_jpa.Model.Docente;
import webapp.escola_jpa.Repository.AlunoRepository;
import webapp.escola_jpa.Repository.DocenteRepository;


@Controller
public class DocenteController {
   
    @Autowired
private DocenteRepository dr;
@Autowired
private AlunoRepository ar;
boolean acessoDocente = false;

@Autowired
private HttpSession httpSession;


@PostMapping("acesso-docente")
public String acessoDocente(HttpSession session,@RequestParam String cpf, @RequestParam String senha) {
    try {
        boolean verificaCpf = dr.existsById(cpf);
        boolean verificaSenha = dr.findByCpf(cpf).getSenha().equals(senha);

        if (verificaCpf && verificaSenha) {
           // Recuperando as informações do docente
           Docente docente = dr.findByCpf(cpf);

           //limpando a Session antes de logar
           session.invalidate();
           // Armazenando as informações do docente na sessão

           httpSession.setAttribute("docente", docente);
           // Definindo loggedIn como true na sessão
           httpSession.setAttribute("prof", true);
            return "redirect:/home";
        } else {
            return "redirect:/login-docente";
        }
    } catch (Exception e) {
        return "redirect:/login-docente";
    }
}

//     @GetMapping("/a")
// public ModelAndView homeHeader(Model model,RedirectAttributes attributes) {
//     ModelAndView modelAndView = new ModelAndView("/home");
   
//     if (acessoDocente) {
//         attributes.addFlashAttribute("msg", "~{fragmentos/header_docente :: header}");
//     } else {
//         attributes.addFlashAttribute("msg", "~{fragmentos/header :: header}");
//     }

//     return modelAndView;
// }
 
@GetMapping("/list-docente")
    public ModelAndView listarDocentes() {
        ModelAndView mv = new ModelAndView("interna/docente/list-docente");
        mv.addObject("docentes", dr.findAll());
        return mv;
    }

    @RequestMapping(value = "/deletar-docente/{cpf}", method = RequestMethod.GET)
    public String deletarDocente(@PathVariable("cpf") String cpf) {
        dr.delete(dr.findByCpf(cpf));
        return "redirect:/list-docente";
    }

    @RequestMapping(value = "/edit-docente/{cpf}", method = RequestMethod.GET)
    public ModelAndView editarDocente(@PathVariable("cpf") String cpf) {
        ModelAndView mv = new ModelAndView("interna/docente/edit-docente");
        mv.addObject("docente", dr.findByCpf(cpf));
        return mv;
    }

    @RequestMapping(value = "/edit-docente/{cpf}", method = RequestMethod.POST)
    public String atualizarDocente(Docente docente) {
        dr.save(docente);
        return "redirect:/list-docente";
    }

    @GetMapping("/lancar-notas")
public ModelAndView lancarNotas(HttpSession session) {
    ModelAndView modelAndView = new ModelAndView("areaProf/lancar-notas");
    Docente docente = (Docente) session.getAttribute("docente");
    if (docente != null) {
        modelAndView.addObject("docente", docente);
        
        // Recuperar apenas o docente com base no CPF armazenado na sessão
        Docente docenteFromDb = dr.findByCpf(docente.getCpf());
        
        if (docenteFromDb != null) {
            modelAndView.addObject("docentes", Collections.singletonList(docenteFromDb));
            
            // Recuperar todos os alunos
            modelAndView.addObject("alunos", ar.findAll());
        } else {
            // Caso não encontre o docente com base no CPF, redireciona para a página de login
            modelAndView.setViewName("redirect:/login-docente");
        }
    } else {
        // Redirecionar para a página de login se o professor não estiver logado
        modelAndView.setViewName("redirect:/login-docente");
    }
    return modelAndView;
}

    
@GetMapping("/logout")
public String logout(HttpSession session) {
    // Limpa todos os atributos da sessão
    session.invalidate();
    // Redireciona o usuário para a página de login
    return "redirect:/home";
}

}
