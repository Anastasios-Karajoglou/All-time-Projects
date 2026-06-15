public class Truck implements Transport {
    private String plateNumber;
    private double maxCapacity;
    private double costPerKm;
    private String currentCargo;
    private double currentCargoWeight;
    private boolean isLoaded;
    private String deliveryStatus;

    public Truck(String plateNumber, double maxCapacity, double costPerKm) {
        this.plateNumber = plateNumber;
        this.maxCapacity = maxCapacity;
        this.costPerKm = costPerKm;
        this.currentCargo = null;
        this.currentCargoWeight = 0.0;
        this.isLoaded = false;
        this.deliveryStatus = "Available";
    }

    @Override
    public boolean loadCargo(String cargoType, double weight) {
        if (weight > maxCapacity || isLoaded) {
            return false;
        }
        
        currentCargo = cargoType;
        currentCargoWeight = weight;
        isLoaded = true;
        deliveryStatus = "Loaded";
        return true;
    }

    @Override
    public boolean startDelivery() {
        if (!isLoaded) {
            return false;
        }
        deliveryStatus = "In Transit";
        return true;
    }

    @Override
    public boolean completeDelivery() {
        if (!deliveryStatus.equals("In Transit")) {
            return false;
        }
        
        currentCargo = null;
        currentCargoWeight = 0.0;
        isLoaded = false;
        deliveryStatus = "Available";
        return true;
    }

    @Override
    public double calculateTransportCost(double distance) {
        return costPerKm * distance;
    }

    @Override
    public String getTransportInfo() {
        return String.format("Truck %s - Status: %s - Cargo: %s (%.2f/%.2f tons)",
            plateNumber,
            deliveryStatus,
            currentCargo != null ? currentCargo : "None",
            currentCargoWeight,
            maxCapacity);
    }

    @Override
    public String getStatus() {
        return deliveryStatus;
    }
} 