import java.util.Scanner;
import java.util.StringTokenizer;

public class TabulationMethod{
	
	public TabulationMethod(){
		
	}
	
	public static String convertToBin(int dec){
		return Integer.toBinaryString(dec);
	}
	
	public static void countVar(int[] inp){
		
	}
	
	public static void main(String[] args){
		
		System.out.print("Input: ");
		
		Scanner input = new Scanner(System.in);
		String inp1 = input.nextLine();
		String inp2 = inp1.trim();
		
		String bin;
		int ctr = 0, num = 0, len = 0, ar = 0;
		
		StringTokenizer tokens = new StringTokenizer(inp2, ",");

       	ar = tokens.countTokens();
		String[] arr = new String[ar];
		
        while(tokens.hasMoreTokens()){
        	String token = tokens.nextToken();
        	String output = token.trim();
        	
        	num = Integer.parseInt(output);
        	bin = convertToBin(num);
        	
        	if(len < bin.length())
        	{
        		len = bin.length();
        	}
        	
        	arr[ctr] = bin;
        	ctr++;
        	
        	System.out.println(ctr + ")" + num);
        }
        
        for(int n = 0; n < arr.length; n++){
        	if(arr[n].length() < len){
        		int arrlen = arr[n].length();
        		for(int ln = 0; ln < (len - arrlen); ln++){
            		String z = "0";
            		arr[n] = z + arr[n];
            	}
        	}
        	System.out.println((n + 1) + ") Binary: " + arr[n]);
        }        
        input.close();
	}
}
