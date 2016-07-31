package Main;

import java.awt.Dimension;
import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Timer;
import java.util.TimerTask;

import javax.swing.ButtonGroup;
import javax.swing.ImageIcon;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JRadioButton;

public class SnakeOrLadderChecker{
	
	public SnakeOrLadderChecker(int currentPlayerPosition, int currentPlayer) {
		if(Dice.ladderCheckpoints.contains(currentPlayerPosition)){
			JOptionPane.showMessageDialog(null, "Ready?");
			if(EnableMusic.MusicEnabled == 1)
				Audio.startBackgroundMusic(3);
			new QuestionWindow(currentPlayer);
		}
		else if(Dice.snakesCheckpoints.contains(currentPlayerPosition)){
			JOptionPane.showMessageDialog(null, "Ready?");
			if(EnableMusic.MusicEnabled == 1)
				Audio.startBackgroundMusic(3);	
			new QuestionWindow(currentPlayer);
		}
	}
}

class QuestionWindow{
	
	public boolean answered;
	public static JPanel content;
	public static JLabel time;
	
	public QuestionWindow(int currentPlayer) {
		
		answered = false;
		
		content = new JPanel(new GridBagLayout());
		content.setPreferredSize(new Dimension(1000,700));
		content.setOpaque(false);
			
			GridBagConstraints c = new GridBagConstraints();
		
			time = new JLabel("20");
			time.setPreferredSize(new Dimension(500,50));
			time.setFont(CreateGUI.quicksand1);
			time.setHorizontalAlignment(JLabel.CENTER);
			
			c.gridx = 1;
			c.gridy = 1;
			
			content.add(time, c);	
			
			QuestionPanel questionPanel = new QuestionPanel(currentPlayer);
			
			c.gridy = 2;
			
			content.add(questionPanel, c);
			
			Timer timer = new Timer();
			new Countdown(currentPlayer);
			timer.scheduleAtFixedRate(Countdown.task, 0, 10);
			
		MainBoard.content.setVisible(false);
		SettingsButton.settings.setVisible(false);
		
		MainBoard.content.getParent().add(content);
		
	}
}

class QuestionPanel extends JPanel{
	
	private static final long serialVersionUID = 1L;
	
	public JButton confirm;
	public JRadioButton radioa, radiob, radioc, radiod;
	public ButtonGroup group;
	
	public static JLabel question, answera, answerb, answerc, answerd;
	public static int arrayListIndex;
	
	public QuestionPanel(int currentPlayer) {
		
		setLayout(new GridBagLayout());
		setPreferredSize(new Dimension(1000,500));
		setOpaque(false);
		
		arrayListIndex = QuestionsGenerator.index.pop();
		
		GridBagConstraints c = new GridBagConstraints();
		
			question = new JLabel(QuestionsGenerator.GenerateQuestion(arrayListIndex));
			question.setPreferredSize(new Dimension(1000,150));
			question.setFont(CreateGUI.quicksand2);
			question.setVerticalAlignment(JLabel.CENTER);
			
			c.gridx = 1;
			c.gridy = 1;
			c.gridwidth = 4;
			c.insets = new Insets(0, 0, 50, 0);
			
			add(question, c);
			
			answera = new JLabel(QuestionsGenerator.GenerateAnswers(arrayListIndex)[0]);
			answera.setPreferredSize(new Dimension(410, 50));
			answera.setFont(CreateGUI.quicksand2);
			
			c.gridy = 2;
			c.gridwidth = 1;
			c.insets = new Insets(0, 10, 50, 10);
			
			add(answera, c);
			
			radioa = new JRadioButton(new ImageIcon(getClass().getResource("images/unselected.png")));
			radioa.setPreferredSize(new Dimension(50,50));
			radioa.setSelectedIcon(new ImageIcon(getClass().getResource("images/selected.png")));
			radioa.setOpaque(false);
			radioa.addActionListener(new ClickSound());
			
			c.gridx = 2;
			
			add(radioa, c);
			
			answerb = new JLabel(QuestionsGenerator.GenerateAnswers(arrayListIndex)[1]);
			answerb.setPreferredSize(new Dimension(410, 50));
			answerb.setFont(CreateGUI.quicksand2);
			
			c.gridx = 3;
			
			add(answerb, c);
			
			radiob = new JRadioButton(new ImageIcon(getClass().getResource("images/unselected.png")));
			radiob.setPreferredSize(new Dimension(50,50));
			radiob.setSelectedIcon(new ImageIcon(getClass().getResource("images/selected.png")));
			radiob.setOpaque(false);
			radiob.addActionListener(new ClickSound());
			
			c.gridx = 4;
			
			add(radiob, c);
			
			answerc = new JLabel(QuestionsGenerator.GenerateAnswers(arrayListIndex)[2]);
			answerc.setPreferredSize(new Dimension(410, 50));
			answerc.setFont(CreateGUI.quicksand2);
			
			c.gridx = 1;
			c.gridy = 3;
			
			add(answerc, c);
			
			radioc = new JRadioButton(new ImageIcon(getClass().getResource("images/unselected.png")));
			radioc.setPreferredSize(new Dimension(50,50));
			radioc.setSelectedIcon(new ImageIcon(getClass().getResource("images/selected.png")));
			radioc.setOpaque(false);
			radioc.addActionListener(new ClickSound());
			
			c.gridx = 2;
			
			add(radioc, c);
			
			answerd = new JLabel(QuestionsGenerator.GenerateAnswers(arrayListIndex)[3]);
			answerd.setPreferredSize(new Dimension(410, 50));
			answerd.setFont(CreateGUI.quicksand2);
			
			c.gridx = 3;
			
			add(answerd, c);
			
			radiod = new JRadioButton(new ImageIcon(getClass().getResource("images/unselected.png")));
			radiod.setPreferredSize(new Dimension(50,50));
			radiod.setSelectedIcon(new ImageIcon(getClass().getResource("images/selected.png")));
			radiod.setOpaque(false);
			radiod.addActionListener(new ClickSound());
			
			c.gridx = 4;
			
			add(radiod, c);
		
			group = new ButtonGroup();
			group.add(radioa);
			group.add(radiob);
			group.add(radioc);
			group.add(radiod);	
	
			confirm = new JButton();
			confirm.setPreferredSize(new Dimension(150, 50));
			confirm.addActionListener(new Confirm(QuestionsGenerator.GenerateAnswerIndex(arrayListIndex), currentPlayer));
			confirm.setContentAreaFilled(false);
			confirm.setBorder(null);
			confirm.setOpaque(false);
			confirm.setIcon(new ImageIcon(getClass().getResource("images/submit.png")));
			confirm.setPressedIcon(new ImageIcon(getClass().getResource("images/submit1.png")));
			
			c.gridx = 1;
			c.gridy = 4;
			c.gridwidth = 4;
			c.insets = new Insets(0, 10, 0, 10);
			
			add(confirm, c);	
	}
	
