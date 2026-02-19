-- Add id_reg column to link bookings with registrations
ALTER TABLE trx_reg_book ADD COLUMN id_reg VARCHAR(20) NULL AFTER slot;

