import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class HelloServlet extends HttpServlet{

	@Override
	public void doGet(HttpServletRequest request, HttpServletResponse response) 
		throws IOException, ServletException{
	
		response.setContentType("text/html; charset=UTF-8");
		
		PrintWriter out = response.getWriter();
		
		try{
			out.println("<!DOCTYPE html>");
			out.println("<html><head>");
			out.println("<meta http-equiv='Content-Type' content='text/htmll charset=UTF-8'>");
			out.println("<title>Hello World</title>");
			out.println("</head><body>");
			out.println("<h1>Hello World</h1>");
			out.println("<p>Request URI: " + request.getRequestURI() + "</p>");
			out.println("<p>Protocol: " + request.getProtocol() + "</p>");
			out.println("<p>PathInfo: " + request.getPathInfo() + "</p>");
			out.println("<p>Remote Address: " + request.getRemoteAddr() + "</p>");
			out.println("<p>A random number: <strong>" + Math.random() + "</strong></p>");
			out.println("</body></html>");
		}
		finally{
			out.close();
		}
		
	}

}