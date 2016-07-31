package Calculator;

import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.awt.event.MouseEvent;
import java.awt.event.MouseListener;
import java.io.IOException;
import java.util.ArrayList;

import javax.swing.*;

public class Calculator extends JFrame {

	private static final long serialVersionUID = 1L;

	private JPanel
		cover,
		main,
		topPanel,
		topMiddlePanel,
		middlePanel,
		bottomPanel;
	
	private JLabel cove;
	
	private ImageIcon[] 
			mainButtons = new ImageIcon[20],
			mainButtonsClicked = new ImageIcon[20],
			middleButtons = new ImageIcon[18],
			middleButtonsClicked = new ImageIcon[18],
			upperButtons = new ImageIcon[8],
			upperButtonsClicked = new ImageIcon[8],
			centerButtons = new ImageIcon[9];
	
	private JButton[]
			mainJButtons = new JButton[20],
			subButtons = new JButton[18],
			specialButtons = new JButton[8],
			centerButton = new JButton[9];
	
	private JTextField textField1, textField2;
	
	private String input, answer;
	
	private int memory = 0, indicator = 0;
	
	private boolean 
			reset = false, 
			shift = false,
			alpha = false,
			nonNumber = false;
	
	private Calculator() throws IOException{
		
		super("Casio fx-85ES");
		
		this.setUndecorated(true);
		this.setBackground(null);
		
	    main = new BackgroundPanel(0);
	    main.setPreferredSize(super.getPreferredSize());
		main.setLayout(null);
	    
		JPanel solarPanel = new JPanel();
    	solarPanel.setBounds(135,35,120,40);
    	solarPanel.setOpaque(false);
		solarPanel.addMouseListener(new solarPanel());
    	
	    topPanel = new JPanel(new GridLayout(2,1));
	    topPanel.setBounds(0, 0, 300, 200);
	    topPanel.setOpaque(false);
	    topPanel.setBorder(BorderFactory.createEmptyBorder(100, 38, 12, 40));
	    
	    	textField1 = new JTextField();
	    	textField1.setEditable(false);
	    	textField1.setOpaque(false);
	    	textField1.setBorder(BorderFactory.createEmptyBorder(0, 10, 0, 10));
	    	textField1.setFont(new Font("Arial", 1, 20));
	    	textField1.setForeground(new Color(120,120,120));
	    	textField1.getCaret().setVisible(true);
	    	
	    	topPanel.add(textField1);
	    
	    	textField2 = new JTextField();
	    	textField2.setEditable(false);
	    	textField2.setOpaque(false);
	    	textField2.setBorder(BorderFactory.createEmptyBorder(0, 10, 0, 10));
	    	textField2.setFont(new Font("Arial", 1, 20));
	    	textField2.setForeground(new Color(120,120,120));
	    	textField2.setHorizontalAlignment(JTextField.RIGHT);
	    
	    	topPanel.add(textField2);
	    	
	    topMiddlePanel = new JPanel(new GridLayout(1,3,10,0));
	    topMiddlePanel.setBounds(0, 200, 300, 100);
	    topMiddlePanel.setBorder(BorderFactory.createEmptyBorder(30, 30, 0, 40));
	    topMiddlePanel.setOpaque(false);
	    
	    	JPanel middleLeftPanel = new JPanel(new GridLayout(1,2,5,0));
	    	middleLeftPanel.setOpaque(false);
	    	
				JPanel middleLeftmostPanel = new JPanel(new GridLayout(2,1,0,26));
				middleLeftmostPanel.setOpaque(false);
			
				for(int i = 0; i < 8; i++){
					String link = "images/3-" + String.valueOf(i+1) + ".png";
					java.net.URL buttonURL = getClass().getResource(link);
					upperButtons[i] = new ImageIcon(buttonURL);
				}
		
				for(int i = 0; i < 8; i++){
					String link = "images/3-" + String.valueOf(i+1) + "-1.png";
					java.net.URL buttonURL = getClass().getResource(link);
					upperButtonsClicked[i] = new ImageIcon(buttonURL);
				}
		
				for(int i = 0; i < 2; i++){
					specialButtons[i] = new JButton(upperButtons[i]);
					specialButtons[i].setPressedIcon(upperButtonsClicked[i]);
					specialButtons[i].setBorderPainted(false); 
					specialButtons[i].setContentAreaFilled(false); 
					specialButtons[i].setFocusPainted(false); 
					specialButtons[i].setOpaque(false);
					middleLeftmostPanel.add(specialButtons[i]);
				}	

				middleLeftPanel.add(middleLeftmostPanel);
	
				JPanel middleLeftCenterPanel = new JPanel(new GridLayout(2,1,0,21));
				middleLeftCenterPanel.setBorder(BorderFactory.createEmptyBorder(5,0,0,0));
				middleLeftCenterPanel.setOpaque(false);
			
				for(int i = 2; i < 4; i++){
					specialButtons[i] = new JButton(upperButtons[i]);
					specialButtons[i].setPressedIcon(upperButtonsClicked[i]);
					specialButtons[i].setBorderPainted(false); 
					specialButtons[i].setContentAreaFilled(false); 
					specialButtons[i].setFocusPainted(false); 
					specialButtons[i].setOpaque(false);
					middleLeftCenterPanel.add(specialButtons[i]);
				}
		
				middleLeftPanel.add(middleLeftCenterPanel);
		
			topMiddlePanel.add(middleLeftPanel);
		
			JPanel middleCenterPanel = new JPanel(new GridLayout(3, 3));
			middleCenterPanel.setOpaque(false);
			
			for(int i = 0; i < 9; i++){
				String link = "images/4-" + String.valueOf(i+1) + ".png";
				java.net.URL buttonURL = getClass().getResource(link);
				centerButtons[i] = new ImageIcon(buttonURL);
			}
			
			for(int i = 0; i < 9; i++){
				centerButton[i] = new JButton(centerButtons[i]);
				centerButton[i].setPressedIcon(centerButtons[i]);
				centerButton[i].setBorderPainted(false); 
				centerButton[i].setContentAreaFilled(false); 
				centerButton[i].setFocusPainted(false); 
				centerButton[i].setOpaque(false);
				middleCenterPanel.add(centerButton[i]);
			}
		
			topMiddlePanel.add(middleCenterPanel);
	
			JPanel middleRightPanel = new JPanel(new GridLayout(1,2,4,0));
			middleRightPanel.setOpaque(false);
			
				JPanel middleRightCenterPanel = new JPanel(new GridLayout(2,1,0,21));
				middleRightCenterPanel.setBorder(BorderFactory.createEmptyBorder(5,0,0,0));
				middleRightCenterPanel.setOpaque(false);
			
				for(int i = 4; i < 6; i++){
					specialButtons[i] = new JButton(upperButtons[i]);
					specialButtons[i].setPressedIcon(upperButtonsClicked[i]);
					specialButtons[i].setBorderPainted(false); 
					specialButtons[i].setContentAreaFilled(false); 
					specialButtons[i].setFocusPainted(false); 
					specialButtons[i].setOpaque(false);
					middleRightCenterPanel.add(specialButtons[i]);
				}
		
				middleRightPanel.add(middleRightCenterPanel);
	
				JPanel middleRightmostPanel = new JPanel(new GridLayout(2,1,0,26));
				middleRightmostPanel.setOpaque(false);
			
				for(int i = 6; i < 8; i++){
					specialButtons[i] = new JButton(upperButtons[i]);
					specialButtons[i].setPressedIcon(upperButtonsClicked[i]);
					specialButtons[i].setBorderPainted(false); 
					specialButtons[i].setContentAreaFilled(false); 
					specialButtons[i].setFocusPainted(false); 
					specialButtons[i].setOpaque(false);
					middleRightmostPanel.add(specialButtons[i]);
				}

				middleRightPanel.add(middleRightmostPanel);
	
			topMiddlePanel.add(middleRightPanel);

	    middlePanel = new JPanel(new GridLayout(3, 6, 5, 9));
	    middlePanel.setBounds(0, 300, 300, 120);
	    middlePanel.setBackground(Color.cyan);
	    middlePanel.setBorder(BorderFactory.createEmptyBorder(13, 30, 15, 40));
	    middlePanel.setOpaque(false);
	    
	    
	    for(int i = 0; i < 18; i++){
			String link = "images/2-" + String.valueOf(i+1) + ".png";
			java.net.URL buttonURL = getClass().getResource(link);
			middleButtons[i] = new ImageIcon(buttonURL);
		}
		
		for(int i = 0; i < 18; i++){
			String link = "images/2-" + String.valueOf(i+1) + "-1.png";
			java.net.URL buttonURL = getClass().getResource(link);
			middleButtonsClicked[i] = new ImageIcon(buttonURL);
		}
		
		for(int i = 0; i < 18; i++){
			subButtons[i] = new JButton(middleButtons[i]);
			subButtons[i].setPressedIcon(middleButtonsClicked[i]);
			subButtons[i].setBorderPainted(false); 
			subButtons[i].setContentAreaFilled(false); 
			subButtons[i].setFocusPainted(false); 
			subButtons[i].setOpaque(false);
			middlePanel.add(subButtons[i]);
		}
	    
	    bottomPanel = new JPanel(new GridLayout(4,5,5,12));
	    bottomPanel.setBounds(0, 415, 300, 185);
	    bottomPanel.setBorder(BorderFactory.createEmptyBorder(2, 30, 25, 40));
	    bottomPanel.setOpaque(false);
	    
	    for(int i = 0; i < 20; i++){
			String link = "images/1-" + String.valueOf(i+1) + ".png";
			java.net.URL buttonURL = getClass().getResource(link);
			mainButtons[i] = new ImageIcon(buttonURL);
		}
		
		for(int i = 0; i < 20; i++){
			String link = "images/1-" + String.valueOf(i+1) + "-1.png";
			java.net.URL buttonURL = getClass().getResource(link);
			mainButtonsClicked[i] = new ImageIcon(buttonURL);
		}
		
		for(int i = 0; i < 20; i++){
			mainJButtons[i] = new JButton(mainButtons[i]);
			mainJButtons[i].setPressedIcon(mainButtonsClicked[i]);
			mainJButtons[i].setBorderPainted(false); 
			mainJButtons[i].setContentAreaFilled(false); 
			mainJButtons[i].setFocusPainted(false); 
			mainJButtons[i].setOpaque(false);
			bottomPanel.add(mainJButtons[i]);
		}
	    
		main.add(solarPanel);
		main.add(topPanel);
	    main.add(topMiddlePanel);
	    main.add(middlePanel);
	    main.add(bottomPanel);
	    
	    main.addKeyListener(new keyboardListener());
	    main.setFocusable(true);
	    
		setContentPane(main);
		
		main.requestFocus();
		
		mainJButtons[0].addActionListener(new mainButtonActionListener(0));
		mainJButtons[1].addActionListener(new mainButtonActionListener(1));
		mainJButtons[2].addActionListener(new mainButtonActionListener(2));
		mainJButtons[3].addActionListener(new mainButtonActionListener(3));
		mainJButtons[4].addActionListener(new mainButtonActionListener(4));
		mainJButtons[5].addActionListener(new mainButtonActionListener(5));
		mainJButtons[6].addActionListener(new mainButtonActionListener(6));
		mainJButtons[7].addActionListener(new mainButtonActionListener(7));
		mainJButtons[8].addActionListener(new mainButtonActionListener(8));
		mainJButtons[9].addActionListener(new mainButtonActionListener(9));
		mainJButtons[10].addActionListener(new mainButtonActionListener(10));
		mainJButtons[11].addActionListener(new mainButtonActionListener(11));
		mainJButtons[12].addActionListener(new mainButtonActionListener(12));
		mainJButtons[13].addActionListener(new mainButtonActionListener(13));
		mainJButtons[14].addActionListener(new mainButtonActionListener(14));
		mainJButtons[15].addActionListener(new mainButtonActionListener(15));
		mainJButtons[16].addActionListener(new mainButtonActionListener(16));
		mainJButtons[17].addActionListener(new mainButtonActionListener(17));
		mainJButtons[18].addActionListener(new mainButtonActionListener(18));
		mainJButtons[19].addActionListener(new mainButtonActionListener(19));
		
		subButtons[1].addActionListener(new subButtonActionListener(1));
		subButtons[2].addActionListener(new subButtonActionListener(2));
		subButtons[3].addActionListener(new subButtonActionListener(3));
		subButtons[4].addActionListener(new subButtonActionListener(4));
		subButtons[5].addActionListener(new subButtonActionListener(5));
		subButtons[9].addActionListener(new subButtonActionListener(9));
		subButtons[10].addActionListener(new subButtonActionListener(10));
		subButtons[11].addActionListener(new subButtonActionListener(11));
		subButtons[14].addActionListener(new subButtonActionListener(14));
		subButtons[15].addActionListener(new subButtonActionListener(15));
		subButtons[17].addActionListener(new subButtonActionListener(17));
		
		specialButtons[0].addActionListener(new specialButtonActionListener(0));
		specialButtons[1].addActionListener(new specialButtonActionListener(1));
		specialButtons[2].addActionListener(new specialButtonActionListener(2));
		specialButtons[3].addActionListener(new specialButtonActionListener(3));
		specialButtons[5].addActionListener(new specialButtonActionListener(5));
		specialButtons[7].addActionListener(new specialButtonActionListener(7));
		
		centerButton[3].addActionListener(new specialButtonActionListener(9));
		centerButton[5].addActionListener(new specialButtonActionListener(10));
	}
	
