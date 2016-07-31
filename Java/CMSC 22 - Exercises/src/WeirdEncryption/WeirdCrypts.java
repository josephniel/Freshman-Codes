/*
 * WeirdCrypts Program by Joseph Niel Tuazon
 * Created July 30, 2013, Tuesday, 2:04 PM
 * 
 * */

package WeirdEncryption;

import java.util.ArrayList;
import java.util.Scanner;
import java.util.StringTokenizer;

public class WeirdCrypts {
		
	private static WeirdCrypts function = new WeirdCrypts();
	
	private static char[] alphabet = {'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'};
	private static char[][] tableau = new char[27][27];
	
	private static ArrayList<Integer> primeNumbers = new ArrayList<Integer>();
	
	private static ArrayList<Integer> spaces;
	private static ArrayList<Integer> capitals;
	
	public void VigenereTableau(){
		
		for(int j = 0; j < 26; j++)
			for(int i = 0; i < 26 - j; i++)
				tableau[i][j] = alphabet[i+j];
		
		for(int j = 0; j < 26; j++)
			for(int i = 26 - j, k = 0; i < 26; i++, k++)
				tableau[i][j] = alphabet[k];
	}
	
	public void primeNumberGenerator(){
		
		ArrayList<Integer> compositeNumbers = new ArrayList<Integer>();
		
		int upperLimit = 2000;
		
		for(int x = 4; x <= upperLimit; x++){ 
			int repeatIndicator = 0;
			for(int y = 2; y < x; y++){
				if(x%y == 0 && repeatIndicator == 0){
					compositeNumbers.add(x);
					repeatIndicator = 1;
				}		
			}
		}
			
		for(int x = 3; x < upperLimit; x++)
			if(!compositeNumbers.contains(x))
				primeNumbers.add(x);
		
	}
	
	public char[] newKey(char[] key, int length){
		
		String newKey = String.copyValueOf(key);
		
		while(newKey.length() < length)
			newKey = newKey.concat(newKey);
		
		newKey = newKey.replaceAll("\\s", "");
		
		for(int i = 0; i < length; i++){
			if(spaces.contains(i)){
				String left = newKey.substring(0, i);
				String right = newKey.substring(i);
				newKey = left.concat(" ").concat(right);
			}
		}
		newKey = newKey.substring(0, length);
		return newKey.toCharArray();
	}

	public char getEquivalentLetter(char message, char key, int a){
		
		if(a == 0){
			int m = 0, k = 0;
			
			ArrayList<Character> alpha = new ArrayList<Character>();
			
			for(int i = 0; i < 26; i++)
				alpha.add(alphabet[i]);
			
			if(alpha.contains(message)){
				int indicator = 0;
				for(int i = 0; indicator != 1; i++){
					if(message == alphabet[i]){
						m = i;
						indicator = 1;
					}
				}
				indicator = 0;
				for(int i = 0; indicator != 1; i++){
					if(key == alphabet[i]){
						k = i;
						indicator = 1;
					}
				}
				return tableau[m][k];
			}
			else{
				return message;
			}
		}
		else{
			int k = 0, m = 0;
			
			ArrayList<Character> alpha = new ArrayList<Character>();
			
			for(int i = 0; i < 26; i++)
				alpha.add(alphabet[i]);
			
			if(alpha.contains(message)){
				int indicator = 0;
				for(int i = 0; indicator != 1; i++){
					if(key == alphabet[i]){
						k = i;
						indicator = 1;
					}
				}
				indicator = 0;
				for(int i = 0; indicator != 1; i++){
					if(message == tableau[k][i]){
						m = i;
						indicator = 1;
					}
				}
				return alphabet[m];
			}
			else{
				return message;
			}
		}
		
	}
	
