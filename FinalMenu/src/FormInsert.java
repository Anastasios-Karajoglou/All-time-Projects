import java.awt.EventQueue;

import javax.swing.JFrame;
import javax.swing.JPanel;
import javax.swing.border.EmptyBorder;
import javax.swing.JButton;
import javax.swing.JTextField;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import java.sql.SQLException;

import java.awt.event.ActionListener;
import java.sql.PreparedStatement;
import java.awt.event.ActionEvent;

public class FormInsert extends JFrame {

	private JPanel contentPane;
	private JTextField tfrm_id;
	private JTextField tfrm_sname;
	private JTextField tfrm_fname;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					FormInsert frame = new FormInsert();
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
	public FormInsert() {
		setTitle("Εισαγώγη καθηγητή");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));

		setContentPane(contentPane);
		contentPane.setLayout(null);
		
		JButton btnInsert = new JButton("Insert");
		btnInsert.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					int t_id = Integer.parseInt(tfrm_id.getText());
					String t_fname = tfrm_fname.getText();
					String t_sname = tfrm_sname.getText();
					PreparedStatement p = (PreparedStatement) MainWindow.Conn.prepareStatement("INSERT INTO TEACHERS VALUES(?,?,?)");
					p.setInt(1, t_id);
					p.setString(2, t_sname);
					p.setString(3, t_fname);
					p.executeUpdate();
					JOptionPane.showMessageDialog(null,"Insert Done","INSERT",JOptionPane.PLAIN_MESSAGE);
					p.close();
					
			
				} catch(SQLException e1) {
					e1.printStackTrace();
				}
			
			}
				
		});
		btnInsert.setBounds(54, 187, 89, 23);
		contentPane.add(btnInsert);
		
		JButton btnClose = new JButton("Close");
		btnClose.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				TestApp.frame4.setEnabled(true);
				TestApp.frame2.setVisible(false);
			}
		});
		btnClose.setBounds(273, 187, 89, 23);
		contentPane.add(btnClose);
		
		tfrm_id = new JTextField();
		tfrm_id.setBounds(206, 43, 86, 20);
		contentPane.add(tfrm_id);
		tfrm_id.setColumns(10);
		
		tfrm_sname = new JTextField();
		tfrm_sname.setBounds(206, 79, 86, 20);
		contentPane.add(tfrm_sname);
		tfrm_sname.setColumns(10);
		
		tfrm_fname = new JTextField();
		tfrm_fname.setBounds(206, 118, 86, 20);
		contentPane.add(tfrm_fname);
		tfrm_fname.setColumns(10);
		
		JLabel lblNewLabel = new JLabel("Κωδικός");
		lblNewLabel.setBounds(63, 46, 46, 14);
		contentPane.add(lblNewLabel);
		
		JLabel lblNewLabel_1 = new JLabel("Επίθετο");
		lblNewLabel_1.setBounds(63, 82, 46, 14);
		contentPane.add(lblNewLabel_1);
		
		JLabel lblName = new JLabel("Όνομα");
		lblName.setBounds(63, 121, 46, 14);
		contentPane.add(lblName);
	}
}
