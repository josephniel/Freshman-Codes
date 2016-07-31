package Main;

import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.GridLayout;
import java.awt.Image;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.FocusEvent;
import java.awt.event.FocusListener;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;
import java.util.ArrayList;
import java.util.Random;

import javax.swing.BorderFactory;
import javax.swing.ButtonGroup;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JRadioButton;
import javax.swing.JTextField;
import javax.swing.border.CompoundBorder;

public class SelectNumberAndTokenOfPlayers{
	
	public static JPanel content;
	public static int humanOrAI = 0;
	
	token token1, token2, token3, token4;
	tokenList list;
	
	JRadioButton[] tokens;
	JButton addButton, play;
	
	String tokenStringIndices = new String();
	
	String[] AIRandomNames, playerNames;
	String[] AINameContainer = 
		{"Jeshurun_AI","Krizia_AI","Earl_AI","Christine_AI","Dominique_AI",
		 "Raffy_AI", "Dan_AI", "Cristine_AI", "Rain_AI", "Kit_AI",
		 "Nathan_AI", "Harold_AI", "Renzo_AI", "Aky_AI", "Aaron_AI"};
	
	int index,
		indicator, // indicates who among the players will pick their avatar
		numberOfRandomTokens,
		numberOfPlayers;
	
	ArrayList<Integer> AINames = new ArrayList<Integer>();
	ArrayList<Integer> tokenIndices = new ArrayList<Integer>();
	
	public SelectNumberAndTokenOfPlayers(){
		
		content = new anotherBackground();
		
		CreateGUI.paneNumber = 1;
		
		AIRandomNames = new String[4];
		playerNames = new String[4];
		
		numberOfRandomTokens = 0;
		numberOfPlayers = 1;
		indicator = 1;
		index = 0;
		
		int i = 0;
		
		while(i != 3){
			Random random = new Random();
			int j = random.nextInt(15);
			
			if(!AINames.contains(j)){
				AINames.add(j);
				AIRandomNames[i] = AINameContainer[j];
				i++;
			}
			
		}
		
		content.setPreferredSize(new Dimension(1200,700));
		content.setOpaque(false);
		content.setLayout(new GridBagLayout());
		
			GridBagConstraints c = new GridBagConstraints();
		
			JPanel leftPanel = new JPanel(new GridBagLayout());
			leftPanel.setPreferredSize(new Dimension(500,700));
			leftPanel.setOpaque(false);
			
				token1 = new token(true, 1);
				
				c.gridx = 1;
				c.gridy = 1;

				leftPanel.add(token1.container, c);								

				token2 = new token(false, 2);

				c.gridy = 2;
				
				leftPanel.add(token2.container, c);	

				token3 = new token(false, 3);

				c.gridy = 3;
				
				leftPanel.add(token3.container, c);	

				token4 = new token(false, 4);

				c.gridy = 4;
				
				leftPanel.add(token4.container, c);
				
				JPanel fifth = new JPanel();
				fifth.setOpaque(false);
				
					new addPlayer();

					c.gridx = 1;
					c.gridy = 1;
				
					fifth.add(addButton, c);
				
					new play();
			
					c.gridx = 2;
					c.gridy = 1;
				
					fifth.add(play, c);
					
				c.gridx = 1;
				c.gridy = 5;
					
				leftPanel.add(fifth, c);
				
			c.gridx = 1;
			c.gridy = 1;
			
			content.add(leftPanel, c);
			
			JPanel rightPanel = new JPanel(new GridLayout(1,1));
			rightPanel.setPreferredSize(new Dimension(700,700));
			rightPanel.setOpaque(false);
			
				list = new tokenList();
				
				rightPanel.add(list.container);
			
			c.gridx = 2;
			
			content.add(rightPanel, c);
	}
	
	class play implements ActionListener{
		
		public play() {
			play = new JButton(new ImageIcon(getClass().getResource("images/play1.png")));
			play.setPreferredSize(new Dimension(100,50));
			play.setPressedIcon(new ImageIcon(getClass().getResource("images/play2.png")));
			
			play.setContentAreaFilled(false);
			play.setBorder(null);
			play.setOpaque(false);
			
			play.setEnabled(false);
			play.addActionListener(this);
		}

		void random(int a, ArrayList<Integer> temp){
				if(a == 15)
					a = new Random().nextInt(15);
				
				if(!temp.contains(a) && a != 0){
					tokenStringIndices = tokenStringIndices + String.valueOf(a) + "-";
					temp.add(a);
				}
				else{
					random(15, temp);
				}
		}
		
