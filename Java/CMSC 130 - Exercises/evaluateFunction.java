import java.util.Scanner;
import java.util.StringTokenizer;


public class evaluateFunction
{
	private String inputFunction;
	
	public evaluateFunction(String inputFunction)
	{
		this.inputFunction = inputFunction;
	}
	
	public void evaluateInputFunction(String presentA, String presentB, String presentX, String presentY)
	{
		inputFunction = inputFunction.replaceAll("A", presentA);
		inputFunction = inputFunction.replaceAll("B", presentB);
		inputFunction = inputFunction.replaceAll("X", presentX);
		inputFunction = inputFunction.replaceAll("Y", presentY);
		
		for(int index = inputFunction.indexOf("("); index >= 0; index = inputFunction.indexOf("(", index + 1))
		{
		    System.out.println("Open P. = " + index);
		}
		
		for(int index2 = inputFunction.indexOf(")"); index2 >= 0; index2 = inputFunction.indexOf(")", index2 + 1))
		{
		    System.out.println("Close P. = " + index2);
		}
		
		
		
		System.out.println("FUNCTION: " + inputFunction);
		
		StringTokenizer terms = new StringTokenizer(inputFunction, "+");
		int ctr = 1;	
		int tkn = terms.countTokens();	

		String[] nd = new String[tkn]; 
		
		while(terms.hasMoreTokens())
        {
			System.out.println("TERM " + ctr + "------------------------------------------------");
        	String token = terms.nextToken();
        	String ans = "";
        	
        	if(token.length() == 1)
        	{
        		ans = token;
        	}

        	for(int index = token.indexOf("'"); index >= 0; index = token.indexOf("'", index + 1))
        	{
        		System.out.println("TOKEN: " + token);
        		
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
    			
    			System.out.println(s1 + " * " + s2 + " = " + ans);
    			
    		}
        	
        	//evaluate: AND
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
        	
        	System.out.println("TERM " + ctr + " FINAL: " + ans);
        	
        	nd[ctr-1] = ans;
        	ctr++;
        }
		
		StringBuilder builder = new StringBuilder();
		for(String s : nd) 
		{
		    builder.append(s);
		}
		String orString = builder.toString();
		
		System.out.println("ARRAY: " + orString);
		
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
		
		System.out.println("FINAL ANSWER: " + orString);
	}
	
	private String convertToCompliment(String ch1)
	{
		if(ch1.equals("1"))
		{
			ch1 = "0";
		}
		else if(ch1.equals("0"))
		{
			ch1 = "1";
		}
		
		return ch1;
	}

	public static void main(String[] args)
	{
		System.out.println("FUNCTION: ");
		
		Scanner input = new Scanner(System.in);
		String func = input.nextLine();
				
		evaluateFunction evaluator = new evaluateFunction(func);
		
		String valueA = "1";
		String valueB = "0";
		String valueX = "0";
		String valueY = "";
		evaluator.evaluateInputFunction(valueA, valueB, valueX, valueY);
	}
}
