package service;
import javax.jws.WebParam;
import javax.jws.WebService;

import metier.User;
import service.UserManagement;
@WebService(serviceName = "UserAuthWS")
public class UserAuth {
	private UserManagement userManag =null;
	  public User Authentification(@WebParam(name = "email")String email,@WebParam(name = "Password") String password) {
	        try {
	            User user = userManag.getUser(email, password);
	            if (user.getPassword().equalsIgnoreCase(password)) {
//	            	if (user.getPassword().equalsIgnoreCase(Crypt.encrypt(password))) {
	                return user;
	            }
	            else
	                return null;
	        } catch (Exception e) {
	            System.out.println(e.getMessage());
	            return null;
	        }
	    }
}
