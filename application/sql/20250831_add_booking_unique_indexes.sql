-- Add unique indexes to prevent duplicate bookings/holds on same slot
-- Prevent double booking for same doctor-date-slot
CREATE UNIQUE INDEX IF NOT EXISTS ux_trx_reg_book_dokter_tgl_slot
  ON trx_reg_book (id_dokter, tanggal, jam_slot);

-- Prevent duplicate holds for the same date/slot (per system design holds are per slot-time)
CREATE UNIQUE INDEX IF NOT EXISTS ux_trx_book_holding_tgl_slot
  ON trx_book_holding (tanggal, jam_slot, slot);

