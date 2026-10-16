# hexamarket


## ADATBÁZIS

1. **users**
   id (PK),
   username,
   email,
   password_hash,
   balance,
   created_at

2. **markets**
   id (PK),
   category_id,
   question,
   description,
   yes_price,
   status,
   winning_side,
   end_date,
   created_at

3. **categories**
   id (PK),
   name

4. **positions**
   id (PK),
   user_id,
   market_id,
   side,
   shares

5. **transactions**
   id (PK),
   user_id ,
   market_id ,
   type,
   side,
   shares,
   price,
   total,
   created_at

6. **price_history**
   id (PK),
   market_id,
   yes_price,
   recorded_at
