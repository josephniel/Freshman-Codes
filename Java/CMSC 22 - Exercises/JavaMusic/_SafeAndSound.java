package JavaMusic;
import java.io.File;
import java.io.IOException;

import org.jfugue.Pattern;
import org.jfugue.Player;


public class _SafeAndSound {
	
	public static Pattern getPattern(){
		
		Pattern right = new Pattern(""
				+ "A3i_E4i A4q E4i_G4i B4q "
				+ "C4q+G4q G4q G4q F4q "
				+ "A3i_E4i A4q E4i_G4i B4q "
				+ "C4q+G4q C5q G5q+B4q B4q "
				+ "A4i_C5i E5q E4i_G4i B4q " // find error
				+ "C4q+G4q C5q G4q+B4q D5q "
				+ "A4i_C5i E5q E4i_G4i B4q "
				);
		
		Pattern left = new Pattern(""
				+ "A4i_E5i C6s B5i Rs E5q D5q "
				+ "E5q E5i_D5i B4i_C5i A4q "
				+ "A4i_E5i C6s B5i Rs E5q D5q "
				+ "E5q G5q D5h+G5h "
				+ "E6i+B6i_E6i+B6i_A6i_A6i G6i G6s_G6s F#6s D6i " // find error
				+ "E6i_E6i_E6i_D6i B5h "
				+ "E6i+B6i_E6i+B6i E6i+A6i G6s G6i F#6i_D6i "
				);
		
		Pattern pattern = new Pattern();
		pattern.add("T[70] I[ACOUSTIC_GRAND] V0 " + right.getMusicString());
		pattern.add("T[70] I[ELECTRIC_GRAND] V1 " + left.getMusicString());
		
		return pattern;
		
	} 
	
	public static void main(String[] args){

		Pattern pattern = _SafeAndSound.getPattern();
		
		Player player = new Player();
		player.play(pattern);
		
		try {
			player.saveMidi(pattern, new File("thousand miles.midi"));
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

}
