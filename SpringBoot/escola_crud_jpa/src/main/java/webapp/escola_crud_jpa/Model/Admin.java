package webapp.escola_crud_jpa.Model;

import java.io.Serializable;

import jakarta.persistence.*;

@Entity
public class Admin implements Serializable{
    private static final long serialVersionUID = 1L;
@Id
@GeneratedValue(strategy = GenerationType.AUTO)
String cpf;
String senha;
String email;

public static long getSerialversionuid() {
    return serialVersionUID;
}
public String getCpf() {
    return cpf;
}
public void setCpf(String cpf) {
    this.cpf = cpf;
}
public String getSenha() {
    return senha;
}
public void setSenha(String senha) {
    this.senha = senha;
}
public String getEmail() {
    return email;
}
public void setEmail(String email) {
    this.email = email;
}



}

