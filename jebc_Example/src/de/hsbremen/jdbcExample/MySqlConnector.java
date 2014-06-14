package de.hsbremen.jdbcExample;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class MySqlConnector {
	private Connection connect = null;
	private Statement statement = null;
	private ResultSet resultSet = null;

	private void connectDataBase() throws Exception {
		Class.forName("com.mysql.jdbc.Driver");
		connect = DriverManager.getConnection("jdbc:mysql://localhost/dbweb?"
				+ "user=root");
		statement = connect.createStatement();
	}

	public void executeQuery(String query) throws Exception {
		this.connectDataBase();
		resultSet = statement.executeQuery(query);
		this.writeResultSet(resultSet);
		resultSet.close();
		statement.close();
		connect.close();
	}

	private void writeResultSet(ResultSet resultSet) throws SQLException {
		while (resultSet.next()) {
			int id = resultSet.getInt("id");
			String username = resultSet.getString("username");
			String firstname = resultSet.getString("firstname");
			String lastname = resultSet.getString("lastname");
			String mail = resultSet.getString("mail");
			String password = resultSet.getString("password");
			System.out.println("ID: " + id);
			System.out.println("User: " + username);
			System.out.println("Firstname: " + firstname);
			System.out.println("Lastname: " + lastname);
			System.out.println("Mail: " + mail);
			System.out.println("Password: " + password);
		}
	}
}