/**
 * Infix to Postfix Converter:
 * A program that converts infix operations 
 * to postfix operations. program is based 
 * on the algorithm given at the lecture 
 * on CMSC 123 about stacks.
 * 
 * @author Joseph Niel Tuazon
 * 
 * Created Sunday, June 14, 2013,  
 * 
 */
package Stacks;

import java.util.ArrayList;
import java.util.Scanner;
import java.util.StringTokenizer;

public class InfixToPostfix {
	
	public static int getPriority(String current, String stackTop){
		
		int icp = 0;
		int isp = 0;
		
		switch(current){
			case "+":
			case "-":
				icp = 1;
				break;
			case "*":
			case "/":
				icp = 3;
			case "^":
				icp = 6;
			default:
				break;
		}
		switch(stackTop){
			case "+":
			case "-":
				isp = 2;
				break;
			case "*":
			case "/":
				isp = 4;
			case "^":
				isp = 5;
			case "(":
				isp = 0;
			default:
				break;
		}
		
		if(icp < isp){
			return 1;
		}
		else{
			return 0;
		}
		
	}
	
	public static void convertInfix(String infix){
		
		StringTokenizer tokens = new StringTokenizer(infix);
		Stack stack = new ArrayStack();
		
		ArrayList<String> operators = new ArrayList<String>();
		
		operators.add("+"); operators.add("-"); operators.add("*"); 
		operators.add("/"); operators.add("^"); operators.add("(");
		operators.add(")");
		
		while(tokens.hasMoreElements()){
			
			String token = tokens.nextToken().toString();
			
			if(!operators.contains(token)){
				System.out.print(token + " ");
			}
			else if(token.equals("(")){
				stack.push(token);
			}
			else if(token.equals(")")){
				while(!stack.top().toString().equals("(")){
					if(!stack.isEmpty())
						System.out.print(stack.pop() + " ");
				}
				if(stack.top().toString().equals("("))
					stack.pop();
			}
			else{
				
				int x = 0;
				
				if(!stack.isEmpty())
					x = getPriority(token,stack.top().toString());
				
				if(x == 0)
					stack.push(token);
				else if(x == 1){
					x = getPriority(token,stack.top().toString());
					while(!stack.isEmpty())
						System.out.print(stack.pop() + " ");
				}
					
			}
			
		}
		
		while(!stack.isEmpty())
			System.out.print(stack.pop() + " ");
		
	}
	
	public static void main(String[] args) {
		System.out.print("Input any infix operations: ");
		Scanner input = new Scanner(System.in);

		String x = input.nextLine();
		input.close();
		
		convertInfix(x);
	}
	
}