	public char[] crypt(String message, String key, int a){
		
		message = message.replaceAll("\\s", " ");
		
		int length = message.length();
		
		char[] messageContainer = message.toCharArray();
			capitals = new ArrayList<Integer>();
			spaces = new ArrayList<Integer>();
		
			for(int i = 0; i < messageContainer.length; i++)
				if(messageContainer[i] == ' ')
					spaces.add(i);
		
			for(int i = 0; i < length; i++)
				if(Character.isUpperCase(messageContainer[i]))
					capitals.add(i);
		
		char[] newMessageContainer = String.copyValueOf(messageContainer).toLowerCase().toCharArray();
		
		char[] keyContainer = key.toCharArray();
			keyContainer = function.newKey(keyContainer, length);
			
		char[] cryptedMessage = new char[length];
			for(int i = 0; i < length; i++)
				cryptedMessage[i] = function.getEquivalentLetter(newMessageContainer[i], keyContainer[i], a);
			
		return cryptedMessage;
	}
	
	public String capitalize(char[] message){
		
		String newMessage = String.copyValueOf(message);
		
		for(int i = 0; i < message.length; i++)
			if(capitals.contains(i))
				if(i!=0){
					String left = newMessage.substring(0, i);
					String middle = newMessage.substring(i, i+1);
					String right = newMessage.substring(i+1);
					newMessage = left.concat(middle.toUpperCase()).concat(right);
				}
				else{
					String left = newMessage.substring(0, 1);
					String right = newMessage.substring(i+1);
					newMessage = left.toUpperCase().concat(right);
				}
		return newMessage;
	}
	
	public String secondEncryption(String message){
		
		ArrayList<Integer> diagonal = new ArrayList<Integer>();
		
		for(int i = 1, j = 0; j < 500; i = i+2, j++){
			diagonal.add(i*(i+1)); 
		}
		
		StringTokenizer tokens = new StringTokenizer(message);
		
		String inverted = new String();
		for(int i = 0; tokens.hasMoreElements(); i++){
			
			String word = tokens.nextToken().toString();
			
			if(diagonal.contains(i+1)){
				
				if(word.length() % 2 != 0){
					String newWord = new String();
					while(word.length() != 1){
						String front = word.substring(0,1);
						String back = word.substring(word.length()-1);
						newWord = newWord.concat(front).concat(back);
						word = word.substring(1, word.length()-1);
					}
					inverted = inverted.concat(newWord).concat(word).concat(" ");
				}
				else{
					String newWord = new String();
					while(word.length() != 0){
						String front = word.substring(0,1);
						String back = word.substring(word.length()-1);
						newWord = newWord.concat(front).concat(back);
						word = word.substring(1, word.length()-1);
					}
					inverted = inverted.concat(newWord).concat(" ");
				}
			}
			else{
				inverted = inverted.concat(word).concat(" ");
			}
		}
		
		return inverted;
	}
	
	public String concatinator(String portion, String message){
		
		StringTokenizer otherTokens = new StringTokenizer(portion);
		
		for(int i = 0; i < message.length(); i++){
			if(message.charAt(i) == '~'){
				String left = message.substring(0, i+1);
				String right = message.substring(i+1);
				message = left.concat(otherTokens.nextToken()).concat(right);
			}
		}
		return message;
	}
	
	public String thirdEncryption(String message, String key){
		
		String primeWords = new String();
		String encryptedWords = new String();
		
		StringTokenizer tokens = new StringTokenizer(message);
		String[] words = new String[tokens.countTokens()];
		
		for(int i = 0; tokens.hasMoreElements(); i++){
			
			String word = tokens.nextToken().toString();
			words[i] = word.toLowerCase();
			
			char[] charArray = new char[words[i].length()];
			int value = 0, total = 0;
			
			for(int j = 0;j < words[i].length(); j++){
			    charArray[j] = words[i].charAt(j);
			    for(int k = 0, indicator = 0; k < 26 && indicator != 1; k++){
			    	if(charArray[j] == alphabet[k]){
			    		value = k+1;
			    		indicator = 1;
			    	}
			    }
			    total = total + value;
			}
			
			if(primeNumbers.contains(total)){
				primeWords = primeWords.concat(word).concat(" ");
				encryptedWords = encryptedWords.concat("~").concat(" ");
			}
			else{ encryptedWords = encryptedWords.concat(word).concat(" "); }			
		}
		
		String keyContainer = new String();
		
		for(int i = 0, k = key.length() - 1; i < key.length(); i++, k--)
			keyContainer = keyContainer.concat(String.valueOf(key.charAt(k)));
		
		return function.concatinator(function.capitalize(function.crypt(primeWords, keyContainer, 0)), encryptedWords);
	}
	
