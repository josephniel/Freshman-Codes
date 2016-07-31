package MultithreadedTCPWebServer;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.StringTokenizer;

public final class TCPWebServer {
	
	private static final int PORT = 6789;
	private static ServerSocket serverSocket;
	
	public static void main(String[] args) throws Exception
	{
		serverSocket = new ServerSocket(PORT);
		
		while(true) 
		{
			// Listen for a TCP connection request.
			Socket client = serverSocket.accept();
			
			// Construct an object to process the HTTP request message.
			HttpRequest request = new HttpRequest( client );

			// Create a new thread to process the request.
			Thread thread = new Thread( request );

			// Start the thread.
			thread.start();
		}
	}
	
}

final class HttpRequest implements Runnable {
	
	final static String CRLF = "\r\n";
	Socket socket;

	// Constructor
	public HttpRequest(Socket socket) throws Exception 
	{
		this.socket = socket;
	}

	// Implement the run() method of the Runnable interface.
	public void run()
	{
		try {
			processRequest();
		} 
		catch (Exception e) {
			System.out.println(e);
		}
	}

	private void processRequest() throws Exception
	{
		// Get a reference to the socket's input and output streams.
		InputStream is = socket.getInputStream();
		OutputStream os = socket.getOutputStream();

		// Set up input stream filters.
		InputStreamReader isr = new InputStreamReader(is);
		BufferedReader br = new BufferedReader(isr);
		
		// Get the request line of the HTTP request message.
		String requestLine = br.readLine();

		// Display the request line.
		System.out.println("\n" + requestLine);
		
		// Get and display the header lines.
		String headerLine = null;
		while ((headerLine = br.readLine()).length() != 0) {
			System.out.println(headerLine);
		}
		
		// Extract the filename from the request line.
		StringTokenizer tokens = new StringTokenizer(requestLine);
		tokens.nextToken();  // skip over the method, which should be "GET"
		String fileName = tokens.nextToken();
		
		// Extract the HTTP version of the request line.
		String httpVersion = tokens.nextToken();

		// Prepend a "." so that file request is within the current directory.
		fileName = "." + fileName;
		
		// Open the requested file.
		FileInputStream fis = null;
		boolean fileExists = true;
		try {
			fis = new FileInputStream(fileName);
		} 
		catch (FileNotFoundException e) {
			fileExists = false;
		}
		
		// Construct the response message.
		String statusLine = null;
		String contentTypeLine = null;
		String entityBody = null;
		if (fileExists) {
			statusLine = httpVersion + " 200 OK" + CRLF;
			contentTypeLine = "Content-type: " + 
				contentType( fileName ) + CRLF;
		} 
		else {
			statusLine = httpVersion + " 404 Not Found" + CRLF;
			contentTypeLine = "Content-type: text/html" + CRLF;
			entityBody = "<HTML>" + 
				"<HEAD><TITLE>Not Found</TITLE></HEAD>" +
				"<BODY>Not Found</BODY></HTML>";
		}
		
		// Send the status line.
		os.write(statusLine.getBytes());
		
		// Send the content type line.
		os.write(contentTypeLine.getBytes());
		
		// Send a blank line to indicate the end of the header lines.
		os.write(CRLF.getBytes());
		
		// Send the entity body.
		if (fileExists)	{
			sendBytes(fis, os);
			fis.close();
		} else {
			os.write(entityBody.getBytes());
		}
		
		// Close streams and socket.
		os.close();
		br.close();
		socket.close();
	}

	private static void sendBytes(FileInputStream fis, OutputStream os) 
			throws Exception
	{
		// Construct a 1K buffer to hold bytes on their way to the socket.
		byte[] buffer = new byte[1024];
		int bytes = 0;

		// Copy requested file into the socket's output stream.
		while((bytes = fis.read(buffer)) != -1 ) {
			os.write(buffer, 0, bytes);
		}
	}

	private static String contentType(String fileName)
	{
		if(fileName.endsWith(".htm") || fileName.endsWith(".html")) {
			return "text/html";
		}
		if(fileName.endsWith(".gif")) {
			return "image/gif";
		}
		if(fileName.endsWith(".jpg") || fileName.endsWith(".jpeg")) {
			return "image/jpeg";
		}
		return "application/octet-stream";
	}

}

