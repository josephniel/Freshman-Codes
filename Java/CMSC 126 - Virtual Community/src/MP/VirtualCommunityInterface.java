package MP;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.net.MalformedURLException;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

public class VirtualCommunityInterface {
	public VirtualCommunityInterface() {
		new CommunityInterface();
	}
}

class CommunityInterface{
	
	public static JPanel main, content, innerContent, innermostContent;
	public static JPanel 
		addInner, addInnerMost, 
		displayInner, displayInnerMost,
		searchInner, searchInnerMost,
		deleteInner, deleteInnerMost,
		marryInner, marryInnerMost,
		migrateInner, migrateInnerMost;
	private JLabel title;
	private welcomeButton 
		create, 
		display, 
		search, 
		delete,
		marry, 
		migrate,
		refresh,
		exit;
	
	public static JFrame mainFrame = new JFrame();
	
	public static mainFunctions mainFunction = new mainFunctions();
	
	CommunityInterface(){
		
		main = new JPanel();
		
			content = new JPanel();
			content.setPreferredSize(new Dimension(1000, 600));
			content.setBackground(new Color(246,246,246,255));
			content.setLayout(new GridBagLayout());
			
			GridBagConstraints c = new GridBagConstraints();
			
				title = new JLabel("Virtual Community Simulator");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 4;
				c.insets = new Insets(0, 0, 0, 0);
				
				content.add(title, c);
				
				title = new JLabel("Machine Problem by OKIE TEAM");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 26));
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 4;
				c.insets = new Insets(0, 0, 0, 0);
				
				content.add(title, c);
				
				create = new welcomeButton(1);
				
				c.gridx = 0;
				c.gridy = 2;
				c.gridwidth = 1;
				c.insets = new Insets(20, 20, 0, 20);
				
				content.add(create, c);
				
				display = new welcomeButton(2);
				
				c.gridx = 1;
				
				content.add(display, c);
				
				search = new welcomeButton(3);
				
				c.gridx = 2;
				
				content.add(search, c);
				
				delete = new welcomeButton(4);
				
				c.gridx = 3;
				
				content.add(delete, c);
		
				marry = new welcomeButton(5);
				
				c.gridx = 0;
				c.gridy = 3;
				c.insets = new Insets(20, 20, 0, 20);
				
				content.add(marry, c);
				
				migrate = new welcomeButton(6);
				
				c.gridx = 1;
				
				content.add(migrate, c);
				
				refresh = new welcomeButton(7);
				
				c.gridx = 2;
				
				content.add(refresh, c);
				
				exit = new welcomeButton(8);
				
				c.gridx = 3;
				
				content.add(exit, c);
				
		mainFrame.setContentPane(new BackgroundImage());
		
		mainFrame.setLayout(new GridBagLayout());
		mainFrame.add(content);
		
		mainFrame.setUndecorated(true);
		mainFrame.setExtendedState(JFrame.MAXIMIZED_BOTH);
		mainFrame.setResizable(false);
		
		mainFrame.setLocationRelativeTo(null);
		mainFrame.getContentPane().setBackground(new Color(246,246,246));
		
		mainFrame.setVisible(true);
		mainFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
	}
	
}

class welcomeButton extends JButton implements ActionListener{
	
	private static final long serialVersionUID = -5491841124976702937L;
	private int indicator;
	
