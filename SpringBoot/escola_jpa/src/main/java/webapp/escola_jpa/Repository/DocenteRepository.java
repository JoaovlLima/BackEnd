package webapp.escola_jpa.Repository;

import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;

import jakarta.persistence.Entity;
import webapp.escola_jpa.Model.Docente;
import java.util.List;

    public interface DocenteRepository extends CrudRepository<Docente, String>  { // interface te permite a ter metodos vazios 
        
        Docente findByCpf(String cpf);

        Docente findByMateria(String materia);
        
    
    }
    

