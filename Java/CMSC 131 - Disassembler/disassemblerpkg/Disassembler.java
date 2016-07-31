package disassemblerpkg;

import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.Font;
import java.awt.Frame;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.GridLayout;
import java.awt.Insets;
import java.awt.Rectangle;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.StringTokenizer;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextArea;
import javax.swing.JTextField;
import javax.swing.SwingConstants;
import javax.swing.WindowConstants;
import javax.swing.plaf.BorderUIResource;

public class Disassembler {

	JFrame frame;
	JPanel main, panel1, panel2;
	JTextArea textField1, textField2;
	
	public Disassembler() {
		
		frame = new JFrame();
		frame.setSize(1000, 500);
		frame.setLocationRelativeTo(null);
		frame.setVisible(true);
		
		GridBagConstraints c = new GridBagConstraints();
		
		main = new JPanel(new GridBagLayout());
		main.setPreferredSize(new Dimension(1000, 500));
		main.setMinimumSize(new Dimension(1000, 500));
		
			panel1 = new JPanel(new GridBagLayout());
			panel1.setPreferredSize(new Dimension(500, 500));
			panel1.setMinimumSize(new Dimension(500, 500));
			
				c.gridx = 1;
				c.gridy = 1;
				
				JLabel label = new JLabel("Input Assembly / C Code", SwingConstants.LEFT);
				label.setFont(new Font("Arial", Font.PLAIN, 18));
				label.setPreferredSize(new Dimension(460, 50));
				panel1.add(label, c);
				
				c.gridy = 2;
				
				textField1 = new JTextArea();
				textField1.setLineWrap(true);
				textField1.setBorder(BorderFactory.createLineBorder(Color.black));
				textField1.setMargin(new Insets(10, 10, 10, 10));
					
				JScrollPane scroll = new JScrollPane(textField1, JScrollPane.VERTICAL_SCROLLBAR_ALWAYS, JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
				scroll.setPreferredSize(new Dimension(460, 300));
				scroll.setMaximumSize(new Dimension(460,300));
				
				panel1.add(scroll, c);
			
				JPanel a = new JPanel(new GridBagLayout());
				a.setPreferredSize(new Dimension(460, 50));
					
					c.gridx = 1;
					c.gridy = 1;
					c.insets = new Insets(10, 10, 10, 10);
				
					JButton submit = new JButton("Generate C Language Code");
					
					submit.addActionListener(new ActionListener() {
						@Override
						public void actionPerformed(ActionEvent e) {
							String originalCode = textField1.getText();
							String convertedCode = new String();
							
							String trimmedOriginalCode = new String();
								StringTokenizer tokenizer = new StringTokenizer(originalCode, "\n");
								while(tokenizer.hasMoreTokens()){
									String line =  tokenizer.nextToken().trim();
										trimmedOriginalCode += line + "\n";
								}
							
							System.out.println(trimmedOriginalCode);
								
							convertedCode = new ToCLanguage(trimmedOriginalCode).getCode();							
							textField2.setText(convertedCode);
						}
					});
					
					a.add(submit, c);
					
					c.gridx = 2;
					c.insets = new Insets(10, 10, 10, 10);
				
					JButton submit1 = new JButton("Generate Assembly Code");
					
					submit1.addActionListener(new ActionListener() {
						@Override
						public void actionPerformed(ActionEvent e) {							
							String originalCode = textField1.getText();
							String convertedCode = new String();
							
							String trimmedOriginalCode = new String();
								StringTokenizer tokenizer = new StringTokenizer(originalCode, "\n");
								while(tokenizer.hasMoreTokens()){
									String line =  tokenizer.nextToken().trim();
										trimmedOriginalCode += line + "\n";
								}
							
							convertedCode = new ToAssembly(trimmedOriginalCode).getCode();
							textField2.setText(convertedCode);
						}
					});
					
					a.add(submit1, c);
				
				c.gridx = 1;
				c.gridy = 3;
					
				panel1.add(a, c);
				
			c.gridx = 1;
			c.gridy = 1;	
			
			main.add(panel1, c);
			
			GridBagConstraints c2 = new GridBagConstraints();	
			c2.gridx = 1;
			c2.gridy = 1;
			
				panel2 = new JPanel(new GridBagLayout());
				panel2.setPreferredSize(new Dimension(500, 500));
				panel2.setMinimumSize(new Dimension(500, 500));
				
				JLabel label2 = new JLabel("Converted Assembly / C Code", SwingConstants.LEFT);
				label2.setFont(new Font("Arial", Font.PLAIN, 18));
				label2.setPreferredSize(new Dimension(460, 50));
				panel2.add(label2, c2);
				
				c2.gridy = 2;

				textField2 = new JTextArea();
				textField2.setLineWrap(true);
				textField2.setBorder(BorderFactory.createLineBorder(Color.black));
				textField2.setMargin(new Insets(10, 10, 10, 10));
					
				JScrollPane scroll2 = new JScrollPane(textField2, JScrollPane.VERTICAL_SCROLLBAR_ALWAYS, JScrollPane.HORIZONTAL_SCROLLBAR_NEVER);
				scroll2.setPreferredSize(new Dimension(460, 300));
				scroll2.setMaximumSize(new Dimension(460,300));
				
				panel2.add(scroll2, c2);
				
				c2.gridy = 3;
				
				JLabel label3 = new JLabel(" ", SwingConstants.LEFT);
				label3.setFont(new Font("Arial", Font.PLAIN, 19));
				label3.setPreferredSize(new Dimension(460, 70));
				panel2.add(label3, c2);
				
			 c.gridx = 2;
			 c.gridy = 1;
			
			main.add(panel2, c);
				
		frame.add(main);
		
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.pack();
	}
	
	public static void main(String[] args) {
		new Disassembler();	
	}
}
