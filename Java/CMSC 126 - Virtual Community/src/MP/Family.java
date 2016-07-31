package MP;
import java.io.Serializable;
import java.util.ArrayList;


public class Family implements Serializable{

	private static final long serialVersionUID = 7067025102116161066L;
	private String familyName;
	private ArrayList<PersonExtension> members;
	
	public Family(){
		familyName = "";
		members = new ArrayList<PersonExtension>();
	}
	
	public Family(String familyName){
		this.familyName = familyName;
		members = new ArrayList<PersonExtension>();
	}

	public String getFamilyName() {
		return familyName;
	}

	public void setFamilyName(String familyName) {
		this.familyName = familyName;
	}

	public ArrayList<PersonExtension> getMembers() {
		return members;
	}

	public void setMembers(ArrayList<PersonExtension> members) {
		this.members = members;
	}
}
