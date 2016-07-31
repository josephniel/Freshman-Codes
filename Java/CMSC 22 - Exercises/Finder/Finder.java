package Finder;

import java.awt.CardLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.FlowLayout;
import java.awt.GridLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.io.IOException;
import java.io.UnsupportedEncodingException;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextField;
import javax.swing.border.CompoundBorder;
import javax.swing.table.DefaultTableModel;

import cs22.mendoza.sample.UPCATResults;

public class Finder{
	
	private JPanel main, cards, p1, p2, p3;
	private JTextField tf1,tf2,tf3;
	private JButton submit, clear;
	private JComboBox<String> list; // only works on JRE 7 
	private JTable table1;
	private JTable table2;
	private JTable table3;
	private DefaultTableModel model1;
	private DefaultTableModel model2;
	private DefaultTableModel model3;
	private Color enabled = new Color(247,247,242);
	private Color disabled = new Color(223,223,208);
	private Color accent = new Color(124,162,64);
	
	private FocusListener f1,f2,f3;
	
	private String tf1t, tf2t, tf3t, result;
	private String[] column1 = {"Surname", "First Name", "Student Number"};
	private String[] column2 = {"First Name", "Surname", "Student Number"};
	private String[] column3 = {"Student Number", "First Name", "Surname"};
	private String[] studentNumber;
	private String[] lastName;
	private String[] firstName;
	private int length;
	
	private void disableTextField(JTextField textField, FocusListener f){
		textField.setBackground(disabled);
		textField.setEditable(false);
		textField.removeFocusListener(f);
	}
	
	private void enableTextField(JTextField textField, FocusListener f){
		textField.setBackground(enabled);
		textField.setEditable(true);
		textField.addFocusListener(f);
	}
	
	private void onClearButtonClicked(){
		
		enableTextField(tf1, f1);
		enableTextField(tf2, f2);
		enableTextField(tf3, f3);
		
		submit.setEnabled(true);
		submit.setBackground(enabled);
		
		list.setEnabled(false);
		list.setBackground(disabled);
		
		clear.setEnabled(false);
		
		p1.setBorder(BorderFactory.createMatteBorder(0, 0, 2, 0, accent));
		p2.setBorder(BorderFactory.createMatteBorder(0, 0, 2, 0, accent));
		p3.setBorder(BorderFactory.createMatteBorder(0, 0, 2, 0, accent));
		
		tf1.setPreferredSize(new Dimension(230,35));
		tf2.setPreferredSize(new Dimension(230,35));
		tf3.setPreferredSize(new Dimension(230,35));
		
		int a = list.getSelectedIndex();
		if(a == 0){
			int b = table1.getRowCount();
			for(int i = 0; i < b; i++)
				model1.removeRow(0);
		}
		else if(a == 1){
			int b = table2.getRowCount();
			for(int i = 0; i < b; i++)
				model2.removeRow(0);
		}
		else if(a == 2){
			int b = table3.getRowCount();
			for(int i = 0; i < b; i++)
				model3.removeRow(0);
		}
	}
	
	private String[] insertionSort(String[] a) {
		
		for(int i = 1; i < a.length; i++) {
			String cur = a[i];
			int j = i - 1;
			
			while((j >= 0) && (a[j].compareTo(cur) > 0)) 
				a[j + 1] = a[j--];
			a[j + 1] = cur;
		}
		return a;
	}
	
	private void divider(String[] lines, int a){
		
		length = lines.length;
		
		studentNumber = new String[length];
		lastName = new String[length];
		firstName = new String[length];
		
		int n = 0;
		
		if(a == 0)
			for(String i : lines){
				String sn = i.substring(0,i.indexOf("-")+6);
				String ln = i.substring(i.indexOf("-")+7,i.indexOf(","));
				String fn = i.substring(i.indexOf(",")+2);
			
				studentNumber[n] = sn;
				lastName[n] = ln;
				firstName[n] = fn;
			
				n++;
			}
		else
			for(String i : lines){
				String fn = i.substring(0,i.indexOf("["));
				String ln = i.substring(i.indexOf("[")+1,i.indexOf("]"));
				String sn = i.substring(i.indexOf("]")+1);
			
				studentNumber[n] = sn;
				lastName[n] = ln;
				firstName[n] = fn;
			
				n++;
			}
	}
	