	class solarPanel implements MouseListener{
		@Override
		public void mouseExited(MouseEvent e) {
			textField1.setForeground(new Color(120,120,120));
			textField2.setForeground(new Color(120,120,120));
		}			
		@Override
		public void mouseEntered(MouseEvent e) {
			textField1.setForeground(new Color(0,0,0));
			textField2.setForeground(new Color(0,0,0));
		}
		@Override
		public void mouseReleased(MouseEvent e){}
		@Override
		public void mousePressed(MouseEvent e){}
		@Override
		public void mouseClicked(MouseEvent e) {}
	}
	
	class keyboardListener implements KeyListener{

		ArrayList<Character> keys;
		
		public keyboardListener() {
			keys = new ArrayList<>();
			keys.add('0');keys.add('1');keys.add('2');keys.add('3');keys.add('4');
			keys.add('5');keys.add('6');keys.add('7');keys.add('8');keys.add('9');
			keys.add('+');keys.add('-');keys.add('/');keys.add('*');keys.add('x');
			keys.add('^');keys.add('(');keys.add(')');
		}
		
		@Override
		public void keyPressed(KeyEvent e) {
			if(e.getKeyCode() == 10){
				answer = textField2.getText();
				if(answer.isEmpty())
					answer = "0";
				if(input.contains("Ans"))
					input = input.replace("Ans", answer);
				
				infixToPostfix infix = new infixToPostfix(input);
				String ans = infix.toString();
				
				if(!ans.equals("Infinity"))
					textField2.setText(ans);
				else
					textField2.setText("Syntax Error");
				textField1.setCaretPosition(input.length());
				reset = true;
			}
			else if(e.getKeyCode() == 8){
				if(textField1.getText().length()!= 0){
					input = textField1.getText();
					int previousPosition = textField1.getCaretPosition() - 1;
					if(textField1.getText().length() > 0)
						if(textField1.getCaretPosition() != input.length())
							input = textField1.getText().substring(0, textField1.getCaretPosition()-1) + textField1.getText().substring(textField1.getCaretPosition());
						else
							input = textField1.getText().substring(0, input.length()-1);
					textField1.setText(input);
					textField1.setCaretPosition(previousPosition);
				}
			}
			else if(e.getKeyCode() == 39){
				if(textField1.getCaretPosition() < input.length() && textField1.getText().length() > 0)
					textField1.getCaret().moveDot(textField1.getCaretPosition()+1);
			}
			else if(e.getKeyCode() == 37){
				if(textField1.getCaretPosition() > 0)
					textField1.getCaret().moveDot(textField1.getCaretPosition()-1);
			}
		}
		
