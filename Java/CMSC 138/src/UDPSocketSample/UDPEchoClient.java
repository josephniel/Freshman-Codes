package UDPSocketSample;

import java.io.*;
import java.net.*;
import java.util.*;

public class UDPEchoClient {
	private static Scanner inFromUser;

	public static void main(String[] args) {
		
		inFromUser = new Scanner(System.in);
		
		try {
			DatagramSocket clientSocket = new DatagramSocket();
			
			InetAddress ipAddress = InetAddress.getByName(args[0]);
			int port = Integer.parseInt(args[1]);
			byte[] sendData = new byte[1024];
			byte[] receiveData = new byte[1024];
			String sentence = inFromUser.nextLine();
			sendData = sentence.getBytes("UTF-8");
			DatagramPacket sendPacket = new DatagramPacket(sendData, sendData.length, ipAddress, port);
			clientSocket.send(sendPacket);
			DatagramPacket receivePacket = new DatagramPacket(receiveData, receiveData.length);
			clientSocket.receive(receivePacket);
			String modifiedSentence = new String(receivePacket.getData(), 0, receivePacket.getLength(), "UTF-8");
			System.out.println("FROM SERVER: " + modifiedSentence);
			
			System.out.println("\n* Closing connection...*");
			clientSocket.close();
		}
		catch(UnknownHostException uhEx) {
			System.out.println("Host ID not found!");
			System.exit(1);
		}
		catch(IOException ioEx) {
			ioEx.printStackTrace();
		}		
		
	}

}
