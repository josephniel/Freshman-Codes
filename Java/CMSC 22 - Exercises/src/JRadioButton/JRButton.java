package JRadioButton;

import java.awt.FlowLayout;
import java.awt.event.ItemEvent;
import java.awt.event.ItemListener;

import javax.swing.ButtonGroup;
import javax.swing.ImageIcon;
import javax.swing.JFrame;
import javax.swing.JRadioButton;
import javax.swing.JTextField;

	public class JRButton {
	
		public static void main(String[] args){
		
		JRButtonGUI a = new JRButtonGUI();
		
		a.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		a.setSize(500,200);
		a.setVisible(true);
		
		}
	}

	class JRButtonGUI extends JFrame{
	
	private static final long serialVersionUID = 1L;
	
	private JTextField textfield;
	private JTextField textfield2;
	private String one = "Hahaha";
	private String two = "Hehehe";
	private String three = "Hihihi";
	private String four = "Hohoho";
	private String one2 = "Ice King";
	private String two2 = "Finn";
	private String three2 = "BMO";
	private String four2 = "Jake";
	private ImageIcon icon1;
	private ImageIcon icon2;
	private ImageIcon icon3;
	private ImageIcon icon4;
	private ImageIcon icon5;
	private JRadioButton orb;
	private JRadioButton twrb;
	private JRadioButton thrb;
	private JRadioButton frb;
	private JRadioButton orb2;
	private JRadioButton twrb2;
	private JRadioButton thrb2;
	private JRadioButton frb2;
	private ButtonGroup group;
	private ButtonGroup group2;
	
	public JRButtonGUI(){
		super("JRadioButton Example");
		setLayout(new FlowLayout());
		
		textfield = new JTextField("Choose a different radio button");
		textfield.setColumns(40);
		textfield.setEditable(false);
		textfield2 = new JTextField("Choose one radio button");
		textfield2.setColumns(40);
		textfield2.setEditable(false);
		
		java.net.URL imgURL1 = getClass().getResource("iceking.gif");
		java.net.URL imgURL2 = getClass().getResource("finn.gif");
		java.net.URL imgURL3 = getClass().getResource("bmo.gif");
		java.net.URL imgURL4 = getClass().getResource("jake.gif");
		java.net.URL imgURL5 = getClass().getResource("gunter.gif");
		icon1 = new ImageIcon(imgURL1,"hehe");
		icon2 = new ImageIcon(imgURL2,"hehe");
		icon3 = new ImageIcon(imgURL3,"hehe");
		icon4 = new ImageIcon(imgURL4,"hehe");
		icon5 = new ImageIcon(imgURL5,"hehe");
		
		orb = new JRadioButton("Choose this!", true);
		twrb = new JRadioButton("No, This!", false);
		thrb = new JRadioButton("Hello", false);
		frb = new JRadioButton("Hey", false);
		orb2 = new JRadioButton(icon1, false);
		twrb2 = new JRadioButton(icon2, false);
		thrb2 = new JRadioButton(icon3, false);
		frb2 = new JRadioButton(icon4, false);
		orb2.setSelectedIcon(icon5);
		twrb2.setSelectedIcon(icon5);
		thrb2.setSelectedIcon(icon5);
		frb2.setSelectedIcon(icon5);
		
		group = new ButtonGroup();
		group.add(orb);
		group.add(twrb);
		group.add(thrb);
		group.add(frb);
		group2 = new ButtonGroup();
		group2.add(orb2);
		group2.add(twrb2);
		group2.add(thrb2);
		group2.add(frb2);
		
		orb.addItemListener(new Handler(one,1));
		twrb.addItemListener(new Handler(two,1));
		thrb.addItemListener(new Handler(three,1));
		frb.addItemListener(new Handler(four,1));
		orb2.addItemListener(new Handler(one2, 2));
		twrb2.addItemListener(new Handler(two2, 2));
		thrb2.addItemListener(new Handler(three2, 2));
		frb2.addItemListener(new Handler(four2, 2));
		
		add(textfield);
		add(orb);
		add(twrb);
		add(thrb);
		add(frb);
		add(textfield2);
		add(orb2);
		add(twrb2);
		add(thrb2);
		add(frb2);
	}
	
	private class Handler implements ItemListener{
		
		private String text;
		private int group;
		
		public Handler(String a, int b){
			text = a;
			group = b;
		}
		
		public void itemStateChanged(ItemEvent event){
			if(group == 1)
				textfield.setText(text);
			else
				textfield2.setText(text);
		}
		
	}
	
}
