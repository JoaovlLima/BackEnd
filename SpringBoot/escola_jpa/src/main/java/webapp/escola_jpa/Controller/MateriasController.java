package webapp.escola_jpa.Controller;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.servlet.ModelAndView;

import java.util.List;

import webapp.escola_jpa.Model.Materias;
import webapp.escola_jpa.Repository.MateriasRepository;

@Controller
public class MateriasController {

    @Autowired
    private MateriasRepository mr;

   @RequestMapping(value = "/cad-docente", method = RequestMethod.GET)
public ModelAndView listarfuncionario() {
ModelAndView mv = new ModelAndView("interna/docente/cad-docente");
mv.addObject("materias", mr.findAll());
return mv;
}
    
    
}

