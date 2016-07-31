package UDPSocketExercise;

import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketTimeoutException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

public class PingClient
{	

	final static int TIMEOUT = 1000;
	private static DatagramSocket socket;
	
	public static void main(String[] args) 
	{	
		try 
		{
			// create socket
			socket = new DatagramSocket();
			
			// get IP address and port number
			InetAddress ipAddress = InetAddress.getByName(args[0]);
			int port = Integer.valueOf(args[1]);
			
			// assign variables for packet sending and packet receiving
			byte[] sendData = new byte[1024];
			byte[] receiveData = new byte[1024];
			
			// start sending 10 packets
			for(int i = 1; i <= 10; i++) 
			{
				long initialMilliseconds = System.currentTimeMillis();
				
				Date date = new Date();
				DateFormat formatter = new SimpleDateFormat("HH:mm:ss:SSSSSS");
				String dateFormatted = formatter.format(date);
				
				String message = "Ping " + i + " " + dateFormatted + "\n";
				
				// converts data to bytes
				sendData = message.getBytes("UTF-8");
				
				// creates packet to send
				DatagramPacket sendPacket = 
						new DatagramPacket(sendData, sendData.length, ipAddress, port);
				
				// sends packet
				socket.send(sendPacket);
				
				// creates packet to receive
				DatagramPacket receivePacket = 
						new DatagramPacket(receiveData, receiveData.length);
				
				// create timeout for the socket
				socket.setSoTimeout(TIMEOUT);
				try
				{
					// loop until timeout
					while( true ) 
					{
						// receive packet
						socket.receive(receivePacket);
						break;
					}
					
					// Print server's response
					String receivedMessage = 
							new String(receivePacket.getData(), 0, receivePacket.getLength(), "UTF-8");
					System.out.println( receivedMessage.substring(0, receivedMessage.indexOf("\n")) );
					
					// compute for RRT
					long returnMilliseconds = System.currentTimeMillis();
					
					long RTT = returnMilliseconds - initialMilliseconds;
					
					System.out.println( "RTT: " + RTT + " milliseconds \n");
				}
				catch(SocketTimeoutException e) // catch timeout exception
				{
					System.out.println( "Request timed out. \n" );
				}
			}
		} 
		catch (Exception e) {
			e.printStackTrace();
		} 
	}
}
