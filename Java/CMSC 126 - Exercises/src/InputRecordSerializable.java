import java.io.*;
import java.util.ArrayList;

public class InputRecordSerializable {
	
	public static void main(String[] args) throws FileNotFoundException, IOException{
		
		ArrayList<RecordSerializable> record = new ArrayList<RecordSerializable>();
		
		record.add(new RecordSerializable
				(202012345, "Austria", "Joshua", "BSCS", "CMSC 280", "TAB", "MJC IGNACIO", 2.00));
		
		record.add(new RecordSerializable
				(202011111, "Binlayo", "Francis", "BSBC", "CMSC 280", "TAB", "MJC IGNACIO", 2.25));
		
		record.add(new RecordSerializable
				(202009876, "Cabalbag",	"Neil",	"BSCS",	"CMSC 280",	"FAB", "MJC IGNACIO", 1.75));
		
		record.add(new RecordSerializable
				(201913579,	"Castillo", "Edward", "BSCS", "CMSC 280", "TAB", "MJC IGNACIO", 1.75));
		
		record.add(new RecordSerializable
				(202008642,	"Cauzarin", "Gerard", "BSBC", "CMSC 280", "FAB", "MJC IGNACIO", 2.50));
		
		record.add(new RecordSerializable
				(201901010,	"Celestial", "Andrei", "BSCS", "CMSC 280", "FAB", "MJC IGNACIO", 2.25));
		
		record.add(new RecordSerializable
				(202000001,	"Monilla", "Ivan", "BSCS", "CMSC 280", "TAB", "MJC IGNACIO", 1.50));
		
		record.add(new RecordSerializable
				(201939401,	"Sarmiento", "Christian", "BSCS", "CMSC 280", "FAB", "MJC IGNACIO", 1.75));
		
		record.add(new RecordSerializable
				(202099999,	"Torres", "Paolo", "BSBC", "CMSC 280", "FAB", "MJC IGNACIO", 2.00));
		
		record.add(new RecordSerializable
				(202054321,	"Villarde", "Rafael", "BSBC", "CMSC 280", "TAB", "MJC IGNACIO", 2.25));
		
		//serialization
		ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream("output.heh"));
		
		for(RecordSerializable write : record){
			oos.writeObject(write);
		}
		
		oos.close();
		oos.flush();
	}
	
}
