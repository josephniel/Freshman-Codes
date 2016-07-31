package TCPSocketSample;

import java.io.*;
import java.net.*;
import java.util.*;

public class TCPClient {
	private static Scanner inFromUser;
	private static Scanner inFromServer;

	public static void main(String[] args) throws Exception {		
		inFromUser = new Scanner(System.in);
		
		while( true ) {
			Socket clientSocket = new Socket("127.0.0.1", 6789);
			PrintWriter outToServer = new PrintWriter(clientSocket.getOutputStream(), true);
			inFromServer = new Scanner(clientSocket.getInputStream());
			String sentence = inFromUser.nextLine();
			outToServer.println(sentence + '\n');
			String modifiedSentence = inFromServer.nextLine();
			System.out.println("FROM SERVER: " + modifiedSentence);
			clientSocket.close();
		}
	}
}
