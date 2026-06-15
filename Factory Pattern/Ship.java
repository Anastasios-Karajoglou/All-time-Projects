public class Ship implements Transport {
    private String vesselName;
    private double maxCapacity;
    private double costPerNauticalMile;
    private String currentCargo;
    private double currentCargoWeight;
    private boolean isLoaded;
    private String deliveryStatus;

    public Ship(String vesselName, double maxCapacity, double costPerNauticalMile) {
        this.vesselName = vesselName;
        this.maxCapacity = maxCapacity;
        this.costPerNauticalMile = costPerNauticalMile;
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
        return costPerNauticalMile * distance;
    }

    @Override
    public String getTransportInfo() {
        return String.format("Ship %s - Status: %s - Cargo: %s (%.2f/%.2f tons)",
            vesselName,
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