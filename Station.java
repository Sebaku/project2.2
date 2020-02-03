import java.util.LinkedList;

public class Station {
	private int stn;
	private LinkedList<Integer> temp = new LinkedList<Integer>();
	private LinkedList<Integer> dewp = new LinkedList<Integer>();
	private LinkedList<Integer> stp = new LinkedList<Integer>();
	private LinkedList<Integer> slp = new LinkedList<Integer>();
	private LinkedList<Integer> visib = new LinkedList<Integer>();
	private LinkedList<Integer> wdsp = new LinkedList<Integer>();
	private LinkedList<Integer> prcp = new LinkedList<Integer>();
	private LinkedList<Integer> sndp = new LinkedList<Integer>();
	private LinkedList<Integer> frshtt = new LinkedList<Integer>();
	private LinkedList<Integer> cldc = new LinkedList<Integer>();
	private LinkedList<Integer> wnddir = new LinkedList<Integer>();
	
	//get methods
	public int getStn() {
		return stn;
	}
		
	public LinkedList<Integer> getTemp() {
		return temp;
	}
		
	public LinkedList<Integer> getDewp() {
		return dewp;
	}
		
	public LinkedList<Integer> getStp() {
		return stp;
	}
		
	public LinkedList<Integer> getSlp() {
		return slp;
	}
		
	public LinkedList<Integer> getVisib() {
		return visib;
	}
		
	public LinkedList<Integer> getWdsp() {
		return wdsp;
	}
		
	public LinkedList<Integer> getPrcp() {
		return prcp;
	}
		
	public LinkedList<Integer> getSndp() {
		return sndp;
	}
		
	public LinkedList<Integer> getFrshtt() {
		return frshtt;
	}
		
	public LinkedList<Integer> getCldc() {
		return cldc;
	}
		
	public LinkedList<Integer> getWnddir() {
		return wnddir;
	}
		
		
	//set methods
	public void setStn(int stn) {
		this.stn = stn;
	}
		
	public void setTemp(int temp) {
		
	  boolean b = true; 
	  if(this.temp.size() == 30) { 
		  b = checkTemp(temp, average(this.temp)); 
	  } 
	  if (b == false) { 
		  System.out.println(temp); 
		  temp = this.temp.getLast() + Math.round(extrapolate(1,2,this.temp.get(28),this.temp.get(29)));
		  System.out.println(temp); 
	  }
		 
	  this.temp = fifo(temp, this.temp);
	}
		
	public void setDewp(int dewp) {
		this.dewp = fifo(dewp, this.dewp);
	}
		
	public void setStp(int stp) {
		this.stp = fifo(stp, this.stp);
	}
		
	public void setSlp(int slp) {
		this.slp = fifo(slp, this.slp);
	}
		
	public void setVisib(int visib) {
		this.visib = fifo(visib, this.visib);
	}
		
	public void setWdsp(int wdsp) {
		this.wdsp = fifo(wdsp, this.wdsp);
	}
		
	public void setPrcp(int prcp) {
		this.prcp = fifo(prcp, this.prcp);
	}
		
	public void setSndp(int sndp) {
		this.sndp = fifo(sndp, this.sndp);
	}
		
	public void setFrshtt(int frshtt) {
		this.frshtt = fifo(frshtt, this.frshtt);
	}
		
	public void setCldc(int cldc) {
		this.cldc = fifo(cldc, this.cldc);
	}
		
	public void setWnddir(int wnddir) {
		this.wnddir = fifo(wnddir, this.wnddir);
	}
	
	public LinkedList<Integer> fifo (int value, LinkedList<Integer> list){
		//If list is bigger than 30, the first value gets removed. We're only interested in the last 30 values.
		if(list.size() == 30) {
			list.removeFirst();
		}
		list.addLast(value);
		return list;
		
	}
	
	public int average(LinkedList<Integer> list){
		int total = 0;
		int i = 0;
		for (int temp : list) {
		    total += temp;
		    i++;
		}
		int output = Math.round(total/i);
		return output;
	}
	
	public boolean checkTemp(int temp, int avg) {
		boolean b = true;
		int dif = Math.abs(temp - avg);
		if (dif > 50) {
			b = false;
		}
		return b;
	}
	
	public float extrapolate(int x1, int x2, int y1, int y2) {
		if(x2 - x1 == 0 || y2 - y1 == 0) {
			return 0;
		}
		return (y2 - y1) / (x2 - x1);
	}
}

