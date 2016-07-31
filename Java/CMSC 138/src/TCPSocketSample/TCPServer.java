package TCPSocketSample;

import java.io.*;
import java.net.*;
import java.util.*;

public class TCPServer {
	private static ServerSocket welcomeSocket;
	private static Scanner inFromClient;

	public static void main(String[] args) throws Exception {
		try {
			welcomeSocket = new ServerSocket(6789);
			while(true) {
				Socket connectionSocket = welcomeSocket.accept();
				inFromClient = new Scanner(connectionSocket.getInputStream());
				PrintWriter outToClient = new PrintWriter(connectionSocket.getOutputStream(), true);
				String clientSentence = inFromClient.nextLine();
				String capitalizedSentence = clientSentence.toUpperCase() + '\n';
				System.out.println(connectionSocket.getRemoteSocketAddress() 
					+ " sends " + clientSentence);
				outToClient.println(capitalizedSentence);
			}
		}
		catch(SocketException sockEx) {
			System.out.println("Unable to attach to port");
			System.exit(1);
		}
		catch(IOException ioEx) {
			ioEx.printStackTrace();
		}
	}
}
