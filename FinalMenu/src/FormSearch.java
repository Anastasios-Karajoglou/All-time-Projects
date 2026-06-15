import java.awt.EventQueue;
import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JButton;
import javax.swing.JTextField;
import javax.swing.JLabel;
import java.awt.Font;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class FormSearch extends JFrame {

    public static String searchEponimoVar;
    private JPanel contentPane;
    private JTextField searchEponimo;
    private JButton btnClose;
    private JButton button;
    private ResultSet results; 

    /**
     * Launch the application.
     */
    public static void main(String[] args) {
        EventQueue.invokeLater(new Runnable() {
            public void run() {
                try {
                    FormSearch frame = new FormSearch();
                    frame.setVisible(true);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }

    /**
     * Create the frame.
     */
    public FormSearch() {
        setTitle("Αναζήτηση καθηγητή");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setBounds(100, 100, 450, 300);
        contentPane = new JPanel();
        contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

        setContentPane(contentPane);
        contentPane.setLayout(null);

        JButton btnInsert = new JButton("Εισαγωγή");
        btnInsert.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                TestApp.frame2.setVisible(true);
                TestApp.frame4.setEnabled(false);
            }
        });
        btnInsert.setBounds(182, 176, 89, 23);
        contentPane.add(btnInsert);

        JButton btnSearch = new JButton("Αναζήτηση");
        btnSearch.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                searchEponimoVar = searchEponimo.getText();
                performSearch(searchEponimoVar);
                TestApp.frame4.setEnabled(false);
                TestApp.frame3.setVisible(true);
            }
        });
        btnSearch.setBounds(182, 107, 89, 23);
        contentPane.add(btnSearch);

        searchEponimo = new JTextField();
        searchEponimo.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
            }
        });
        searchEponimo.setBounds(182, 61, 86, 20);
        contentPane.add(searchEponimo);
        searchEponimo.setColumns(10);

        JLabel lblNewLabel = new JLabel("Επώνυμο");
        lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 18));
        lblNewLabel.setBounds(185, 23, 86, 27);
        contentPane.add(lblNewLabel);

        JButton btnclose = new JButton("Close");
        btnclose.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                TestApp.frame.setEnabled(true);
                TestApp.frame4.setVisible(false);
            }
        });
        btnclose.setBounds(324, 227, 89, 23);
        contentPane.add(btnclose);
    }

    private void performSearch(String eponimo) {
        String url = "jdbc:mysql://localhost:3307/javadb";
        String username = "Anastasis"; 
        String password = "2003"; 

        try (Connection connection = DriverManager.getConnection(url, username, password)) {
            String query = "SELECT * FROM teachers WHERE LNAME LIKE ?";
            PreparedStatement statement = connection.prepareStatement(query);
            statement.setString(1, eponimo + "%");

            ResultSet resultSet = statement.executeQuery();

            // Assign the results to the field
            setResults(resultSet);

            resultSet.close();
            statement.close();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }
    
    public void setResults(ResultSet results) {
        this.results = results;
    }
}