	public String weirdEncrypt(String message, String key){
		return function.thirdEncryption(function.secondEncryption(function.capitalize(function.crypt(message, key, 0))), key);
	}
	
	public String firstDecryption(String message, String key){
		
		StringTokenizer tokens = new StringTokenizer(message);
		
		String primeWords = new String();
		String compositeWords = new String();
		
		while(tokens.hasMoreTokens()){
			String token = tokens.nextToken();
			if(token.contains("~")){
				primeWords = primeWords.concat(token).concat(" ");
				compositeWords = compositeWords.concat("~ ");
			}
			else
				compositeWords = compositeWords.concat(token).concat(" ");
		}
		
		primeWords = primeWords.replaceAll("~", "");
		
		String keyContainer = new String();
		
		for(int i = 0, k = key.length() - 1; i < key.length(); i++, k--)
			keyContainer = keyContainer.concat(String.valueOf(key.charAt(k)));
		
		return function.concatinator(function.capitalize(function.crypt(primeWords, keyContainer, 1)), compositeWords).replaceAll("~", "");
	}
	
	public String secondDecryption(String message){
		
		ArrayList<Integer> diagonal = new ArrayList<Integer>();
		
		for(int i = 1, j = 0; j < 500; i = i+2, j++){
			diagonal.add(i*(i+1)); 
		}
		
		StringTokenizer tokens = new StringTokenizer(message);
		
		String reverted = new String();
		for(int i = 0; tokens.hasMoreElements(); i++){
			
			String word = tokens.nextToken().toString();
			
			if(diagonal.contains(i+1)){
				
				if(word.length() % 2 == 0){
					String newWord = new String();
					for(int j = 1; j != word.length()+1; j = j+2){
						String letter = word.substring(j-1, j);
						newWord = newWord.concat(letter);
					}
					for(int j = word.length(); j != 0; j = j-2){
						String letter = word.substring(j-1, j);
						newWord = newWord.concat(letter);
					}
					reverted = reverted.concat(newWord).concat(" ");
				}
				else{
					String newWord = new String();
					for(int j = 1; j != word.length()+2; j = j+2){
						String letter = word.substring(j-1, j);
						newWord = newWord.concat(letter);
					}
					for(int j = word.length()-1; j != 0; j = j-2){
						String letter = word.substring(j-1, j);
						newWord = newWord.concat(letter);
					}
					reverted = reverted.concat(newWord).concat(" ");
				}
			}
			else{
				reverted = reverted.concat(word).concat(" ");
			}
		}
		
		return reverted;
	}
	
	public String weirdDecrypt(String message, String key){
		return function.capitalize(function.crypt(function.secondDecryption(function.firstDecryption(message, key)), key, 1));
	}
	
	public static void main(String[] args){
	
		function.VigenereTableau();
		function.primeNumberGenerator();
		
		Scanner input = new Scanner(System.in);
		
		System.out.print("Are you going to encrypt or decrypt? (0 = encrypt, 1 = decrypt): ");
		String choice = input.nextLine();
		
		if(choice.equals("0")){
			
			System.out.print("Input the message you want to encrypt: ");
			String message = input.nextLine();
			System.out.print("Input the key for encryption: ");
			String key = input.nextLine();
			
			System.out.print("\nThe encrypted message is: ");
			System.out.print(function.weirdEncrypt(message, key.toLowerCase()));
		}
		else if(choice.equals("1")){
			
			System.out.print("Input the message you want to decrypt: ");
			String message = input.nextLine();
			System.out.print("Input the key for decryption: ");
			String key = input.nextLine();
		
			System.out.print("\nThe decrypted message is: ");
			System.out.print(function.weirdDecrypt(message, key.toLowerCase()));
		}
		else{
			System.err.println("Choose 0 or 1 only!");
		}
		input.close();
	}

}
