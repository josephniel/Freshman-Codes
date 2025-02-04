package JavaMusic;
import java.io.File;
import java.io.IOException;

import org.jfugue.Pattern;
import org.jfugue.Player;

public class _OutOfMyLeague implements Song {

	@Override
	public void play() {
		Player player = new Player();
		Pattern pattern1 = new Pattern("T[150] I[Piano] Rw E5q E5q " + 
										"C5q C6q. B5i A5q G5q. G5i G5h. Rq E5q D5q " +
										"C5q C6q B5q A5q G5q. G5i A5h. Ri A5q B5q " +
										"C6q D6q B5q C6q D6q B5q C6q D6q. B5i C6q B5q A5q " +
										"C6i_B5i_Ri A5q G5i_F5i_E5q Ri A5h. Ri G5q E5q " +
										"C5q C6q. B5i A5q G5q. G5i G5h. Rq E5q D5q " +
										"C5q C6q B5q A5q G5q. G5i A5h. Ri A5q B5q " +
										"C6q D6q B5q C6q D6q B5q C6q D6q. B5i C6q D6q. B5i C6q D6q. B5i C6q D6q. B5i " +
										"C6q D6q. C6i E6q C6q. C6i F6q E6q D6q E6h. " +
										"Ri C6q D6q E6q C6q. C6i F6q E6q D6q E6h. " +
										"Ri C6q D6q E6q. D6i C6q B5q C6q D6q C6q. B5i A5q " +
										"G5q. A5i B5q C6q. B5i A5q G5q C6q. B5i C6h. " +
										"Ri B5q D6q C6q. B5i_A5i G5q A5q B5q C6q. D6q_B5q " +
										"C6q D6q B5q C6q. B5i_A5q G5q C6q B5q C6h. Rw ");
		

		player.play(pattern1);
		try {
			player.saveMidi(pattern1, new File("Out of My League.midi"));
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
}
