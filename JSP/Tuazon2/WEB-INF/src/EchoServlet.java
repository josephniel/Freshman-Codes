import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

public class EchoServlet extends HttpServlet{

	@Override
	public void doPost(HttpServletRequest request, HttpServletResponse response) 
		throws IOException, ServletException{
	
		response.setContentType("text/html; charset=UTF-8");
		
		PrintWriter out = response.getWriter();
		
		try{	
			out.println("<!doctype><html><head><title>Exercise 2 - Registration Form Validation</title>");
			out.println("<style type='text/css'>body{background-image: url(images/bg.png);}</style></head>");
			out.println("<body>");
			
			String firstname = request.getParameter("firstname");
			String lastname = request.getParameter("lastname");
			String month = request.getParameter("birth_month");
			String day = request.getParameter("birthday");
			String year = request.getParameter("birth_year");
			String age = request.getParameter("Age");
			String email = request.getParameter("email");
			
			out.println("<p>Name: " + lastname + ", " + firstname + "</p>");
			
			String newMonth = new String();
			
			switch(Integer.parseInt(month)){
				case 1: newMonth = "January"; break;
				case 2: newMonth = "February"; break;
				case 3: newMonth = "March"; break;
				case 4: newMonth = "April"; break;
				case 5: newMonth = "May"; break;
				case 6: newMonth = "June"; break;
				case 7: newMonth = "July"; break;
				case 8: newMonth = "August"; break;
				case 9: newMonth = "September"; break;
				case 10: newMonth = "October"; break;
				case 11: newMonth = "November"; break;
				case 12: newMonth = "December"; break;
			}
			
			out.println("<p>Birth date: " + newMonth + " " + day + ", " + year + "</p>");
			out.println("<p>Age: " + age + "</p>");
			out.println("<p>Email Address: " + email + "</p>");
			
			out.println("</body></html>");
		}
		finally{
			out.close();
		}
		
	}

	private static String htmlFilter(String message){
		if(message == null)
			return null;
		
		int len = message.length();
		StringBuffer result = new StringBuffer(len + 20);

		char aChar;
		
		for(int i = 0; i < len; i++){
			aChar = message.charAt(i);
			switch(aChar){
				case '<': result.append("&lt;"); break;
				case '>': result.append("&gt;"); break;
				case '&': result.append("&amp;"); break;
				case '"': result.append("&quot;"); break;
				default: result.append(aChar); break;
			}
		}
		return result.toString();
	}
	
}