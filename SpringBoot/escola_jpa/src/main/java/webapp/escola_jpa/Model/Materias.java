package webapp.escola_jpa.Model;

import java.util.HashSet;
import java.util.Set;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.ManyToMany;

@Entity
public class Materias {
    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
        private long id;

    private String nome;

    private String descricao;
    private String duracao;

    @ManyToMany(mappedBy = "materias", cascade = CascadeType.ALL)
    private Set<Aluno> alunos = new HashSet<>();

    public void adicionarAluno(Aluno aluno) {
        this.alunos.add(aluno);
        aluno.getMaterias().add(this);
    }

    public static long getSerialversionuid() {
        return serialVersionUID;
    }
    public Set<Aluno> getAlunos() {
        return alunos;
    }
    public void setAlunos(Set<Aluno> alunos) {
        this.alunos = alunos;
    }
    public long getId() {
        return id;
    }
    public void setId(long id) {
        this.id = id;
    }
    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }
    public String getDescricao() {
        return descricao;
    }
    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }
    public String getDuracao() {
        return duracao;
    }
    public void setDuracao(String duracao) {
        this.duracao = duracao;
    }
    
}