	public void sortingFunction(String result, int a){
		
		int b;
		
		b = table1.getRowCount();
		for(int i = 0; i < b; i++)
			model1.removeRow(0);
		b = table2.getRowCount();
		for(int i = 0; i < b; i++)
			model2.removeRow(0);
		b = table3.getRowCount();
		for(int i = 0; i < b; i++)
			model3.removeRow(0);
		
		String[] lines = result.split("\\r?\\n");
		
		if(a == 0){
			
			divider(lines,0);
			
			for(int i = 0; i < length; i++){
				String[] row = new String[3];
				row[0] = lastName[i];
				row[1] = firstName[i];
				row[2] = studentNumber[i];
				model1.addRow(row);
			}
		}
		else if(a == 1){
			
			divider(lines,0);
			
			for(int i = 0; i < length; i++){
				String row = firstName[i] + "[" + lastName[i] + "]" + studentNumber[i];
				lines[i] = row;
			}
			
			divider(insertionSort(lines),1);
			
			for(int i = 0; i < length; i++){
				String[] row = new String[3];
				row[0] = firstName[i];
				row[1] = lastName[i];
				row[2] = studentNumber[i];
				model2.addRow(row);
			}
		}
		else if(a == 2){
			
			divider(insertionSort(lines),0);
			
			for(int i = 0; i < length; i++){
				String[] row = new String[3];
				row[0] = studentNumber[i];
				row[1] = firstName[i];
				row[2] = lastName[i];
				model3.addRow(row);
			}
		}
	}
	
	public void onSubmitButtonClick() throws IOException{
		
		disableTextField(tf1, f1);
		disableTextField(tf2, f2);
		disableTextField(tf3, f3);
		
		submit.setEnabled(false);
		submit.setBackground(disabled);
		
		list.setEnabled(true);
		list.setBackground(enabled);
		
		clear.setEnabled(true);
		
		p1.setBorder(new CompoundBorder(
			BorderFactory.createMatteBorder(0, 2, 0, 0, accent),
			BorderFactory.createMatteBorder(0, 0, 1, 0, Color.black)));	
		p2.setBorder(new CompoundBorder(
			BorderFactory.createMatteBorder(0, 2, 0, 0, accent),
			BorderFactory.createMatteBorder(0, 0, 1, 0, Color.black)));	
		p3.setBorder(new CompoundBorder(
			BorderFactory.createMatteBorder(0, 2, 0, 0, accent),
			BorderFactory.createMatteBorder(0, 0, 1, 0, Color.black)));	
		
		tf1.setPreferredSize(new Dimension(228,35));
		tf2.setPreferredSize(new Dimension(228,35));
		tf3.setPreferredSize(new Dimension(228,35));
		
		UPCATResults fetchResults = new UPCATResult();
		result = new String();
		
		int a = Integer.valueOf(tf1.getText());

		for(int i = a; i <= 128; i++){
			
			String pageLink = "http://upcat.up.edu.ph/results/page-";
			
			if(i < 10)
				pageLink = pageLink + "00" + String.valueOf(i) + ".html";
			else if(i < 100)
				pageLink = pageLink + "0" + String.valueOf(i) + ".html";
			else
				pageLink = pageLink + String.valueOf(i) + ".html";
			
			String course =  tf2.getText().toUpperCase();
			String campus = tf3.getText().toUpperCase();
			
			String results = fetchResults.fetchResults(pageLink, course, campus);
			
			if(results.length()!=0)
				result = result.concat(results);
		}
		sortingFunction(result, list.getSelectedIndex());
	}
	
