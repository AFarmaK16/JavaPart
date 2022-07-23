package serveur;


	import javax.xml.ws.Endpoint;

	import service.UserAuth;
	import service.UserManagement;



	public class UserServeur {
	    public static void main(String[] args) throws Exception {
	        String url1 = "http://localhost:8080/UserManagement?wsdl";
	        String url2 = "http://localhost:8080/UserAuth?wsdl";
	        Endpoint.publish(url1, new UserManagement());
	        Endpoint.publish(url2, new UserAuth());
			System.out.println("\nServer For User Management Up and Running at : " + url1);
			System.out.println("\nServer For User Auhtentication Up and Running at : " + url2);
	    }

}
