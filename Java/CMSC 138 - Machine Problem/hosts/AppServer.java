package hosts;

import java.io.IOException;
import java.io.PrintStream;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import java.util.NoSuchElementException;
import java.util.Scanner;

import models.AppGUIModel;
import models.AppHostModel;

/**
 * @author Joseph Niel Tuazon
 * @author Riana King
 * @author Joshua Pabilona
 * */
public class AppServer extends Thread {

	private AppHostModel hostModel;
	private ServerSocket serverSocket;
	
	private ArrayList<Socket> clientSockets;
	
	public AppServer( AppHostModel hostModel ) {
		
		this.hostModel = hostModel;
		
		this.clientSockets = new ArrayList<Socket>();
		
		try {
			this.serverSocket = new ServerSocket( this.hostModel.getHostPort() );
		}
		catch(IOException e) {
			
			AppGUIModel.writeToGUI("\n[SERVER] Unable to set up port!");
			System.exit(1);
		}
	}
	
	public void run() {
		
		while( true ) {
			
			try {
				
				Socket serverSocketInstance = serverSocket.accept();
				clientSockets.add( serverSocketInstance );
				
				( new ClientHandler( hostModel, clientSockets, serverSocketInstance ) ).start();
			} 
			catch (IOException e) {
				e.printStackTrace();
			}
		}
	}
}


/**
 * @author Joseph Niel Tuazon
 * @author Riana King
 * @author Joshua Pabilona
 * */
class ClientHandler extends Thread {
	
	private AppHostModel hostModel;
	
	private Socket clientSocket;
	private Scanner scanner;
	private PrintWriter toClient;
	
	private ArrayList<Socket> clientSockets;
	
	private String clientHostName;
	
	protected ClientHandler( AppHostModel hostModel, 
			ArrayList<Socket> clientSockets, Socket serverSocketInstance ) throws IOException {
		
		this.hostModel = hostModel;
		this.clientSockets = clientSockets;
		
		this.clientSocket = serverSocketInstance;
		
		scanner = new Scanner( this.clientSocket.getInputStream() );
		toClient = new PrintWriter( this.clientSocket.getOutputStream(), true );
	}

	public void run() {
		
		int messageType;
		String message = "";
		do {
			ArrayList<String> clientRequest = new ArrayList<String>();
			try {
				clientRequest = hostModel.parseMessageInstance( scanner.nextLine() );
				
				messageType = Integer.parseInt( clientRequest.get( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE_TYPE ) );
				message = clientRequest.get( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE );
			}
			catch( NoSuchElementException e ) {
				
				messageType = AppHostModel.TYPE_END_CLIENT_PROCESS;
				message = clientHostName + " has abruptly";
			}
			
			switch( messageType ) {
			
				case AppHostModel.TYPE_GET_SERVER_HOSTNAMES:
					
					toClient.println( 
						hostModel.createMessageInstance( 
							AppHostModel.TYPE_SET_SERVER_HOSTNAMES, 
							hostModel.serializeHostNames() 
						) 
					);
					break;
					
				case AppHostModel.TYPE_SET_SERVER_HOSTNAMES:
					
					clientHostName = message;
					
					hostModel.addHostName( message );
					
					toClient.println( 
						hostModel.createMessageInstance( 
							AppHostModel.TYPE_SET_HOST_NAMES_SUCCESSFUL,
							""
						) 
					);
					break;
					
				case AppHostModel.TYPE_SEND_CHAT_MESSAGE:
					
					for( Socket otherClient : clientSockets ) {
						try {
							PrintStream writer = new PrintStream( otherClient.getOutputStream() );
							writer.println(
								hostModel.createMessageInstance( 
									AppHostModel.TYPE_GET_CHAT_MESSAGE,
									message
								) 
							);
						} 
						catch (IOException e) {
							e.printStackTrace();
						}
					}
					break;
				
				case AppHostModel.TYPE_END_CLIENT_PROCESS:
					
					hostModel.handleQuitMessage( message );
					
					for( Socket otherClient : clientSockets ) {
						try {
							PrintStream writer = new PrintStream( otherClient.getOutputStream() );
							writer.println(
								hostModel.createMessageInstance( 
									AppHostModel.TYPE_GET_CHAT_MESSAGE,
									message + " left the conference."
								) 
							);
						} 
						catch (IOException e) {
							e.printStackTrace();
						}
					}
					break;
					
				default: 
					break;
			}
		} 
		while( messageType != AppHostModel.TYPE_END_CLIENT_PROCESS );
	}
}
