package MP;

import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.Insets;
import java.io.IOException;
import java.util.ArrayList;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JScrollPane;
import javax.swing.JTable;

class displayEntityPanel extends mainJPanelClass{
	
	private static final long serialVersionUID = -282186032559429612L;

	public displayEntityPanel(int indicator) {
		
		GridBagConstraints c = new GridBagConstraints();
		
		ArrayList<String> tempData = new ArrayList<String>();
		
			if(indicator == 1){
				
				JLabel title = new JLabel("LIST OF PEOPLE");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 2;
				c.insets = new Insets(0, 0, 100, 0);
				
				add(title, c);
				
				ArrayList<String> personList = new ArrayList<String>();
				try {
					personList = CommunityInterface.mainFunction.display(1);
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
				for(String a : personList){
					tempData.add(a);
				}
				
			}else{
				
				JLabel title = new JLabel("LIST OF FAMILY NAMES");
				title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
				
				c.gridx = 0;
				c.gridy = 0;
				c.gridwidth = 2;
				c.insets = new Insets(0, 0, 100, 0);
				
				add(title, c);
				
				ArrayList<String> familyList = new ArrayList<String>();
				try {
					familyList = CommunityInterface.mainFunction.display(2);
				} catch (ClassNotFoundException | IOException e) {
					e.printStackTrace();
				}
				
				for(String a : familyList){
					tempData.add(a);
				}
				
			}
			
			String[][] data = new String[tempData.size()][1];
			String col[] = {"Names"};
			
			int b = 0;
			for(String a : tempData){
				data[b][0] = a;
				b++;
			}
			
			JTable table = new JTable( data, col );
	        JScrollPane pane = new JScrollPane(table);
			pane.setPreferredSize(new Dimension(600, 300));
	        
			c.gridx = 0;
			c.gridy = 1;
			c.gridwidth = 1;
			c.insets = new Insets(0, 10, 0, 10);
			
			add(pane, c);
			
			JButton back = new backButton(2);
			
			c.gridx = 1;
			
			add(back, c);
		
	}
	
}
