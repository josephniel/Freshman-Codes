<%@page language="java" contentType="text/html" pageEncoding="UTF-8" import="java.util.*" %>

<%!
	private static int numberOfInput, numberOfFlipFlops, numberOfRows, binaryLength;
	private static String flipFlopType, outputFunction;
	private static ArrayList<String> flipFlopFunctions;
	private static boolean hasOutput = false;
	
	private static String headerTableHTML, rowHTML;
	
	public static String JKNextStateEvaluator(String j, String k, String current){
	
		String returnString = "";
	
		if(j.equals("0") && k.equals("0")){ 
			returnString = current;
		}
		else if(
			j.equals("0") && k.equals("1")){ returnString = "0";
		}
		else if(
			j.equals("1") && k.equals("0")){ returnString = "1"; 
		}
		else{
			if(current.equals("0")){
				returnString = "1";
			}
			else{
				returnString = "0";
			}
		}
		
		return returnString;
		
	}
	
	public static String RSNextStateEvaluator(String r, String s, String current){

		String returnString = "";
	
		if(r.equals("0") && s.equals("0")){
			returnString = current;
		}
		else if(r.equals("0") && s.equals("1")){
			returnString = "1";
		}
		else if(r.equals("1") && s.equals("0")){
			returnString = "0";
		}
		else{
			returnString = "-";
		}
		
		return returnString;
	
	}
	
	public static String DNextStateEvaluator(String d){
		
		return d;
		
	}
	
	public static String TNextStateEvaluator(String t, String current){
	
		String returnString = "";
	
		if(t.equals("1")){
			if(current.equals("0")){
				returnString = "1";
			}
			else{
				returnString = "0";
			}
		}
		else{
			returnString = current;
		}
		
		return returnString;
		
	}
	
	public static String functionEvaluator(String fnxn, String presentA, String presentB, String inputX, String inputY){
	
		fnxn = fnxn.toLowerCase();
		fnxn = fnxn.replaceAll(" ","");
	
		fnxn = fnxn.replaceAll("a", presentA);
		fnxn = fnxn.replaceAll("b", presentB);
		fnxn = fnxn.replaceAll("x", inputX);
		fnxn = fnxn.replaceAll("y", inputY);	
		
		if(fnxn.contains("(") && fnxn.contains(")"))
		{
			String prt = "";
			int ind = 0;
			
			for(int ind1 = fnxn.indexOf("("), ind2 = fnxn.indexOf(")"); ind1 >= 0 && ind2 >=0; ind1 = fnxn.indexOf("(", ind1 + 1), ind2 = fnxn.indexOf(")", ind2 + 1))
			{			    
			    prt += "_" + fnxn.substring(ind1+1,ind2);
			    ind = ind2;  
			}
			
			prt += "_" + fnxn.substring(ind+1);
			
			StringTokenizer tknZ = new StringTokenizer(prt, "_");
			int ctr = 1;	
			int tknz = tknZ.countTokens();	

			String[] ndd = new String[tknz]; 
			
			while(tknZ.hasMoreTokens())
			{
				String tkns = tknZ.nextToken();
				
				String answ = evaluateToken(tkns);
				
				ndd[ctr-1] = answ;
	        	ctr++;
			}
			
			StringBuilder builder = new StringBuilder();
			for(String s : ndd) 
    		{
    		    builder.append(s);
    		}
    		String orString = builder.toString();
    		
    		
    		
    		if(fnxn.substring(ind+1) == "+")
    		{

        		if(orString.contains("1") && orString.contains("0"))
        		{
        			orString = "1";
        		}
        		else if(orString.contains("0") && !orString.contains("1"))
        		{
        			orString = "0";
        		}
        		else
        		{
        			orString = "1";
        		}
    		}
    		else
    		{
    			if(orString.contains("1") && orString.contains("0"))
            	{
    				orString = "0";
            	}
            	else if(orString.contains("0") && !orString.contains("1"))
            	{
            		orString = "0";
            	}
            	else
            	{
            		orString = "1";
            	}
    		}
    		
    		
    		return orString;
		}
		else
		{
			String output = evaluateToken(fnxn);
			return output;
		}
		
	}
	
	private static String evaluateToken(String inputFunction) 
	{		
		StringTokenizer terms = new StringTokenizer(inputFunction, "+");
		int ctr = 1;	
		int tkn = terms.countTokens();	

		String[] nd = new String[tkn]; 
		
		while(terms.hasMoreTokens())
        {
        	String token = terms.nextToken();
        	String ans = "";
        	
        	if(token.length() == 1)
        	{
        		ans = token;
        	}
        	
        	if(token.contains("'"))
        	{
        		if(token.length() == 2)
        		{
        			String p = token.substring(0,1);       		
            		p = convertToCompliment(p);
            		String sub = token.substring(0,1).replaceFirst(token.substring(0,1),p);
           		        		
            		ans = sub;
        		}
        	}

        	for(int index = token.indexOf("'"); index >= 0; index = token.indexOf("'", index + 1))
        	{

        		
        		String comp = token.substring(index-1,index);       		
        		String rest = token.substring(index+1);
        		comp = convertToCompliment(comp);
        		String sub = token.substring(index-1,index).replaceFirst(token.substring(index-1,index),comp);
       		        		
        		if((index-1) != 0)
        		{	
        			String before = token.substring(0, index-1);
            		token = before.concat(sub.concat(rest));
        		}
        		else
        		{
        			token = sub.concat(rest);
        		}
        	}
        	
        	System.out.println("FINAL NEW TOKEN: " + token);
        	
        	for(int i = 0; i < (token.length() - 1); i++)
    		{
    			String s1 = token.substring(i, i + 1);
    			String s2 = token.substring(i + 1, i + 2);
    			
    			if(s1.equals("1") && s2.equals("1"))
    			{
    				ans += "1";
    			}
    			else
    			{
    				ans += "0";
    			}
    			
    			
    			
    		}
        	
        	
        	if(ans.contains("1") && ans.contains("0"))
        	{
        		ans = "0";
        	}
        	else if(ans.contains("0") && !ans.contains("1"))
        	{
        		ans = "0";
        	}
        	else
        	{
        		ans = "1";
        	}
        	
        	
        	nd[ctr-1] = ans;
        	ctr++;
        }
		
		StringBuilder builder = new StringBuilder();
		for(String s : nd) 
		{
		    builder.append(s);
		}
		String orString = builder.toString();
		
		
		
		//evaluate: OR
		if(orString.contains("1") && orString.contains("0"))
		{
			orString = "1";
		}
		else if(orString.contains("0") && !orString.contains("1"))
		{
			orString = "0";
		}
		else
		{
			orString = "1";
		}
		
		
		
		return orString;
	}
	
	private static String convertToCompliment(String ch1){
		
		if(ch1.equals("1")){
			ch1 = "0";
		}
		else if(ch1.equals("0")){
			ch1 = "1";
		}
		
		return ch1;
	}
	
 %>

