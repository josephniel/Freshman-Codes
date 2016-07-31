import java.io.*;

public class OutputRecordSerializable{
	
	public static void main(String[] args) throws FileNotFoundException, IOException, ClassNotFoundException{
		
		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("output.heh"));
		
		try{
			RecordSerializable s;
			while(true){
				s = (RecordSerializable) ois.readObject();
				System.out.println(
						"Student Number: " + s.getStudentNumber() + "\n" +
						"Lastname: " + s.getLastName() + "\n" +
						"Firstname: " + s.getFirstName() + "\n" +
						"Course: " + s.getCourse() + "\n" +
						"Subject: " + s.getSubject() + "\n" +
						"Section: " + s.getSection() + "\n" +
						"Instructor: " + s.getInstructor() + "\n" +
						"Grade: " + s.getGrade() + "\n\n");
			}
		}
		catch(EOFException a){
			System.out.println("*** Nothing Follows ***");
		}
	}
}
