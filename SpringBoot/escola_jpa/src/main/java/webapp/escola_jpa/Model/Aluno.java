package webapp.escola_jpa.Model;

import java.io.Serializable;
import java.util.HashSet;
import java.util.Set;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Entity;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.JoinTable;
import jakarta.persistence.ManyToMany;

@Entity
public class Aluno implements Serializable {

    @Id
    private String rg;

    private String nome;
    private String turma;
    private String senha;

    @ManyToMany(cascade = CascadeType.ALL)
    @JoinTable(name = "materia_aluno",
               joinColumns = @JoinColumn(name = "aluno_rg", referencedColumnName = "rg"),
               inverseJoinColumns = @JoinColumn(name = "materias_id", referencedColumnName = "id"))
    private Set<Materias> materias = new HashSet<>();
    
    public void adicionarMaterias(Materias materias) {
        this.materias.add(materias);
        materias.getAlunos().add(this);

      
    }

    public void setDisciplinas(Set<Materias> materias) {
        this.materias = materias;
    }

    public String getRg() {
        return rg;
    }
    public Set<Materias> getMaterias() {
        return materias;
    }
    public void setMaterias(Set<Materias> materias) {
        this.materias = materias;
    }
    public void setRg(String rg) {
        this.rg = rg;
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }
    public String getTurma() {
        return turma;
    }
    public void setTurma(String turma) {
        this.turma = turma;
    }
    public String getSenha() {
        return senha;
    }
    public void setSenha(String senha) {
        this.senha = senha;
    }
}