<%
		
	Enumeration parameters = request.getParameterNames();
	
	flipFlopFunctions = new ArrayList<String>();

	while( parameters.hasMoreElements() ){
		String parameterName = parameters.nextElement().toString();

		if(parameterName.equals("numberOfInput")){
			numberOfInput = Integer.parseInt(request.getParameter(parameterName));
		}
		else if(parameterName.equals("flipFlop")){
			flipFlopType = request.getParameter(parameterName);
		}
		else if(parameterName.equals("outputFunction")){
			outputFunction = request.getParameter(parameterName);
			hasOutput = true;
		}
		else if(parameterName.equals("secondFlipFlop")){
			if(request.getParameter(parameterName).equals("0")){
				numberOfFlipFlops = 1;
			}
			else{
				numberOfFlipFlops = 2;
			}
		}
		else{
			flipFlopFunctions.add( parameterName.substring(0,2) + " = " + request.getParameter(parameterName));
		}
		
	}
	
	headerTableHTML = 
		"<tr>" +
		"<th colspan='2'>Present State</th>" +
		"<th colspan='2'>Input</th>" + 
		"<th colspan='4'>Flip-flop Inputs</th>" +
		"<th colspan='2'>Next State</th>";
	if(hasOutput){
		headerTableHTML += "<th rowspan='2'>Output</th>"; 
	}
	headerTableHTML += "</tr>";
	
	if(numberOfFlipFlops == 1){
		
		headerTableHTML += 
			"<tr>" + 
			"<th colspan='2'>A</th>";
		
		if(numberOfInput == 1){
			headerTableHTML += "<th colspan='2'>X</th>";
			if(numberOfFlipFlops == 2){
				numberOfRows = 8;
				binaryLength = 3;
			}else{
				numberOfRows = 4;
				binaryLength = 2;
			}
		}else{
			headerTableHTML += 
				"<th>X</th>" +
				"<th>Y</th>";
			if(numberOfFlipFlops == 2){
				numberOfRows = 16;
				binaryLength = 4;
			}else{
				numberOfRows = 8;
				binaryLength = 3;
			}
		}
		
		if(flipFlopType.equals("d")){
			headerTableHTML += "<th colspan='4'>DA</th>";
		}else if(flipFlopType.equals("t")){
			headerTableHTML += "<th colspan='4'>TA</th>";
		}else if(flipFlopType.equals("rs")){
			headerTableHTML += 
				"<th colspan='2'>RA</th>" +
				"<th colspan='2'>SA</th>";
		}else{
			headerTableHTML += 
				"<th colspan='2'>JA</th>" +
				"<th colspan='2'>KA</th>";
		}
		
		headerTableHTML += "<th colspan='2'>A</th>";
		headerTableHTML += "</tr>";
		
	}
	else{
	
		headerTableHTML += 
			"<tr>" + 
			"<th>A</th>" +
			"<th>B</th>";
		
		if(numberOfInput == 1){
			headerTableHTML += "<th colspan='2'>X</th>";
			if(numberOfFlipFlops == 2){
				numberOfRows = 8;
				binaryLength = 3;
			}else{
				numberOfRows = 4;
				binaryLength = 2;
			}
		}else{
			headerTableHTML += 
				"<th>X</th>" +
				"<th>Y</th>";
			if(numberOfFlipFlops == 2){
				numberOfRows = 16;
				binaryLength = 4;
			}else{
				numberOfRows = 8;
				binaryLength = 3;
			}
		}
		
		if(flipFlopType.equals("d")){
			headerTableHTML += 
				"<th colspan='2'>DA</th>" +
				"<th colspan='2'>DB</th>";
		}else if(flipFlopType.equals("t")){
			headerTableHTML += 
				"<th colspan='2'>TA</th>" +
				"<th colspan='2'>TB</th>";
		}else if(flipFlopType.equals("rs")){
			headerTableHTML += 
				"<th>RA</th>" +
				"<th>SA</th>" + 
				"<th>RB</th>" +
				"<th>SB</th>";
		}else{
			headerTableHTML += 
				"<th>JA</th>" +
				"<th>KA</th>" + 
				"<th>JB</th>" +
				"<th>KB</th>";
		}
		
		headerTableHTML += 
			"<th>A</th>" +
			"<th>B</th>";
		headerTableHTML += "</tr>";
	}
	
	
	
	
