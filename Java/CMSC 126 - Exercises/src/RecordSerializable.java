import java.io.*;

public class RecordSerializable implements Serializable {
	
	/**
	 * 
	 */
	private static final long serialVersionUID = 1L;
	private String 
		lastName, 
		firstName, 
		course,
		subject,
		section,
		instructor;
	private int studentNumber;
	private double grade;
	
	public RecordSerializable() {
		lastName = new String();
		firstName = new String(); 
		course = new String();
		subject = new String();
		section = new String();
		instructor = new String();
		studentNumber = 0;
		grade = 0;
	}
	
	public RecordSerializable(int studentNumber, String lastName, String firstName, String course, String subject, String section, String instructor, double grade) {
		this.studentNumber = studentNumber;
		this.lastName = lastName;
		this.firstName = firstName;
		this.course = course;
		this.subject = subject;
		this.section = section;
		this.instructor = instructor;
		this.grade = grade;
	}

	public String getLastName() {
		return lastName;
	}

	public void setLastName(String lastName) {
		this.lastName = lastName;
	}

	public String getFirstName() {
		return firstName;
	}

	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	public String getCourse() {
		return course;
	}

	public void setCourse(String course) {
		this.course = course;
	}

	public String getSubject() {
		return subject;
	}

	public void setSubject(String subject) {
		this.subject = subject;
	}

	public String getSection() {
		return section;
	}

	public void setSection(String section) {
		this.section = section;
	}

	public String getInstructor() {
		return instructor;
	}

	public void setInstructor(String instructor) {
		this.instructor = instructor;
	}

	public int getStudentNumber() {
		return studentNumber;
	}

	public void setStudentNumber(int studentNumber) {
		this.studentNumber = studentNumber;
	}

	public double getGrade() {
		return grade;
	}

	public void setGrade(double grade) {
		this.grade = grade;
	}
	
}
