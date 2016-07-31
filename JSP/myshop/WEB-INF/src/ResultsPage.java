import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;
import java.lang.*;

public class ResultsPage extends HttpServlet{
 
   @Override
   public void doPost(HttpServletRequest request, HttpServletResponse response)
               throws IOException, ServletException {
      
		response.setContentType("text/html; charset=UTF-8");
		PrintWriter out = response.getWriter();
		
		HttpSession session = request.getSession();
		
		String[][] selectedItems = (String[][]) session.getAttribute("data");
		String[][] quantityAndPrice = (String[][]) session.getAttribute("qap"); 
 
		try {	
			out.println("<!DOCTYPE html>");
			out.println("<html><head>");
			out.println("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>");
			out.println("<link rel='stylesheet' type='text/css' href='css/main.css' />");
			out.println("<script src='scripts/jquery.js'></script><script src='scripts/other.js'></script>");
			out.println("<title>Results</title></head>");
			out.println("<body class='bgBody'>");
			out.println("<div id='productListContainer'>");
			out.println("<div id='servletTitleHeader'>Step 4 - View Results</div>");
			
			String cardNumber = request.getParameter("cardnum");
			String month = request.getParameter("month");
			String year = request.getParameter("year");
			String csc = request.getParameter("csc");
			
			int indicator = 0;
			
			if(cardNumber.compareTo("5123456789012346") != 0 || month.compareTo("5") != 0 || year.compareTo("2017") != 0 || csc.compareTo("111") != 0){
				indicator = 1;
			}
			
			if(indicator != 0){
				out.println("<div id='servletBoxContainer' class='extra'>");
				out.println("<h3 id='reasonsh3'>The transaction was <span>unsuccessful</span>. See the detailed view of reasons on why it is so:</h3>");
				out.println("<ul id='reasons'>");
					if(cardNumber.compareTo("5123456789012346") != 0){
						out.println("<li>The credit card number that was given is not a valid credit card number.</li>");
					}
					if(month.compareTo("5") != 0 || year.compareTo("2017") != 0){
						out.println("<li>The expiration date of your credit card is incorrect.</li>");
					}
					if(csc.compareTo("111") != 0){
						out.println("<li>The card security code given was invalid.</li>");
					}
				out.println("</ul>");
				out.println("<h3 id='reasonsh3'>We are sorry for the inconvenience. The next time, give valid card details. Thank you for your time.</h3>");
				out.println("</div>");
			}
			else{
				out.println("<div id='servletBoxContainer'>");
				out.println("<h3 id='reasonsh3'>The transaction was <span>successful</span>; Congratulations! See the guide below on how to claim bought products</h3>");
				out.println("<ul id='reasons'>");
				out.println("<li>Product bought can be claimed through shipment. Please email us the reference number written below at <a>notarealstore@pleasebesmart.com.</a> </li>");
				out.println("<li>Product shipment takes 2-3 days depending on your location. Please email your address as soon as possible.</li>");
				out.println("<li>If email was not sent within a week, the bought product would be invalidated. Credit would NOT BE REFUNDED.</li>");
				
					int temp1 = 1000 + (int)(Math.random() * ((9999 - 1000) + 1));
					int temp2 = 1000 + (int)(Math.random() * ((9999 - 1000) + 1));
					int temp3 = 1000 + (int)(Math.random() * ((9999 - 1000) + 1));
					
				out.println("<li>Reference number: <span id='referenceNumber'>" + temp1 + " </span><span id='referenceNumber'>" + temp2 + " </span><span id='referenceNumber'>"+ temp3 + "</span></li>");
				out.println("</ul>");
				out.println("</div>");
				out.println("<div id='servletTitleHeader'>Purchased Products</div>");
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
			}
			out.println("<a href='index.html'><button id='returnToHome'>Return to Home</button></a>");
			
			out.println("</div>");
			out.println("<div id='progressBarContainer'><div id='progressBar4' class='progressBar'><div></div></div></div>");
			out.println("</body></html>");
		} 
		finally {
			out.close();
		}
	}
}