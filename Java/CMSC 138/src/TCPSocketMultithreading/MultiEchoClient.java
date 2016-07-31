package TCPSocketMultithreading;

import java.io.*;
import java.net.*;
import java.util.*;

public class MultiEchoClient {
	private static InetAddress host;
	private static final int PORT = 1234;
	private static Scanner networkInput;
	private static Scanner userEntry;
	
	public static void main(String[] args) {
		try {
			//host = InetAddress.getLocalHost();
			host = InetAddress.getByName("172.16.126.196");
		}
		catch(UnknownHostException e) {
			System.out.println("\nHost ID not found!\n");
			System.exit(1);
		}
		sendMessages();
	}
	
	private static void sendMessages() {
		Socket socket = null;
		
		try {
			socket = new Socket(host, PORT);
			
			networkInput = new Scanner(socket.getInputStream());
			PrintWriter networkOutput = new PrintWriter(socket.getOutputStream(), true);
			
			userEntry = new Scanner(System.in);
			
			String message, response;
			
			do {
				System.out.println("Enter message ('QUIT' to exit): ");
				message = userEntry.nextLine();
				
				// Send message to server on the 
				// socket's output stream ...
				
				// Accept response from server on the
				// socket's input stream...
				networkOutput.println(message);
				response = networkInput.nextLine();
				
				// Display server's response to user ...
				System.out.println("\nSERVER> " + response);
			}while(!message.equals("QUIT"));
		}
		catch(IOException ioe) {
			ioe.printStackTrace();
		}
		finally {
			try {
				System.out.println("\nClosing connection...");
				socket.close();
			}
			catch(IOException ioe) {
				System.out.println("Unable to disconnect!");
				System.exit(1);
			}
		}
	}
}
