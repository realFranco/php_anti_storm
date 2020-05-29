/*
Dev: f97gp1@gmail.com
Date: May 28th, 2020

Insert a user will also:
    - insert a new bank_acc row
    - insert a new daily_limit row
*/

/*
A new data type will require new functions, 
new operators, and probably new index operator classes. 
It is helpful to collect all these objects into a 
single package to simplify database management.
*/

CREATE EXTENSION IF NOT EXISTS "uuid-ossp";


create or replace FUNCTION get_uuid()
    returns uuid as
    $$
    begin 
        return (select uuid_generate_v4());
    end;
    $$
    language plpgsql;

-- select get_uuid();

alter functions get_uuid()
    owner to system;


create or replace function trigger_add_bank_row()
    returns trigger as
    $$
    declare 
        v_id_bank uuid := get_uuid();
        v_id_limit uuid := get_uuid();
        time_stamp timestamp := (select current_timestamp);
    begin
        -- magic
        insert into Bank_Acc (id_bank, id_user, bank_number, balance)
            values ( v_id_bank, NEW.id_user, 1234, 0 );

        INSERT INTO Daily_Limit (id_limit, id_bank, incoming, outcoming, "date")  
            VALUES (v_id_limit, v_id_bank, 1000, 1000, time_stamp);

        raise info 'new bank row with id_user: %', NEW.id_user;

        return new;
    end;
    $$
    language plpgsql;


alter function trigger_add_bank_row()
    owner to system;


create trigger add_bank_row
    after insert
    on p2p_user
    for each row
    EXECUTE PROCEDURE trigger_add_bank_row();
