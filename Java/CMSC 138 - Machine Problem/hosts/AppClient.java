package hosts;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.PrintWriter;
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
public class AppClient extends Thread {
	
	/** Host Model instance */
	private AppHostModel hostModel;
	
	/** Socket instance */
	private Socket clientSocket;
	/** client socket input reader helper */
	private Scanner scanner;
	/** client socket output writer helper */
	private PrintWriter toServer;
	
	/**
	 * Class constructor. Initialises the local copy of the
	 * AppHostModel hostModel; the socket connection of the
	 * current client host; and the local reader and writer 
	 * functions for the local class AppClient. In here is 
	 * the host name list retrieved from the server.
	 * */
	public AppClient( AppHostModel hostModel ) {
		
		this.hostModel = hostModel;
		
		try {
			clientSocket = new Socket( this.hostModel.getHostIP(), this.hostModel.getHostPort() );
			scanner = new Scanner( this.clientSocket.getInputStream() );
			toServer = new PrintWriter( this.clientSocket.getOutputStream(), true );
		} 
		catch (IOException e) {
			e.printStackTrace();
		}
		
		this.getHostNames();
	}
	
	/**
	 * This function retrieves a list of connected hosts
	 * identified by their host names. This is only called 
	 * in the initialisation phase where it is necessary to check 
	 * currently available host names in the server prior to
	 * the entering of the current host.
	 * */
	private void getHostNames() {
		
		// Retrieve the host names from the server
			toServer.println( 
				hostModel.createMessageInstance( 
					AppHostModel.TYPE_GET_SERVER_HOSTNAMES, 
					"" 
				) 
			);
						
		// Parse the message sent from the server
			ArrayList<String> serverResponse = 
				hostModel.parseMessageInstance( scanner.nextLine() );
						
		// Update host name list
			hostModel.deserializeHostNames( 
					serverResponse.get( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE ) 
					);
	}
	
	/**
	 * This function sends the host name of the current host to the server. 
	 * Sending of host name to server is necessary for the server to 
	 * add the current client in the list.
	 * 
	 * @return Message Instance Message Type
	 * */
	private int sendUpdateHostName() {
		
		// Send back to the server the current host name
			toServer.println( 
				hostModel.createMessageInstance( 
					AppHostModel.TYPE_SET_SERVER_HOSTNAMES, 
					hostModel.getHostName()
				) 
			);
									
		// Retrieve server response
			ArrayList<String> serverResponse = 
					hostModel.parseMessageInstance( this.scanner.nextLine() );
							
		return Integer.parseInt( 
				serverResponse.get( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE_TYPE ) 
				);
	}
	
	/**
	 * Synchronised function; starts whenever the start() function of the
	 * AppClient class is instantiated. Sends a new nickname for the current
	 * client host and initialises the reader and writer for the current host.
	 * */
	public void run() {
				
		int messageType = sendUpdateHostName();
			
		if( messageType == AppHostModel.TYPE_SET_HOST_NAMES_SUCCESSFUL ) {
			
			try {
				( new ReadHandler( hostModel, clientSocket ) ).start();
				( new WriteHandler( hostModel, clientSocket ) ).start();
			} 
			catch (IOException e) {
				e.printStackTrace();
			}
		}
	}
}

class ReadHandler extends Thread {
	
	/** Host Model instance */
	private AppHostModel hostModel;
	
	/** Socket instance */
	private Socket clientSocket;
	/** client socket input reader helper */
	private Scanner scanner;
	
	/**
	 * Class constructor. Initialises the host model; the client socket;
	 * and the reader class helper.
	 * */
	protected ReadHandler( AppHostModel hostModel, Socket clientSocket ) throws IOException {
		this.hostModel = hostModel;
		this.clientSocket = clientSocket;
		
		scanner = new Scanner( this.clientSocket.getInputStream() );
	}
	
	/**
	 * Synchronised function; starts whenever the start() function of the
	 * ReadHandler class is instantiated. Reads the current response from 
	 * the server.
	 * */
	public void run() {
		
		/* 
		 * TODO Create GUI for this console-based application 
		 * */
		int messageType;
		do {
			
			ArrayList<String> serverRequest = new ArrayList<String>();
			try {
				serverRequest = hostModel.parseMessageInstance( scanner.nextLine() );
			}
			catch( NoSuchElementException e ) {
				
				AppGUIModel.writeToGUI( "\nConnection to server was lost." );
				System.exit(0);
			}
			
			messageType = Integer.parseInt( serverRequest.get( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE_TYPE ) );
			String message = serverRequest.get( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE );
			
			if( messageType == AppHostModel.TYPE_GET_CHAT_MESSAGE ) {
				int endIndex = message.indexOf( ":" );
				if( endIndex > -1 ) {
					String hostName = message.substring( 0, message.indexOf( ":" ) );
					if( !hostName.equalsIgnoreCase( hostModel.getHostName() ) ) {
						
						AppGUIModel.writeToGUI( "\n" + message + "\n" );
					}
				}
				else {
					
					AppGUIModel.writeToGUI( "\n" + message + "\n" );
				}
			}
		} 
		while( messageType != AppHostModel.TYPE_END_CLIENT_PROCESS );
		System.exit(0);
	}
}

class WriteHandler extends Thread {

	/** Host Model instance */
	private AppHostModel hostModel;
	
	/** Socket instance */
	private Socket clientSocket;
	/** Client socket output writer helper */
	private PrintWriter toServer;
	/** Reader instance */
	private BufferedReader bufferReader;
	
	/**
	 * Class constructor. Initialises the host model; the client socket;
	 * and the writer class helper.
	 * */
	protected WriteHandler( AppHostModel hostModel, Socket clientSocket ) throws IOException {
		this.hostModel = hostModel;
		this.clientSocket = clientSocket;
		
		this.toServer = new PrintWriter( this.clientSocket.getOutputStream(), true );
		this.bufferReader = AppGUIModel.readFromGUI();
	}
	
	/**
	 * Synchronised function; starts whenever the start() function of the
	 * ReadHandler class is instantiated. Writes a  particular request to 
	 * the server.
	 * */
	public void run() {
	
		/* 
		 * TODO Create GUI for this console-based application 
		 * */
		int messageType;
		do {
			
			String message = "";
			try {
				message = bufferReader.readLine();
			} 
			catch (IOException e) {
				e.printStackTrace();
			}
			
			messageType = AppHostModel.TYPE_SEND_CHAT_MESSAGE;
			if( message.equalsIgnoreCase( "QUIT" ) ) {
				messageType = AppHostModel.TYPE_END_CLIENT_PROCESS;
				message = hostModel.getHostName();
			}
			else {
				message = hostModel.getHostName() + ": " + message;
			}
			
			if( messageType == AppHostModel.TYPE_SEND_CHAT_MESSAGE ) {
				
				AppGUIModel.writeToGUI( "\n" + message + "\n" );
			}
			
			toServer.println( hostModel.createMessageInstance( messageType, message ) );
		}
		while( messageType != AppHostModel.TYPE_END_CLIENT_PROCESS );
		System.exit(0);
	}
}