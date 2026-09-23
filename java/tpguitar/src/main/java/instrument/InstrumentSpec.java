package instrument;

import enums.Builder;
import enums.Type;
import enums.Wood;

public abstract class InstrumentSpec {

    private String model;
    private Builder builder;
    private Type type;
    private Wood backWood;
    private Wood topWood;

    public InstrumentSpec(Builder builder, String model, Type type,
                          Wood backWood, Wood topWood) {
        this.builder = builder;
        this.model = model;
        this.type = type;
        this.backWood = backWood;
        this.topWood = topWood;
    }

    public Builder getBuilder() { return builder; }
    public String getModel()    { return model; }
    public Type getType()       { return type; }
    public Wood getBackWood()   { return backWood; }
    public Wood getTopWood()    { return topWood; }

    public boolean matches(InstrumentSpec instrumentSpec) {
        if (builder != instrumentSpec.builder)
            return false;
        if ((model != null) && (!model.equals("")) &&
                (!model.equalsIgnoreCase(instrumentSpec.model)))
            return false;
        if (type != instrumentSpec.type)
            return false;
        if (backWood != instrumentSpec.backWood)
            return false;
        if (topWood != instrumentSpec.topWood)
            return false;
        return true;
    }
}