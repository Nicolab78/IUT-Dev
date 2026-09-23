package instrument.guitar;

import instrument.InstrumentSpec;
import enums.Builder;
import enums.Type;
import enums.Wood;

public class GuitarSpec extends InstrumentSpec {

    private int numStrings;

    public GuitarSpec(Builder builder, String model, Type type,
                      int numStrings, Wood backWood, Wood topWood) {
        super(builder, model, type, backWood, topWood);
        this.numStrings = numStrings;
    }

    public int getNumStrings() { return numStrings; }

    public boolean matches(InstrumentSpec instrumentSpec) {
        if (!super.matches(instrumentSpec))
            return false;
        if (!(instrumentSpec instanceof GuitarSpec))
            return false;
        GuitarSpec guitarSpec = (GuitarSpec) instrumentSpec;
        if (numStrings != guitarSpec.numStrings)
            return false;
        return true;
    }
}