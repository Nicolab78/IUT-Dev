package instrument;

import instrument.guitar.GuitarSpec;
import instrument.mandolin.MandolinSpec;
import enums.Builder;
import enums.Style;
import enums.Type;
import enums.Wood;
import inventory.Inventory;

import java.util.List;

public class FindInstrumentTester {

    public static void main(String[] args) {
        Inventory inventory = new Inventory();
        initializeInventory(inventory);

        GuitarSpec whatErinLikes = new GuitarSpec(Builder.FENDER, "Stratocastor",
                Type.ELECTRIC, 6, Wood.ALDER, Wood.ALDER);

        List<Instrument> matchingGuitars = inventory.search(whatErinLikes);
        if (!matchingGuitars.isEmpty()) {
            System.out.println("Erin, you might like these guitars:");
            for (Instrument instrument : matchingGuitars) {
                GuitarSpec spec = (GuitarSpec) instrument.getSpec();
                System.out.println("  We have a " + spec.getBuilder() + " "
                        + spec.getModel() + " " + spec.getType() + " guitar:\n     "
                        + spec.getNumStrings() + " strings, "
                        + spec.getBackWood() + " back and sides,\n     "
                        + spec.getTopWood() + " top.\n  You can have it for only $"
                        + instrument.getPrice() + "!\n  ----");
            }
        } else {
            System.out.println("Sorry, Erin, we have nothing for you.");
        }

        MandolinSpec whatBobLikes = new MandolinSpec(Builder.GIBSON, "F-5G",
                Type.ACOUSTIC, Style.F, Wood.MAPLE, Wood.MAPLE);

        List<Instrument> matchingMandolins = inventory.search(whatBobLikes);
        if (!matchingMandolins.isEmpty()) {
            System.out.println("Bob, you might like these mandolins:");
            for (Instrument instrument : matchingMandolins) {
                MandolinSpec spec = (MandolinSpec) instrument.getSpec();
                System.out.println("  We have a " + spec.getBuilder() + " "
                        + spec.getModel() + " style " + spec.getStyle()
                        + " mandolin for only $" + instrument.getPrice() + "!\n  ----");
            }
        } else {
            System.out.println("Sorry, Bob, we have nothing for you.");
        }
    }

    private static void initializeInventory(Inventory inventory) {
        inventory.addInstrument("11277", 3999.95, new GuitarSpec(Builder.COLLINGS, "CJ", Type.ACOUSTIC, 6, Wood.INDIAN_ROSEWOOD, Wood.SITKA));
        inventory.addInstrument("V95693", 1499.95, new GuitarSpec(Builder.FENDER, "Stratocastor", Type.ELECTRIC, 6, Wood.ALDER, Wood.ALDER));
        inventory.addInstrument("V9512", 1549.95, new GuitarSpec(Builder.FENDER, "Stratocastor", Type.ELECTRIC, 6, Wood.ALDER, Wood.ALDER));
        inventory.addInstrument("122784", 5495.95, new GuitarSpec(Builder.MARTIN, "D-18", Type.ACOUSTIC, 6, Wood.MAHOGANY, Wood.ADIRONDACK));
        inventory.addInstrument("76531", 6295.95, new GuitarSpec(Builder.MARTIN, "OM-28", Type.ACOUSTIC, 6, Wood.BRAZILIAN_ROSEWOOD, Wood.ADIRONDACK));
        inventory.addInstrument("70108276", 2295.95, new GuitarSpec(Builder.GIBSON, "Les Paul", Type.ELECTRIC, 6, Wood.MAHOGANY, Wood.MAHOGANY));
        inventory.addInstrument("82765501", 1890.95, new GuitarSpec(Builder.GIBSON, "SG '61 Reissue", Type.ELECTRIC, 6, Wood.MAHOGANY, Wood.MAHOGANY));
        inventory.addInstrument("77023", 6275.95, new GuitarSpec(Builder.MARTIN, "D-28", Type.ACOUSTIC, 6, Wood.BRAZILIAN_ROSEWOOD, Wood.ADIRONDACK));
        inventory.addInstrument("1092", 12995.95, new GuitarSpec(Builder.OLSON, "SJ", Type.ACOUSTIC, 12, Wood.INDIAN_ROSEWOOD, Wood.CEDAR));
        inventory.addInstrument("566-62", 8999.95, new GuitarSpec(Builder.RYAN, "Cathedral", Type.ACOUSTIC, 12, Wood.COCOBOLO, Wood.CEDAR));
        inventory.addInstrument("6 29584", 2100.95, new GuitarSpec(Builder.PRS, "Dave Navarro Signature", Type.ELECTRIC, 12, Wood.MAHOGANY, Wood.MAPLE));

        inventory.addInstrument("9019920", 5495.99, new MandolinSpec(Builder.GIBSON, "F-5G", Type.ACOUSTIC, Style.F, Wood.MAPLE, Wood.MAPLE));
        inventory.addInstrument("8900231", 2945.95, new MandolinSpec(Builder.GIBSON, "A-5", Type.ACOUSTIC, Style.A, Wood.MAPLE, Wood.ADIRONDACK));
    }
}