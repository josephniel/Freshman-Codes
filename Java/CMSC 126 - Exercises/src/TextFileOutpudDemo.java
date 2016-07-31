import java.io.*;

public class TextFileOutpudDemo {

	public static void main(String[] args) throws IOException {
		
		BufferedReader buffer = new BufferedReader(new InputStreamReader(System.in));
		PrintWriter outputStream = null;
		
		try{
			outputStream = new PrintWriter(new FileOutputStream("out.txt"));
			System.out.println("Enter 3 lines of text.");
				String line = buffer.readLine();
				outputStream.println(line);
			outputStream.close();
			System.out.println("Those lines were written to out.txt");
		}
		catch(FileNotFoundException e){
			System.out.println("May Error daw");
		} 
		catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
}
