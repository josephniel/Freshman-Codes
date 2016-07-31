package driver;

import controllers.AppMainController;
import models.AppHostModel;

public class AppDriver {
	
	public static void main(String[] args) {
		new AppMainController( new AppHostModel() ).init();
	}
}