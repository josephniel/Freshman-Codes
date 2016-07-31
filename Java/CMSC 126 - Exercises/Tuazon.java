import java.io.*;
import java.util.StringTokenizer;

public class Tuazon {
	
	public static void main(String[] args){

		try{
			System.out.print("Input the word to search: ");
			
			BufferedReader buffer = new BufferedReader(new InputStreamReader(System.in));
			String word = buffer.readLine();
			
			word = word.trim();
			
			if(word.contains(" ")){
				System.out.println("Please enter one word only!");
			}
			else{
				wordSearch(word);
			}
		} 
		catch (IOException e) {
			System.err.println("An error occured while reading the file.");
		}
	}
	
	private static void wordSearch(String word) {
		
		try{
			int indicator = 0;
			
			BufferedReader inputStream = new BufferedReader(new FileReader("out.txt"));
			String line = inputStream.readLine();
			String newLine = line;
			
			line = wordFormat(line);
			
			while(line != null){
				StringTokenizer token = new StringTokenizer(line);
				while(token.hasMoreTokens()){
					String current = token.nextToken();
					if(current.toLowerCase().equals(word.toLowerCase())){
						System.out.println(newLine);
						indicator = 1;
					}
				}
				line = inputStream.readLine();
				if(line != null)
					line = wordFormat(line);
				newLine = line;
			}
			if(indicator == 0){
				System.out.println("The word " + word + " was not found.");
			}
			inputStream.close();
		}
		catch(FileNotFoundException e){
			e.printStackTrace();
		}
		catch(IOException e){
			System.err.println("An error occured while reading the file.");
		}
		
	}

	private static String wordFormat(String line) {
		
		String[] punctuations = {".", ",", "?", "!", ":", "\"", ")", "(", "@", "#", "$", "%", "^", "&", "*", ";", "\'", "<", ">", "/", "\\", "|", "+", "=", "_", "-"};
		
		String returnString = new String();
		
		StringTokenizer token = new StringTokenizer(line);
		while(token.hasMoreTokens()){
			String current = token.nextToken();
			for(int i = 0; i < punctuations.length; i++){
				if(current.substring(0, 1).equals(punctuations[i])){
					current = current.substring(1);
				}
				if(current.substring(current.length() - 1, current.length()).equals(punctuations[i])){
					current = current.substring(0,current.length()-1);
				}
			}
			returnString = returnString + current + " ";
		}
		
		return returnString;
	}
}