	class Confirm implements ActionListener{
		
		private int answerIndex, selectedIndex = -1, currentPlayer;
		
		public Confirm(int answerIndex, int currentPlayer) {
			this.answerIndex = answerIndex;
			this.currentPlayer = currentPlayer;
		}
		@Override
		public void actionPerformed(ActionEvent arg0) {
			
			Sound.click2.play(EnableMusic.SoundEnabled);
			
			Countdown.task.cancel();
			Audio.disableBackgroundMusic();
			
			if(radioa.isSelected()){
				selectedIndex = 0;
			}
			else if(radiob.isSelected()){
				selectedIndex = 1;
			}
			else if(radioc.isSelected()){
				selectedIndex = 2;
			}
			else if(radiod.isSelected()){
				selectedIndex = 3;
			}
			
			if(answerIndex == selectedIndex){
				JOptionPane.showMessageDialog(null, "Correct!");
				if(currentPlayer == 1){
					if(Dice.ladderCheckpoints.contains(Integer.valueOf(Dice.player1.getText())))
						Dice.player1.setText(String.valueOf(Dice.ladderEnd.get(Dice.ladderCheckpoints.indexOf(Integer.parseInt(Dice.player1.getText())))));
				}
				else if(currentPlayer == 2){
					if(Dice.ladderCheckpoints.contains(Integer.valueOf(Dice.player2.getText())))
						Dice.player2.setText(String.valueOf(Dice.ladderEnd.get(Dice.ladderCheckpoints.indexOf(Integer.parseInt(Dice.player2.getText())))));
				}
				else if(currentPlayer == 3){
					if(Dice.ladderCheckpoints.contains(Integer.valueOf(Dice.player3.getText())))
						Dice.player3.setText(String.valueOf(Dice.ladderEnd.get(Dice.ladderCheckpoints.indexOf(Integer.parseInt(Dice.player3.getText())))));
				}
				else if(currentPlayer == 4){
					if(Dice.ladderCheckpoints.contains(Integer.valueOf(Dice.player4.getText())))
						Dice.player4.setText(String.valueOf(Dice.ladderEnd.get(Dice.ladderCheckpoints.indexOf(Integer.parseInt(Dice.player4.getText())))));
				}
			}
			else{
				JOptionPane.showMessageDialog(null, "Sorry, wrong answer.");
				if(currentPlayer == 1){
					if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player1.getText())))
						Dice.player1.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player1.getText())))));
				}
				else if(currentPlayer == 2){
					if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player2.getText())))
						Dice.player2.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player2.getText())))));
				}
				else if(currentPlayer == 3){
					if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player3.getText())))
						Dice.player3.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player3.getText())))));
				}
				else if(currentPlayer == 4){
					if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player4.getText())))
						Dice.player4.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player4.getText())))));
				}
			}
			
			new SetLocation();
			
			if(Dice.currentPlayer == 1){
				if(Dice.player2finished == false){
					Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player2IconIndex) + ".png")));
					Dice.currentPlayer = 2;
				}
				else if(Dice.player3finished == false && Dice.numberOfPlayers >= 3){
					Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player3IconIndex) + ".png")));
					Dice.currentPlayer = 3;
				}
				else if(Dice.player4finished == false && Dice.numberOfPlayers == 4){
					Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player4IconIndex) + ".png")));
					Dice.currentPlayer = 4;
				}
			}
			else if(Dice.currentPlayer == 2){
				if(Dice.player3finished == false && Dice.numberOfPlayers >= 3){
					Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player3IconIndex) + ".png")));
					Dice.currentPlayer = 3;
				}
				else if(Dice.player4finished == false && Dice.numberOfPlayers == 4){
					Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player4IconIndex) + ".png")));
					Dice.currentPlayer = 4;
				}
				else if(Dice.player1finished == false){
					Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player1IconIndex) + ".png")));
					Dice.currentPlayer = 1;
				}
			}
			else if(Dice.currentPlayer == 3){
				if(Dice.player4finished == false && Dice.numberOfPlayers == 4){
					Dice.player4Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player4IconIndex) + ".png")));
					Dice.currentPlayer = 4;
				}
				if(Dice.player1finished == false){
					Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player1IconIndex) + ".png")));
					Dice.currentPlayer = 1;
				}
				else if(Dice.player2finished == false){
					Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player2IconIndex) + ".png")));
					Dice.currentPlayer = 2;
				}
			}
			else if(Dice.currentPlayer == 4){
				if(Dice.player1finished == false){
					Dice.player1Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player1IconIndex) + ".png")));
					Dice.currentPlayer = 1;
				}
				else if(Dice.player2finished == false){
					Dice.player2Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player2IconIndex) + ".png")));
					Dice.currentPlayer = 2;
				}
				else if(Dice.player3finished == false && Dice.numberOfPlayers >= 3){
					Dice.player3Icon.setIcon(new ImageIcon(getClass().getResource("images/C" + String.valueOf(Dice.player3IconIndex) + ".png")));
					Dice.currentPlayer = 3;
				}
			}
			
			JOptionPane.showMessageDialog(null, QuestionsGenerator.listOfAnswerTrivia.get(QuestionPanel.arrayListIndex), "Trivia", JOptionPane.INFORMATION_MESSAGE);
			
			if(EnableMusic.MusicEnabled == 1)
				Audio.resumeGameMusic();
			
			MainBoard.content.setVisible(true);
			SettingsButton.settings.setVisible(true);
			QuestionWindow.content.setVisible(false);
		}
	}
}

