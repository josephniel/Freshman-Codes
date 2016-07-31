import java.io.*;

public class TextFileInputDemo {

	public static void main(String[] args) {
		try{
			BufferedReader inputStream = new BufferedReader(new FileReader("out.txt"));
			System.out.println("Here are the contents of out txt file.");
			String line = null;
			
			for(int i = 1; i <= 3; i++){
				line = inputStream.readLine();
				System.out.println(line);
			}
			inputStream.close();
		}
		catch(FileNotFoundException e){
			System.out.println("error");
		}
		catch(IOException e){
			System.out.println("error");
		}
	}

}
