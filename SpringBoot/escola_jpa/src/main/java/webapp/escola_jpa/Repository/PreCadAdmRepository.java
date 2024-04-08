package webapp.escola_jpa.Repository;

import org.springframework.data.jpa.repository.support.CrudMethodMetadata;
import org.springframework.data.repository.CrudRepository;

import webapp.escola_jpa.Model.PreCadAdm;
import java.util.List;


public interface PreCadAdmRepository extends CrudRepository<PreCadAdm, String> {
   
    PreCadAdm findByCpf(String cpf);
}