		@Override
		public void actionPerformed(ActionEvent e) {
			
			Sound.click3.play(EnableMusic.SoundEnabled);
			
			playerNames[0] = token1.name.getText();
			playerNames[1] = token2.name.getText();
			playerNames[2] = token3.name.getText();
			playerNames[3] = token4.name.getText();
			
			ArrayList<Integer> temp = new ArrayList<Integer>();
			
			for(int a : tokenIndices){
				random(a, temp);
			}
			
			new MainBoard(humanOrAI, numberOfPlayers, playerNames, tokenStringIndices);
			
			play.getParent().getParent().getParent().getParent().add(MainBoard.content);
			SelectNumberAndTokenOfPlayers.content.setVisible(false);
			
			Audio.startBackgroundMusic(2);
			
		}
	}
	
	class addPlayer implements ActionListener{

		int counter = 1;
		
		public addPlayer() {
			addButton = new JButton(new ImageIcon(getClass().getResource("images/add1.png")));
			addButton.setPreferredSize(new Dimension(100,50));
			addButton.setPressedIcon(new ImageIcon(getClass().getResource("images/add2.png")));
			
			addButton.setContentAreaFilled(false);
			addButton.setBorder(null);
			addButton.setOpaque(false);
			
			addButton.setEnabled(false);
			addButton.addActionListener(this);
		}
		
		@Override
		public void actionPerformed(ActionEvent e) {
			
			switch(counter){
				case 1:
					token2.container.setVisible(true);
					if(humanOrAI == 1)
						token2.name.setText(AIRandomNames[indicator-2]);
					counter++;
					break;
				case 2:
					token3.container.setVisible(true);
					if(humanOrAI == 1)
						token3.name.setText(AIRandomNames[indicator-2]);
					counter++;
					break;
				case 3:
					token4.container.setVisible(true);
					if(humanOrAI == 1)
						token4.name.setText(AIRandomNames[indicator-2]);
					addButton.setEnabled(false);
					break;
				default:
					break;
			}
			
			Sound.click3.play(EnableMusic.SoundEnabled);
			
			numberOfPlayers++;
			addButton.setEnabled(false);
			play.setEnabled(false);
		}	
	}
	
	class tokenList implements ItemListener{

		JPanel container;
		ImageIcon[] tokenIcons, tokenIconsSelected;
		ButtonGroup tokenGroup;
		
		public tokenList() {
			container = new JPanel(new GridBagLayout());
			container.setPreferredSize(new Dimension(700,700));
			container.setOpaque(false);
			
			tokens = new JRadioButton[17];
			tokenIcons = new ImageIcon[17];
			tokenIconsSelected = new ImageIcon[17];
			
			GridBagConstraints c = new GridBagConstraints();
			
			tokenGroup = new ButtonGroup();
			
			for(int i = 1; i < 17; i++){
				String link = "images/T" + String.valueOf(i) +".png";
				tokenIcons[i] = new ImageIcon(getClass().getResource(link));
				
				link = "images/ST" + String.valueOf(i) +".png";
				tokenIconsSelected[i] = new ImageIcon(getClass().getResource(link));
			}
			
			for(int i = 1; i < 17; i++){
				tokens[i] = new JRadioButton();
				tokens[i].setPreferredSize(new Dimension(125,125));
				tokens[i].setIcon(tokenIcons[i]);
				tokens[i].setSelectedIcon(tokenIconsSelected[i]);
				tokens[i].setOpaque(false);
				tokens[i].addItemListener(this);
				
				tokenGroup.add(tokens[i]);

				c.insets = new Insets(20,20,20,20);
				
				if(i%4!=0){ c.gridx = i%4; }
				else{ c.gridx = 4; }
				
				if(i<5){ c.gridy = 1; }
				else if(i<9){ c.gridy = 2; }
				else if(i<13){ c.gridy = 3; }
				else{ c.gridy = 4; }
				
				container.add(tokens[i], c);
			}
		}

		@Override
		public void itemStateChanged(ItemEvent e) {
			for(int i = 1; i < 17; i++){
				if(tokens[i].isSelected()){
					
					index = i;
					
					if(indicator == 1)
						token1.image.setIcon(tokenIcons[i]);
					else if(indicator == 2)
						token2.image.setIcon(tokenIcons[i]);
					else if(indicator == 3)
						token3.image.setIcon(tokenIcons[i]);
					else if(indicator == 4)
						token4.image.setIcon(tokenIcons[i]);
					
				}
			}
			Sound.click1.play(EnableMusic.SoundEnabled);
		}	
	} // end of tokenList class

