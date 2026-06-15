import java.awt.BorderLayout;
import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JComboBox;
import javax.swing.JButton;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.SwingConstants;
import javax.swing.JTextField;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.awt.Color;
import java.awt.SystemColor;

 
public class MainWindow extends JFrame {

	private JPanel contentPane;
	static Connection Conn;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					MainWindow frame = new MainWindow();
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
	public MainWindow() {
		setTitle("Αρχικό Μενού");
		addWindowListener(new WindowAdapter() {
			@Override
			public void windowOpened(WindowEvent ev) {
				
				String url="jdbc:mysql://localhost:3307/javadb";
				String username="Anastasis";
				String password="2003";
				System.out.println("Connecting database...");
				try {  
					Conn = DriverManager.getConnection(url,username,password);
				} catch(SQLException e) {
					throw new IllegalStateException("Cannot connect the database",e);
			}
			}
		});
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JButton btnversion = new JButton("");
		btnversion.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				TestApp.frame5.setVisible(true);
				TestApp.frame.setEnabled(false);
			}
		});
		btnversion.setBackground(Color.GREEN);
		btnversion.setBounds(226, 154, 113, 39);
		contentPane.add(btnversion);
		
		JButton btnteachers = new JButton("");
		btnteachers.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				TestApp.frame4.setVisible(true);
				TestApp.frame.setEnabled(false);
			}
		});
		btnteachers.setForeground(Color.RED);
		btnteachers.setBackground(Color.RED);
		btnteachers.setBounds(49, 154, 113, 39);
		contentPane.add(btnteachers);
		
		JLabel lblNewLabel = new JLabel("Καθηγητές");
		lblNewLabel.setForeground(Color.RED);
		lblNewLabel.setFont(new Font("Tahoma", Font.BOLD, 18));
		lblNewLabel.setBounds(49, 72, 104, 39);
		contentPane.add(lblNewLabel);
		
		JLabel lblNewLabel_1 = new JLabel("Έκδοση");
		lblNewLabel_1.setForeground(Color.GREEN);
		lblNewLabel_1.setBackground(Color.GREEN);
		lblNewLabel_1.setFont(new Font("Tahoma", Font.BOLD, 18));
		lblNewLabel_1.setBounds(226, 84, 104, 14);
		contentPane.add(lblNewLabel_1);
	}
}
