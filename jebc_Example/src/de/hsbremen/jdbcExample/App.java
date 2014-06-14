package de.hsbremen.jdbcExample;

public class App {
	/**
	 * @param args
	 */
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		MySqlConnector dao = new MySqlConnector();
		try {
			dao.executeQuery("SELECT * FROM user");
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
