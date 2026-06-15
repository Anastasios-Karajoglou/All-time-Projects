import java.util.Scanner;

public class TransportationApp {
    private static final Scanner scanner = new Scanner(System.in);

    public static void main(String[] args) {
        while (true) {
            System.out.println("\n=== Transportation Management System ===");
            System.out.println("1. Create new shipment");
            System.out.println("2. Exit");
            System.out.print("Select an option: ");

            int choice = scanner.nextInt();
            scanner.nextLine(); // Consume newline

            if (choice == 1) {
                createNewShipment();
            } else if (choice == 2) {
                break;
            }
        }
        scanner.close();
    }

    private static void createNewShipment() {
        System.out.println("\n=== New Shipment ===");
        System.out.print("Enter transport type (truck/ship): ");
        String transportType = scanner.nextLine().toLowerCase();

        System.out.print("Enter identifier (plate number for truck, vessel name for ship): ");
        String identifier = scanner.nextLine();

        System.out.print("Enter maximum capacity (tons): ");
        double maxCapacity = scanner.nextDouble();

        System.out.print("Enter cost per unit (per km for truck, per nautical mile for ship): ");
        double costPerUnit = scanner.nextDouble();
        scanner.nextLine(); // Consume newline

        Transport transport = TransportFactory.createTransport(transportType, identifier, maxCapacity, costPerUnit);

        System.out.print("Enter cargo type: ");
        String cargoType = scanner.nextLine();

        System.out.print("Enter cargo weight (tons): ");
        double cargoWeight = scanner.nextDouble();

        System.out.print("Enter transport distance: ");
        double distance = scanner.nextDouble();
        scanner.nextLine(); // Consume newline

        if (transport.loadCargo(cargoType, cargoWeight)) {
            System.out.println("\nCargo loaded successfully!");
            System.out.println(transport.getTransportInfo());
            
            double cost = transport.calculateTransportCost(distance);
            System.out.printf("Total transport cost: $%.2f%n", cost);
            
            transport.startDelivery();
            System.out.println("Delivery started!");
        } else {
            System.out.println("\nError: Could not load cargo. Check capacity limits.");
        }
    }
} 