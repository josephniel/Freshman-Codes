package JavaMusic;
import java.io.File;
import java.io.IOException;

import org.jfugue.Pattern;
import org.jfugue.Player;

public class _SundayMorning implements Song{
	
	@Override
	public void play(){	
		Player player = new Player();
		Pattern pattern1 = new Pattern("T[140] I[Piano] Rh G5q E5i G5q E5q G5q E5q D5q C5h. " +
				"Rq G5q E5i G5q E5q D5q.. C5q C5h. " + "Rq G5q E5i G5q E5q E5q. D5q D5i C5q. C5q D5q E5q D5i C5q. " +
				"C5i A4q C5q D5 Eb5q D5q. C5i C5i A4i C5h. Rq " + " C5q A5q G5q G5i E5q A5q G5q. G5i E5q A5q G5q G5q E5i A5q Rq "
 				+ " E5i E5i G5q A5q G5q. G5i E5q A5q Ri G5q. E5q A5q. G5i E5i A5q Rq. " +
				"G5q F5q E5q D5q C5q D5q C5q. D5i E5i E5q Rh " + "G5q F5q E5q D5q C5q D5q E5q D5q C5i C5q.. Rh."
				+ "E5q E5q F5q G5h.. E5h.. C5q Rq Rq C5i E5q D5q E5q F5q G5h.. E5h.. C5q Rq Rq "
				+ "E5i D5q E5q F5q G5h.. E5h.. C5q E5i F5q E5q D5q C5q A4q A4q C5q.. Ri C5i G5q G5i D5q D5q. C5i C5q.. ");
		

		player.play(pattern1);
		try {
			player.saveMidi(pattern1, new File("sunday morning.midi"));
		} catch (IOException e) {
			e.printStackTrace();
		}
	}
}