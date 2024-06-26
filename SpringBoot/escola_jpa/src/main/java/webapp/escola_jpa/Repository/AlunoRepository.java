package webapp.escola_jpa.Repository;

import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

import jakarta.persistence.Entity;
import webapp.escola_jpa.Model.Aluno;
import webapp.escola_jpa.Model.Docente;

import java.util.List;
import java.util.Optional;

public interface AlunoRepository extends CrudRepository<Aluno, String>  { // interface te permite a ter metodos vazios 
    
    Aluno findByRg(String rg);

    
  
}