	public welcomeButton(int buttonNumber){
		
		addActionListener(this);
		
		String URL = "", desc = "";
		
		this.indicator = buttonNumber;
		
		if(buttonNumber == 1){ URL = "Images/1.png"; desc = "1.png"; }
		else if(buttonNumber == 2){ URL = "Images/2.png"; desc = "2.png"; }
		else if(buttonNumber == 3){ URL = "Images/3.png"; desc = "3.png"; }
		else if(buttonNumber == 4){ URL = "Images/4.png"; desc = "4.png"; }
		else if(buttonNumber == 5){ URL = "Images/5.png"; desc = "5.png"; }
		else if(buttonNumber == 6){ URL = "Images/6.png"; desc = "6.png"; }
		else if(buttonNumber == 7){ URL = "Images/7.png"; desc = "7.png"; }
		else if(buttonNumber == 8){ URL = "Images/8.png"; desc = "8.png"; }
		
		try {
			setIcon(new ImageIcon(new java.net.URL(getClass().getResource(URL), desc)));
		} catch (MalformedURLException e) {
			e.printStackTrace();
		}
		
		setPreferredSize(new Dimension(200, 200));
		
		setBorderPainted(false);
		setFocusPainted(false);
		setContentAreaFilled(false);
		
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		
		if(indicator != 7 && indicator != 8){
			CommunityInterface.content.setVisible(false);
			switch(indicator){
				case 1 : 
					if(CommunityInterface.addInner == null){
						CommunityInterface.addInner = new subDirectory(indicator); 
						CommunityInterface.mainFrame.add(CommunityInterface.addInner);
					}
					else{
						CommunityInterface.addInner.setVisible(true);
					}
					break;
				case 2 : 
					if(CommunityInterface.displayInner == null){
						CommunityInterface.displayInner = new subDirectory(indicator); 
						CommunityInterface.mainFrame.add(CommunityInterface.displayInner);
					}
					else{
						CommunityInterface.displayInner.setVisible(true);
					}
					break;
				case 3 : 
					if(CommunityInterface.searchInner == null){
						CommunityInterface.searchInner = new subDirectory(indicator);
						CommunityInterface.mainFrame.add(CommunityInterface.searchInner);
					}
					else{
						CommunityInterface.searchInner.setVisible(true);
					}	
					break;
				case 4 : 
					if(CommunityInterface.deleteInner == null){
						CommunityInterface.deleteInner = new subDirectory(indicator); 
						CommunityInterface.mainFrame.add(CommunityInterface.deleteInner);
					}
					else{
						CommunityInterface.deleteInner.setVisible(true);
					}
					break;
				case 5 : 
					if(CommunityInterface.marryInner == null){
						CommunityInterface.marryInner = new subDirectory(indicator); 
						CommunityInterface.mainFrame.add(CommunityInterface.marryInner);
					}
					else{
						CommunityInterface.marryInner.setVisible(true);
					}
					break;
				case 6 : 
					if(CommunityInterface.migrateInner == null){
						CommunityInterface.migrateInner = new subDirectory(indicator); 
						CommunityInterface.mainFrame.add(CommunityInterface.migrateInner);
					}
					else{
						CommunityInterface.migrateInner.setVisible(true);
					}
					break;
			}
			
			
		}
		else if(indicator == 7){
			
			try {
				CommunityInterface.mainFunction.updateAge();
			} catch (ClassNotFoundException | IOException e) {
				e.printStackTrace();
			}
			
			JOptionPane.showMessageDialog(null, "Age Updated!", "Prompt", JOptionPane.DEFAULT_OPTION);
		}
		else{
			
			int i = JOptionPane.showConfirmDialog(null, "Do You really want to exit?");
			
			if(i == 0){
				System.exit(0);
			}
			
		}
	}
	
}

class mainJPanelClass extends JPanel{
	
	private static final long serialVersionUID = 1882045295386672185L;

	public mainJPanelClass() {
		setPreferredSize(new Dimension(1000, 600));
		setBackground(new Color(246,246,246,255));
		setLayout(new GridBagLayout());
	}
	
}

class subDirectory extends mainJPanelClass{
	
	private static final long serialVersionUID = -5234956827971511815L;

