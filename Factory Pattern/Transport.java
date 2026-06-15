public interface Transport {
    boolean loadCargo(String cargoType, double weight);
    boolean startDelivery();
    boolean completeDelivery();
    double calculateTransportCost(double distance);
    String getTransportInfo();
    String getStatus();
} 