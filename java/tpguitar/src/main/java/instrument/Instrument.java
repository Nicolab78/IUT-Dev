package instrument;

public abstract class Instrument {

    private String serialNumber;
    private double price;
    private InstrumentSpec instrumentSpec;

    public Instrument(String serialNumber, double price, InstrumentSpec instrumentSpec) {
        this.serialNumber = serialNumber;
        this.price = price;
        this.instrumentSpec = instrumentSpec;
    }

    public String getSerialNumber() { return serialNumber; }
    public double getPrice()        { return price; }
    public void setPrice(double newPrice) { this.price = newPrice; }
    public InstrumentSpec getSpec() { return instrumentSpec; }
}