%>
<!doctype>
<html>
	<head>
		<title> <%= flipFlopType.toUpperCase() %> Flip-flop Function Tabulator </title>
		
		<link rel='stylesheet' href='./css/normalize.css' />
		<link rel='stylesheet' href='./css/main.css' />
		
	</head>
	<body class='table'>
	
		<h1> <%= flipFlopType.toUpperCase() %> Flip-flop Function Tabulator </h1>
	
		<table>
			
			<%= headerTableHTML %>
		
			<%
			
				String 
						DA = "", DB = "",
						TA = "", TB = "",
						RA = "", RB = "",
						SA = "", SB = "",
						JA = "", JB = "",
						KA = "", KB = "";
				String 
						da = "", db = "",
						ta = "", tb = "",
						ra = "", rb = "",
						sa = "", sb = "",
						ja = "", jb = "",
						ka = "", kb = "";
				
					for(int j = 0; j < flipFlopFunctions.size(); j++){
						
						String flipFlopFunction = flipFlopFunctions.get(j);
						String temp = flipFlopFunction.substring(0,2);
						flipFlopFunction = flipFlopFunction.substring(4).trim();
						
						if(temp.equals("DA")){ DA = flipFlopFunction; }
						else if(temp.equals("DB")){ DB = flipFlopFunction; }
						else if(temp.equals("TA")){ TA = flipFlopFunction; }
						else if(temp.equals("TB")){ TB = flipFlopFunction; }
						else if(temp.equals("RA")){ RA = flipFlopFunction; }
						else if(temp.equals("RB")){ RB = flipFlopFunction; }
						else if(temp.equals("SA")){ SA = flipFlopFunction; }
						else if(temp.equals("SB")){ SB = flipFlopFunction; }
						else if(temp.equals("JA")){ JA = flipFlopFunction; }
						else if(temp.equals("JB")){ JB = flipFlopFunction; }
						else if(temp.equals("KA")){ KA = flipFlopFunction; }
						else{ KB = flipFlopFunction; }
						
					}
			
				for(int i = 0; i < numberOfRows; i++){
					
					String binaryString = Integer.toBinaryString(i);
					int numberOfZeroes = binaryLength - binaryString.length();
					
					for(int j = 0; j < numberOfZeroes; j++){
						binaryString = 0 + binaryString;
					}
					
					String presentA = binaryString.substring(0,1);
					String presentB = "", inputX = "", inputY = "";
					
					if(numberOfFlipFlops == 2){
						presentB = binaryString.substring(1,2);
						inputX = binaryString.substring(2,3);
						if(binaryString.length() == 4){
							inputY = binaryString.substring(3,4);
						}
					}else{
						inputX = binaryString.substring(1,2);
						if(binaryString.length() == 3){
							inputY = binaryString.substring(2,3);
						}
					}
						
					rowHTML = "<tr>";
					
					if(numberOfFlipFlops == 2){
						rowHTML += 
							"<td>" + presentA + "</td>" +
							"<td>" + presentB + "</td>";
					}else{
						rowHTML += "<td colspan='2'>" + presentA + "</td>";
					}
					
					if(numberOfInput == 1){
						rowHTML += "<td colspan='2'>" + inputX + "</td>";
					}else{
						rowHTML += "<td>" + inputX + "</td>";
						rowHTML += "<td>" + inputY + "</td>";
					}
				
					if(flipFlopType.equals("d")){
						
						if(numberOfFlipFlops == 2){
							
							rowHTML += "<td colspan='2'>";
							
							da = functionEvaluator(DA, presentA, presentB, inputX, inputY);
							rowHTML += da;
							
							rowHTML += "</td>";
							rowHTML += "<td colspan='2'>";
							
							db = functionEvaluator(DB, presentA, presentB, inputX, inputY);
							rowHTML += db;
							
							rowHTML += "</td>";
							
						}
						else{
							rowHTML += "<td colspan='4'>";
							
							da = functionEvaluator(DA, presentA, presentB, inputX, inputY);
							rowHTML += da;
							
							rowHTML += "</td>";
						}
						
					}else if(flipFlopType.equals("t")){
					
						if(numberOfFlipFlops == 2){
							
							rowHTML += "<td colspan='2'>";
							
							ta = functionEvaluator(TA, presentA, presentB, inputX, inputY);
							rowHTML += ta;
							
							rowHTML += "</td>";
							rowHTML += "<td colspan='2'>";
							
							tb = functionEvaluator(TB, presentA, presentB, inputX, inputY);
							rowHTML += tb;
							
							rowHTML += "</td>";
						}
						else{
							
							rowHTML += "<td colspan='4'>";
							
							ta = functionEvaluator(TA, presentA, presentB, inputX, inputY);
							rowHTML += ta;
							
							rowHTML += "</td>";
						}
						
					}else if(flipFlopType.equals("rs")){
					
						if(numberOfFlipFlops == 2){
							rowHTML += "<td>";
							
							ra = functionEvaluator(RA, presentA, presentB, inputX, inputY);
							rowHTML += ra;
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							sa = functionEvaluator(SA, presentA, presentB, inputX, inputY);
							rowHTML += sa;
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							rb = functionEvaluator(RB, presentA, presentB, inputX, inputY);
							rowHTML += rb;
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							sb = functionEvaluator(SB, presentA, presentB, inputX, inputY);
							rowHTML += sb;
							
							rowHTML += "</td>";
						}
						else{
							rowHTML += "<td colspan='2'>";
							
							ra = functionEvaluator(RA, presentA, presentB, inputX, inputY);
							rowHTML += ra;
							
							rowHTML += "</td>";
							rowHTML += "<td colspan='2'>";
							
							sa = functionEvaluator(SA, presentA, presentB, inputX, inputY);
							rowHTML += sa;
							
							rowHTML += "</td>";
						}
						
					}else{
					
						if(numberOfFlipFlops == 2){
							rowHTML += "<td>";
							
							ja = functionEvaluator(JA, presentA, presentB, inputX, inputY);
							rowHTML += ja;
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							ka = functionEvaluator(KA, presentA, presentB, inputX, inputY);
							rowHTML += ka;
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							jb = functionEvaluator(JB, presentA, presentB, inputX, inputY);
							rowHTML += jb;
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							kb = functionEvaluator(KB, presentA, presentB, inputX, inputY);
							rowHTML += kb;
							
							rowHTML += "</td>";
						}
						else{
							rowHTML += "<td colspan='2'>";
							
							ja = functionEvaluator(JA, presentA, presentB, inputX, inputY);
							rowHTML += ja;
							
							rowHTML += "</td>";
							rowHTML += "<td colspan='2'>";
							
							ka = functionEvaluator(KA, presentA, presentB, inputX, inputY);
							rowHTML += ka;
							
							rowHTML += "</td>";
						}						
					}
					
					
					if(flipFlopType.equals("d")){
						
						if(numberOfFlipFlops == 2){

							rowHTML += "<td>";
							
							rowHTML += DNextStateEvaluator(da);
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							rowHTML += DNextStateEvaluator(db);
							
							rowHTML += "</td>";
						
						}
						else{
						
							rowHTML += "<td colspan='2'>";
							
							rowHTML += DNextStateEvaluator(da);
							
							rowHTML += "</td>";
						
						}
					
					}
					else if(flipFlopType.equals("t")){
						
						if(numberOfFlipFlops == 2){
						
							rowHTML += "<td>";
							
							rowHTML += TNextStateEvaluator(ta, presentA);
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							rowHTML += TNextStateEvaluator(tb, presentB);
							
							rowHTML += "</td>";
						
						}
						else{
						
							rowHTML += "<td colspan='2'>";
							
							rowHTML += TNextStateEvaluator(ta, presentA);
							
							rowHTML += "</td>";
						
						}
					
					}
					else if(flipFlopType.equals("rs")){
						
						if(numberOfFlipFlops == 2){
						
							rowHTML += "<td>";
							
							rowHTML += RSNextStateEvaluator(ra, sa, presentA);
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							rowHTML += RSNextStateEvaluator(rb, sb, presentB);
							
							rowHTML += "</td>";
						
						}
						else{
						
							rowHTML += "<td colspan='2'>";
							
							rowHTML += RSNextStateEvaluator(ra, sa, presentA);
							
							rowHTML += "</td>";
						
						}
					
					}
					else{
						
						if(numberOfFlipFlops == 2){
						
							rowHTML += "<td>";
							
							rowHTML += JKNextStateEvaluator(ja, ka, presentA);
							
							rowHTML += "</td>";
							rowHTML += "<td>";
							
							rowHTML += JKNextStateEvaluator(jb, kb, presentB);
							
							rowHTML += "</td>";
						
						}
						else{
						
							rowHTML += "<td colspan='2'>";
							
							rowHTML += JKNextStateEvaluator(ja, ka, presentA);
							
							rowHTML += "</td>";
						
						}
					
					}
					
					
					if(hasOutput){
						
						rowHTML += "<td>";
						
						rowHTML += functionEvaluator(outputFunction, presentA, presentB, inputX, inputY);
						
						rowHTML += "</td>";
						
					}
					
					rowHTML += "</tr>";
					
					%>
						<%= rowHTML %>
					<%
				}
			%>
		
		</table>
	
	</body>
</html>