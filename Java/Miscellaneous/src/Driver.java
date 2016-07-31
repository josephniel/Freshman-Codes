import java.util.ArrayList;
import java.util.Scanner;


public class Driver {
	
	private static AddressBook addressBook;
	private static String menuChoice;
	
	public static void main(String[] args) {
		
		addressBook = new AddressBook(20);
		menuChoice = new String();
		
		System.out.println("Address Book Case Study");
		
		do{
			startMenu();
		}
		while(!menuChoice.equals("Q"));
		
	}
	
	private static Scanner scanner;
	
	private static void startMenu(){
		
		System.out.println("\nAddress Book Entries: " + addressBook.getAddressBookSize());
		System.out.println("Choose a task:");
		System.out.println("[A] Add");
		System.out.println("[D] Delete");
		System.out.println("[V] View");
		System.out.println("[U] Update");
		System.out.println("[Q] Quit");
		
		scanner = new Scanner(System.in);
		
		System.out.print("\nChoice: ");
		menuChoice = scanner.nextLine().toUpperCase();
		
		switch(menuChoice){
			case "A":
				addUser();
				break;
			case "D":
				deleteUser();
				break;
			case "V":
				viewUsers();
				break;
			case "U":
				updateUser();
				break;
			case "Q":
				System.out.println("Good bye!");
				break;
			default:
				System.out.print("Input is not in the list. Please select from the menu list.\n");
				break;
		}
		
	}
	
	public static void addUser() {
		if(addressBook.getAddressBookSize() < addressBook.getCapacity()){
			
			System.out.print("Input name: ");
			String name = scanner.nextLine();
			
			System.out.print("Input address: ");
			String address = scanner.nextLine();
			
			System.out.print("Input telephone number: ");
			String telephoneNumber = scanner.nextLine();
			
			System.out.print("Input email address: ");
			String email = scanner.nextLine();
			
			addressBook.addUser(new User(name, address, telephoneNumber, email));
			
		} else{
			System.out.println("Address book is full.");
		}
	}

	public static void deleteUser() {
		if(addressBook.getAddressBookSize() > 0){
			
			System.out.print("Input user ID of user to delete: ");
			String userID = scanner.nextLine();
			
			ArrayList<User> users = addressBook.getUsers();
			
			boolean userFound = false;
			for(User user : users){
				if(userID.equals(String.valueOf(user.getEntryNumber()))){
					users.remove(user);
					System.out.println("User with user ID " + userID + " has been deleted.");
					userFound = true;
					break;
				}
			}
			
			if(!userFound){
				System.out.println("There is no user with user ID " + userID);
			}
			
		} else{
			System.out.println("Address book is empty.");
		}
	}

	public static void viewUsers() {
		
		ArrayList<User> users = addressBook.getUsers();
		
		System.out.println("\nUsers:");
		for(User user : users){
			System.out.print("\nUser ID\t\t: ");
				System.out.println(""+user.getEntryNumber());
			System.out.print("Name\t\t: ");
				System.out.println(user.getName());
			System.out.print("Address\t\t: ");
				System.out.println(user.getAddress());
			System.out.print("Telephone Number: ");
				System.out.println(user.getTelephoneNumber());
			System.out.print("Email\t\t: ");
				System.out.println(user.getEmail());
		}
		
	}

	public static void updateUser() {
		if(addressBook.getAddressBookSize() > 0){
			
			System.out.print("Input user ID of user to update: ");
			String userID = scanner.nextLine();
			
			ArrayList<User> users = addressBook.getUsers();
			
			boolean userFound = false;
			for(User user : users){
				if(userID.equals(String.valueOf(user.getEntryNumber()))){
					
					System.out.print("Input name: ");
					user.setName(scanner.nextLine());
					
					System.out.print("Input address: ");
					user.setAddress(scanner.nextLine());
					
					System.out.print("Input telephone number: ");
					user.setTelephoneNumber(scanner.nextLine());
					
					System.out.print("Input email address: ");
					user.setEmail(scanner.nextLine());
					
					System.out.println("User with user ID " + userID + " has been updated.");
					userFound = true;
					break;
				}
			}
			
			if(!userFound){
				System.out.println("There is no user with user ID " + userID);
			}
			
		} else{
			System.out.println("Address book is empty. No User to update.");
		}
	}
}

class AddressBook {

	private int capacity;
	private ArrayList<User> users;
	
	public AddressBook(int capacity) {
		this.capacity = capacity;
		this.users = new ArrayList<User>();
	}
	
	public int getAddressBookSize() {
		return users.size();
	}

	public int getCapacity() {
		return capacity;
	}

	public ArrayList<User> getUsers() {
		return users;
	}

	public void addUser(User user) {
		if(users.size() != 0){
			user.setEntryNumber(users.get(users.size()-1).getEntryNumber()+1);
		} else{
			user.setEntryNumber(1);
		}
		users.add(user);
	}

}

class User {
	
	private int entryNumber;
	private String name;
	private String address;
	private String telephoneNumber;
	private String email;
	
	public User(String name, String address, String telephoneNumber, String email) {
		this.name = name;
		this.address = address;
		this.telephoneNumber = telephoneNumber;
		this.email = email;
	}
	
	public String getName() {
		return name;
	}
	
	public String getAddress() {
		return address;
	}
	
	public String getTelephoneNumber() {
		return telephoneNumber;
	}
	
	public String getEmail() {
		return email;
	}
	
	public void setName(String name) {
		this.name = name;
	}
	
	public void setAddress(String address) {
		this.address = address;
	}
	
	public void setTelephoneNumber(String telephoneNumber) {
		this.telephoneNumber = telephoneNumber;
	}
	
	public void setEmail(String email) {
		this.email = email;
	}

	public int getEntryNumber() {
		return entryNumber;
	}

	public void setEntryNumber(int entryNumber) {
		this.entryNumber = entryNumber;
	}
	
}



