import java.awt.EventQueue;

public class TestApp {
    public static MainWindow frame;
    public static FormInsert frame2;
    public static FormUpdate frame3;
    public static FormSearch frame4;
    public static FormVersion frame5;

    public static void main(String[] args) {
        EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    frame = new MainWindow();
                    frame.setLocationRelativeTo(null);
                    frame.setVisible(true);

                    frame2 = new FormInsert();
                    frame2.setLocationRelativeTo(null);
                    frame2.setVisible(false);

                    frame3 = new FormUpdate();
                    frame3.setLocationRelativeTo(null);
                    frame3.setVisible(false);

                    frame4 = new FormSearch();
                    frame4.setLocationRelativeTo(null);
                    frame4.setVisible(false);
                    
                    frame5 = new FormVersion();
                    frame5.setLocationRelativeTo(null);
                    frame5.setVisible(false);

                    

                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }
}