	public subDirectory(int indicator){
		
		GridBagConstraints c = new GridBagConstraints();
	
			if(indicator == 1){ // ADD
				
				JLabel title = new JLabel("ADD OPTIONS");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 3;
				c.insets = new Insets(0, 0, 0, 0);
				
				add(title, c);
				
				JButton addPerson = new functionButton(indicator, 1);
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 1;
				c.insets = new Insets(100, 20, 0, 20);
				
				add(addPerson, c);
				
				JButton addFamily = new functionButton(indicator, 2);
				
				c.gridx = 1;
				
				add(addFamily, c);
				
				JButton back = new functionButton(indicator, 3);
				
				c.gridx = 3;
				
				add(back, c);
				
			}
			else if(indicator == 2){ // DISPLAY
				
				JLabel title = new JLabel("DISPLAY OPTIONS");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 3;
				c.insets = new Insets(0, 0, 0, 0);
				
				add(title, c);
				
				JButton displayAllPerson = new functionButton(indicator, 1);
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 1;
				c.insets = new Insets(100, 20, 0, 20);
				
				add(displayAllPerson, c);
				
				JButton displayAllFamily = new functionButton(indicator, 2);
				
				c.gridx = 1;
				
				add(displayAllFamily, c);
				
				JButton back = new functionButton(indicator, 3);
				
				c.gridx = 3;
				
				add(back, c);
				
			}
			else if(indicator == 3){ // SEARCH 
				
				JLabel title = new JLabel("SEARCH OPTIONS");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 3;
				c.insets = new Insets(0, 0, 0, 0);
				
				add(title, c);
				
				JButton searchPerson = new functionButton(indicator, 1);
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 1;
				c.insets = new Insets(100, 20, 0, 20);
				
				add(searchPerson, c);
				
				JButton searchFamily = new functionButton(indicator, 2);
				
				c.gridx = 1;
				
				add(searchFamily, c);
				
				JButton back = new functionButton(indicator, 3);
				
				c.gridx = 3;
				
				add(back, c);
				
			}
			else if(indicator == 4){ // DELETE
				
				JLabel title = new JLabel("DELETE OPTIONS");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 2;
				c.insets = new Insets(0, 0, 0, 0);
				
				add(title, c);
				
				JButton deletePerson = new functionButton(indicator, 1);
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 1;
				c.insets = new Insets(100, 20, 0, 20);
				
				add(deletePerson, c);
				
				JButton back = new functionButton(indicator, 3);
				
				c.gridx = 2;
				
				add(back, c);
				
			}
			else if(indicator == 5){ // MARRY
				
				JLabel title = new JLabel("MARRY OPTIONS");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 2;
				c.insets = new Insets(0, 0, 0, 0);
				
				add(title, c);
				
				JButton marryPeople = new functionButton(indicator, 1);
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 1;
				c.insets = new Insets(100, 20, 0, 20);
				
				add(marryPeople, c);
				
				JButton back = new functionButton(indicator, 3);
				
				c.gridx = 2;
				
				add(back, c);
				
			}
			else if(indicator == 6){ // MIGRATE
				
				JLabel title = new JLabel("MIGRATE OPTIONS");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 3;
				c.insets = new Insets(0, 0, 0, 0);
				
				add(title, c);
				
				JButton migratePerson = new functionButton(indicator, 1);
				
				c.gridx = 0;
				c.gridy = 1;
				c.gridwidth = 1;
				c.insets = new Insets(20, 20, 0, 20);
				
				add(migratePerson, c);
				
				JButton acceptPerson = new functionButton(indicator, 2);
				
				c.gridx = 1;
				
				add(acceptPerson, c);
				
				JButton migrateFamily = new functionButton(indicator, 4);
				
				c.gridx = 0;
				c.gridy = 2;
				c.gridwidth = 1;
				c.insets = new Insets(0, 20, 0, 20);
				
				add(migrateFamily, c);
				
				JButton acceptFamily = new functionButton(indicator, 5);
				
				c.gridx = 1;
				
				add(acceptFamily, c);
				
				JButton back = new functionButton(indicator, 3);
				
				c.gridx = 2;
				c.gridy = 1;
				c.gridheight = 2;
				
				add(back, c);
				
			}
			
	}
	
}

class functionButton extends JButton implements ActionListener{
	
	private static final long serialVersionUID = -3910466145754064738L;
	public int buttonNumber, indicator;
	
