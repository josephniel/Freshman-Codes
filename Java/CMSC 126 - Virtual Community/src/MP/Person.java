package MP;
import java.io.Serializable;

public class Person implements Serializable{
	
	private static final long serialVersionUID = 2868727482598282507L;
	
	private String firstName;
	private String middleName;
	private String familyName;
	private int age;
	private String sex;
	
	public Person(){
		firstName = middleName = familyName = sex = "";
		age = 0;
	}
	
	public Person(String firstName, String middleName, String familyName, int age, String sex){
		this.firstName = firstName;
		this.middleName = middleName;
		this.familyName = familyName;
		this.age = age;
		this.sex = sex;
	}
	
	
	public String getFirstName() {
		return firstName;
	}

	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	public String getMiddleName() {
		return middleName;
	}

	public void setMiddleName(String middleName) {
		this.middleName = middleName;
	}

	public String getFamilyName() {
		return familyName;
	}

	public void setFamilyName(String familyName) {
		this.familyName = familyName;
	}

	public int getAge() {
		return age;
	}

	public void setAge(int age) {
		this.age = age;
	}

	public String getSex() {
		return sex;
	}

	public void setSex(String sex) {
		this.sex = sex;
	}
	
	
}
