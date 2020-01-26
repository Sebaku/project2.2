import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.ServerSocket;
import java.net.Socket;

import javax.xml.namespace.QName;
import javax.xml.stream.XMLEventReader;
import javax.xml.stream.XMLInputFactory;
import javax.xml.stream.XMLStreamException;
import javax.xml.stream.events.Attribute;
import javax.xml.stream.events.EndElement;
import javax.xml.stream.events.StartElement;
import javax.xml.stream.events.XMLEvent;

class client {
    public static void main(String args[]){
        try {
            ServerSocket socket = new ServerSocket(7789);
            
        	XMLInputFactory xmlInputFactory = XMLInputFactory.newInstance();
        	String pathfile = "C:/Users/Sebas/eclipse-workspace/Project 2.2/src/db/";
            
            Thread t1 = new Thread();
            t1.start();
            Thread thread1;
            //Socket sock;
            System.out.println("Service running");           
            while(true){
                final Socket sock = socket.accept();
                new Thread() {
                	public void run() {
		                try {
							System.out.println(sock.getInputStream());
						} catch (IOException e1) {
							// TODO Auto-generated catch block
							e1.printStackTrace();
						}
                		String station = "";
                		boolean loop = true;
		                try {
		                	XMLEventReader reader = xmlInputFactory.createXMLEventReader(new InputStreamReader(sock.getInputStream()));;
		        			String output = new String();
		        			
		        			while (reader.hasNext()) {
		        				while (loop == true) {
			        			    XMLEvent nextEvent = reader.nextEvent();
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
			        			            	break;
			        			            case "STN":
			        			            	nextEvent = reader.nextEvent();
			        			            	station = nextEvent.asCharacters().getData();
			        			            	output += station + ",";
			        			            	break;
			        			            case "WNDDIR":
			        			            	nextEvent = reader.nextEvent();
			        			            	output += nextEvent.asCharacters().getData() + "\r\n";
			        			            	break;
			        			            default: 
			        			            	nextEvent = reader.nextEvent();
			        			            	output += nextEvent.asCharacters().getData() + ",";
			        			            	break;
			        			                
			        			        }
			        			    }
			        			    if (nextEvent.isEndElement()) {
			        			        EndElement endElement = nextEvent.asEndElement();
			        			        if (endElement.getName().getLocalPart().equals("WEATHERDATA")) {
			        			        	loop = false;
			        			        }
			        			        else if (endElement.getName().getLocalPart().equals("MEASUREMENT")) {			        			        	
			        			        	//System.out.println(output);
			        			        	fileWriter(output, pathfile +station+ ".txt");
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
            System.out.println("Werkt niet");
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
}