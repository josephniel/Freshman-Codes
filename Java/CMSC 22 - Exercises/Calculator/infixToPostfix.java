package Calculator;
import java.util.ArrayList;
import java.util.Stack;

class infixToPostfix{
	
	Stack<String> stack;
	ArrayList<String> operators;
	
	String postFix;
	
	int[] operand = {-2, -2};
	int[] plusorminus = {1,2};
	int[] timesordivide = {3,4};
	int[] raiseto = {6,5};
	int[] openparenthesis = {-2,0};
	
	public infixToPostfix(String infix) {
		
		infix = infix.replace('*', 'x');
		
		stack = new Stack<String>();
		operators = new ArrayList<String>();
	
		operators.add("+");
		operators.add("-");
		operators.add("x");
		operators.add("/");
		operators.add("^");
		operators.add("(");
		operators.add(")");
	
		postFix = new String();
	
		int capacity;
	
		if(infix.contains("(") || infix.contains(")"))
			capacity = 0;
		else
			capacity = 1;
	
		while(infix.length() > capacity){
		
			String operator = new String();
		
			if(!operators.contains(infix.substring(0, 1))){
				postFix = postFix + infix.substring(0,1);
				infix = infix.substring(1);
			}	
			else if(operators.get(5).equals(infix.substring(0, 1))){
				stack.push(infix.substring(0, 1));
				infix = infix.substring(1);
			}
			else if(operators.get(6).equals(infix.substring(0, 1))){
				while(!stack.peek().equals("("))
					postFix = postFix + " " + stack.pop();
				stack.pop();
				infix = infix.substring(1);
			}
			else{
				operator = infix.substring(0,1);
			
				int[] current = getICPandISP(operator);
			
				if(!stack.isEmpty()){
					int[] top = getICPandISP(stack.peek());
					while(current[0] < top[1] && !stack.isEmpty()){
						postFix = postFix + " " + stack.pop();
						if(!stack.isEmpty())
							top = getICPandISP(stack.peek());
					}
				}
				stack.push(operator);
				infix = infix.substring(1);
				postFix = postFix + " ";
			}
		}
		postFix = postFix + infix;
	
		while(!stack.isEmpty())
			postFix = postFix + " " + stack.pop();
		
	}
	
	public String toString(){
		return postFix;
	}
	
	public int findRank(){
		int r = 0;
		String postFix = this.postFix;
		
		while(postFix.length() > 0){
			String token = postFix.substring(0, 1);
			postFix = postFix.substring(1);
			r = r + getRank(token);
		}
		return r;
	}
	
	private int[] getICPandISP(String operator){
		if(operator.equals("+") || operator.equals("-"))
			return plusorminus;
		else if(operator.equals("x") || operator.equals("/"))
			return timesordivide;
		else if(operator.equals("^"))
			return raiseto;
		else
			return openparenthesis;
	}
	
	private int getRank(String token){
		if(operators.get(5).equals(token))
			return -2;
		else if(operators.get(6).equals(token))
			return 2;
		else if(operators.contains(token))
			return -1;
		else
			return 1;
	}
	
	public String calculate(){
		
		stack = new Stack<String>(); 
		
		String[] tokens = postFix.split(" ");
		
		for(String i : tokens){
			
			if(!operators.contains(i)){
				stack.push(i);
			}
			else{
				double second = Double.parseDouble(stack.pop());
				double first = Double.parseDouble(stack.pop());
				
				if(operators.get(0).equals(i))
					stack.push(String.valueOf(first + second));
				else if(operators.get(1).equals(i))
					stack.push(String.valueOf(first - second));
				else if(operators.get(2).equals(i))
					stack.push(String.valueOf(first * second));
				else if(operators.get(3).equals(i))
					stack.push(String.valueOf(first / second));
				else if(operators.get(4).equals(i))
					stack.push(String.valueOf(Math.pow(first, second)));
			}
			
		}
		
		return stack.pop();
	}

}

class infixToPostfixWithNonNumbers{

	public infixToPostfixWithNonNumbers(String infix, String stack) {
		
	}
	
}