		@Override
		public void keyTyped(KeyEvent e) {
			if(keys.contains(e.getKeyChar())){
				int nextPosition = textField1.getCaretPosition()+1;
				if(textField1.getCaretPosition()!=0 && textField1.getCaretPosition() < input.length())
					input = textField1.getText().substring(0, textField1.getCaretPosition()) + String.valueOf(e.getKeyChar()) + textField1.getText().substring(textField1.getCaretPosition());
				else
					input = textField1.getText() + String.valueOf(e.getKeyChar());
				textField1.setText(input);
				textField1.setCaretPosition(nextPosition);
			}
		}
		@Override
		public void keyReleased(KeyEvent e) {}
		
	}
	
	class specialButtonActionListener implements ActionListener{
		
		int index;
		
		public specialButtonActionListener(int index) {
			this.index = index;
		}
		
		@Override
		public void actionPerformed(ActionEvent arg0) {
			
			if(reset == true){
				reset = false;
				textField1.setText("");
			}
			
			if(index == 0){
				if(alpha == true)
					alpha = false;
					
				if(shift == false)
					shift = true;
				else
					shift = false;
			}
			else if(index == 1){
				textField1.setText(textField1.getText() + "Abs(");
				nonNumber = true;
				indicator = 1;
			}
			else if(index == 2){
				if(shift == true)
					shift = false;
				
				if(alpha == false)
					alpha = true;
				else
					alpha = false;
			}
			else if(index == 3){
				input = textField1.getText() + "^3";
				textField1.setText(input);
			}
			else if(index == 5){
				if(shift == false)
					input = textField1.getText() + "^-1";
				else{
					input = textField1.getText() + "!";
					shift = false;
					nonNumber = true;
					indicator = 2;
				}
				textField1.setText(input);
			}
			else if(index == 7){
				input = textField1.getText() + "log_(";
				textField1.setText(input);
				indicator = 21;
				nonNumber = true;
			}
			else if(index == 9){
				if(textField1.getCaretPosition() > 0)
					textField1.getCaret().moveDot(textField1.getCaretPosition()-1);
			}
			else if(index == 10){
				if(textField1.getCaretPosition() < input.length())
					textField1.getCaret().moveDot(textField1.getCaretPosition()+1);
			}
			main.requestFocus();
		}
	}
	
