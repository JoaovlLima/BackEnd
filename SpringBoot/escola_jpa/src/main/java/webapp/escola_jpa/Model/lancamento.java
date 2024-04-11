package webapp.escola_jpa.Model;

import java.io.Serializable;
import java.time.LocalDateTime;

import org.springframework.format.annotation.DateTimeFormat;

import com.fasterxml.jackson.annotation.JacksonInject.Value;


import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;

public class lancamento implements Serializable {
    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
        private long id_lancamento;
    @ManyToOne
    @JoinColumn(name = "materias")
    private Docente materia;

    public static long getSerialversionuid() {
        return serialVersionUID;
    }

    public long getId_lancamento() {
        return id_lancamento;
    }

    public void setId_lancamento(long id_lancamento) {
        this.id_lancamento = id_lancamento;
    }

    public Docente getMateria() {
        return materia;
    }

    public void setMateria(Docente materia) {
        this.materia = materia;
    }

    public Aluno getNomeAluno() {
        return nomeAluno;
    }

    public void setNomeAluno(Aluno nomeAluno) {
        this.nomeAluno = nomeAluno;
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

    @ManyToOne
    @JoinColumn(name = "nome")
    private Aluno nomeAluno;
    private double nota;
    
    @DateTimeFormat(pattern = "dd/MM/yyyy HH:mm")
    private LocalDateTime data;
    

}