	public Finder() throws IOException{
	
			JFrame mainFrame = new JFrame("UP Freshie Finder");
			
			main = new JPanel(new GridLayout(2, 1));
			main.setBackground(new Color(245,248,241));
			main.setBorder(BorderFactory.createEmptyBorder(30,0,0,0));
			
				JPanel top = new JPanel(new GridLayout(4, 1));
				top.setOpaque(false);
				
					JPanel panel1 = new JPanel(new FlowLayout(1,0,0));
					panel1.setOpaque(false);
					
						JLabel l1 = new JLabel("     Start page: ");
						l1.setPreferredSize(new Dimension(100,36));
						l1.setBorder(new CompoundBorder(
								BorderFactory.createMatteBorder(0, 0, 1, 0, Color.black),
								BorderFactory.createEmptyBorder(10,10,10,10)
								));
					
						panel1.add(l1);
					
						p1 = new JPanel(new GridLayout(1,1));
						p1.setOpaque(false);
						p1.setBorder(BorderFactory.createMatteBorder(0, 0, 2, 0, accent));
					
							tf1 = new JTextField("1");
							tf1.setPreferredSize(new Dimension(230,35));
							tf1.setBorder(BorderFactory.createEmptyBorder(10,10,10,10));
							tf1.setOpaque(false);
						
								f1 = new TextFieldFocus(tf1, tf1t);
								tf1.addFocusListener(f1);
								
							p1.add(tf1);
						
						panel1.add(p1);
						
					top.add(panel1);
							
					JPanel panel2 = new JPanel(new FlowLayout(1,0,0));
					panel2.setOpaque(false);
					
						JLabel l2 = new JLabel("           Course: ");
						l2.setPreferredSize(new Dimension(100,36));
						l2.setBorder(new CompoundBorder(
								BorderFactory.createMatteBorder(0, 0, 1, 0, Color.black),
								BorderFactory.createEmptyBorder(10,10,10,10)
								));
					
						panel2.add(l2);
					
						p2 = new JPanel(new GridLayout(1,1));
						p2.setOpaque(false);
						p2.setBorder(BorderFactory.createMatteBorder(0, 0, 2, 0, accent));
						
							tf2 = new JTextField("BS Computer Science");
							tf2.setPreferredSize(new Dimension(230,35));
							tf2.setBorder(BorderFactory.createEmptyBorder(10,10,10,10));
							tf2.setOpaque(false);
						
								f2 = new TextFieldFocus(tf2, tf2t);
								tf2.addFocusListener(f2);
								
							p2.add(tf2);
						
						panel2.add(p2);
						
					top.add(panel2);
					
					JPanel panel3 = new JPanel(new FlowLayout(1,0,0));
					panel3.setOpaque(false);
					
						JLabel l3 = new JLabel("         Campus: ");
						l3.setPreferredSize(new Dimension(100,36));
						l3.setBorder(new CompoundBorder(
								BorderFactory.createMatteBorder(0, 0, 1, 0, Color.black),
								BorderFactory.createEmptyBorder(10,10,10,10)
								));
					
						panel3.add(l3);
					
						p3 = new JPanel(new GridLayout(1,1));
						p3.setOpaque(false);
						p3.setBorder(BorderFactory.createMatteBorder(0, 0, 2, 0, accent));
						
							tf3 = new JTextField("Manila");
							tf3.setPreferredSize(new Dimension(230,35));
							tf3.setBorder(BorderFactory.createEmptyBorder(10,10,10,10));
							tf3.setOpaque(false);
						
								f3 = new TextFieldFocus(tf3, tf3t);
								tf3.addFocusListener(f3);
								
							p3.add(tf3);
						
						panel3.add(p3);
						
					top.add(panel3);
					
					JPanel p4 = new JPanel(new FlowLayout());
					p4.setOpaque(false);
					
						JLabel sort = new JLabel("Sort by:");
						
						p4.add(sort);
					
						list = new JComboBox<>();
						
						list.addItem("Surname");
						list.addItem("First Name");
						list.addItem("Student Number");
			
						list.setEnabled(false);
						list.setBackground(disabled);
						list.addItemListener(new ComboBoxListener());
						
						p4.add(list);
						
						JPanel bc = new JPanel();
						bc.setBorder(BorderFactory.createEmptyBorder(0,10,0,0));
						bc.setOpaque(false);
						
							submit = new JButton("Submit");
							submit.setBackground(new Color(247,247,242));
							
							submit.addActionListener(new Submit());
							submit.addKeyListener(new Enter());
							
							bc.add(submit);
							
							clear = new JButton("Clear");
							clear.setEnabled(false);
							clear.setBackground(disabled);
							
							clear.addActionListener(new Clear());
							
							bc.add(clear);
							
						p4.add(bc);
					
					top.add(p4);
					
				main.add(top);
				
				JPanel bottom = new JPanel(new GridLayout(1, 1));
				bottom.setBorder(BorderFactory.createEmptyBorder(0, 10, 10, 10));
				bottom.setOpaque(false);
					
					cards = new JPanel(new CardLayout());
					
						table1 = new JTable(new DefaultTableModel(column1, 0));
						model1 = (DefaultTableModel) table1.getModel();
						
						table2 = new JTable(new DefaultTableModel(column2, 0));
						model2 = (DefaultTableModel) table2.getModel();
					
						table3 = new JTable(new DefaultTableModel(column3, 0));
						model3 = (DefaultTableModel) table3.getModel();
					
						JScrollPane border1 = new JScrollPane(table1);
						border1.setBorder(BorderFactory.createLineBorder(Color.black, 1));
					
						JScrollPane border2 = new JScrollPane(table2);
						border2.setBorder(BorderFactory.createLineBorder(Color.black, 1));
					
						JScrollPane border3 = new JScrollPane(table3);
						border3.setBorder(BorderFactory.createLineBorder(Color.black, 1));
					
						cards.add(border1, "Surname");
						cards.add(border2, "First Name");
						cards.add(border3, "Student Number");
					
					bottom.add(cards);	
				
				main.add(bottom);
			
			mainFrame.add(main);
			
			mainFrame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
			mainFrame.setPreferredSize(new Dimension(400,550));
			mainFrame.setMinimumSize(new Dimension(400,550));
			mainFrame.setLocationRelativeTo(null);
			mainFrame.setVisible(true);
			mainFrame.pack();
			
	}
	