class ClickSound implements ActionListener{
	@Override
	public void actionPerformed(ActionEvent arg0) {
		Sound.click1.play(EnableMusic.SoundEnabled);
	}
}

class Countdown{
	
	private int count;
	
	public static TimerTask task;
	public static int currentPlayer;
	
	public Countdown(int currentPlayer) {
		
		Countdown.currentPlayer = currentPlayer;
		
		count = 20;
		task = new TimerTask() {
			
			@Override
			public void run() {
				if(count > 0){
		            try{Thread.sleep(1000);} 
		            catch(InterruptedException e){e.printStackTrace();}
		            count --;
		            QuestionWindow.time.setText(String.valueOf(count));
		        }
				else{
					this.cancel();
					JOptionPane.showMessageDialog(null, "Time's up!", "", JOptionPane.OK_OPTION);
					
					if(EnableMusic.MusicEnabled == 1)
						Audio.resumeGameMusic();
					
					if(Countdown.currentPlayer == 1)
						if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player1.getText())))
							Dice.player1.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player1.getText())))));
					else if(Countdown.currentPlayer == 2)
						if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player2.getText())))
							Dice.player2.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player2.getText())))));
					else if(Countdown.currentPlayer == 3)
						if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player3.getText())))
							Dice.player3.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player3.getText())))));
					else if(Countdown.currentPlayer == 4)
						if(Dice.snakesCheckpoints.contains(Integer.valueOf(Dice.player4.getText())))
							Dice.player4.setText(String.valueOf(Dice.snakesEnd.get(Dice.snakesCheckpoints.indexOf(Integer.parseInt(Dice.player4.getText())))));
					
					MainBoard.content.setVisible(true);
					SettingsButton.settings.setVisible(true);
					QuestionWindow.content.setVisible(false);
				}
			}
		}; // end of timer task
	}
}
