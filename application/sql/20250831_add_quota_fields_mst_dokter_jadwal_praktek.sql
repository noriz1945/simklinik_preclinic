-- Add quota columns to mst_dokter_jadwal_praktek
ALTER TABLE mst_dokter_jadwal_praktek
  ADD COLUMN quota_vaksin SMALLINT NOT NULL DEFAULT 13 AFTER durasi,
  ADD COLUMN quota_konsul SMALLINT NOT NULL DEFAULT 5 AFTER quota_vaksin;

