package webapp.escola_jpa.Repository;

import org.springframework.data.jpa.repository.support.CrudMethodMetadata;
import org.springframework.data.repository.CrudRepository;

import webapp.escola_jpa.Model.Lancamento;

import java.util.List;


public interface LancamentoRepository extends CrudRepository<Lancamento, Long> {
   
    Lancamento findById(long id_lancamento);


 
    
}
