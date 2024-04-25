package webapp.escola_jpa.Model;

import java.io.Serializable;
import java.time.LocalDateTime;

import org.springframework.format.annotation.DateTimeFormat;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Lancamento implements Serializable {
    private static final long serialVersionUID = 1L;

    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private long id_lancamento;

    private String alunoNome; // Nome do aluno
    private String materiaNome; // Nome da matéria
    private double nota;

    @DateTimeFormat(pattern = "dd/MM/yyyy")
    private LocalDateTime data;

    // Getters e setters

    public long getId() {
        return id_lancamento; 
    }

    public void setId(long id_lancamento) {
        this.id_lancamento = id_lancamento;
    }

    public String getAlunoNome() {
        return alunoNome;
    }

    public void setAlunoNome(String alunoNome) {
        this.alunoNome = alunoNome;
    }

    public String getMateriaNome() {
        return materiaNome;
    }

    public void setMateriaNome(String materiaNome) {
        this.materiaNome = materiaNome;
    }

    public double getNota() {
        return nota;
    }

    public void setNota(double nota) {
        this.nota = nota;
    }

    public LocalDateTime getData() {
        return data;
    }

    public void setData(LocalDateTime data) {
        this.data = data;
    }
}
