package models;

import java.util.ArrayList;

import com.google.gson.Gson;

/**
 * @author Joseph Niel Tuazon
 * @author Riana King
 * @author Joshua Pabilona
 * */
public class AppHostModel 
{
	/** Host type identifier for client. */
	public static final int HOST_TYPE_CLIENT = 1;
	/** Host type identifier for server. */
	public static final int HOST_TYPE_SERVER = 2;
	
	/** Message instance type for host name list retrieval from server. */
	public static final int TYPE_GET_SERVER_HOSTNAMES = 1;
	/** Message instance type for host name list update to server. */
	public static final int TYPE_SET_SERVER_HOSTNAMES = 2;
	/** Message instance type for successful update of host name list. */
	public static final int TYPE_SET_HOST_NAMES_SUCCESSFUL = 3;
	/** Message instance type for client exit process. */
	public static final int TYPE_END_CLIENT_PROCESS = 4;
	/** Message instance type for client chat retrieval. */
	public static final int TYPE_GET_CHAT_MESSAGE = 5;
	/** Message instance type for client chat update. */
	public static final int TYPE_SEND_CHAT_MESSAGE = 6;
	
	/** Message instance message type index. */
	public static final int INDEX_MESSAGE_INSTANCE_MESSAGE_TYPE = 0;
	/** Message instance message index. */
	public static final int INDEX_MESSAGE_INSTANCE_MESSAGE = 1;
	
	/** Host name of the current host.  */
	private String hostName;
	/** Host type of the current host.  */
	private int hostType;
	/** Host IP of the server the current host connects. */
	private String hostIP;
	/** Host port of the server the current host connects.  */
	private int hostPort;
	
	/** Host name list of the current host. */
	private ArrayList<String> hostNames;
	
	/** 
	 * Class constructor. Initialises the host name list
	 * array list;
	 * */
	public AppHostModel() {
		
		this.hostNames = new ArrayList<String>();
	}

	/**
	 * This function gets the host type of the current host.
	 * 
	 * @return
	 * 	String this.hostType - the host type of the current host.
	 * */
	public int getHostType() {
		return this.hostType;
	}

	/**
	 * This function sets the host type of the current host;
	 * 
	 * @param
	 * 	String hostType - the host type of the current host.
	 * */
	public void setHostType( int hostType ) {
		this.hostType = hostType;
	}

	/**
	 * This function checks if the current host is a server or a client.
	 * 
	 * @return
	 * 	TRUE if host is a server;
	 * 	FALSE if host is a client.
	 * */
	public boolean isServer() {
		return ( this.hostType == AppHostModel.HOST_TYPE_SERVER );
	}

	/**
	 * This function gets the current host's port number.
	 * 
	 * @return
	 * 	String this.hostPort - the port number of the current host.
	 * */
	public int getHostPort() {
		return this.hostPort;
	}

	/**
	 * This function sets the current host's port number.
	 * 
	 * @param
	 * 	String hostPort - the port number of the current host.
	 * */
	public void setHostPort( int hostPort ) {
		this.hostPort = hostPort;
	}

	/**
	 * This function gets the current host's IP Address.
	 * 
	 * @return
	 * 	String this.hostIP - the IP address of the current host.
	 * */
	public String getHostIP() {
		return this.hostIP;
	}

	/**
	 * This function sets the current host's IP Address.
	 * 
	 * @param
	 * 	String hostIP - the IP address of the current host.
	 * */
	public void setHostIP(String hostIP) {
		this.hostIP = hostIP;
	}

	/**
	 * This function gets the host name of the current host.
	 * 
	 * @return
	 * 	String this.hostName - the host name of the current host.
	 * */
	public String getHostName() {
		return this.hostName;
	}
	
	/**
	 * This function sets the host name of the current host.
	 * 
	 * @param 
	 * 	String hostName - the host name of the current host.
	 * */
	public void setHostName( String hostName ) {
		this.hostName = hostName.toUpperCase();
	}

	/**
	 * This function checks if the host name is already present in the
	 * list of host names (ArrayList this.hostNames).
	 * 
	 * @return
	 * 	TRUE if no host name is found in the array list;
	 * 	FALSE if otherwise.
	 * */
	public boolean hasHostName( String hostName ) {
		return ( hostNames.contains( hostName.toUpperCase() ) );
	}

	/**
	 * This function adds a host name to the list of host names
	 * for the current host (be it a server or client)
	 * 
	 * */
	public void addHostName( String hostName ) {
	
		if( !this.hasHostName( hostName ) ) {
			this.hostNames.add( hostName.toUpperCase() );
		}
	}
	
	/**
	 * Converts the list of hosts into a JSON using 
	 * Google's GSON library (since Java does not have 
	 * a default JSON converter).
	 * 
	 * @return
	 * 	String representation of the host names.
	 * */
	public String serializeHostNames() {
		return ( new Gson() ).toJson( this.hostNames, ArrayList.class );
	}
	
	/**
	 * Converts the JSON back to a list of hosts using 
	 * Google's GSON library (since Java does not have 
	 * a default JSON converter).
	 * 
	 * @return
	 * 	ArrayList<ArrayList<String>> this.hosts - list of hosts currently in the conference.
	 * */
	@SuppressWarnings("unchecked")
	public void deserializeHostNames( String hostNames ) {
		this.hostNames = ( new Gson() ).fromJson( hostNames, ArrayList.class );
	}

	/**
	 * This function creates a message instance with message type and message as 
	 * part of the client-server communication API
	 * 
	 * @param
	 * 	int messageType - type of message being sent
	 *  String message - message to send
	 * @return 
	 * 	String representation of the message instance
	 * */
	public String createMessageInstance( int messageType, String message ) {
		
		MessageInstance mi = new MessageInstance();
		
		mi.message = message;
		mi.messageType = messageType;
		
		return ( new Gson() ).toJson( mi );
	}
	
	/**
	 * This function parses a message instance for its message type and message as 
	 * part of the client-server communication API
	 * 
	 * @param
	 * 	String messageInstance - string representation of the message instance
	 * @return 
	 * 	ArrayList<String> representation of the message instance
	 * */
	public ArrayList<String> parseMessageInstance( String messageInstance ) {
	
		MessageInstance mi = ( new Gson() ).fromJson( messageInstance, MessageInstance.class );
		
		String messageType = String.valueOf( mi.messageType );
		String message = mi.message;
		
		ArrayList<String> returnArray = new ArrayList<String>();
		
		returnArray.add( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE_TYPE, messageType );
		returnArray.add( AppHostModel.INDEX_MESSAGE_INSTANCE_MESSAGE, message );
		
		return returnArray;
	}
	
	/**
	 * This function handles clients who quit either normally or abnormally
	 * by removing them from the host name list.
	 * 
	 * @return Message Instance Message Type
	 * */
	public String handleQuitMessage( String hostName ) {
		
		if( hostNames.remove( hostName.toUpperCase() ) ) {
			return this.serializeHostNames();
		}
		return "Something went wrong.";
	}
}

class MessageInstance {
	protected int messageType;
	protected String message;
}