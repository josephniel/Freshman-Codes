package Calculator;

public class nonNumber{

	private String input,answer;
	private int indicator;
	
	public nonNumber(String input, int indicator) {
		this.input = input;
		this.indicator = indicator;
	}

	public String calculate() {
		
		if(indicator == 1){
			input = input.substring(4);
			answer = String.valueOf(Math.abs(Double.parseDouble(input)));
		}
		else if(indicator == 2){
			input = input.substring(0,input.length()-1);
			Double doubleInput = Double.parseDouble(input);
			Double doubleAnswer = 1.0;
			while(doubleInput > 0){
				doubleAnswer = doubleAnswer * doubleInput;
				doubleInput = doubleInput - 1;
			}
			answer = String.valueOf(doubleAnswer);
		}
		else if(indicator == 3){
			answer = String.valueOf(Math.sqrt(Double.parseDouble(input)));
		}
		else if(indicator == 4){
			input = input.substring(4);
			answer = String.valueOf(Math.log10(Double.parseDouble(input)));
		}
		else if(indicator == 5){
			input = input.substring(3);
			answer = String.valueOf(Math.log(Double.parseDouble(input)));
		}
		else if(indicator == 6){
			input = input.substring(4);
			answer = String.valueOf(Math.sin(Double.parseDouble(input)));
		}
		else if(indicator == 7){
			input = input.substring(4);
			answer = String.valueOf(Math.cos(Double.parseDouble(input)));
		}
		else if(indicator == 8){
			input = input.substring(4);
			answer = String.valueOf(Math.tan(Double.parseDouble(input)));
		}
		return answer;
	}
	
	
	
}