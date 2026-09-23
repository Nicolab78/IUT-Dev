package instrument.mandolin;

import instrument.InstrumentSpec;
import enums.Builder;
import enums.Style;
import enums.Type;
import enums.Wood;

public class MandolinSpec extends InstrumentSpec {

    private Style style;

    public MandolinSpec(Builder builder, String model, Type type,
                        Style style, Wood backWood, Wood topWood) {
        super(builder, model, type, backWood, topWood);
        this.style = style;
    }

    public Style getStyle() { return style; }

    public boolean matches(InstrumentSpec instrumentSpec) {
        if (!super.matches(instrumentSpec))
            return false;
        if (!(instrumentSpec instanceof MandolinSpec))
            return false;
        MandolinSpec mandolinSpec = (MandolinSpec) instrumentSpec;
        if (!style.equals(mandolinSpec.style))
            return false;
        return true;
    }
}