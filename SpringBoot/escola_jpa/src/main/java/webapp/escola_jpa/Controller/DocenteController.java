
package webapp.escola_jpa.Controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

import webapp.escola_jpa.Model.Docente;
import webapp.escola_jpa.Repository.DocenteRepository;


@Controller
public class DocenteController {
   
    @Autowired
private DocenteRepository dr;

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
}
