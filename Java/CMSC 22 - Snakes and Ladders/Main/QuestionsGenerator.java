package Main;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Random;
import java.util.Stack;

public class QuestionsGenerator{
	
	private String[] answers;
	private String question;
	
	public static int answerIndex, arrayListIndex;
	public static Stack<Integer> index;
	public static ArrayList<String[]> listOfAnswers;
	public static ArrayList<String> listOfQuestions;
	public static ArrayList<Integer> listOfAnswerIndices;
	public static ArrayList<String> listOfAnswerTrivia;
	
	public QuestionsGenerator() throws IOException{
		
		listOfAnswers = new ArrayList<String[]>();
		listOfQuestions = new ArrayList<String>();
		listOfAnswerIndices = new ArrayList<Integer>();
		listOfAnswerTrivia = new ArrayList<String>();
		
		index = new Stack<Integer>();
		
		// 1
		answers = new String[4];
		question = "How many holes are there in a polo?";
		answers[0] = "One";
		answers[1] = "Two";
		answers[2] = "Three";
		answers[3] = "Four";
		listOfQuestions.add(question); listOfAnswers.add(answers);	listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("There are 2 on the sleeves, 1 on the neck part and 1 on the bottom part");
		
		// 2
		answers = new String[4];
		question = "Can a match box?";
		answers[0] = "Yes";
		answers[1] = "No";
		answers[2] = "No, but a tin can.";
		answers[3] = "Yes, one beat Mike Tyson";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("No, but a tin can - Hehehe");
		
		// 3
		answers = new String[4];
		question = ".SDRAWKCAB NOITSEUQ SIHT REWSNA";
		answers[0] = "K.O";
		answers[1] = "What?";
		answers[2] = "I don't understand.";
		answers[3] = "Tennis Elbow";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("K.O (O.K in reverse) - The question says 'ANSWER THIS QUESTION IN REVERSE' (in case you didn't get that). ");
		
		// 4
		answers = new String[4];
		question = "What is the square root of onion?";
		answers[0] = "28";
		answers[1] = "Carrots";
		answers[2] = "Shallots";
		answers[3] = "Pi";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("Shallot - A small bulb that resembles an onion and is used for pickling or as a substitute for onion.");
		
		// 5
		answers = new String[4];
		question = "<html> Mary has a father who has 4 children in which 3 are named as follows: <br />September, October, November. <br /> Question: What came first, the chicken or the egg?</html>";
		answers[0] = "Chicken";
		answers[1] = "Egg";
		answers[2] = "The Fox";
		answers[3] = "I don't know (or care)";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("Chicken - Some studies in which I can't recall say that the chicken came before the egg because there is this specific enzyme on eggs that only chickens can produce.");
		
		// 6
		answers = new String[4];
		question = "What does the fox say?";
		answers[0] = "Awoooooo";
		answers[1] = "Arf Arf";
		answers[2] = "Sweeeekk";
		answers[3] = "Ring-ding-ding-ding-dingeringeding";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("Ring-ding-ding-ding-dingeringeding - Watch Ylvis' music video 'The Fox'.");
		
		// 7
		answers = new String[4];
		question = "What is another possible sound a fox makes?";
		answers[0] = "Wa-pa-pa-pa-pa-pa-pow!";
		answers[1] = "Joff-tchoff-tchoffo-tchoffo-tchoff!";
		answers[2] = "A-hee-ahee ha-hee!";
		answers[3] = "All of the above";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("All of the above - Another reference from 'The Fox' by Ylvis. That song's awesome.");
		
		// 8
		answers = new String[4];
		question = "<html> Tanya is older than Eric. <br /> Cliff is older than Tanya. <br /> Eric is older than Cliff. <br /> If the first two statements are true, the third statement is</html";
		answers[0] = "True";
		answers[1] = "False";
		answers[2] = "I don't know";
		answers[3] = "Who cares?";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("Logic.");
		
		// 9
		answers = new String[4];
		question = "<html> Fact 1: All dogs like to run. <br /> Fact 2: Some dogs like to swim. <br /> Fact 3:	Some dogs look like their masters. <br /> If the first three statements are facts, which of the following statements must also be a fact? <br /> I:	All dogs who like to swim look like their masters.<br /> II: Dogs who like to swim also like to run. <br /> III: Dogs who like to run do not look like their masters.</html>";
		answers[0] = "I only";
		answers[1] = "II only";
		answers[2] = "II and III only";
		answers[3] = "TL; DR";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("Hehehe.");
		
		// 10
		answers = new String[4];
		question = "";
		answers[0] = "True";
		answers[1] = "False";
		answers[2] = "I don't know";
		answers[3] = "Who cares?";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("There is really no question given here. Hahaha. Just try to guess the answer next time. ;)");
		
		// 11
		answers = new String[4];
		question = "What is the best-selling fruit in the United States?";
		answers[0] = "Strawberries";
		answers[1] = "Oranges";
		answers[2] = "Apples";
		answers[3] = "Bananas"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("The Cavendish banana is the most popular variety.");

		// 12
		answers = new String[4];
		question = "<html>What is the most common reason <br /> that people hire a private detective?</html>";
		answers[0] = "Catch a cheating spouse";
		answers[1] = "Find a debtor";
		answers[2] = "Catch company thieves";
		answers[3] = "Locate a missing person"; 
		listOfQuestions.add(question); 	listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("Find a debtor - People trying to catch a cheater often use hidden cameras and check emails.");

		// 13
		answers = new String[4];
		question = "What is the world's best-selling musical instrument?";
		answers[0] = "Harmonica";
		answers[1] = "Recorder";
		answers[2] = "Piano";
		answers[3] = "Guitar"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("It is believed that the harmonica originated in Europe in the early part of the nineteenth century.");
		
		// 14
		answers = new String[4];
		question = "<html>What is the record for the most<br /> folds in a single piece of paper? </html>";
		answers[0] = "12";
		answers[1] = "9";
		answers[2] = "6";
		answers[3] = "18"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("12 - Britney Gallivan set the record in January of 2002 while she was still in high school.");

		// 15
		answers = new String[4];
		question = "Which country invented playing cards?";
		answers[0] = "Italy";
		answers[1] = "Russia";
		answers[2] = "China";
		answers[3] = "France";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("China - The playing card was invented during the Tang Dynasties reign.");

		// 16
		answers = new String[4];
		question = "In a public washroom, which stall is used the least?";
		answers[0] = "The one closest to the door";
		answers[1] = "The handicapped stall";
		answers[2] = "The one farthest from the door";
		answers[3] = "The one in the middle"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("According to research, the stall closest to the door is the least used and therefore most likely to be the cleanest.");

		// 17
		answers = new String[4];
		question = "<html>In a standard deck of playing cards, <br />whom does the King of Spades represent?</html>";
		answers[0] = "King Edward";
		answers[1] = "King David";
		answers[2] = "Charlemagne";
		answers[3] = "Julius Caesar"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("King David - The King of Clubs represents Alexander the Great.");

		// 18
		answers = new String[4];
		question = "<html>How many deaths are caused each <br />year by doctor's poor handwriting?</html> ";
		answers[0] = "500";
		answers[1] = "3500";
		answers[2] = "7000";
		answers[3] = "1500"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("According to statistics, 7000 people worldwide die each year because doctors have sloppy writing.");

		// 19
		answers = new String[4];
		question = "<html>Which country regards sleeping <br /> on the job as a sign of hard work?</html>";
		answers[0] = "Brazil";
		answers[1] = "Mexico";
		answers[2] = "Japan";
		answers[3] = "Spain"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("Some people in Japan even pretend to sleep to appear more dedicated.");

		// 20
		answers = new String[4];
		question = "<html>How much did the United States' first <br />electronic computer ENIAC weigh?</html> ";
		answers[0] = "5 tons";
		answers[1] = "30 tons";
		answers[2] = "500 lbs";
		answers[3] = "1 ton"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("30 tons - This huge computer cost the government $500, 000.");

		// 21
		answers = new String[4];
		question = "How many bones make up the skeleton of a dog? ";
		answers[0] = "276";
		answers[1] = "321";
		answers[2] = "230";
		answers[3] = "179"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("Dogs have 321 bones and have 42 permanent teeth.");

		// 22
		answers = new String[4];
		question = "For which movie was the first promotional T-shirt printed? ";
		answers[0] = "The Wizard of Oz";
		answers[1] = "The Sound of Music";
		answers[2] = "Snow White and the Seven Dwarfs";
		answers[3] = "Gone With the Wind"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("The Wizard of OZ - This t-shirt was printed in 1939.");

		// 23
		answers = new String[4];
		question = "When was the Eifel Tower built?";
		answers[0] = "1856";
		answers[1] = "1923";
		answers[2] = "1908";
		answers[3] = "1889"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("1889 - The tower was built as the entrance to The World's Fair.");

		// 24
		answers = new String[4];
		question = "<html>What is the name of <br />the cat that is listed in Guinness <br />as the World's fattest cat?</html>";
		answers[0] = "Max";
		answers[1] = "Garfield";
		answers[2] = "Martin";
		answers[3] = "Henry"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("Henry - This enormous feline weighed thirty-five pounds.");

		// 25
		answers = new String[4];
		question = "What does a white tongue indicate?";
		answers[0] = "Lots of germs";
		answers[1] = "You just ate rice";
		answers[2] = "Your red blood cell count is down";
		answers[3] = "You have tonsillitis"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("A white tongue is an indicator of lots of germs.");
		
		// 26
		answers = new String[4];
		question = "<html>Other than man, what is the<br />only mammal that has death rituals?</html>";
		answers[0] = "Gorillas";
		answers[1] = "Elephants";
		answers[2] = "Dogs";
		answers[3] = "Dolphins"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("Elephants sometimes dig a shallow grave for their dead.");
		
		// 27
		answers = new String[4];
		question = "<html> According to a recent survey,<br />how long does it take before a woman<br />reveals a secret she has been told?</html>";
		answers[0] = "1 hour";
		answers[1] = "24 hours";
		answers[2] = "48 hours";
		answers[3] = "1 week"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("48 hours - If you want to keep your secret, do not tell anyone.");
		
		// 28
		answers = new String[4];
		question = "What is America's favorite pizza topping?";
		answers[0] = "Mushrooms";
		answers[1] = "Pepperoni";
		answers[2] = "Pineapple";
		answers[3] = "Green peppers"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("Pepperoni - The second most popular topping is mushrooms.");

		// 29
		answers = new String[4];
		question = "<html>According to many posts found<br />on the Internet, which Disney movie has<br />the word 'Sex' written in the sky?";
		answers[0] = "Tarzan";
		answers[1] = "Mulan";
		answers[2] = "The Lion King";
		answers[3] = "Tangled"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(2);
		listOfAnswerTrivia.add("The Lion King - Disney says that the letters spell SFX.");
		
		// 30
		answers = new String[4];
		question = "Why do otters hold hands while sleeping?";
		answers[0] = "To stay together";
		answers[1] = "To make themselves look larger to predators";
		answers[2] = "Love";
		answers[3] = "Indicates a bonded pair"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("By holding hands, the otters will not float away from each other.");

		// 31
		answers = new String[4];
		question = "<html>How many times will the average person<br />walk around the world during their life?</html>";
		answers[0] = "1";
		answers[1] = "7";
		answers[2] = "11";
		answers[3] = "5"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("5 - The Earth's circumference is 40,075 km. Make sure you have a good pair of shoes.");

		// 32
		answers = new String[4];
		question = "What did a person mail that weighed 40,000-tons?";
		answers[0] = "A tank";
		answers[1] = "A house";
		answers[2] = "A train engine";
		answers[3] = "A plane"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("A house - It is now illegal to mail houses in America.");

		// 33
		answers = new String[4];
		question = "What could you power with your brain's energy??";
		answers[0] = "A toaster";
		answers[1] = "A light bulb";
		answers[2] = "A television";
		answers[3] = "A microwave"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("A light bulb - Your brain generates between 10 and 23 watts of power.");

		// 34
		answers = new String[4];
		question = "What are gorillas? ";
		answers[0] = "Carnivores";
		answers[1] = "Diurnal";
		answers[2] = "Omnivores";
		answers[3] = "Herbivores"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("Herbivores - Gorillas live in family groups.");

		// 35
		answers = new String[4];
		question = "What did Queen Elizabeth do during WWI? ";
		answers[0] = "Worked with the coast guard";
		answers[1] = "Flew planes";
		answers[2] = "Worked as a candy striper";
		answers[3] = "Worked as a mechanic"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("Worked as a mechanic - The Queen worked with the Auxiliary Territorial Service.");

		// 36
		answers = new String[4];
		question = "<html>Who is credited with introducing the<br />first computer mouse to the world?</html>";
		answers[0] = "Steve Jobs";
		answers[1] = "Konrad Kuse";
		answers[2] = "Steve Wozniak";
		answers[3] = "Dr. Douglas Engelbart"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("Dr. Douglas Engelbart made the introduction in 1968.");
		
		// 37
		answers = new String[4];
		question = "<html>According to recent studies,<br />how long does it take the average person<br />to forgive someone who has emotionally hurt them?</html>";
		answers[0] = "Five years";
		answers[1] = "One year";
		answers[2] = "2-3 weeks";
		answers[3] = "6-8 months"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(3);
		listOfAnswerTrivia.add("6-8 months - Although many people can forgive, they normally do not forget ");
		
		// 38
		answers = new String[4];
		question = "In what year was the F-word first used in the movies?";
		answers[0] = "1968";
		answers[1] = "1961";
		answers[2] = "1957";
		answers[3] = "1974";
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(0);
		listOfAnswerTrivia.add("1968 - The word was first heard in the movie 'I'll Never Forget Whatshisname.");
		
		// 39
		answers = new String[4];
		question = "<html>How many people have died in the US<br />while shaking vending machines since 1978?<html>";
		answers[0] = "52";
		answers[1] = "37";
		answers[2] = "26";
		answers[3] = "9"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("37 - Most were attempting to get their purchase out of the machine.");
		
		// 40
		answers = new String[4];
		question = "How much did the world's largest pumpkin weigh?";
		answers[0] = "1866 lbs";
		answers[1] = "2009 lbs";
		answers[2] = "1903 lbs";
		answers[3] = "1785 lbs"; 
		listOfQuestions.add(question); listOfAnswers.add(answers); listOfAnswerIndices.add(1);
		listOfAnswerTrivia.add("2009 pounds - This record was set in 2012.");
		
		int i = 0;
		while(i != 40){
			Random random = new Random();
			int j = random.nextInt(40);
		
			if(!QuestionsGenerator.index.contains(j)){
				QuestionsGenerator.index.push(j);
				i++;
			}
		}
		
	}
	
	public static String GenerateQuestion(int a){
		return QuestionsGenerator.listOfQuestions.get(a);
	}
	
	public static String[] GenerateAnswers(int a){
		return QuestionsGenerator.listOfAnswers.get(a);
	}
	
	public static int GenerateAnswerIndex(int a){
		return QuestionsGenerator.listOfAnswerIndices.get(a);
	}
}