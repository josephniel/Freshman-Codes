package userInterface;

import java.awt.Color;
import java.awt.Component;
import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.GridLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.ListCellRenderer;
import javax.swing.plaf.basic.BasicComboBoxEditor;

public class QueuesPanel_CreateLastQueue extends JPanel{
	
	private static final long serialVersionUID = 1L;
	
	static JTextField timeQuantum;
	
	public QueuesPanel_CreateLastQueue() {
		
		this.setLayout(new GridBagLayout());
		this.setOpaque(false);
		
		GridBagConstraints c = new GridBagConstraints();
		
		JButton button = new JButton();
		button.setEnabled(false);
		button.setPreferredSize(new Dimension(30,30));
		button.setIcon(MainInterface.getImageIcon("remove.png"));
		button.setBorderPainted(false); 
		button.setContentAreaFilled(false); 
		button.setFocusPainted(false); 
		button.setOpaque(false);
		
		c.gridx = 1;
		c.gridy = 1;
		
		this.add(button, c);
		
		schedulingAlgorithms list = new schedulingAlgorithms();
		list.setPreferredSize(new Dimension(200, 30));
		
		c.gridx = 2;
		c.insets = new Insets(0, 20, 0, 20);
		
		this.add(list, c);
		
		timeQuantum = new JTextField();
		timeQuantum.setPreferredSize(new Dimension(100,30));
		timeQuantum.setEnabled(false);
		timeQuantum.setBackground(MainInterface.inputBoxColor);
		timeQuantum.setOpaque(false);
		timeQuantum.setBorder(MainInterface.defaultInputBorder);
		timeQuantum.setFont(MainInterface.mainFontBold);
		
		c.gridx = 3;
		c.insets = new Insets(0, 0, 0, 0);
		
		this.add(timeQuantum, c);
		
		this.setPreferredSize(new Dimension(MainInterface.mainRowWidth, MainInterface.mainRowHeight));
		this.setVisible(true);
		
	}
	
	static class schedulingAlgorithms extends JComboBox<String> implements ActionListener{
		
		private static final long serialVersionUID = 1L;
		
		private static String[] schedulingAlgorithmsList = {
				"First Come, First Serve", 
				"Shortest Job First",
				"Shortest Remaining Time First",
				"Round Robin",
				"Priority Without Preemption",
				"Priority With Preemption"};
		
		public schedulingAlgorithms() {
			super(schedulingAlgorithmsList);
			
			this.setRenderer(new NewComboRenderer());
			this.setEditor(new NewComboEditor());
			
			JButton button = (JButton) this.getComponent(0); 
			button.setBackground(MainInterface.buttonColor);
			
			this.setEditable(true);
			
			this.addActionListener(this);
		}
		
		@Override
		public void actionPerformed(ActionEvent e) {
			
			String selected = (String) this.getSelectedItem();
			
			switch(selected){
				case "First Come, First Serve":
					Panel_QueuesPanel.setSelectedSchedulingAlgorithm(1);
					timeQuantum.setEnabled(false);
					timeQuantum.setOpaque(false);
					break;
				case "Shortest Job First":
					Panel_QueuesPanel.setSelectedSchedulingAlgorithm(2);
					timeQuantum.setEnabled(false);
					timeQuantum.setOpaque(false);
					break;
				case "Shortest Remaining Time First":
					Panel_QueuesPanel.setSelectedSchedulingAlgorithm(3);
					timeQuantum.setEnabled(false);
					timeQuantum.setOpaque(false);
					break;
				case "Round Robin":
					Panel_QueuesPanel.setSelectedSchedulingAlgorithm(4);
					timeQuantum.setEnabled(true);
					timeQuantum.setOpaque(true);
					break;
				case "Priority Without Preemption":
					Panel_QueuesPanel.setSelectedSchedulingAlgorithm(5);
					timeQuantum.setEnabled(false);
					timeQuantum.setOpaque(false);
					break;
				case "Priority With Preemption":
					Panel_QueuesPanel.setSelectedSchedulingAlgorithm(6);
					timeQuantum.setEnabled(false);
					timeQuantum.setOpaque(false);
					break;
				default:
					break;
			}
		}
		
	}
	
	
}

class NewComboRenderer extends JLabel implements ListCellRenderer<Object> {  

	private static final long serialVersionUID = 1L;

	public NewComboRenderer() {  
            this.setOpaque(true);  
        }  

        public Component getListCellRendererComponent(  
                JList<?> list, Object value, 
                int index, boolean isSelected, boolean cellHasFocus) {  
            
        	setText(value.toString());  

        	this.setBackground(isSelected ? Color.GRAY : MainInterface.otherInputColor);  
        	this.setForeground(isSelected ? Color.WHITE : Color.BLACK);  
        	this.setBorder(BorderFactory.createEmptyBorder(5, 10, 5, 10));
        	this.setFont(MainInterface.mainFont);
            
        	return this;  
        }  
        
 }  

class NewComboEditor extends BasicComboBoxEditor{
	
	private JLabel label;
	private JPanel panel;
	private Object selectedItem;
	     
	public NewComboEditor() {
	   
		panel = new JPanel();
		panel.setLayout(new GridLayout(1, 1));
		panel.setBackground(MainInterface.otherInputColor);
	        panel.setBorder(BorderFactory.createCompoundBorder(
	        		BorderFactory.createMatteBorder(1, 1, 1, 0, Color.GRAY), 
	        		BorderFactory.createEmptyBorder(5,10,5,10)));
	        
			label = new JLabel();
			label.setOpaque(false);
			label.setForeground(Color.BLACK);
			label.setFont(MainInterface.mainFont);
	         
	        panel.add(label);
	    
	}
	     
	public Component getEditorComponent() {
	        return this.panel;
	}
	     
	public Object getItem() {
	        return "[" + this.selectedItem.toString() + "]";
	}
	     
	public void setItem(Object item) {
	        this.selectedItem = item;
	        label.setText(item.toString());
	}
	
}