package webapp.escola_jpa.Controller;

import java.util.Set;

import org.hibernate.annotations.processing.Find;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.ModelAndView;

import webapp.escola_jpa.Model.Aluno;
import webapp.escola_jpa.Model.Materias;
import webapp.escola_jpa.Repository.AlunoRepository;
import webapp.escola_jpa.Repository.MateriasRepository;

@Controller
public class AlunoController {
    
@Autowired
private AlunoRepository ar;
  @Autowired
    private MateriasRepository mr;

    @GetMapping("/list-aluno")
    public ModelAndView listarDocentes() {
        ModelAndView mv = new ModelAndView("interna/aluno/list-aluno");
        mv.addObject("alunos", ar.findAll());
        return mv;
    }
    @GetMapping("/aluno-filtrado")
    public ModelAndView filtroAluno() {
        ModelAndView mv = new ModelAndView("fragmentos/aluno-filtrado");
        mv.addObject("alunos", ar.findAll());
        return mv;
    }

    @RequestMapping(value = "/deletar-aluno/{rg}", method = RequestMethod.GET)
    public String deletarAluno(@PathVariable("rg") String rg) {
        // Buscar o aluno pelo RG
        Aluno aluno = ar.findByRg(rg);
    
        // Verificar se o aluno foi encontrado
        if (aluno != null) {
            // Remover o aluno
            ar.delete(aluno);
        }
    
        return "redirect:/list-aluno";
    }
   
    

    @RequestMapping(value = "/edit-aluno/{rg}", method = RequestMethod.GET)
    public ModelAndView editarAluno(@PathVariable("rg") String rg) {
        ModelAndView mv = new ModelAndView("interna/aluno/edit-aluno");
        mv.addObject("aluno", ar.findByRg(rg));
        return mv;
    }

    @RequestMapping(value = "/edit-aluno/{rg}", method = RequestMethod.POST)
    public String atualizarAluno(Aluno aluno) {
        ar.save(aluno);
        return "redirect:/list-aluno";
    }
}
