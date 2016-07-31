import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;
import java.math.BigDecimal;

public class Cart extends HttpServlet{
 
   @Override
   public void doPost(HttpServletRequest request, HttpServletResponse response)
               throws IOException, ServletException {
      
		response.setContentType("text/html; charset=UTF-8");
		PrintWriter out = response.getWriter();

		HttpSession session = request.getSession();
		
		try {
			
			String[][] details = new String[][]{
				{"","","",""},
				{"Too Weird To Live, Too Rare To Die","Panic! at the Disco","499.50","1"},
				{"Overnight","Parachute","499.50","2"},
				{"Lights","Ellie Goulding","499.50","3"},
				{"Wonders of the Younger","Plain White T's","499.50","4"},
				{"On Letting Go","Circa Survive","499.50","5"},
				{"Stars - Some Nights","fun.","49.50","6"},
				{"Nicotine - Too Weird To Live, Too Rare to Die","Panic! at the Disco","49.50","7"},
				{"The Greatest Lie - On Letting Go","Circa Survive","49.50","8"},
				{"Hurricane - Overnight","Parachute","49.50","9"},
				{"Broken Record - Wonders of the Younger","Plain White T's","49.50","10"},
				{"Pure Heroine","Lorde","499.50","11"},
				{"Native","OneRepublic","499.50","12"},
				{"A.M.","Arctic Monkeys","499.50","13"},
				{"Bangerz","Miley Cyrus","409.50","14"},
				{"Midnight Memories","One Direction","409.50","15"}
			};
			
			out.println("<!DOCTYPE html>");
			out.println("<html><head>");
			out.println("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>");
			out.println("<link rel='stylesheet' type='text/css' href='css/main.css' />");
			out.println("<title> Your Cart </title></head>");
			out.println("<body class='bgBody'>");
			out.println("<div id='productListContainer'>");
			out.println("<div id='servletTitleHeader'>Step 1 - Your Cart</div>");
			out.println("<form id='servletBoxContainer' name='mainCart' method='post' action='paymentmethod'><ul id='productList'>");
			
			String[] a = request.getParameterValues("product");
			
			int index = a.length;
			
			String[][] selectedItems = new String[index][4];
			int itemQuantity[] = new int[index]; 
			
			int temp = 0;
			float temp2 = 0;
			
			for(String number : a){
			
				int num = Integer.parseInt(number);
				
				out.println("<li id='prod" + num + "' class='productDetails product" + num + "'>");
				out.println("<div class='productArt'></div>");
				out.println("<div class='productDescription'><ul>");
				for(int j = 0; j < 4; j++){
					if(j==0){
						out.println("<li id='title'>" + details[num][j] + "</li>");
					}
					else if(j==2){
						temp2 = temp2 + Float.parseFloat(details[num][j]);
						out.println("<li>Php " + details[num][j] + "</li>");
					}
					else if(j==1){
						out.println("<li>" + details[num][j] + "</li>");
					}
					selectedItems[temp][j] = details[num][j];
				}
				out.println("</ul></div>");
				out.println("<div id='productCount'><form><div class='leftButton' id='lb" + num + "'></div><div class='quantity' id='pr" + num + "'>1</div><div class='rightButton' id='rb" + num + "'></div><div id='PSign'>P</div><div id='price" + num + "' class='cPrice'>"+ details[num][2] + "</div></form></div><input type='hidden' name='hidden" + num + "' id='pro" + num + "' value='1' /><input type='hidden' name='hiddenprice" + num + "' id='produ" + num + "' value='" + details[num][2] + "' />");
				out.println("</li>");
				temp++;
			}
			out.println("<li id='total'><div id='php'><span>Total Price:</span> Php</div><div id='totalPrice'>" + temp2 + "</div><input type='submit' value='Proceed to Checkout' id='cartPageCheckOutButton' /></li>");
			out.println("</ul></form></div>");
			out.println("<div id='progressBarContainer'><div id='progressBar1' class='progressBar'><div></div></div></div>");
			out.println("<script src='scripts/jquery.js'></script><script src='scripts/other.js'></script>");
			out.println("</body></html>");
			
			session.setAttribute("data",selectedItems);
		} 
		finally {
			out.close();
		}
	}
}