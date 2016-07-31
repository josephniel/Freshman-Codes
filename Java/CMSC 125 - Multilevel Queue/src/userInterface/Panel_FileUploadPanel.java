package userInterface;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFileChooser;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.filechooser.FileNameExtensionFilter;

public class Panel_FileUploadPanel extends JPanel implements ActionListener{

	private static final long serialVersionUID = 1L;

	private JFileChooser fc;
	private JButton openButton;
	private JLabel fileName;
	
	static File processFile;
	
	public Panel_FileUploadPanel() {
		
		fc = new JFileChooser();
		fc.setFileSelectionMode(JFileChooser.FILES_ONLY);
		fc.setFileFilter(new FileNameExtensionFilter("Text Only", "txt"));
		
		this.setPreferredSize(new Dimension(MainInterface.mainRowWidth, MainInterface.mainRowHeight + 30));
		this.setLayout(new GridBagLayout());
		this.setOpaque(false);
		
		openButton = new JButton("Open");
		openButton.setPreferredSize(new Dimension(80, 30));
		openButton.addActionListener(this);
		openButton.setBackground(MainInterface.buttonColor);
		openButton.setFont(MainInterface.mainFontBold);
		
		GridBagConstraints c = new GridBagConstraints();
		
		c.gridx = 1;
		c.gridy = 1;
		
		this.add(openButton, c);
		
		fileName = new JLabel("Choose file...");
		fileName.setPreferredSize(new Dimension(290, 30));
		fileName.setBorder(BorderFactory.createCompoundBorder(BorderFactory.createMatteBorder(1, 0, 1, 1, Color.GRAY), BorderFactory.createEmptyBorder(10,10,10,10)));
		fileName.setBackground(MainInterface.otherInputColor);
		fileName.setOpaque(true);
		fileName.setFont(MainInterface.mainFont);
		
		c.gridx = 2;
		
		this.add(fileName, c);
		
	}

	@Override
	public void actionPerformed(ActionEvent e) {

		if (e.getSource() == openButton) {
			int returnVal = fc.showOpenDialog(Panel_FileUploadPanel.this);
			if (returnVal == JFileChooser.APPROVE_OPTION) {
				processFile = fc.getSelectedFile();
				fileName.setText(processFile.getName());
			}
		}
		
	}
}
