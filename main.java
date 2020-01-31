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
                		Station currentStation = null;
                		boolean loop = true;
                		int i = 0;
		                try {
		                	XMLEventReader reader = xmlInputFactory.createXMLEventReader(new InputStreamReader(sock.getInputStream()));;
		        			String output = new String();
		        			
		        			while (reader.hasNext()) {
		        				while (loop == true) {
			        			    XMLEvent nextEvent = reader.nextEvent();
			        			    boolean error = false;
        			            	if (nextEvent.isEndElement()) {
        			            	error = true;
        			            	} 
			        			    //System.out.println(nextEvent);
			        			    if (nextEvent.isStartElement()) {
			        			        StartElement startElement = nextEvent.asStartElement();
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
			        			            	nextEvent = reader.nextEvent();
			        			            	station = nextEvent.asCharacters().getData();
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
			        			            case "TEMP":
			        			            	nextEvent = reader.nextEvent();
			        			            	output = nextEvent.asCharacters().getData();
			        			            	String strip = output.replaceAll("[.]", "");
			        			            	int tempInt = Integer.parseInt(strip) + 500;
			        			            	if (currentStation != null) {
			        			            		currentStation.setTemp(tempInt);
			        			            		System.out.println(currentStation.getStn() + ": " + currentStation.getTemp());
			        			            	}
			        			            	output = Integer.toString(tempInt);
			        			            	//System.out.println(output);
			        			            	break;
			        			            case "WNDDIR":
		        			            	
			        			            	break;
			        			            default: 
			        			            	nextEvent = reader.nextEvent();
			        			            	if (nextEvent.isEndElement() == false) {
			        			            		output += nextEvent.asCharacters().getData() + ",";
			        			            	} 
			        			            	else {
			        			            		output += 0 + ",";
			        			            	}			        			            	
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
			        			        	Runnable task = () -> {
			        			        		fileWriter(finaloutput, pathfile +finalstation+ ".txt");
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
    
    public static void incInit() {
		initialize++;
	}
    
}