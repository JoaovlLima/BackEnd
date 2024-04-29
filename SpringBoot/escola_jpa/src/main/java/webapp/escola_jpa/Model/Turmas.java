package webapp.escola_jpa.Model;

import java.util.HashSet;
import java.util.Set;

import javax.print.Doc;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.ManyToMany;

@Entity
public class Turmas {
    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private long id_turmas;
    
    private String nome;
    private int quantidade_aluno;

     @ManyToMany(mappedBy = "turmas", cascade = CascadeType.ALL)
    private Set<Docente> docentes = new HashSet<>();

    public void adicionarAluno(Docente docente) {
        this.docentes.add(docente);
        docente.getTurmas().add(this);
    }


    public static long getSerialversionuid() {
        return serialVersionUID;
    }
    public Set<Docente> getDocentes() {
        return docentes;
    }
    public long getId_turmas() {
        return id_turmas;
    }
    public void setId_turmas(long id_turmas) {
        this.id_turmas = id_turmas;
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }
    public int getQuantidade_aluno() {
        return quantidade_aluno;
    }
    public void setQuantidade_aluno(int quantidade_aluno) {
        this.quantidade_aluno = quantidade_aluno;
    }
   
    

}
