package dao;

import exceptions.WebServiceException;
import service.UserAuth;
import service.Authentification;
import service.AuthentificationResponse;
//import service.UserAuthWS;
import stub.Stub;

public class UserLogin {
    private static Stub stubManagement = Stub.getStubInstance();
    private static UserAuth stub;
    private static UserLogin instance = new UserLogin();

    private UserLogin() {
        try {
            stub = stubManagement.getAuthStubInstance();
        } catch (ExceptionInInitializerError e) {
            System.out.println("WebService d'Authentication indisponible ! :" + e.getMessage());
        }
    }

    public static UserLogin getUserLoginInstance() throws WebServiceException {
        if (stub != null) {
            return instance;
        } else {
            throw new WebServiceException("WebService d'Authentication indisponible !!");
        }
    }
    
    public AuthentificationResponse login(Authentification request) {
    	AuthentificationResponse response = new AuthentificationResponse();
        response.setReturn(stub.authentification(request.getEmail(), request.getPassword()));
        return response;
    }
}
