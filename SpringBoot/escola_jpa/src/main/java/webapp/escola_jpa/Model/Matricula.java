package webapp.escola_jpa.Model;

import java.io.Serializable;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.OneToOne;

@Entity
public class Matricula implements Serializable{
    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
        private long id_matricula;

    @OneToOne
    @JoinColumn(name = "rg_aluno", referencedColumnName = "rg")
     private Aluno rgAluno ;

    public static long getSerialversionuid() {
        return serialVersionUID;
    }

    public long getId_matricula() {
        return id_matricula;
    }

    public void setId_matricula(long id_matricula) {
        this.id_matricula = id_matricula;
    }

    @ManyToOne
    @JoinColumn(name = "nome_materias" , referencedColumnName = "nome")
    private Materias materias;

    public Aluno getRgAluno() {
        return rgAluno;
    }

    public void setRgAluno(Aluno rgAluno) {
        this.rgAluno = rgAluno;
    }

    public Materias getMaterias() {
        return materias;
    }

    public void setMaterias(Materias materias) {
        this.materias = materias;
    }

}
