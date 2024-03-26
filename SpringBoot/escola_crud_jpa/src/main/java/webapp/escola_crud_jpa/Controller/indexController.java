package webapp.escola_crud_jpa.Controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

import webapp.escola_crud_jpa.Repository.FuncionarioRepository;

@Controller
public class indexController {

    @Autowired
    FuncionarioRepository fr;

    @RequestMapping(value = "", method = RequestMethod.GET)
    public ModelAndView abrirIndex() {
        ModelAndView mv = new ModelAndView("index");
        String mensagem = "Olá Seja Bem Vinda(o) !";
        mv.addObject("msg", mensagem);
        return mv;


    }

    
}