	public static void main(String[] args) throws IOException{
		Finder finder = new Finder();
	}
	
	private class TextFieldFocus implements FocusListener{

		private JTextField textField;
		private String text;
		
		public TextFieldFocus(JTextField textField, String text){
			this.textField = textField;
			this.text = text;
		}
		
		@Override
		public void focusLost(FocusEvent arg0) {
			if(textField.getText().equals(""))
				textField.setText(text);
		}
		
		@Override
		public void focusGained(FocusEvent arg0) {
			text = textField.getText();
			textField.setText("");
		}
		
	}
	
	private class Enter implements KeyListener{

		private int key;
		
		@Override
		public void keyPressed(KeyEvent e) {
			key = e.getKeyCode();
		}

		@Override
		public void keyReleased(KeyEvent e) {
			if(key == 10)
				try { onSubmitButtonClick(); } 
				catch (IOException e1) { e1.printStackTrace(); }
		}
		@Override
		public void keyTyped(KeyEvent e) {}
		
	}
	
	private class ComboBoxListener implements ItemListener{
		@Override
		public void itemStateChanged(ItemEvent e) {
			CardLayout cl = (CardLayout)(cards.getLayout());
		    cl.show(cards, (String)e.getItem());
		    sortingFunction(result, list.getSelectedIndex());
		}
	}
	
	private class Submit implements ActionListener{
		@Override
		public void actionPerformed(ActionEvent arg0) {
				try{onSubmitButtonClick();} 
				catch(IOException e){e.printStackTrace();}
		}
	}
	
