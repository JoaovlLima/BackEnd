package webapp.escola_jpa.Controller;

import java.time.LocalDateTime;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.ModelAndView;

import webapp.escola_jpa.Model.Aluno;
import webapp.escola_jpa.Model.Docente;
import webapp.escola_jpa.Model.Lancamento;
import webapp.escola_jpa.Repository.AlunoRepository;
import webapp.escola_jpa.Repository.DocenteRepository;
import webapp.escola_jpa.Repository.LancamentoRepository;

@Controller
public class LancamentoController {
    
    @Autowired
    private AlunoRepository ar;

    @Autowired 
    private DocenteRepository dr;

    @Autowired
    private LancamentoRepository lr;

    @RequestMapping(value = "/lancamento/{rg}", method = RequestMethod.GET)
    public ModelAndView editarAluno(@PathVariable("rg") String rg) {
        ModelAndView mv = new ModelAndView("areaProf/lancamento");
        mv.addObject("aluno", ar.findByRg(rg));
        return mv;
    }

    @PostMapping("lancamento-notas")
    public String postLancamentoNotas(Lancamento lan) {

       lan.setData(LocalDateTime.now());
       

        lr.save(lan);
        System.out.println("Notas Lançadas com sucesso");
        
        return "/lancar-notas";
    }



}
