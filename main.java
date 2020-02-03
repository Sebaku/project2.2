import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.HashMap;
import java.util.concurrent.Executors;
import java.util.concurrent.ThreadPoolExecutor;

import javax.xml.namespace.QName;
import javax.xml.stream.XMLEventReader;
import javax.xml.stream.XMLInputFactory;
import javax.xml.stream.XMLStreamException;
import javax.xml.stream.events.Attribute;
import javax.xml.stream.events.EndElement;
import javax.xml.stream.events.StartElement;
import javax.xml.stream.events.XMLEvent;

class client {
	static HashMap<Integer, Station> stationList = new HashMap<>();
	static int initialize = 0;
    public static void main(String args[]){    	
    	
        try {
        	
            @SuppressWarnings("resource")
			ServerSocket socket = new ServerSocket(7789);
            
        	XMLInputFactory xmlInputFactory = XMLInputFactory.newInstance();
        	String pathfile = "./db/";
            
            Thread t1 = new Thread();
            t1.start();
            //Socket sock;
            System.out.println("Service running");
            ThreadPoolExecutor executor = (ThreadPoolExecutor) Executors.newFixedThreadPool(80);
            while(true){
                final Socket sock = socket.accept();
                new Thread() {
                	public void run() {
//		                try {
//							System.out.println(sock.getInputStream());
//						} catch (IOException e1) {
//							// TODO Auto-generated catch block
//							e1.printStackTrace();
//						}
                		String station = "";
                		String date = "";
                		Station currentStation = null;
                		boolean loop = true;
                		int temp = 0;
                		int i = 0;
		                try {
		                	XMLEventReader reader = xmlInputFactory.createXMLEventReader(new InputStreamReader(sock.getInputStream()));;
		        			String output = new String();
		        			String input = new String();
		        			
		        			while (reader.hasNext()) {
		        				while (loop == true) {
			        			    XMLEvent nextEvent = reader.nextEvent();
			        			    //System.out.println(nextEvent);
			        			    if (nextEvent.isStartElement()) {
			        			        StartElement startElement = nextEvent.asStartElement();
				        			    XMLEvent value = reader.nextEvent();
			        			        switch (startElement.getName().getLocalPart()) {
			        			            case "WEATHERDATA":
			        			                
			        			                Attribute station2 = startElement.getAttributeByName(new QName("station2"));
			        			                if (station2 != null) {
			        			                    System.out.println(((javax.xml.stream.events.Attribute) station2).getValue());
			        			                }
			        			                break;
			        			            case "MEASUREMENT":
											/*
											 * if (initialize <= 8000) { incInit(); }
											 */
			        			            	break;
			        			            case "STN":
			        			            	station = value.asCharacters().getData();
			        			            	int stationInt = Integer.parseInt(station);
			        			            	if (stationList.containsKey(stationInt) == false) {
			        			            		currentStation = new Station();
			        			            		currentStation.setStn(stationInt);
			        			            		stationList.put(stationInt, currentStation);
			        			            		//System.out.println(initialize);
			        			            	}
			        			            	else
			        			            	{			        			            		
				        			            	currentStation = stationList.get(stationInt);
			        			            	}
			        			            	break;
			        			            case "DATE":
			        			            	date = value.asCharacters().getData();
			        			            	break;
			        			            case "TEMP":
			        			            	
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getTemp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip) + 500;
			        			            	}
			        			            	
			        			            	if (currentStation != null) {
			        			            		currentStation.setTemp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getTemp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;			        			            	
			        			            case "DEWP":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getDewp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip) + 500;
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setDewp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getDewp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "STP":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getStp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip) - 5000;
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setStp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getStp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 4) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "SLP":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getSlp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip) - 5000;
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setSlp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getSlp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 4) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "VISIB":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getVisib().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip);
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setVisib(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getVisib());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	
			        			            	break;
			        			            case "WDSP":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getWdsp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip);
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setWdsp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getWdsp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "PRCP":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getPrcp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip);
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setPrcp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getPrcp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "SNDP":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getSndp().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip) / 2;
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setSndp(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getSndp());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "FRSHTT":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getFrshtt().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = binaryToDecimal(Integer.parseInt(strip));
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setFrshtt(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getFrshtt());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 2) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;
			        			            case "CLDC":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getCldc().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip);
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setCldc(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getCldc());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;		        			            	
			        			            case "WNDDIR":
			        			            	if (value.isEndElement()) {
			        			            		temp = currentStation.getWnddir().getLast();
			        			            	}
			        			            	else {
			        			            		input = value.asCharacters().getData();
			        			            		String strip = input.replaceAll("[.]", "");
				        			            	temp = Integer.parseInt(strip);
			        			            	}
			        			            	if (currentStation != null) {
			        			            		currentStation.setWnddir(temp);
			        			            		//System.out.println(currentStation.getStn() + ": " + currentStation.getWnddir());
			        			            	}
			        			            	input = Integer.toString(temp);
			        			            	while (input.length() < 3) {
			        			            		input = "0" + input;
			        			            	}
			        			            	output += input;
			        			            	break;			        			                
			        			        }
			        			    }
			        			    if (nextEvent.isEndElement()) {
			        			        EndElement endElement = nextEvent.asEndElement();
			        			        if (endElement.getName().getLocalPart().equals("WEATHERDATA")) {
			        			        	loop = false;
			        			        }
			        			        else if (endElement.getName().getLocalPart().equals("MEASUREMENT")) {			        			        	
			        			        	String finaloutput = output;
			        			        	String finalstation = station;
			        			        	String finaldate = date;
			        			        	Runnable task = () -> {
			        			        		fileWriter(finaloutput, pathfile  + finaldate + "/" +finalstation+ ".txt");
			        			        	};
			        			        	executor.execute(task);
			        			        	output = "";
			        			        }
			        			    }
		        				}
		        				reader = xmlInputFactory.createXMLEventReader(new InputStreamReader(sock.getInputStream()));;
			        			output = new String();
			        			loop = true;
		        			}
		                } catch (IOException e) {
		        			e.printStackTrace();
		        		} catch (XMLStreamException e) {
							// TODO Auto-generated catch block
							e.printStackTrace();
						}
                }}.start();
           }
        } catch (Exception e) {
            System.out.println("Connection can't be made");
        }
    }
    
    public static void fileWriter(String var1, String var2) {
    	BufferedWriter writer;
		try {
			writer = new BufferedWriter(new FileWriter(var2,true));
			writer.write(var1);
	        writer.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
    }
    
    //https://www.geeksforgeeks.org/program-binary-decimal-conversion/
    public static int binaryToDecimal(int n) 
    { 
        int num = n; 
        int dec_value = 0; 
  
        // Initializing base 
        // value to 1, i.e 2^0 
        int base = 1; 
  
        int temp = num; 
        while (temp > 0) { 
            int last_digit = temp % 10; 
            temp = temp / 10; 
  
            dec_value += last_digit * base; 
  
            base = base * 2; 
        } 
  
        return dec_value; 
    } 
    
    public static void incInit() {
		initialize++;
	}
    
}