	private class Clear implements ActionListener{
		@Override
		public void actionPerformed(ActionEvent arg0){onClearButtonClicked();}
	}
}

class UPCATResult extends UPCATResults{

	private String[]
			name,
			oldCampus,
			oldCourse;
	private String code, result;
	
	@Override
	public String fetchResults(String url, String course, String campus)
			throws UnsupportedEncodingException, IOException {
		
			code = getHTMLContents(url);
		
			return parseHTMLToResults(url, course, campus);
	}

	@Override
	protected String parseHTMLToResults(String url, String course, String campus) {
		
		String lines[] = code.split("\\r?\\n");
		
		if(!url.equals("http://upcat.up.edu.ph/results/page-128.html")){
		
			String[] newLines = new String[300];
			
			int indicator = 1;
			for(int i = 45, k = 0; i < 645; i++, k++){
				if(indicator%4==1){
					int j = i + 1;
					newLines[k] = lines[i].substring(22,lines[i].length()-5) + " " + lines[j].substring(22,lines[j].length()-5);
					i++;
					indicator++;
				}
				else
					newLines[k] = lines[i].substring(22,lines[i].length()-5);
				
				if(indicator%4==0){
					indicator = 0;
					i = i + 2;
				}
				indicator++;
			}
		
			name = new String[100]; 
			oldCampus = new String[100]; 
			oldCourse = new String[100];
		
			indicator = 0;
			for(int i = 0; i < 100; i++){
				for(int j = 0; j < 3; j++){
					if(j==0)
						name[i] = newLines[indicator];
					else if(j==1)
						oldCampus[i] = newLines[indicator];
					else
						oldCourse[i] = newLines[indicator];
					indicator++;
				}
			}
			
			boolean searched[] = new boolean[100]; 
			
			for(int i = 0; i < 100; i++){
				
				if(oldCampus[i].equals("LOS BA&Ntilde;OS"))
					oldCampus[i] = "LOS BANOS";
				
				if(oldCampus[i].equals(campus)){
					if(oldCourse[i].equals(course))
						searched[i] = true;
					else searched[i] = false;
				}
				else searched[i] = false;
			}
			
			result = new String();
		
			for(int i = 0; i < 100; i++)
				if(searched[i]==true)
					result = result.concat(name[i]).concat("\n");
		}// end of if
		else{
			
			String[] newLines = new String[93];
			int indicator = 1;
			
			for(int i = 45, k = 0; i < 231; i++, k++){
				if(indicator%4==1){
					int j = i + 1;
					newLines[k] = lines[i].substring(22,lines[i].length()-5) + " " + lines[j].substring(22,lines[j].length()-5);
					i++;
					indicator++;
				}
				else
					newLines[k] = lines[i].substring(22,lines[i].length()-5);
				
				if(indicator%4==0){
					indicator = 0;
					i = i + 2;
				}
				indicator++;
			}
			
			name = new String[31]; 
			oldCampus = new String[31]; 
			oldCourse = new String[31];
		
			indicator = 0;
			for(int i = 0; i < 31; i++){
				for(int j = 0; j < 3; j++){
					if(j==0)
						name[i] = newLines[indicator];
					else if(j==1)
						oldCampus[i] = newLines[indicator];
					else
						oldCourse[i] = newLines[indicator];
					indicator++;
				}
			}
			
			boolean searched[] = new boolean[31]; 
			
			for(int i = 0; i < 31; i++){
				
				if(oldCampus[i].equals("LOS BA&Ntilde;OS"))
					oldCampus[i] = "LOS BANOS";
				
				if(oldCampus[i].equals(campus)){
					if(oldCourse[i].equals(course))
						searched[i] = true;
					else searched[i] = false;
				}
				else searched[i] = false;
			}
			
			result = new String();
		
			for(int i = 0; i < 31; i++)
				if(searched[i]==true)
					result = result.concat(name[i]).concat("\n");
			
		} // end of else
		
		return result;
	}
	
}
