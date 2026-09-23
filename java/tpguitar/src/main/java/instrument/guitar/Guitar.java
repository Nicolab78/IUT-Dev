package instrument.guitar;

import instrument.Instrument;

public class Guitar extends Instrument {

    public Guitar(String serialNumber, double price, GuitarSpec guitarSpec) {
        super(serialNumber, price, guitarSpec);
    }
}