package UDPSocketSample;
import java.io.*;
import java.net.*;

public class UDPEchoServer {
	private static DatagramSocket serverSocket;

	public static void main(String[] args) {
		final int PORT = 55555/*9876*/;
		try {
			serverSocket = new DatagramSocket(PORT);
			byte[] receiveData = new byte[1024];
			byte[] sendData = new byte[1024];
			while(true) {
				DatagramPacket receivePacket = new DatagramPacket(receiveData, receiveData.length);
				serverSocket.receive(receivePacket);
				String sentence = new String(receivePacket.getData(), 0, receivePacket.getLength(), "UTF-8");
				InetAddress ipAddress = receivePacket.getAddress();
				int port = receivePacket.getPort();
				String capitalizedSentence = sentence.toUpperCase();
				sendData = capitalizedSentence.getBytes("UTF-8");				
				DatagramPacket sendPacket = new DatagramPacket(sendData, sendData.length, ipAddress, port);
				serverSocket.send(sendPacket);
				System.out.println(ipAddress + ":" + port + " - " + sentence );
			}
		}
		catch(SocketException sockEx) {
			System.out.println("Unable to attach to port!");
			System.exit(1);
		}
		catch(IOException ioEx) {
			ioEx.printStackTrace();
		}		
	}

}
