public class TransportFactory {
    public static Transport createTransport(String type, String identifier, double maxCapacity, double costPerUnit) {
        return switch (type.toLowerCase()) {
            case "truck" -> new Truck(identifier, maxCapacity, costPerUnit);
            case "ship" -> new Ship(identifier, maxCapacity, costPerUnit);
            default -> throw new IllegalArgumentException("Unknown transport type: " + type);
        };
    }
} 