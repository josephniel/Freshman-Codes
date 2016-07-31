package MP;

import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;
import java.net.MalformedURLException;

import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JTextField;

class addEntityPanel extends mainJPanelClass{
	
	private static final long serialVersionUID = 8552301582116710063L;
	public JTextField
		JTfirstName,
		JTmiddleName,
		JTlastName,
		JTage,
		JTsex;
	private int indicator;
	
	public addEntityPanel(int indicator) {
		
		this.indicator = indicator;
		
		GridBagConstraints c = new GridBagConstraints();
		
			JLabel title = new JLabel("Create a Person");
			title.setFont(new Font("Calibri Light", Font.PLAIN, 48));
			
			c.gridx = 0;
			c.gridy = 0;
			c.gridwidth = 4;
			c.insets = new Insets(0, 0, 100, 0);
			
			add(title, c);
			
			JLabel label = new JLabel("First Name");
			
			c.gridx = 0;
			c.gridy = 1;
			c.gridwidth = 1;
			c.insets = new Insets(5, 10, 5, 10);
			
			add(label, c);
			
			JTfirstName = new JTextField();
			JTfirstName.setPreferredSize(new Dimension(200, 30));
			
			c.gridx = 1;
			
			add(JTfirstName, c);
			
			label = new JLabel("Middle Name");
			
			c.gridx = 0;
			c.gridy = 2;
			
			add(label, c);
			
			JTmiddleName = new JTextField();
			JTmiddleName.setPreferredSize(new Dimension(200, 30));
			
			c.gridx = 1;
			
			add(JTmiddleName, c);
			
			label = new JLabel("Last Name");
			
			c.gridx = 0;
			c.gridy = 3;
			
			add(label, c);
			
			JTlastName = new JTextField();
			JTlastName.setPreferredSize(new Dimension(200, 30));
			
			c.gridx = 1;
			
			add(JTlastName, c);
			
			label = new JLabel("Age");
			
			c.gridx = 0;
			c.gridy = 4;
			
			add(label, c);
			
			JTage = new JTextField();
			JTage.setPreferredSize(new Dimension(200, 30));
			
			c.gridx = 1;
			
			add(JTage, c);
			
			label = new JLabel("Sex");
			
			c.gridx = 0;
			c.gridy = 5;
			
			add(label, c);
			
			JTsex = new JTextField();
			JTsex.setPreferredSize(new Dimension(200, 30));
			
			c.gridx = 1;
			
			add(JTsex, c);
			
			JButton confirm = new addConfirm();
			
			c.gridx = 2;
			c.gridy = 1;
			c.gridheight = 5;
			c.insets = new Insets(0, 10, 0, 10);
			
			add(confirm, c);
			
			JButton back = new backButton(1);
			
			c.gridx = 3;
			c.gridy = 1;
			c.gridheight = 5;
			c.insets = new Insets(0, 10, 0, 10);
			
			add(back, c);
		
	}
	
	class addConfirm extends JButton implements ActionListener{
		
		private static final long serialVersionUID = 3720399799823911667L;

		public addConfirm() {
			
			addActionListener(this);
			
			setPreferredSize(new Dimension(200, 200));
			
			String URL = "Images/10.png";
			String desc = "10.png";
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
		public void actionPerformed(ActionEvent e) {

			if(indicator == 1){
				try {
					mainFunctions.x = 1;
					CommunityInterface.mainFunction.create(JTlastName.getText(), JTfirstName.getText(), JTmiddleName.getText(), JTage.getText(), JTsex.getText());
				} 
				catch (ClassNotFoundException | IOException e1) {
					e1.printStackTrace();
				}
			}
			else{
				try {
					int i = 1;
					while(i == 1){
						i = CommunityInterface.mainFunction.createFamily(JTlastName.getText(), JTfirstName.getText(), JTmiddleName.getText(), JTage.getText(), JTsex.getText());
					}
				} 
				catch (ClassNotFoundException | IOException e1) {
					e1.printStackTrace();
				}
			}
			
		}
		
	}
	
}