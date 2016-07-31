package TCPSocketExercise;

import java.io.*;
import java.net.*;
import java.util.*;

public class EmailClient {
	
	private static InetAddress host;
	private static final int PORT = 1234;
	private static String name;
	private static Scanner networkInput, userEntry;
	private static PrintWriter networkOutput;
	private static Socket clientSocket;
	
	public static void main(String[] args) throws IOException {		
		try {
			host = InetAddress.getLocalHost();
		}
		catch(UnknownHostException uhEx) {
			System.out.println("Host ID not found!");
			System.exit(1);
		}
		
		userEntry = new Scanner(System.in);
		do {
			System.out.print("\nEnter name ('Dave' or 'Karen'): ");
			name = userEntry.nextLine();
		}while(!name.equals("Dave") && !name.equals("Karen"));
		
		talkToServer();
	}
	
	private static void talkToServer() throws IOException 
	{
		String 	option = new String();
		
		do {
			/*
			 * CREATE A SOCKET, SET UP INPUT AND OUT STREAMS,
			 * ACCEPT THE USER'S REQUEST, CALL UP THE APPROPRIATE 
			 * METHOD (doSend or doRead), CLOSE THE LINK AND THEN
			 * ASK IF USER WANTS TO DO ANOTHER READ/SEND.
			 */
			
			System.out.println("\nLegend:");
			System.out.println("S = send message.");
			System.out.println("R = read message/s.");
			System.out.println("N = quit");
			System.out.print("Choice: ");
			
			// initialize the user entry 
			userEntry = new Scanner(System.in);
			option = userEntry.nextLine();
			
			// initialize the connection
			clientSocket = new Socket(host, PORT);
			
			// initialize the networkInput variable
			networkInput = new Scanner(clientSocket.getInputStream());
			
			// initialize the networkOutput variable
			networkOutput = new PrintWriter(clientSocket.getOutputStream(), true);
			
			if(option.equalsIgnoreCase("S")) { // send message 
				
				// use the provided function
				doSend();
			}
			else if(option.equalsIgnoreCase("R")) { // read message/s
				
				// use the provided function
				doRead();
			}
			else { // quit from program
				
				// created a similar function for uniformity
				doQuit();
			}
			
			// close the connection
			clientSocket.close();
			
		}while(!option.equalsIgnoreCase("N"));
	
	}
	
	private static void doSend() {
		System.out.println("\nEnter 1-line message: ");
		String message = userEntry.nextLine();
		
		networkOutput.println( name );
		networkOutput.println( "send" );
		networkOutput.println( message );
	}
	
	private static void doRead() throws IOException {

		networkOutput.println( name );
		networkOutput.println( "read" );
		
		// loop the message
		System.out.println("\nNew Message/s: " + networkInput.nextLine() + "\n");
		
		int i = 1;
		while(networkInput.hasNext()){
			System.out.println("Message " + i + ": " + networkInput.nextLine());
			i++;
		}
	}
	
	private static void doQuit() {
		
		networkOutput.println( name );
		networkOutput.println( "quit" );
	}

}
