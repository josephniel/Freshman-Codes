package Diagonal;

public class Diagonal {
	
	public static void main(String[] args){
		
		for(int i = 1, j = 0; j < 500; i = i+2, j++){
			System.out.print(i*(i+1));
			if(j!=499)
				System.out.print(", ");
		}
	}
}
