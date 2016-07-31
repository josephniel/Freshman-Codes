package MP;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;

import javax.swing.JOptionPane;

public class mainFunctions {

	public String prevName = "";
	public static int x = 1;
	
	private int ind = 0;
	
	public boolean create(String lastName, String firstName, String middleName, String age, String sex) throws IOException, ClassNotFoundException {
		
		if (x == 2) {
			if (!"".equals(prevName) && !lastName.equalsIgnoreCase(prevName)) {
				String out = "You entered a different family name. The program will now go back to the main menu.";
				JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
				
				CommunityInterface.addInnerMost.setVisible(false);
				CommunityInterface.content.setVisible(true);
				
				ind = 1;
				return false;
			}
		}
		prevName = lastName;
		
		int intAge = Integer.parseInt(age);
		
		Date date = new Date();
		SimpleDateFormat sdf = new SimpleDateFormat("dd HH mm ss");
		String birthdate = sdf.format(date);
		
		String[] birthtime = new String[4];
		int i = 0;
		for (String a : birthdate.split(" ")) {
			birthtime[i] = a;
			i++;
		}
		
		PersonExtension person = new PersonExtension(firstName, middleName, lastName, intAge, sex, birthtime);
		
		if (intAge >= 100)
			person.isOld(true);
		if (intAge >= 18)
			person.canMarry(true);
		String fileName = "file.ser";
		
		try {

			ObjectInputStream ois = new ObjectInputStream(new FileInputStream(fileName));
			ArrayList<Family> oldFamilies = ((ArrayList<Family>) ois.readObject());
			ois.close();
			
			try {
				String wholeName = firstName + " " + middleName + " " + lastName;
				for (Family f : oldFamilies) {
					for (PersonExtension pe : f.getMembers()) {
						String name = pe.getFirstName() + " " + pe.getMiddleName() + " " + pe.getFamilyName();
						if (wholeName.equalsIgnoreCase(name)) {
							
							String out =  name + " already exists in the community.";
							JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
							
							CommunityInterface.addInnerMost.setVisible(false);
							CommunityInterface.content.setVisible(true);
							return false;
						} 
					}
				}
			} catch (Exception e) {}

			ArrayList<String> lastNames = new ArrayList<String>();
			for (Family a : oldFamilies) {
				lastNames.add(a.getFamilyName().toLowerCase());
			}

			String tempLastName = lastName.toLowerCase();
			if (lastNames.contains(tempLastName)) {

				int familyIndex = lastNames.indexOf(tempLastName);

				Family currentFamily = oldFamilies.get(familyIndex);

				ArrayList<PersonExtension> extendedPersons = currentFamily.getMembers();
				extendedPersons.add(person);

				currentFamily.setMembers(extendedPersons);

			} else {

				ArrayList<PersonExtension> extendedPerson = new ArrayList<PersonExtension>();
				extendedPerson.add(person);

				Family family = new Family(person.getFamilyName());
				family.setMembers(extendedPerson);

				oldFamilies.add(family);

			}

			ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream(fileName));
			oos.writeObject(oldFamilies);
			oos.flush();
			oos.close();

		} catch (Exception e) {

			ArrayList<PersonExtension> temp = new ArrayList<PersonExtension>();
			temp.add(person);

			Family tempFamily = new Family(person.getFamilyName());
			tempFamily.setMembers(temp);

			ArrayList<Family> tempFamilies = new ArrayList<Family>();
			tempFamilies.add(tempFamily);

			ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream(fileName));
			oos.writeObject(tempFamilies);
			oos.flush();
			oos.close();

		}
		
		if(this.x != 2){
			
			String out = firstName + " " + middleName + " " + lastName + " is created successfully.";
			JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
			
			CommunityInterface.addInnerMost.setVisible(false);
			CommunityInterface.content.setVisible(true);
			
			return true;
			
		}
		
		this.x = 1;
		
		return true;

	} 
	
	public int createFamily(String lastName, String firstName, String middleName, String age, String sex) throws IOException, ClassNotFoundException {

		this.x = 2;
		
		int a = 0; 
		if(create(lastName, firstName, middleName, age, sex)){
			a = JOptionPane.showConfirmDialog(null, "Add another family member?");
			return a;
		}

		if(ind == 1){
			return a;
		}
		
		JOptionPane.showMessageDialog(null, "That member is already in the family. The program will now go back to menu.", "Message", JOptionPane.DEFAULT_OPTION);
		return 0;
	}

	public ArrayList<String> display(int x) throws IOException, ClassNotFoundException, FileNotFoundException {
		
		String fileName = "file.ser";
		
		ObjectInputStream ois = new ObjectInputStream(new FileInputStream(fileName));
		
		ArrayList<Family> f = (ArrayList<Family>) ois.readObject();
		ArrayList<String> famResult = new ArrayList<String>();
		ArrayList<String> personResult = new ArrayList<String>();
		
		try {
			for (int i = 0; i < f.size(); i++) {
				famResult.add(f.get(i).getFamilyName().toUpperCase() + " FAMILY");
				personResult.add(f.get(i).getFamilyName().toUpperCase() + " FAMILY");
				if (x == 1) {
					for (int j = 0; j < f.get(i).getMembers().size(); j++) {
						personResult.add(f.get(i).getMembers().get(j).getFirstName() + " " + f.get(i).getMembers().get(j).getMiddleName() + " " + f.get(i).getMembers().get(j).getAge());
					}
				}
			}
				
		} catch (Exception e) { }
		
		ois.close();
		if(x==1)
			return personResult;
		else
			return famResult;
	}

	public void search(int x, String name) throws IOException, ClassNotFoundException, FileNotFoundException {
		
		boolean exists = false;
		
		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("file.ser"));
		
		try {
			while (true) {
				
				ArrayList<Family> f = (ArrayList<Family>) ois.readObject();
				for (int i = 0; i < f.size(); i++) {
					
					if (f.get(i).getFamilyName().equalsIgnoreCase(name)) {
						
						String out = name.toUpperCase() + " is here!\nMembers:\n\n";
						
						for (int j = 0; j < f.get(i).getMembers().size(); j++) {
							out += f.get(i).getMembers().get(j).getFirstName() + "\n";
						}
						
						JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
						exists = true;
					}

					if (x == 1) {
						for (int j = 0; j < f.get(i).getMembers().size(); j++) {
							String wholeName = f.get(i).getMembers().get(j).getFirstName() + " " + f.get(i).getMembers().get(j).getMiddleName() + " " + f.get(i).getMembers().get(j).getFamilyName();
							if (name.equalsIgnoreCase(wholeName)) {
								String out = wholeName + " is here!";
								JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
								exists = true;
							}
						}
					}
				}
				
				String out = "";
				if (x == 1 && !exists)
					out = name + " is not here!";
				if (x == 2 && !exists)
					out = name + " family is not here!";
				if(!exists)
					JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
				
			}
		} 
		catch (Exception e) { }
		ois.close();
	}

	public void delete(String name) throws IOException, ClassNotFoundException, FileNotFoundException {

		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("file.ser"));
		
		ArrayList<Family> record = (ArrayList<Family>) ois.readObject();
		ois.close();

		try {
			boolean exists = false;
			for (Family f : record) {
				// search person
				for (PersonExtension pe : f.getMembers()) {
					String wholeName = pe.getFirstName() + " " + pe.getMiddleName() + " " + pe.getFamilyName();
					if (name.equalsIgnoreCase(wholeName)) {
						if (pe.isOld()) {
							f.getMembers().remove(pe);
							if (f.getMembers().size() == 0)
								record.remove(f);
							
							String out = name + " is successfully killed.";
							JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
						} else {
							String out = name + " is far too young to die.";
							JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
						}
						exists = true;
					}
				}
			}
			if (!exists) {
				String out = name + " is not found in the community.";
				JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
			}
		} catch (Exception e) { }

		ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream("file.ser"));
		oos.writeObject(record);
		oos.flush();
		oos.close();

	}

	public void marry(String groom, String bride) throws IOException, ClassNotFoundException, FileNotFoundException {

		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("file.ser"));
		ArrayList<Family> record = (ArrayList<Family>) ois.readObject();
		ois.close();

		String[] aGroom = groom.split(" ");
		String[] aBride = bride.split(" ");
		if (aGroom[2].equalsIgnoreCase(aBride[2])) {
			
			String out = "People in the same family cannot be married to each other.";
			JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
			
			CommunityInterface.marryInnerMost.setVisible(false);
			CommunityInterface.content.setVisible(true);
			
			return;
		}
		try {
			boolean groomValid = false, brideValid = false;
			int fIndexGroom = 0, recordIndexGroom = 0, fIndexBride = 0, recordIndexBride = 0;
			for (Family f : record) {
				for (PersonExtension pe : f.getMembers()) {
					String wholeName = pe.getFirstName() + " "
							+ pe.getMiddleName() + " " + pe.getFamilyName();
					if (groom.equalsIgnoreCase(wholeName)) {
						if (pe.canMarry()) {
							if (pe.getSex().equalsIgnoreCase("male")) {
								groomValid = true;
								fIndexGroom = f.getMembers().indexOf(pe);
								recordIndexGroom = record.indexOf(f);
							}
						}
					}
					if (bride.equalsIgnoreCase(wholeName)) {
						if (pe.canMarry()) {
							if (pe.getSex().equalsIgnoreCase("female")) {
								brideValid = true;
								fIndexBride = f.getMembers().indexOf(pe);
								recordIndexBride = record.indexOf(f);
							}
						}
					}
				}
			}
			if (groomValid && brideValid) {
				// change bride's middle and last name
				record.get(recordIndexBride)
						.getMembers()
						.get(fIndexBride)
						.setMiddleName(
								record.get(recordIndexBride).getMembers()
										.get(fIndexBride).getFamilyName());
				record.get(recordIndexBride).getMembers().get(fIndexBride)
						.setFamilyName(aGroom[2]);

				// sets their status to married
				record.get(recordIndexBride).getMembers().get(fIndexBride)
						.isMarried(true);
				record.get(recordIndexBride).getMembers().get(fIndexBride)
						.canMarry(false);
				record.get(recordIndexGroom).getMembers().get(fIndexGroom)
						.isMarried(true);
				record.get(recordIndexGroom).getMembers().get(fIndexGroom)
						.canMarry(false);

				// transfer bride to groom's family
				ArrayList<PersonExtension> ape = record.get(recordIndexGroom)
						.getMembers();
				ape.add(record.get(recordIndexBride).getMembers()
						.get(fIndexBride));
				record.get(recordIndexGroom).setMembers(ape);
				record.get(recordIndexBride).getMembers().remove(fIndexBride);

				// delete the family of the bride if member is 0
				if (record.get(recordIndexBride).getMembers().size() == 0) {
					record.remove(recordIndexBride);
				}

				String out = groom + " and " + bride + " are successfully married.";
				JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
				
				CommunityInterface.marryInnerMost.setVisible(false);
				CommunityInterface.content.setVisible(true);
				
			} else {
				String out = "Sorry, " + groom + " and " + bride + " cannot be married.";
				JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
				
				CommunityInterface.marryInnerMost.setVisible(false);
				CommunityInterface.content.setVisible(true);
			}
		} catch (Exception e) {

		}

		ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream("file.ser"));
		oos.writeObject(record);
		oos.flush();
		oos.close();
	}

	public void migrate(int z, int y, String name, String fileName) throws IOException, ClassNotFoundException, FileNotFoundException {
		//JOptionPane na successfully migrated or accepted
		String original = "";
		if(y==1){ // migrate
			original = "file.ser";
		}
		else if(y==2){ // accept
			original = fileName;
			fileName = "file.ser";
		}
		
		ObjectInputStream ois = new ObjectInputStream(new FileInputStream(original));
		ArrayList<Family> record = (ArrayList<Family>) ois.readObject();
		ois.close();
		
		try {
			for (Family f : record) {
				for (PersonExtension pe : f.getMembers()) {
					
					// migrate a person
					if (z == 1) {
						String wholeName = pe.getFirstName() + " " + pe.getMiddleName() + " " + pe.getFamilyName();
						if (name.equalsIgnoreCase(wholeName)) {
							
							// start of creation
							try {

								ObjectInputStream ois2 = new ObjectInputStream(new FileInputStream(fileName));
								ArrayList<Family> oldFamilies = ((ArrayList<Family>) ois2.readObject());
								ois2.close();
								// List all the families on an array to check if the current added
								// person has same family name
								ArrayList<String> lastNames = new ArrayList<String>();
								for (Family a : oldFamilies) {
									lastNames.add(a.getFamilyName().toLowerCase());
								}

								String tempLastName = pe.getFamilyName().toLowerCase();
								if (lastNames.contains(tempLastName)) {
									int familyIndex = lastNames.indexOf(tempLastName);
									Family currentFamily = oldFamilies.get(familyIndex);

									ArrayList<PersonExtension> extendedPersons = currentFamily.getMembers();
									extendedPersons.add(pe);

									currentFamily.setMembers(extendedPersons);
									f.getMembers().remove(pe);
									if (f.getMembers().size() == 0)
										record.remove(f);
									
									String out = name + " is successfully migrated.";
									JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
									
									CommunityInterface.migrateInnerMost.setVisible(false);
									CommunityInterface.content.setVisible(true);
									
								} else {
									ArrayList<PersonExtension> extendedPerson = new ArrayList<PersonExtension>();
									extendedPerson.add(pe);

									Family family = new Family(pe.getFamilyName());
									family.setMembers(extendedPerson);

									oldFamilies.add(family);
									f.getMembers().remove(pe);
									if (f.getMembers().size() == 0)
										record.remove(f);
									
									String out = name + " is successfully migrated.";
									JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
									
									CommunityInterface.migrateInnerMost.setVisible(false);
									CommunityInterface.content.setVisible(true);
								}

								ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream(fileName));
								oos.writeObject(oldFamilies);
								oos.flush();
								oos.close();
								
								ObjectOutputStream oos2 = new ObjectOutputStream(new FileOutputStream(original));
								oos2.writeObject(record);
								oos2.flush();
								oos2.close();

							} catch (Exception e) {
								String out = "Exception. We do not want to add this person to an empty community. ho ho";
								JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
								
								CommunityInterface.migrateInnerMost.setVisible(false);
								CommunityInterface.content.setVisible(true);
							}
						}
						
					}
					
				}
				// migrate a family
				if (z == 2) {
					if (f.getFamilyName().equalsIgnoreCase(name)) {
						ObjectInputStream ois2 = new ObjectInputStream(new FileInputStream(fileName));
						ArrayList<Family> oldFamilies = ((ArrayList<Family>) ois2.readObject());
						ois2.close();
						
						oldFamilies.add(f);
						ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream(fileName));
						oos.writeObject(oldFamilies);
						oos.flush();
						oos.close();
						
						ObjectOutputStream oos2 = new ObjectOutputStream(new FileOutputStream(original));
						record.remove(f);
						oos2.writeObject(record);
						oos2.flush();
						oos2.close();

						String out = name + " is successfully migrated.";
						JOptionPane.showMessageDialog(null, out, "Message", JOptionPane.DEFAULT_OPTION);
						
						CommunityInterface.migrateInnerMost.setVisible(false);
						CommunityInterface.content.setVisible(true);
						
					}
				}
			}
		}
		catch(Exception e) {
			
		}
	}
	
	public void updateAge() throws IOException, ClassNotFoundException, FileNotFoundException {

		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("file.ser"));
		ArrayList<Family> familyList = (ArrayList<Family>) ois.readObject();
		ois.close();

		try {

			Date date = new Date();
			SimpleDateFormat sdf = new SimpleDateFormat("dd HH mm ss");
			String tempDate = sdf.format(date);

			String[] currentTime = new String[4];
			int i = 0;
			for (String a : tempDate.split(" ")) {
				currentTime[i] = a;
				i++;
			}

			for (Family fam : familyList) {
				for (PersonExtension extendedPerson : fam.getMembers()) {

					String[] tempBirthdate = extendedPerson.getBirthdate();

					int totalDiff = 0, newAge;
					for (int j = 0; j < 4; j++) {
						if (!currentTime[j].equals(tempBirthdate[j])) {
							int currTime = Integer.parseInt(currentTime[j]);
							int persTime = Integer.parseInt(tempBirthdate[j]);

							int diff = currTime - persTime;

							if (j == 0) {
								diff = diff * 86400;
							} else if (j == 1) {
								diff = diff * 3600;
							} else if (j == 2) {
								diff = diff * 60;
							}

							totalDiff += diff;
						}
					}

					newAge = totalDiff / 30;
					extendedPerson.setAge((extendedPerson.getAge() + newAge));
					if (extendedPerson.getAge() >= 100)
						extendedPerson.isOld(true);
					if (extendedPerson.getAge() >= 18)
						extendedPerson.canMarry(true);
				}
			}
			
			ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream("file.ser"));
			oos.writeObject(familyList);
			oos.flush();
			oos.close();

		} catch (Exception e) {

		}

	}

}
