package webapp.escola_jpa.Repository;

import org.springframework.data.repository.CrudRepository;

import webapp.escola_jpa.Model.Materias;
import java.util.List;




public interface MateriasRepository extends CrudRepository<Materias, Long> {
    
   Iterable<Materias> findAll();



   
}


    

