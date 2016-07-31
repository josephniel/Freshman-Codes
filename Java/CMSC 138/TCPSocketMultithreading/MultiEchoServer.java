package TCPSocketMultithreading;

import java.io.*;
import java.net.*;
import java.util.*;

public class MultiEchoServer {
	
	private static ServerSocket serverSocket;
	private static final int PORT = 1234;
	
	public static void main(String[] args) throws IOException {
		try {
			serverSocket = new ServerSocket(PORT);
		}
		catch(IOException e) {
			System.out.println("\nUnable to set up port!");
			System.exit(1);
		}
		
		do {
			// Wait for client...
			Socket client = serverSocket.accept();
			
			System.out.println(client + " connected");
			
			// Create a thread to handle communication with
			// this client and pass the constructor for this
			// thread a reference to the relevant socket...
			ClientHandler handler = new ClientHandler(client);
			
			handler.start();	
		}while(true);		
	}
}

class ClientHandler extends Thread {
	private Socket client;
	private Scanner input;
	private PrintWriter output;
	
	public ClientHandler(Socket socket) {
		// Set up reference to associated socket...
		client = socket;
		
		try {
			input = new Scanner(client.getInputStream());
			output = new PrintWriter(client.getOutputStream(), true);
		}
		catch(IOException e) {
			e.printStackTrace();
		}
	}
	
	public void run() {
		String received;
		
		do {
			// Accept message from client on
			// the socket's input stream ...
			received = input.nextLine();
		
			// Echo message back to client on
			// the socket's output stream ...
			output.println("ECHO: " + received);
			
			// Display what the client sent
			System.out.println(client.getRemoteSocketAddress() + ": "
					+ received); 
			
			// Repeat above until 'QUIT" sent by client...
		}while(!received.equals("QUIT"));
		
		try {
			if (client != null) {
				System.out.println(client.getRemoteSocketAddress() + " disconnected");
				client.close();
			}
		}
		catch(IOException e) {
			System.out.println("Unable to disconnect!");
		}
	}
}
