package MP;

public class PersonExtension extends Person {


	private static final long serialVersionUID = -7115334511101419894L;
	
	private boolean isOld;
	private boolean isMarried;
	private boolean canMarry;
	private String[] birthdate;
	
	public PersonExtension(String firstName, String middleName, String familyName, int age, String sex, String[] birthdate) {
		super(firstName, middleName, familyName, age, sex);
		this.birthdate = birthdate;
		isOld = isMarried = canMarry = false;
	}

	public boolean isOld() {
		return this.isOld;
	}
	
	public void isOld(boolean isOld) {
		this.isOld = isOld;
	}
	
	public boolean isMarried() {
		return this.isMarried;
	}
	
	public void isMarried(boolean isMarried) {
		this.isMarried = isMarried;
	}
	
	public boolean canMarry() {
		return this.canMarry;
	}
	
	public void canMarry(boolean canMarry) {
		this.canMarry = canMarry;
	}
	
	public String[] getBirthdate() {
		return this.birthdate;
	}

	public void setBirthdate(String[] birthdate) {
		this.birthdate = birthdate;
	}
}
