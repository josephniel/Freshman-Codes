package controllers;

import java.io.BufferedReader;
import java.io.IOException;

import hosts.AppClient;
import hosts.AppServer;
import models.AppGUIModel;
import models.AppHostModel;

/**
 * @author Joseph Niel Tuazon
 * @author Riana King
 * @author Joshua Pabilona
 * */
public class AppMainController { 
	
	private AppHostModel hostModel;
	private BufferedReader bufferRead;
	
	public AppMainController( AppHostModel hostModel ) {
		
		this.hostModel = hostModel;
		this.bufferRead = AppGUIModel.readFromGUI();
	}
	
	public void init() {
		
		/*
		 *  TODO: Create a GUI for this console-based application. 
		 *  */
		AppGUIModel.writeToGUI( "\nSelect host type (1 - client, 2 - server, 0 - quit): " );
		
	    try {
	    	
	    	// Get host type from console
	    		String selection = bufferRead.readLine();
	    	
	    	// Catches non-integer selection
		    	int hostType = 0;
		    	try {
		    		hostType = Integer.parseInt( selection );
		    	} 
			    catch( NumberFormatException e ) {
			    	
			    	AppGUIModel.writeToGUI( "\n" + selection + " not in options. \n" );
			    	this.init();
			    }
	    	
			// Check if choice is quit
				if( hostType == 0 ) {
					
					AppGUIModel.writeToGUI( "\nGoodbye." );
					return;
				}
			
			// Check if choice is a host type;
			// end function if not.
				if( hostType != AppHostModel.HOST_TYPE_CLIENT &&
						hostType != AppHostModel.HOST_TYPE_SERVER ) {
					
					AppGUIModel.writeToGUI( "\n" + hostType + " not in options. \n" );
					this.init();
				}
			
			// Set host type in host model
				hostModel.setHostType( hostType );
			
			// Do necessary Q&A for either server of client
				if( hostModel.isServer() ) {
					
					AppGUIModel.writeToGUI( "\nEnter port: " );
					AppGUIModel.readFromGUI();
					hostModel.setHostPort( Integer.parseInt( bufferRead.readLine() ) );
					
					AppServer server = new AppServer( hostModel ); 
					
					// RUN A THREAD INSTANCE OF THE SERVER
					server.start();
					
					// SET THE HOST IP OF CURRENT SERVER
					hostModel.setHostIP( "127.0.0.1" );
					
					AppGUIModel.writeToGUI( "\nEnter nickname: " );
					hostModel.setHostName( bufferRead.readLine() );
					
					AppClient client = new AppClient( hostModel );
					
					// RUN A THREAD INSTANCE OF THE CLIENT
					client.start();
				}
				else {
					
					AppGUIModel.writeToGUI( "\nEnter Server IP: " );
					hostModel.setHostIP( bufferRead.readLine() );
					
					AppGUIModel.writeToGUI( "\nEnter Server Port: " );
					hostModel.setHostPort( Integer.parseInt( bufferRead.readLine() ) );
					
					AppClient client = new AppClient( hostModel );
					
					String hostName = "";
					do {
						
						if( !hostName.equals( "" ) ) {
							AppGUIModel.writeToGUI( "\nNickname already taken. Please select another one." );
						}
						
						AppGUIModel.writeToGUI( "\nEnter nickname: " );
						hostName = bufferRead.readLine();
					}
					while( hostModel.hasHostName( hostName ) );
					
					hostModel.setHostName( hostName );
					
					// RUN A THREAD INSTANCE OF THE CLIENT
					client.start();
				}
		}
	    catch( IOException e ) {
			e.printStackTrace();
		}
	}
}