	class subButtonActionListener implements ActionListener{
		
		int index;
		
		public subButtonActionListener(int index) {
			this.index = index;
		}
		
		@Override
		public void actionPerformed(ActionEvent e) {
			
			if(reset == true){
				reset = false;
				textField1.setText("");
			}
			
			if(index == 1){
				input = textField1.getText() + "\u221A";
				textField1.setText(input);
				nonNumber = true;
			}
			else if(index == 2){
				input = textField1.getText() + "^2";
				textField1.setText(input);
			} 
			else if(index == 3){
				if(shift == false)
					input = textField1.getText() + "^";
				else{
					input = textField1.getText();
					indicator = 3;
					nonNumber = true;
				}
				textField1.setText(input + "\u221A");
			}
			else if(index == 4){
				if(shift == false){
					input = textField1.getText() + "log(";
					nonNumber = true;
					indicator = 4;
				}
				else
					input = textField1.getText() + "10^";
				textField1.setText(input);
			}
			else if(index == 5){
				if(shift == false)
					input = textField1.getText() + "ln(";
				else
					input = textField1.getText() + "e^";
				textField1.setText(input);
				nonNumber = true;
				indicator = 5;
			}
			else if(index == 9){
				if(shift == false)
					input = textField1.getText() + "sin(";
				else
					input = textField1.getText() + "sin^-1(";
				textField1.setText(input);
				nonNumber = true;
				indicator = 6;
			}
			else if(index == 10){
				if(shift == false)
					input = textField1.getText() + "cos(";
				else
					input = textField1.getText() + "cos^-1(";
				textField1.setText(input);
				nonNumber = true;
				indicator = 7;
			}
			else if(index == 11){
				if(shift == false)
					input = textField1.getText() + "tan(";
				else
					input = textField1.getText() + "tan^-1(";
				textField1.setText(input);
				nonNumber = true;
				indicator = 8;
			}
			else if(index == 14){
				input = textField1.getText() + "(";
				textField1.setText(input);
			}
			else if(index == 15){
				input = textField1.getText() + ")";
				textField1.setText(input);
			}
			else if(index == 17){
				String ans;
				if(input != null){
					infixToPostfix infix = new infixToPostfix(input);
					ans = infix.toString();
				}
				else
					ans = "0";
				if(shift == false && alpha == false){
					memory = (int) (memory + Double.parseDouble(ans));
					textField2.setText(ans + "M+");
					textField1.setText("");
				}
				else if(alpha == true && shift == false){
					textField1.setText("M=");
					textField2.setText(String.valueOf(memory));
					alpha = false;
				}
				else if(shift == true && alpha == false){
					memory = (int) (memory - Double.parseDouble(ans));
					textField2.setText(ans + "M-");
					textField1.setText("");
					shift = false;
				}
			}
			main.requestFocus();
		}
	}
	
