import java.awt.Color;
import java.awt.EventQueue;
import java.awt.Font;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JTextField;
import javax.swing.border.EmptyBorder;
import javax.swing.ImageIcon;

public class FormUpdate extends JFrame {

	private JPanel contentPane;
	private JTextField tfrm_id;
	private JTextField tfrm_lname;
	private JTextField tfrm_fname;
	private PreparedStatement pst;
	private ResultSet rs;

	/**
	 * Launch the application.
	 */
	public static void main(String[] args) {
		EventQueue.invokeLater(new Runnable() {
			public void run() {
				try {
					FormUpdate frame = new FormUpdate();
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
	public FormUpdate() {
		setTitle("Ενημέρωση/Διαγραφή καθηγητή");
		setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		setBounds(100, 100, 450, 300);
		contentPane = new JPanel();
		contentPane.setBackground(Color.LIGHT_GRAY);
		contentPane.setBorder(new EmptyBorder(5, 5, 5, 5));
		setContentPane(contentPane);
		contentPane.setLayout(null);

		addWindowListener(new WindowAdapter() {
			public void windowActivated(WindowEvent e) {
				try {
					String sql = "SELECT TEACHERID, LNAME, FNAME FROM TEACHERS WHERE LNAME LIKE ?";
					pst = MainWindow.Conn.prepareStatement(sql, ResultSet.TYPE_SCROLL_INSENSITIVE,
							ResultSet.CONCUR_UPDATABLE);
					pst.setString(1, FormSearch.searchEponimoVar + '%');

					rs = pst.executeQuery();

					if (rs.next()) {
						tfrm_id.setText(Integer.toString(rs.getInt("TEACHERID"))); // Fixed: Added missing closing parenthesis
						tfrm_lname.setText(rs.getString("LNAME"));
						tfrm_fname.setText(rs.getString("FNAME"));
					}
				} catch (SQLException ex1) {
					ex1.printStackTrace();
				}
			}

			public void windowDeactivated(WindowEvent e) {
				tfrm_id.setText("");
				tfrm_lname.setText("");
				tfrm_fname.setText("");
			}
		});

		JLabel lblNewLabel = new JLabel("ID");
		lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel.setForeground(new Color(0, 0, 0));
		lblNewLabel.setBounds(163, 24, 46, 14);
		contentPane.add(lblNewLabel);

		JLabel lblNewLabel_1 = new JLabel("Όνομα");
		lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_1.setBounds(163, 49, 46, 14);
		contentPane.add(lblNewLabel_1);

		JLabel lblNewLabel_2 = new JLabel("Επίθετο");
		lblNewLabel_2.setFont(new Font("Tahoma", Font.PLAIN, 13));
		lblNewLabel_2.setBounds(163, 74, 46, 14);
		contentPane.add(lblNewLabel_2);

		tfrm_id = new JTextField();
		tfrm_id.setBounds(240, 21, 119, 20);
		contentPane.add(tfrm_id);
		tfrm_id.setColumns(10);

		tfrm_lname = new JTextField();
		tfrm_lname.setBounds(240, 46, 119, 20);
		contentPane.add(tfrm_lname);
		tfrm_lname.setColumns(10);

		tfrm_fname = new JTextField();
		tfrm_fname.setBounds(240, 71, 119, 20);
		contentPane.add(tfrm_fname);
		tfrm_fname.setColumns(10);

		JButton btnUpdate = new JButton("Update");
		btnUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
					String query = "UPDATE teachers set LNAME = ?, FName=? where TEACHERID=?";
					PreparedStatement preparedStmt = MainWindow.Conn.prepareStatement(query);
					preparedStmt.setString(1, tfrm_lname.getText());
					preparedStmt.setString(2, tfrm_fname.getText());
					preparedStmt.setInt(3, Integer.parseInt(tfrm_id.getText()));
					preparedStmt.executeUpdate();
					JOptionPane.showMessageDialog(null, "Update Done", "UPDATE", JOptionPane.PLAIN_MESSAGE);
					preparedStmt.close();
					
				}catch(SQLException e1) {
					e1.printStackTrace();
				}
			}
		});
		btnUpdate.setBounds(31, 212, 89, 23);
		contentPane.add(btnUpdate);

		JButton btnDelete = new JButton("Delete");
		btnDelete.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				try {
				String query = "DELETE from teachers where TEACHERID = ?";
				PreparedStatement preparedStmt = MainWindow.Conn.prepareStatement(query);
				preparedStmt.setInt(1, Integer.parseInt(tfrm_id.getText()));
				
				int dialogButton;
				dialogButton = JOptionPane.showConfirmDialog(null, "Είστε σίγουρος","Warning", JOptionPane.YES_NO_OPTION);
				if (dialogButton == JOptionPane.YES_OPTION) preparedStmt.execute();
				else {}
				
				}catch(SQLException e6) {
					e6.printStackTrace();
				}
			}
		});
		btnDelete.setBounds(181, 212, 89, 23);
		contentPane.add(btnDelete);

		JButton btnClose = new JButton("Close");
		btnClose.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				TestApp.frame4.setEnabled(true);
				TestApp.frame3.setVisible(false);
			}
		});
		btnClose.setBounds(322, 212, 89, 23);
		contentPane.add(btnClose);

		JButton btnFirst = new JButton("First");
		btnFirst.setIcon(null);
		btnFirst.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				try {
					if (rs.first())
					{
							tfrm_id.setText(Integer.toString (rs.getInt("TEACHERID")));
							tfrm_lname.setText(rs.getString("LNAME"));
							tfrm_fname.setText(rs.getString("FNAME"));
					}
				
				}catch(SQLException e2) {
					e2.printStackTrace();
				}
			
			}
		});
		btnFirst.setBounds(56, 152, 63, 29);
		contentPane.add(btnFirst);

		JButton btnSecond = new JButton("prev");
		btnSecond.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
			
				try {
					if (rs.previous())
					{
							tfrm_id.setText(Integer.toString (rs.getInt("TEACHERID")));
							tfrm_lname.setText(rs.getString("LNAME"));
							tfrm_fname.setText(rs.getString("FNAME"));
					}
				
				}catch(SQLException e3) {
					e3.printStackTrace();
				}		
			}		
		});
		btnSecond.setBounds(146, 152, 63, 29);
		contentPane.add(btnSecond);

		JButton btnThird = new JButton("next");
		btnThird.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				try {
					if (rs.next())
					{
							tfrm_id.setText(Integer.toString (rs.getInt("TEACHERID")));
							tfrm_lname.setText(rs.getString("LNAME"));
							tfrm_fname.setText(rs.getString("FNAME"));
					}
				
				}catch(SQLException e4) {
					e4.printStackTrace();
				}	
			}
		});
		btnThird.setBounds(240, 152, 63, 29);
		contentPane.add(btnThird);

		JButton btnForth = new JButton("last");
		btnForth.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				
				try {
					if (rs.last())
					{
							tfrm_id.setText(Integer.toString (rs.getInt("TEACHERID")));
							tfrm_lname.setText(rs.getString("LNAME"));
							tfrm_fname.setText(rs.getString("FNAME"));
					}
				
				}catch(SQLException e5) {
					e5.printStackTrace();
				}
			}
		});
		btnForth.setBounds(319, 152, 63, 29);
		contentPane.add(btnForth);
	}
}
