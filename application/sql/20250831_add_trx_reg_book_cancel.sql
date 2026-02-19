-- Create cancel table for booking cancellations
CREATE TABLE IF NOT EXISTS trx_reg_book_cancel (
  id_cancel INT AUTO_INCREMENT PRIMARY KEY,
  id_book INT NULL,
  id_pasien VARCHAR(8) NOT NULL,
  id_dokter INT NOT NULL,
  tanggal DATE NOT NULL,
  jam_slot VARCHAR(5) NULL,
  slot VARCHAR(8) NULL,
  sudah_checkin TINYINT(1) DEFAULT 0,
  created DATETIME NULL,
  ket_batal TEXT NOT NULL,
  cancel_date DATETIME NOT NULL,
  INDEX idx_pasien (id_pasien),
  INDEX idx_dokter_tanggal (id_dokter, tanggal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