	class mainButtonActionListener implements ActionListener{

		int index;
		
		public mainButtonActionListener(int index) {
			this.index = index;
		}
		
		@Override
		public void actionPerformed(ActionEvent arg0) {
			
			ArrayList<Integer> numbers = new ArrayList<>();
			numbers.add(0);numbers.add(1);numbers.add(2);
			numbers.add(5);numbers.add(6);numbers.add(7);
			numbers.add(10);numbers.add(11);numbers.add(12);
			numbers.add(15);
			
			ArrayList<Integer> operations = new ArrayList<>();
			operations.add(8);operations.add(9);
			operations.add(13);operations.add(14);
			
			String in = new String();
			
			if(numbers.contains(index)){
				
				switch(index){
					case 0: in = "7"; break;
					case 1: in = "8"; break;
					case 2: in = "9"; break;
					case 5: in = "4"; break;
					case 6: in = "5"; break;
					case 7: in = "6"; break;
					case 10: in = "1"; break;
					case 11: in = "2"; break;
					case 12: in = "3"; break;
					case 15: in = "0"; break;
					default: break;
				}
				
				int nextPosition;
				
				if(reset == true){
					nextPosition = 1;
					input = in; 
					reset = false;
				}
				else{
					nextPosition = textField1.getCaretPosition()+1;
					
					if(textField1.getText().contains("M=")){
						textField1.setText(textField1.getText().replace("M=", ""));
						nextPosition = textField1.getCaretPosition()+1;
					}
					
					if(textField1.getCaretPosition()!=0)
						input = textField1.getText().substring(0, textField1.getCaretPosition()) + in + textField1.getText().substring(textField1.getCaretPosition());
					else
						input = textField1.getText() + in;
				}
				
				textField1.setText(input);
				textField1.setCaretPosition(nextPosition);
			}
			else if(operations.contains(index)){
	
				switch(index){
					case 8: in = "x"; break;
					case 9: in = "/"; break;
					case 13: in = "+"; break;
					case 14: in = "-"; break;
					default: break;
				}
				
				int nextPosition = textField1.getCaretPosition()+1;
				
				if(textField1.getCaretPosition()!=0)
					input = textField1.getText().substring(0, textField1.getCaretPosition()) + in + textField1.getText().substring(textField1.getCaretPosition());
				else
					input = textField1.getText() + in;
				textField1.setText(input);
				textField1.setCaretPosition(nextPosition);
				
			}
			else if(index == 3){
				if(textField1.getText().length()!= 0){
					input = textField1.getText();
					int previousPosition = textField1.getCaretPosition() - 1;
					if(textField1.getCaretPosition() != input.length())
						input = input.substring(0, textField1.getCaretPosition()-1) + input.substring(textField1.getCaretPosition());
					else
						input = input.substring(0, input.length()-1);
					textField1.setText(input);
					textField1.setCaretPosition(previousPosition);
				}
			}
			else if(index == 4){
				if(shift == false){
					input = "";
					textField1.setText(input);
					textField1.getCaret().setVisible(true);
					textField2.setText(input);
				}
				else{
					System.exit(0);
				}
			}
			else if(index == 16){
				input = textField1.getText() + ".";
				textField1.setText(input);
				textField1.getCaret().setVisible(true);
			}
			else if(index == 17){
				input = textField1.getText() + "x10^";
				textField1.setText(input);
				textField1.getCaret().setVisible(true);
			}
			else if(index == 18){
				if(reset == true){
					input = "Ans";
					reset = false;
				}
				else{
					input = textField1.getText() + "Ans";
				}
				textField1.setText(input);
				textField1.getCaret().setVisible(true);
			}
			else{
				answer = textField2.getText();
				if(answer.isEmpty())
					answer = "0";
				if(input.contains("Ans"))
					input = input.replace("Ans", answer);
				if(input.contains("^-1")){
					input = textField1.getText().replace("^-1", "^(0-1)");
					textField1.setText(input);
				}
				
				String ans;
				
				if(nonNumber == true){
					nonNumber answer = new nonNumber(input, indicator);
					ans = answer.calculate();
				}
				else{
					infixToPostfix infix = new infixToPostfix(input);
					ans = infix.calculate();
				}
				
				if(input.contains("^(0-1)")){
					input = textField1.getText().replace("^(0-1)","^-1");
					textField1.setText(input);
				}
				
				if(!ans.equals("Infinity"))
					textField2.setText(ans);
				else
					textField2.setText("Syntax Error");
				reset = true;
			}
			main.requestFocus();
		}
	}
	
	public static void main(String[] args) throws IOException{
		
		Calculator calculator = new Calculator();
		
		calculator.setDefaultCloseOperation(WindowConstants.DO_NOTHING_ON_CLOSE);
		calculator.setResizable(false);
		calculator.setSize(300, 625);
		calculator.setVisible(true);
		calculator.getGlassPane().setVisible(true);
		calculator.setLocationRelativeTo(null);
	}
	
}