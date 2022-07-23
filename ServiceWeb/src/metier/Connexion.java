package metier;
import java.sql.*;

public class Connexion {
	
	public static 	Connection getCon() {
		Connection myCon=null;
		 try {
	            myCon= DriverManager.getConnection("jdbc:mysql://localhost:3308/mglsi_news","root","");
//	            System.out.println("ok");
	        } catch (Exception e) {
//	            System.out.println("err");
	            e.printStackTrace();
	        }
		 return myCon;
	}
}
