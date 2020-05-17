CREATE TABLE Bank_Acc (
  id_bank     uuid NOT NULL, 
  id_user     uuid NOT NULL, 
  bank_number int4 NOT NULL UNIQUE, 
  balance     int4 NOT NULL, 
  PRIMARY KEY (id_bank));
  
CREATE TABLE Daily_Limit (
  id_limit  uuid NOT NULL, 
  id_bank   uuid NOT NULL, 
  incoming  float4 NOT NULL, 
  outcoming float4 NOT NULL, 
  "date"    timestamp(64) NOT NULL, 
  PRIMARY KEY (id_limit));
  
CREATE TABLE "Transaction" (
  id_transaction uuid NOT NULL, 
  amount         float4 NOT NULL, 
  description    varchar(32) NOT NULL, 
  id_bank_from   uuid NOT NULL, 
  id_bank_to     uuid NOT NULL, 
  PRIMARY KEY (id_transaction));
  
CREATE TABLE "User" (
  id_user     uuid NOT NULL, 
  name        varchar(64) NOT NULL, 
  document_id int4 NOT NULL UNIQUE, 
  PRIMARY KEY (id_user));
  
ALTER TABLE Daily_Limit ADD CONSTRAINT acc_have_daily_lim FOREIGN KEY (id_bank) REFERENCES Bank_Acc (id_bank);

ALTER TABLE Bank_Acc ADD CONSTRAINT have_acc FOREIGN KEY (id_user) REFERENCES "User" (id_user);

ALTER TABLE "Transaction" ADD CONSTRAINT make_transcation FOREIGN KEY (id_bank_from) REFERENCES Bank_Acc (id_bank) ON UPDATE Cascade ON DELETE Cascade;

ALTER TABLE "Transaction" ADD CONSTRAINT recieve_transcation FOREIGN KEY (id_bank_to) REFERENCES Bank_Acc (id_bank);

