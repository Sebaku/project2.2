public class Station {
	private int stn = 0;
	private int date;
	private int time;
	private byte temp;
	private byte dewp;
	private byte stp;
	private byte slp;
	private byte visib;
	private byte wdsp;
	private byte prcp;
	private byte sndp;
	private byte frshtt;
	private byte cldc;
	private byte wnddir;
	
	//get methods
	public int getStn() {
		return stn;
	}
		
	public int getDate() {
		return date;
	}
		
	public int getTime() {
		return time;
	}
		
	public byte getTemp() {
		return temp;
	}
		
	public byte getDewp() {
		return dewp;
	}
		
	public byte getStp() {
		return stp;
	}
		
	public byte getSlp() {
		return slp;
	}
		
	public byte getVisib() {
		return visib;
	}
		
	public byte getWdsp() {
		return wdsp;
	}
		
	public byte getPrcp() {
		return prcp;
	}
		
	public byte getSndp() {
		return sndp;
	}
		
	public byte getFrshtt() {
		return frshtt;
	}
		
	public byte getCldc() {
		return cldc;
	}
		
	public byte getWnddir() {
		return wnddir;
	}
		
		
	//set methods
	public void setStn(int stn) {
		this.stn = stn;
	}
		
	public void setDate(int date) {
		this.date = date;
	}
		
	public void setTime(int time) {
		this.time = time;
	}
		
	public void setTemp(byte temp) {
		this.temp = temp;
	}
		
	public void setDewp(byte dewp) {
		this.dewp = dewp;
	}
		
	public void setStp(byte stp) {
		this.stp = stp;
	}
		
	public void setSlp(byte slp) {
		this.slp = slp;
	}
		
	public void setVisib(byte visib) {
		this.visib = visib;
	}
		
	public void setWdsp(byte wdsp) {
		this.wdsp = wdsp;
	}
		
	public void setPrcp(byte prcp) {
		this.prcp = prcp;
	}
		
	public void setSndp(byte sndp) {
		this.sndp = sndp;
	}
		
	public void setFrshtt(byte frshtt) {
		this.frshtt = frshtt;
	}
		
	public void setCldc(byte cldc) {
		this.cldc = cldc;
	}
		
	public void setWnddir(byte wnddir) {
	}
}