package webapp.escola_jpa.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.ModelAndView;

import webapp.escola_jpa.Repository.AlunoRepository;

@Controller
public class LancamentoController {
    
    @Autowired
    private AlunoRepository ar;

    @RequestMapping(value = "/lancamento/{rg}", method = RequestMethod.GET)
    public ModelAndView editarAluno(@PathVariable("rg") String rg) {
        ModelAndView mv = new ModelAndView("areaProf/lancamento");
        mv.addObject("aluno", ar.findByRg(rg));
        return mv;
    }

}
