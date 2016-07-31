import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;

public class PaymentMethod extends HttpServlet{
 
   @Override
   public void doPost(HttpServletRequest request, HttpServletResponse response)
               throws IOException, ServletException {
      
		response.setContentType("text/html; charset=UTF-8");
		PrintWriter out = response.getWriter();
		
		HttpSession session = request.getSession();
		
		String[][] selectedItems = (String[][]) session.getAttribute("data");
		String[][] quantityAndPrice = new String[selectedItems.length][2]; 
 
		String hidd1 = new String();
		String hidd2 = new String();
		String hidd3 = new String();
		String hidd4 = new String();
		String hidd5 = new String();
		String hidd6 = new String();
		String hidd7 = new String();
		String hidd8 = new String();
		String hidd9 = new String();
		String hidd10 = new String();
		String hidd11 = new String();
		String hidd12 = new String();
		String hidd13 = new String();
		String hidd14 = new String();
		String hidd15 = new String();
		
		String hiddp1 = new String();
		String hiddp2 = new String();
		String hiddp3 = new String();
		String hiddp4 = new String();
		String hiddp5 = new String();
		String hiddp6 = new String();
		String hiddp7 = new String();
		String hiddp8 = new String();
		String hiddp9 = new String();
		String hiddp10 = new String();
		String hiddp11 = new String();
		String hiddp12 = new String();
		String hiddp13 = new String();
		String hiddp14 = new String();
		String hiddp15 = new String();

 
		for(int c = 0; c < selectedItems.length; c++){
			int ind = 0;
			for(String b : selectedItems[c]){
				if(ind != 3){
					ind++;
				}
				else{
					String newHid = "hidden" + b;
					
					if(newHid.compareTo("hidden1") == 0){
						 hidd1 = request.getParameter("hidden1");
						 hiddp1 = request.getParameter("hiddenprice1"); 
					}
					else if(newHid.compareTo("hidden2") == 0){
						hidd2 = request.getParameter("hidden2");
						hiddp2 = request.getParameter("hiddenprice2"); 
					}
					else if(newHid.compareTo("hidden3") == 0){
						hidd3 = request.getParameter("hidden3");
						hiddp3 = request.getParameter("hiddenprice3"); 
					}
					else if(newHid.compareTo("hidden4") == 0){
						hidd4 = request.getParameter("hidden4");
						hiddp4 = request.getParameter("hiddenprice4"); 
					}
					else if(newHid.compareTo("hidden5") == 0){
						hidd5 = request.getParameter("hidden5");
						hiddp5 = request.getParameter("hiddenprice5");
					}
					else if(newHid.compareTo("hidden6") == 0){
						hidd6 = request.getParameter("hidden6");
						hiddp6 = request.getParameter("hiddenprice6");
					}
					else if(newHid.compareTo("hidden7") == 0){
						hidd7 = request.getParameter("hidden7");
						hiddp7 = request.getParameter("hiddenprice7");
					}
					else if(newHid.compareTo("hidden8") == 0){
						hidd8 = request.getParameter("hidden8");
						hiddp8 = request.getParameter("hiddenprice8");
					}
					else if(newHid.compareTo("hidden9") == 0){
						hidd9 = request.getParameter("hidden9");
						hiddp9 = request.getParameter("hiddenprice9");
					}
					else if(newHid.compareTo("hidden10") == 0){
						hidd10 = request.getParameter("hidden10");
						hiddp10 = request.getParameter("hiddenprice10");
					}
					else if(newHid.compareTo("hidden11") == 0){
						hidd11 = request.getParameter("hidden11");
						hiddp11 = request.getParameter("hiddenprice11");
					}
					else if(newHid.compareTo("hidden12") == 0){
						hidd12 = request.getParameter("hidden12");
						hiddp12 = request.getParameter("hiddenprice12");
					}
					else if(newHid.compareTo("hidden13") == 0){
						hidd13 = request.getParameter("hidden13");
						hiddp13 = request.getParameter("hiddenprice13");
					}
					else if(newHid.compareTo("hidden14") == 0){
						hidd14 = request.getParameter("hidden14");
						hiddp14 = request.getParameter("hiddenprice14");
					}
					else if(newHid.compareTo("hidden15") == 0){
						hidd15 = request.getParameter("hidden15");
						hiddp15 = request.getParameter("hiddenprice15");
					}
				}
			}
		}
  
		try {	
			out.println("<!DOCTYPE html>");
			out.println("<html><head>");
			out.println("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>");
			out.println("<link rel='stylesheet' type='text/css' href='css/main.css' />");
			out.println("<script src='scripts/jquery.js'></script><script src='scripts/other.js'></script>");
			out.println("<title>Payment Method</title></head>");
			out.println("<body class='bgBody'>");
			out.println("<div id='productListContainer'>");
			out.println("<div id='servletTitleHeader'>Step 2 - Select Payment Method</div>");
			out.println("<form action='carddetails' method='post'><div id='servletBoxContainer'><ul>");
			out.println("<li id='method'><table><tr><td id='mc'><label for='m'><div id='mastercard'></div><div id='mastercardh'></div> <input name='selected' value='Mastercard' id='m' type='radio'/></label></td><td id='vc'><label for='v'><div id='visa'></div><div id='visah'></div> <input name='selected' value='Visa' id='v' type='radio'/></label></td></tr></table></li>");
			out.println("</ul></div>");
			out.println("<div id='servletTitleHeader'>Cart Details</div>");
			out.println("<div id='cartDetails'><ul>");
			for(int c = 0; c < selectedItems.length; c++){
				out.println("<li><ol>");
				int ind = 0, temp = 0;
				
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
					else if(ind == 3){
						out.println("<li style='list-style-type:circle;margin:0 0 0 30px;padding:0 0 0 20px;'>"); 
	
						if(b.compareTo("1") == 0 ){
							out.println(hidd1);
							temp = 1;
							quantityAndPrice[c][0] = hidd1;
						}
						else if(b.compareTo("2") == 0 ){
							out.println(hidd2);
							temp = 2;
							quantityAndPrice[c][0] = hidd2;
						}
						else if(b.compareTo("3") == 0 ){
							out.println(hidd3);
							temp = 3;
							quantityAndPrice[c][0] = hidd3;
						}
						else if(b.compareTo("4") == 0 ){
							out.println(hidd4);
							temp = 4;
							quantityAndPrice[c][0] = hidd4;
						}
						else if(b.compareTo("5") == 0 ){
							out.println(hidd5);
							temp = 5;
							quantityAndPrice[c][0] = hidd5;
						}
						else if(b.compareTo("6") == 0 ){
							out.println(hidd6);
							temp = 6;
							quantityAndPrice[c][0] = hidd6;
						}
						else if(b.compareTo("7") == 0 ){
							out.println(hidd7);
							temp = 7;
							quantityAndPrice[c][0] = hidd7;
						}
						else if(b.compareTo("8") == 0 ){
							out.println(hidd8);
							temp = 8;
							quantityAndPrice[c][0] = hidd8;
						}
						else if(b.compareTo("9") == 0 ){
							out.println(hidd9);
							temp = 9;
							quantityAndPrice[c][0] = hidd9;
						}
						else if(b.compareTo("10") == 0 ){
							out.println(hidd10);
							temp = 10;
							quantityAndPrice[c][0] = hidd10;
						}
						else if(b.compareTo("11") == 0 ){
							out.println(hidd11);
							temp = 11;
							quantityAndPrice[c][0] = hidd11;
						}
						else if(b.compareTo("12") == 0 ){
							out.println(hidd12);
							temp = 12;
							quantityAndPrice[c][0] = hidd12;
						}
						else if(b.compareTo("13") == 0 ){
							out.println(hidd13);
							temp = 13;
							quantityAndPrice[c][0] = hidd13;
						}
						else if(b.compareTo("14") == 0 ){
							out.println(hidd14);
							temp = 14;
							quantityAndPrice[c][0] = hidd14;
						}
						else if(b.compareTo("15") == 0 ){
							out.println(hidd15);
							temp = 15;
							quantityAndPrice[c][0] = hidd15;
						}
						out.println("</li>");
						
						out.println("<li style='list-style-type:circle;margin:0 0 0 30px;padding:0 0 0 20px;'>");
						if(temp == 1){
							out.println(hiddp1);
							quantityAndPrice[c][1] = hiddp1;
						}
						else if(temp == 2){
							out.println(hiddp2);
							quantityAndPrice[c][1] = hiddp2;
						}
						else if(temp == 3){
							out.println(hiddp3);
							quantityAndPrice[c][1] = hiddp3;
						}
						else if(temp == 4){
							out.println(hiddp4);
							quantityAndPrice[c][1] = hiddp4;
						}
						else if(temp == 5){
							out.println(hiddp5);
							quantityAndPrice[c][1] = hiddp5;
						}
						else if(temp == 6){
							out.println(hiddp6);
							quantityAndPrice[c][1] = hiddp6;
						}
						else if(temp == 7){
							out.println(hiddp7);
							quantityAndPrice[c][1] = hiddp7;
						}
						else if(temp == 8){
							out.println(hiddp8);
							quantityAndPrice[c][1] = hiddp8;
						}
						else if(temp == 9){
							out.println(hiddp9);
							quantityAndPrice[c][1] = hiddp9;
						}
						else if(temp == 10){
							out.println(hiddp10);
							quantityAndPrice[c][1] = hiddp10;
						}
						else if(temp == 11){
							out.println(hiddp11);
							quantityAndPrice[c][1] = hiddp11;
						}
						else if(temp == 12){
							out.println(hiddp12);
							quantityAndPrice[c][1] = hiddp12;
						}
						else if(temp == 13){
							out.println(hiddp13);
							quantityAndPrice[c][1] = hiddp13;
						}
						else if(temp == 14){
							out.println(hiddp14);
							quantityAndPrice[c][1] = hiddp14;
						}
						else if(temp == 15){
							out.println(hiddp15);
							quantityAndPrice[c][1] = hiddp15;
						}
						out.println("</li>");
						
					}
				}
				out.println("</ol></li>");
			}
			out.println("</ul></div>");
			out.println("<div style='position:relative;overflow:auto;'><input type='submit' value='Next' id='nextButton' onclick='return checkPaymentMethod()' /></div>");
			out.println("</form></div>");
			out.println("<div id='progressBarContainer'><div id='progressBar2' class='progressBar'><div></div></div></div>");
			
			out.println("</body></html>");
			
			session.setAttribute("qap",quantityAndPrice);
		} 
		finally {
			out.close();
		}
	}
}