	public functionButton(int indicator, int buttonNumber) {
		
		this.buttonNumber = buttonNumber;
		this.indicator = indicator;
		
		addActionListener(this);
		
		setPreferredSize(new Dimension(200, 200));
		
		String URL = "", desc = "";
		if(indicator == 1 || indicator == 2){
			if(buttonNumber == 1){
				URL = "Images/11.png";
				desc = "11.png";
			}
			else if(buttonNumber == 2){
				URL = "Images/12.png";
				desc = "12.png";
			}
		}
		else if(indicator == 3){
			if(buttonNumber == 1){
				URL = "Images/11.1.png";
				desc = "11.1.png";
			}
			else if(buttonNumber == 2){
				URL = "Images/12.1.png";
				desc = "12.1.png";
			}
		}
		else if(indicator == 4){
			if(buttonNumber == 1){
				URL = "Images/11.2.png";
				desc = "11.2.png";
			}
		}
		else if(indicator == 5){
			if(buttonNumber == 1){
				URL = "Images/15.png";
				desc = "15.png";
			}
		}
		else if(indicator == 6){
			if(buttonNumber == 1){
				URL = "Images/11.3.png";
				desc = "11.3.png";
			}
			else if(buttonNumber == 2){
				URL = "Images/12.3.png";
				desc = "12.3.png";
			}
			else if(buttonNumber == 4){
				URL = "Images/11.4.png";
				desc = "11.4.png";
			}
			else{
				URL = "Images/12.4.png";
				desc = "12.4.png";
			}
		}
		
		if(buttonNumber == 3){
			URL = "Images/9.png";
			desc = "9.png";
		}
		
		try {
			setIcon(new ImageIcon(new java.net.URL(getClass().getResource(URL), desc)));
		} catch (MalformedURLException e) {
			e.printStackTrace();
		}
		
		setBorderPainted(false);
		setFocusPainted(false);
		setContentAreaFilled(false);
		
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0) {

		if(this.buttonNumber == 3){
			
			switch(indicator){
				case 1 : CommunityInterface.addInner.setVisible(false); break;
				case 2 : CommunityInterface.displayInner.setVisible(false); break;
				case 3 : CommunityInterface.searchInner.setVisible(false); break;
				case 4 : CommunityInterface.deleteInner.setVisible(false); break;
				case 5 : CommunityInterface.marryInner.setVisible(false); break;
				case 6 : CommunityInterface.migrateInner.setVisible(false); break;
			}
			CommunityInterface.content.setVisible(true);
			
		}
		else{
			if(indicator == 1){ // ADD
				
				CommunityInterface.mainFunction.prevName = "";
				
				CommunityInterface.addInner.setVisible(false);
				CommunityInterface.addInnerMost = new addEntityPanel(buttonNumber);
				CommunityInterface.mainFrame.add(CommunityInterface.addInnerMost);
				
			}
			else if(indicator == 2){ // DISPLAY
				
				CommunityInterface.displayInner.setVisible(false);
				CommunityInterface.displayInnerMost = new displayEntityPanel(buttonNumber);
				CommunityInterface.mainFrame.add(CommunityInterface.displayInnerMost);
				
				
			}
			else if(indicator == 3){ // SEARCH
						
				CommunityInterface.searchInner.setVisible(false);
				CommunityInterface.searchInnerMost = new searchEntityPanel(buttonNumber);
				CommunityInterface.mainFrame.add(CommunityInterface.searchInnerMost);
					
			}
			else if(indicator == 4){ // DELETE
				
				CommunityInterface.deleteInner.setVisible(false);
				CommunityInterface.deleteInnerMost = new deleteEntityPanel();
				CommunityInterface.mainFrame.add(CommunityInterface.deleteInnerMost);
				
			}
			else if(indicator == 5){ // MARRY
				
				CommunityInterface.marryInner.setVisible(false);
				CommunityInterface.marryInnerMost = new marryEntityPanel();
				CommunityInterface.mainFrame.add(CommunityInterface.marryInnerMost);
				
			}
			else if(indicator == 6){ // MIGRATE
				
				CommunityInterface.migrateInner.setVisible(false);
				CommunityInterface.migrateInnerMost = new migrateEntityPanel(buttonNumber);
				CommunityInterface.mainFrame.add(CommunityInterface.migrateInnerMost);
				
			}
		}
		

		
	}
	
}

class backButton extends JButton implements ActionListener{
	
	private static final long serialVersionUID = -6940622785545198112L;
	private int indicator;
	
	public backButton(int indicator) {
		
		addActionListener(this);
		
		this.indicator = indicator;
		
		setPreferredSize(new Dimension(200, 200));
		
		String URL = "Images/9.png";
		String desc = "9.png";
		try {
			setIcon(new ImageIcon(new java.net.URL(getClass().getResource(URL), desc)));
		} catch (MalformedURLException e) {
			e.printStackTrace();
		}
		
		setBorderPainted(false);
		setFocusPainted(false);
		setContentAreaFilled(false);
		
	}
	
	@Override
	public void actionPerformed(ActionEvent arg0) {
	
		CommunityInterface.content.setVisible(true);
		switch(indicator){
			case 1 : CommunityInterface.addInnerMost.setVisible(false); break;
			case 2 : CommunityInterface.displayInnerMost.setVisible(false); break;
			case 3 : CommunityInterface.searchInnerMost.setVisible(false); break;
			case 4 : CommunityInterface.deleteInnerMost.setVisible(false); break;
			case 5 : CommunityInterface.marryInnerMost.setVisible(false); break;
			case 6 : CommunityInterface.migrateInnerMost.setVisible(false); break;
		}
		
	}
	
}


