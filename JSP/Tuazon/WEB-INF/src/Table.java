import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class Table extends HttpServlet{

	@Override
	public void doGet(HttpServletRequest request, HttpServletResponse response) 
		throws IOException, ServletException{
	
		response.setContentType("text/html; charset=UTF-8");
		
		PrintWriter out = response.getWriter();
		
		try{
			out.println(
				"<!DOCTYPE html>" + 
				"<head><title>A Table</title>" +
				"<style type='text/css'>" +
				"body{background-color: #FDFCCE}th{background-color:#FA6900}" +
				"</style></head>" +
				"<body><center>" +
				"<h1>A Table</h1>" +
				"<table border='1'>" +
				"<tr>");
			for(int a = 1; a != 11; a++){
				out.println("<th> Column " + a + "</th>");
			}
			out.println(
				"</tr>");
			for(int a = 1; a != 26; a++){
				out.println("<tr>");
					for(int b = 1; b != 11; b++){
						out.println("<td> Row " + a + ", Column " + b + "</td>");
					}
				out.println("</tr>");
			}
			out.println("</table></center></body></html>");
		}
		finally{
			out.close();
		}
		
	}

}