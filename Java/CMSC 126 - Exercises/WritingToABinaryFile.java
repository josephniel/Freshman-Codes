import java.io.DataOutputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.Scanner;

public class WritingToABinaryFile {

	public static void main(String[] args) throws IOException{
		
		DataOutputStream output = new DataOutputStream(new FileOutputStream("student.dat"));
		Scanner input = new Scanner(System.in);
		
		System.out.println("Input any number (input negative number to terminate):");
		int x = input.nextInt();
		
		while(x >= 0){
			output.writeInt(x);
			x = input.nextInt();
		}
		
		output.writeInt(-1);
		
		input.close();
		output.close();
	}
}
