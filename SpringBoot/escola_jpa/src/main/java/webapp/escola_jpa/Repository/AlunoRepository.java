package webapp.escola_jpa.Repository;

import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

import jakarta.persistence.Entity;
import webapp.escola_jpa.Model.Aluno;
import java.util.List;

public interface AlunoRepository extends CrudRepository<Aluno, String>  { // interface te permite a ter metodos vazios 
    
    Aluno findByRg(String rg);

 
    
  
}