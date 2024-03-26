package webapp.escola_jpa.Repository;

import org.springframework.data.repository.CrudRepository;

import jakarta.persistence.Entity;
import webapp.escola_jpa.Model.Administrador;
import java.util.List;



public interface AdministradorRepository extends CrudRepository<Administrador, String>  { // interface te permite a ter metodos vazios 
    
    Administrador findByCpf(String cpf);
}
