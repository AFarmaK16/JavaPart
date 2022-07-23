package stub;

import javax.xml.ws.WebServiceException;

import service.UserAuth;
import service.UserAuthWS;
import service.UserManagement;
import service.UserManagementWS;

public class Stub {
    private UserManagement mgtStub = null;
    private UserAuth authStub = null;
    private static Stub stub = new Stub();

    private Stub() {
        try {
            this.mgtStub = new UserManagementWS().getUserManagementPort();
            this.authStub = new UserAuthWS().getUserAuthPort();
        } catch (WebServiceException e) {
            System.out.println("Web Services Unavailbale !" + e.getMessage());
        }
    }

    public static Stub getStubInstance() {
        return stub;
    }
    
    public UserManagement getMgtStubInstance() {
        return mgtStub;
    }

    public UserAuth getAuthStubInstance() {
        return authStub;
    }
}
