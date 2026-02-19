-- Add jenis_perawatan to booking tables
ALTER TABLE trx_reg_book ADD COLUMN jenis_perawatan VARCHAR(32) NULL AFTER slot;
ALTER TABLE trx_reg_book_cancel ADD COLUMN jenis_perawatan VARCHAR(32) NULL AFTER slot;