	class token{
		
		JPanel container;
		JTextField name;
		JButton confirm;
		JLabel image;
		
		public token(Boolean b, int tokenNumber) {
			
			container = new JPanel(new GridBagLayout());
			container.setPreferredSize(new Dimension(500,140));
			container.setBorder(BorderFactory.createEmptyBorder(0,0,15,0));
			container.setOpaque(false);
			
			GridBagConstraints c = new GridBagConstraints();
			
			image = new JLabel();
			image.setPreferredSize(new Dimension(125,125));
			image.setOpaque(false);
			image.setIcon(new ImageIcon(getClass().getResource("images/default.png")));
			
			c.gridx = 1;
			c.gridy = 1;
			c.insets = new Insets(0, 0, 0, 0);
			
			container.add(image, c);
			
			name = new nameTextField();
			
			c.gridx = 2;
			c.insets = new Insets(25, 25, 25, 25);
			
			container.add(name, c);
			
			confirm = new confirmButton();
			
			c.gridx = 3;
			c.insets = new Insets(35, 0, 35, 45);
			
			container.add(confirm, c);
		
			if(b == false){
				container.setVisible(false);
			}
			
		}

		class nameTextField extends JTextField implements FocusListener {

			private static final long serialVersionUID = 1L;

			public nameTextField() {
				
				setText("Enter player's name");
				
				addFocusListener(this);
				
				setPreferredSize(new Dimension(230,50));
				setBorder(new CompoundBorder(
						BorderFactory.createMatteBorder(0, 0, 3, 0, new ImageIcon(getClass().getResource("images/border.png"))),
						BorderFactory.createEmptyBorder(0, 10, 0, 10)));
				setBackground(null);
				setFont(CreateGUI.quicksand2);
				setOpaque(false);
				
			}
			
			@Override
			public void focusGained(FocusEvent arg0) {
				setText("");
			}

			@Override
			public void focusLost(FocusEvent arg0) {
				if(getText().equals(""))
					if(humanOrAI == 1){
						if(indicator > 1)
							setText(AIRandomNames[indicator-2]);
						else
							setText("Enter player's name");
					}
					else{
						setText("Enter player's name");
					}
			}
			
		}
		
		class confirmButton extends JButton implements ActionListener{

			private static final long serialVersionUID = 1L;

			public confirmButton() {
				setPreferredSize(new Dimension(30,30));
				addActionListener(this);
				setIcon(new ImageIcon(getClass().getResource("images/button1.png")));
				setPressedIcon(new ImageIcon(getClass().getResource("images/button2.png")));
				setOpaque(false);
				setBorder(null);
				setContentAreaFilled(false);
			}
			
			@Override
			public void actionPerformed(ActionEvent arg0) {
				
				if(!name.getText().equals("Enter player's name")){
					name.setFocusable(false);
					name.setEditable(false);
					setEnabled(false);
					
					addButton.setEnabled(true);
					if(indicator == 1){
						play.setEnabled(false);
					}
					else{
						play.setEnabled(true);
					}
					
					indicator = indicator + 1;
					
					if(index == 0){
						numberOfRandomTokens++;
						tokenIndices.add(15);
					}
					else{
						tokenIndices.add(index);
						tokens[index].setEnabled(false);
					}
					
					tokens[16].setEnabled(true);
					
					if(indicator == 5){
						for(int i = 1; i < 17; i++){
							tokens[i].setEnabled(false);
							addButton.setEnabled(false);
						}
					}
				}
				else{
					JOptionPane.showMessageDialog(null, "Please enter a name for the player.");
				}
				
				Sound.click2.play(EnableMusic.SoundEnabled);
				
			}
		} // end of confirmButton class
	} // end of token class
}// end of main class

class anotherBackground extends JPanel {

	private static final long serialVersionUID = 1L;
	private Image image;
	  
	public anotherBackground() {
		try{image = javax.imageio.ImageIO.read(new java.net.URL(getClass().getResource("images/background2.jpg"), "background2.jpg"));}
		catch(Exception e){e.printStackTrace();}
	}

	@Override
	protected void paintComponent(Graphics g) {
		super.paintComponent(g);
		if (image != null)
			g.drawImage(image, 0,0,this.getWidth(),this.getHeight(),this);
	  }
}