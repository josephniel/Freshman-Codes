package userInterface;

import java.awt.CardLayout;
import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.util.ArrayList;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JComboBox;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTable;
import javax.swing.JTextArea;
import javax.swing.table.DefaultTableModel;

import scheduling.Process;

public class Panel_TableResultsPanel extends JPanel {

	private static final long serialVersionUID = 1L;
	
	private static String[] columnNames = {"PID",
                        		"AT",
                        		"BT",
                        		"Priority",
                        		"WT",
                        		"TT",
                        		"ET"};
	
	private static JPanel mainPanel;
	private static JTable table;
	private static JTextArea logArea;

	public static JComboBox<String> comboBox;
	
	public Panel_TableResultsPanel() {
		
		this.setPreferredSize(new Dimension(430, 280));
		this.setOpaque(false);
		
			mainPanel = new JPanel();
			
			mainPanel.setPreferredSize(new Dimension(430, 275));
			mainPanel.setOpaque(false);
			mainPanel.setLayout(new CardLayout());
			
				JPanel panel = new JPanel();
				panel.setPreferredSize(new Dimension(430, 273));
				panel.setOpaque(false);
				
				table = new JTable(new DefaultTableModel(columnNames, 0));
				table.setFont(MainInterface.mainFont);
				table.setRowHeight(25);
				table.setEnabled(false);
				
				JScrollPane pane = new JScrollPane(table);
				pane.setPreferredSize(new Dimension(430, 271));
				pane.setBorder(null);
			
				panel.add(pane);
				
			mainPanel.add(pane, "Table");
			
				panel = new JPanel();
				panel.setPreferredSize(new Dimension(430, 271));
				panel.setOpaque(false);
				
				logArea = new JTextArea();
				logArea.setFont(MainInterface.mainFont);
				logArea.setDisabledTextColor(Color.BLACK);
				logArea.setEnabled(false);
				logArea.setBorder(BorderFactory.createEmptyBorder(10, 10, 10, 10));
				
				pane = new JScrollPane(logArea);
				pane.setPreferredSize(new Dimension(430, 269));
				pane.setBorder(null);
				pane.setBorder(BorderFactory.createLineBorder(Color.LIGHT_GRAY));
				
				panel.add(pane);
				
			mainPanel.add(panel, "Log");
	
		this.add(mainPanel);
	}
	
	public static JComboBox<String> createComboBox(){
		
		comboBox = new JComboBox<String>();
		
		comboBox.setRenderer(new NewComboRenderer());
		comboBox.setEditor(new NewComboEditor());
		comboBox.setPreferredSize(new Dimension(150, 30));
		
		JButton button = (JButton) comboBox.getComponent(0); 
		button.setBackground(MainInterface.buttonColor);
		
		comboBox.addItem("Table");
		comboBox.addItem("Log");
		
		comboBox.addItemListener(new ItemListener() {
			@Override
			public void itemStateChanged(ItemEvent e) {
				CardLayout cl = (CardLayout)(mainPanel.getLayout());
				cl.show(mainPanel, (String)e.getItem());
			}
		});
		
		return comboBox;
	}
	
	public static void displayTable(ArrayList<Process> processes){
		
		DefaultTableModel model = new DefaultTableModel(columnNames, 0);
		for(Process p : processes){
			Object[] rowData = new Object[7];
				
			rowData[0] = p.getId();
			rowData[1] = p.getArrivalTime();
			rowData[2] = p.getBurstTime();
			rowData[3] = p.getPriorityNum();
			rowData[4] = p.getWaitingTime();
			rowData[5] = p.getTurnaroundTime();
			rowData[6] = p.getEndTime();
				
			model.addRow(rowData);
		}
		table.setModel(model);
		
	}
	
	public static void displayLog(String log){
		logArea.setText(log);
	}

	public static void displayGantt(ArrayList<Integer> ganttChart) {
		
		
	}
	
}


