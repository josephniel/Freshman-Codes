package Main;

import java.applet.Applet;
import java.applet.AudioClip;
import java.io.IOException;

import org.newdawn.easyogg.OggClip;

public class Sound {
	
	public static final Sound click1 = new Sound("Sounds/click1.wav", 1);
	public static final Sound click2 = new Sound("Sounds/click2.wav", 1);
	public static final Sound click3 = new Sound("Sounds/click3.wav", 1);
	public static final Sound dice = new Sound("Sounds/dice.ogg", 2);
	
	private AudioClip clip;
	private OggClip oggClip;
	private int a;
	
	public Sound(String file, int a) {
		this.a = a;
		if(a == 1){
			clip = Applet.newAudioClip(getClass().getResource(file));
		}
		else{
			try {oggClip = new OggClip(getClass().getResourceAsStream(file));} 
			catch (IOException e){e.printStackTrace();}
		}
	}
	public void play(int indicator){
		if(indicator == 1){
			new Thread(){
				@Override
				public void run() {
					if(a == 1)
						clip.play();
					else
						oggClip.play();
				}
			}.start();
		}
	}
	
}

class Audio{
	
	private static OggClip[] Sound;
	
	public Audio() throws IOException {
		Sound = new OggClip[3];
		Sound[0] = new OggClip(getClass().getResourceAsStream("Sounds/background.ogg"));
		Sound[1] = new OggClip(getClass().getResourceAsStream("Sounds/background1.ogg"));
		Sound[2] = new OggClip(getClass().getResourceAsStream("Sounds/ticktock.ogg"));
	}
	
	public static void startBackgroundMusic(int a){
		if(a == 1){
			Sound[1].stop();
			Sound[0].loop();
		}
		else if(a == 2){
			Sound[0].stop();	
			if(EnableMusic.MusicEnabled == 1)
				Sound[1].loop();
		}
		else if(a == 3){
			Sound[1].stop();
			Sound[2].play();
		}
	}
	
	public static void disableBackgroundMusic(){
		Sound[0].stop();
		Sound[1].stop();
		Sound[2].stop();
	}
	
	public static void resumeGameMusic(){
		Sound[2].stop();
		Sound[1].loop();
	}
	
}