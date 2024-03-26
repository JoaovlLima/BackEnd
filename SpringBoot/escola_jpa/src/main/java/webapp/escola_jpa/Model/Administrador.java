package webapp.escola_jpa.Model;

import java.io.Serializable;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class Administrador implements Serializable { // implements normalmente é usado para que seja obrigatório o uso de todos os metodos da class,
                                                      // mas nesse caso o serializable não tem metodos, então é usado para transformala em binario
    //atributos
@Id
 private String cpf;
 
 private String nome;
 private String email;
 private String senha;
 


public String getCpf() {
    return cpf;
}
public void setCpf(String cpf) {
    this.cpf = cpf;
}
public String getNome() {
    return nome;
}
public void setNome(String nome) {
    this.nome = nome;
}
public String getEmail() {
    return email;
}
public void setEmail(String email) {
    this.email = email;
}
public String getSenha() {
    return senha;
}
public void setSenha(String senha) {
    this.senha = senha;
}


    
    
}
