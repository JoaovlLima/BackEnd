package webapp.newsletterjdbc.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.ModelAndView;

import com.fasterxml.jackson.annotation.JsonCreator.Mode;

import webapp.newsletterjdbc.connection.IndexDAO;

@Controller
public class CadastroController {
   @RequestMapping(value = "/cadastro", method = RequestMethod.GET)
    public ModelAndView abrirCadastro() {
        ModelAndView mv = new ModelAndView("cadastro");
    

        new IndexDAO().criaTabela();
        String mensagem = "Olá, seja bem-vinda(o)!";
        mv.addObject("msg", mensagem);

        return mv;
    }
    
    @RequestMapping(value = "/", method=RequestMethod.POST)
    public ModelAndView enviarEmailBanco(@RequestParam("email") String email) {
        ModelAndView mv = new ModelAndView("index");
        new IndexDAO().cadastrar(email);
        return mv;
    }
    
    
    

}
