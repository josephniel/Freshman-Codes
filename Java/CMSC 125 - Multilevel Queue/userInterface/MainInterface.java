package userInterface;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.io.File;

import javax.swing.BorderFactory;
import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.border.CompoundBorder;

import scheduling.MultilevelQueue;

/**
 * A class that constructs the entire GUI of the system
 * 
 * @author Joseph Niel Tuazon
 * @author Brendan De Guzman
 * @author James-andrew Sarmiento
 * 
 * */
public class MainInterface extends JFrame{

	private static final long serialVersionUID = 1L;
	
	static int mainRowWidth = 400;
	static int mainRowHeight = 40;
	
	static Color inputBoxColor = new Color(255,255,255);
	static Color otherInputColor = new Color(240,240,240);
	static Color buttonColor = new Color(230,230,230);
	
	static Font mainFont = new Font("Arial", Font.PLAIN, 12);
	static Font mainFontBold = new Font("Arial", Font.BOLD, 12);
	
	static CompoundBorder defaultInputBorder = 
			BorderFactory.createCompoundBorder(
					BorderFactory.createLineBorder(Color.GRAY), 
					BorderFactory.createEmptyBorder(0, 10, 0, 10)
			);
	
	static Dimension mainDimension = new Dimension(MainInterface.mainRowWidth * 2 + 71, 370 + 0);
	
	public MainInterface() {
		
		super("Multilevel Queue Simulator");
		
		GridBagConstraints c = new GridBagConstraints();
		
		JPanel mainPanel = new JPanel(new GridBagLayout());
		mainPanel.setPreferredSize(mainDimension);
		
			JPanel leftPanel = new JPanel();
			leftPanel.setPreferredSize(new Dimension(MainInterface.mainRowWidth + 1, 370));
			leftPanel.setBorder(BorderFactory.createMatteBorder(0, 0, 0, 1, Color.GRAY));
			leftPanel.setOpaque(false);
				
				leftPanel.add(new Panel_FileUploadPanel());
				leftPanel.add(new Panel_QueuesPanel());
				leftPanel.add(new Panel_OtherButtonsPanel());
			
		c.gridx = 1;
			
		mainPanel.add(leftPanel, c);
				
			JPanel rightPanel = new JPanel();
			rightPanel.setPreferredSize(new Dimension(MainInterface.mainRowWidth + 70, 370));
			rightPanel.setBorder(BorderFactory.createEmptyBorder(15, 20, 15, 20));
			rightPanel.setOpaque(false);
				
				rightPanel.add(Panel_TableResultsPanel.createComboBox());
				rightPanel.add(new Panel_TableResultsPanel());
			
		c.gridx = 2;
			
		mainPanel.add(rightPanel, c);
		mainPanel.setBackground(new Color(245,248,241));
		
		JScrollPane scrollPane = new JScrollPane(mainPanel);
		scrollPane.setBorder(null);
		scrollPane.setPreferredSize(mainDimension);
		
		this.add(scrollPane);
		
		this.pack();
		this.setVisible(true);
		this.setResizable(true);
		this.setLocationRelativeTo(null);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		
	}
	
	protected static void executeScheduling(File processFile, int numberOfQueues, int lastAlgorithm, int[] timeQuanta){
		new MultilevelQueue(Panel_FileUploadPanel.processFile, numberOfQueues, lastAlgorithm, timeQuanta);
	}

	protected static void showErrorMessage(String errorMessage) {
		JOptionPane.showMessageDialog(null, errorMessage);
	} 
	
	protected static ImageIcon getImageIcon(String imageName) {
	        java.net.URL imgURL = MainInterface.class.getResource("images/" + imageName);
	        if (imgURL != null) {
	        	return new ImageIcon(imgURL);
	        } else {
	        	System.err.println("Couldn't find file: " + imageName);
	            	return null;
	        }
	}
	
}
