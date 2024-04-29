package webapp.escola_jpa.Repository;

import org.springframework.data.repository.CrudRepository;

import webapp.escola_jpa.Model.Turmas;
import java.util.List;


public interface TurmasRepository  extends CrudRepository<Turmas, Long>{
    
    Iterable<Turmas> findAll();
    
}
