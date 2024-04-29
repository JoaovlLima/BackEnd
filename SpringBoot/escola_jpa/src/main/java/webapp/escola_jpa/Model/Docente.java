package webapp.escola_jpa.Model;

import java.io.Serializable;
import java.util.HashSet;
import java.util.Set;

import jakarta.persistence.Entity;
import jakarta.persistence.FetchType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.JoinTable;
import jakarta.persistence.ManyToMany;
import jakarta.persistence.ManyToOne;

@Entity
public class Docente implements Serializable {

    @Id
    private String cpf;

    private String nome;

    @ManyToOne
    @JoinColumn(name = "id_materias", referencedColumnName = "id")
    private Materias materias;
    private String materia;
    private String senha;

    @ManyToMany(fetch = FetchType.EAGER)
    @JoinTable(name = "turma_docente",
               joinColumns = @JoinColumn(name = "docente_cpf", referencedColumnName = "cpf"),
               inverseJoinColumns = @JoinColumn(name = "turmas_id", referencedColumnName = "id_turmas"))
    private Set<Turmas> turmas = new HashSet<>();

    public Set<Turmas> getTurmas() {
        return turmas;
    }


    public void setTurmas(Set<Turmas> turmas) {
        this.turmas = turmas;
    }


    public void adicionarTurma(Turmas turmas) {
        this.turmas.add(turmas);
        turmas.getDocentes().add(this);

      
    }


    public String getCpf() {
        return cpf;
    }

    public void setCpf(String cpf) {
        this.cpf = cpf;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getMateria() {
        return materia;
    }

    public void setMateria(String materia) {
        this.materia = materia;
    }

    public String getSenha() {
        return senha;
    }

    public void setSenha(String senha) {
        this.senha = senha;
    }

}
