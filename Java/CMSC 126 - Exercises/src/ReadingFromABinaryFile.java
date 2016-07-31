import java.io.DataInputStream;
import java.io.FileInputStream;
import java.io.IOException;

public class ReadingFromABinaryFile {

	public static void main(String[] args) throws IOException{
		
		DataInputStream input = new DataInputStream(new FileInputStream("student.dat"));
		int x = input.readInt();
		
		System.out.println("List of numbers: ");
		while(x >= 0){
			System.out.println(x);
			x = input.readInt();
		}
		
		input.close();
	}

}
