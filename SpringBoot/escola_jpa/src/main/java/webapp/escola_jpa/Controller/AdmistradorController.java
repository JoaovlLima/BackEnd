package webapp.escola_jpa.Controller;

import java.util.HashSet;
import java.util.List;
import java.util.Optional;
import java.util.Set;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestParam;

import webapp.escola_jpa.Model.Administrador;
import webapp.escola_jpa.Model.Aluno;
import webapp.escola_jpa.Model.Docente;
import webapp.escola_jpa.Model.Materias;
import webapp.escola_jpa.Model.PreCadAdm;
import webapp.escola_jpa.Model.Turmas;
import webapp.escola_jpa.Repository.AdministradorRepository;
import webapp.escola_jpa.Repository.AlunoRepository;
import webapp.escola_jpa.Repository.DocenteRepository;
import webapp.escola_jpa.Repository.MateriasRepository;
import webapp.escola_jpa.Repository.PreCadAdmRepository;
import webapp.escola_jpa.Repository.TurmasRepository;


@Controller
public class AdmistradorController {

    @Autowired
    private AdministradorRepository ar;
    @Autowired
    private DocenteRepository dr;
    @Autowired
    private PreCadAdmRepository pcar;
    @Autowired
    private AlunoRepository alr;
    @Autowired
    private MateriasRepository mr;
    @Autowired
    private TurmasRepository tr;

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
    // @PostMapping("cadastro-docente")
    // public String postCadastroDoc(Docente doc) {
       
    //     dr.save(doc);
    //     System.out.println("Cadastro Realizado com Sucesso");
        
    //     return "interna/interna-adm";
    // }
    // @PostMapping("cadastro-aluno")
    // public String postCadastroAluno(@RequestParam Aluno aluno) {
       
    //     alr.save(aluno);
    //     System.out.println("Cadastro Realizado com Sucesso");
        
    //     return "interna/interna-adm";
    // }
    @PostMapping("/cadastro-docente")
public String postCadastroDocente(@RequestParam("turma_docente[]") List<String> turma_docente,
                                  @RequestParam String cpf,
                                  @RequestParam String nome,
                                  @RequestParam String materia,
                                  @RequestParam String senha,
                                  Model model) {
    // Verifica se algum campo obrigatório está vazio
    if (nome == null || nome.isEmpty() ||
            cpf == null || cpf.isEmpty() ||
            materia == null || materia.isEmpty() ||
            senha == null || senha.isEmpty()) {
        model.addAttribute("mensagem", "Por favor, preencha todos os campos.");
        return "interna/interna-adm";
    }

    // Verifica se o docente já existe no banco de dados
    Optional<Docente> docenteOptional = dr.findById(cpf);
    Docente docente = docenteOptional.orElseGet(() -> new Docente()); // Se não existir, cria um novo docente

    // Preenche os detalhes do docente
    docente.setNome(nome);
    docente.setCpf(cpf);
    docente.setMateria(materia);
    docente.setSenha(senha);

    // Atualiza as turmas selecionadas para o docente
    Set<Turmas> turmasSelecionadas = new HashSet<>();
    for (String turmaId : turma_docente) {
        Optional<Turmas> turmasOptional = tr.findById(Long.parseLong(turmaId));
        turmasOptional.ifPresent(turmasSelecionadas::add);
    }
    docente.setTurmas(turmasSelecionadas);

    // Salva o docente no banco de dados
    dr.save(docente);
    model.addAttribute("mensagem", "Cadastro de docente realizado com sucesso!");
    return "interna/interna-adm";
}

    @PostMapping("/cadastro-aluno")
public String postCadastroAluno(@RequestParam("materia_aluno[]") List<String> materia_aluno,
        @RequestParam String rg,
        @RequestParam String nome,
        @RequestParam String senha,
        @RequestParam String turma,
        Model model) {
    // Verifica se algum campo obrigatório está vazio
    if (nome == null || nome.isEmpty() ||
            rg == null || rg.isEmpty() ||
            materia_aluno == null || materia_aluno.isEmpty() ||
            senha == null || senha.isEmpty()) {
        model.addAttribute("mensagem", "Por favor, preencha todos os campos.");
        return "interna/interna-adm";
    }

    // Verifica se o aluno já existe no banco de dados
    Optional<Aluno> alunoOptional = alr.findById(rg);
    Aluno aluno = alunoOptional.orElseGet(() -> new Aluno()); // Se não existir, cria um novo aluno

    // Preenche os detalhes do aluno
    aluno.setNome(nome);
    aluno.setRg(rg);
    aluno.setSenha(senha);
    aluno.setTurma(turma);
    // Atualiza as disciplinas selecionadas para o aluno
    Set<Materias> materiasSelecionadas = new HashSet<>();
    for (String materia_alunoId : materia_aluno) {
        Optional<Materias> materiasOptional = mr.findById(Long.parseLong(materia_alunoId));
        materiasOptional.ifPresent(materiasSelecionadas::add);
    }
    aluno.setMaterias(materiasSelecionadas);

    // Salva o aluno no banco de dados
    alr.save(aluno);
    model.addAttribute("mensagem", "Cadastro de aluno realizado com sucesso!");
    return "interna/interna-adm";
}


   
    
    }
    


