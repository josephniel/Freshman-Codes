import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;

public class CardDetails extends HttpServlet{
 
   @Override
   public void doPost(HttpServletRequest request, HttpServletResponse response)
               throws IOException, ServletException {
      
		response.setContentType("text/html; charset=UTF-8");
		PrintWriter out = response.getWriter();
 
		String a = request.getParameter("selected");
	
		HttpSession session = request.getSession();
	
		String[][] selectedItems = (String[][]) session.getAttribute("data");
		String[][] quantityAndPrice = (String[][]) session.getAttribute("qap"); 
 
		try {	
			out.println("<!DOCTYPE html>");
			out.println("<html><head>");
			out.println("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>");
			out.println("<link rel='stylesheet' type='text/css' href='css/main.css' />");
			out.println("<script src='scripts/jquery.js'></script>");
			out.println("<script src='scripts/other.js'></script>");
			out.println("<title>Credit Card Details</title></head>");
			out.println("<body class='bgBody'>");
			out.println("<div id='productListContainer'>");
			out.println("<div id='servletTitleHeader'>Step 3 - Input Card Details</div>");
			out.println("<div id='servletBoxContainer'>");
			out.println("<form name='cardForm' action='result' method='post' onsubmit='return validate()'>");
			out.println("<table id='cardDetailsTable'><tr>");
			out.println("<td width='30%'>Credit Card Type:</td>");
			out.println("<td width='30%'>" + a + "</td>");
			out.println("</tr><tr>");
			out.println("<td width='30%'>First Name</td>");
			out.println("<td width='30%'><input type='text' name='firstname' id='firstname' /></td>");
			out.println("<td width='40%' class='error' id='firstnameerror'>Please provide your first name</td>");
			out.println("</tr><tr>");
			out.println("<td width='30%'>Last Name</td>");
			out.println("<td width='30%'><input type='text' name='lastname' id='lastname' /></td>");
			out.println("<td width='40%' class='error' id='lastnameerror'>Please provide your last name</td>");
			out.println("</tr><tr>");
			out.println("<td width='30%'>Card Number</td>");
			out.println("<td width='30%'><input type='text' name='cardnum' id='cardnum' maxlength='16' /></td>");
			out.println("<td width='40%' class='error' id='cardnumbererror'>Please provide a valid card number</td>");
			out.println("</tr><tr>");
			out.println("<td width='30%'>Expiry Date</td>");
			out.println("<td width='30%'><select name='month' id='month'>");
			out.println("<option value='-'>-</option>");
			out.println("<option value='1'>01</option>");
			out.println("<option value='2'>02</option>");
			out.println("<option value='3'>03</option>");
			out.println("<option value='4'>04</option>");
			out.println("<option value='5'>05</option>");
			out.println("<option value='6'>06</option>");
			out.println("<option value='7'>07</option>");
			out.println("<option value='8'>08</option>");
			out.println("<option value='9'>09</option>");
			out.println("<option value='10'>10</option>");
			out.println("<option value='11'>11</option>");
			out.println("<option value='12'>12</option>");
			out.println("</select>");
			out.println("<select name='year' id='year'>");
			out.println("<option value='-'>-</option>");
			out.println("<option value='2014'>2014</option>");
			out.println("<option value='2015'>2015</option>");
			out.println("<option value='2016'>2016</option>");
			out.println("<option value='2017'>2017</option>");
			out.println("<option value='2018'>2018</option>");
			out.println("<option value='2019'>2019</option>");
			out.println("</select>");
			out.println("</td>");
			out.println("<td width='40%' class='error' id='dateerror'>Please provide a valid expiry date</td>");
			out.println("</tr><tr>");
			out.println("<td width='30%'>Card Security Code</td>");
			out.println("<td width='30%'><input type='text' name='csc' id='csc' maxlength='3' /></td>");
			out.println("<td width='40%' class='error' id='cscerror'>Please provide a valid CSC</td>");
			out.println("</tr><tr>");
			out.println("<td colspan='3'><input type='reset' value='Reset' class='cardButton' /></td>");
			out.println("</tr></table>");
			out.println("</div><div id='servletTitleHeader'>Cart Details</div>");
			out.println("<div id='cartDetails'><ul>");
			for(int c = 0; c < selectedItems.length; c++){
				out.println("<li><ol>");
				int ind = 0;
				for(String b : selectedItems[c]){
					if(ind == 0){
						out.println("<li class='productName'>" + b + "</li>");
						ind = 1;
					}
					else if(ind == 1){
						out.println("<li style='list-style-type:circle;margin:0 0 0 30px;padding:0 0 0 20px;'>" + b + "</li>");
						ind = 2;
					}
					else if(ind == 2){
						ind = 3;
					}
				}
				for(String b : quantityAndPrice[c]){
					if(ind == 3){
						out.println("<li style='list-style-type:circle;margin:0 0 0 30px;padding:0 0 0 20px;'>Quantity: " + b + "</li>");
						ind = 4;
					}
					else{
						out.println("<li style='list-style-type:circle;margin:0 0 0 30px;padding:0 0 0 20px;'>Price: " + b + "</li>");
					}
				}
				out.println("</ol></li>");
			}

			out.println("</ul></div>");
			out.println("<div style='position:relative;overflow:auto;'><input type='submit' value='Next' class='cardButton' id='nextButton' /></div>");
			out.println("</form>");
			out.println("</div><div id='progressBarContainer'><div id='progressBar3' class='progressBar'><div></div></div></div>");
			out.println("</body></html>");
		} 
		finally {
			out.close();
		}
	}
}