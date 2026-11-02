# HexaMarket – félkész változat

A fájlok a majorosneu/hexamarket tár meglévő db.php és users.php szerkezetére épülnek. Minden táblához külön PHP-fájl tartozik.

## Elkészült

- PDO-kapcsolat a db.php fájlban.
- Eseménylista, kategóriaszűrés és bannerképek.
- Dokumentáció szerinti Bootstrap-navbar, külön HTML-oldalakkal.
- Regisztráció, egyszerű jelszó-összehasonlítás és PHP session.
- Felugró eseményrészletek bezáró X-szel.
- Időrendben lekért árfolyamtörténet és egyszerű canvas-vonalgrafikon.

A portfólió üres navbaros oldal. A kereskedés és adminisztráció még nincs kész. A positions.php és transactions.php egyelőre csak helyőrzők.

## A GitHub-tárhoz igazított nevek

- config.php helyett db.php.
- markets.question, nem title.
- markets.winning_side, nem outcome.
- price_history.recorded_at, nem created_at.
- transactions.price és transactions.total, nem amount.
- A users és markets táblában is van created_at.
- A félkész változatban nincs is_admin, cost_basis, volume vagy weather_note mező.

Egy szándékos eltérés a korábbi GitHub README-től: a users.password_hash helyett users.password maradt, mert a kért legegyszerűbb jelszó-összehasonlítást használjuk. A mezőt nem nevezzük hash-nek, ha nem hash-t tárol. Ez a helyi bemutató csak kitalált tesztjelszóval használandó. Későbbi hash-eléskor ezt külön, a PHP-val együtt kell átállítani.

## Helyi indítás

Cím: http://localhost/nemkesz/

Az Apache és a MySQL fusson. A db.php a hexamarket adatbázishoz kapcsolódik. Üres telepítéshez az adatbazis.sql, mintaadatok.sql és past_prices.sql fájlokat kell importálni. A meglévő táblákat ne importáld újra: a félkész felület a teljesebb változat title, outcome és created_at mezőit SQL-aliasokkal olvassa.

A félkész változat külön sessionnevet használ: hexamarket_nemkesz. Így a két felület bejelentkezése külön marad. Az átállítás után újra jelentkezz be.

Friss telepítésnél hozz létre üres adatbázist, majd ebben a sorrendben importáld:

1. adatbazis.sql – csak a hat tábla.
2. mintaadatok.sql – négy esemény, kategóriák és kezdő árak.
3. past_prices.sql – eseményenként 14 korábbi, kitalált bemutatóár.

Meglévő, már feltöltött adatbázisba ezeket nem kell újra importálni. Az SQL-fájlok nem törölnek táblát. A GitHubon vagy más gépen a db.php helyi elérési adatait az ottani adatbázishoz kell állítani.

## Fájlok és feladatok

Backend: db.php, users.php, markets.php, categories.php, price_history.php, az SQL-fájlok, valamint a későbbi positions.php és transactions.php.

Frontend: index.html, belepes.html, regisztracio.html, portfolio.html, kilepes.html, images/. Mindegyik HTML a saját script részét tartalmazza. A Bootstrap CSS és bundle CDN-ről töltődik.

A sessiont a db.php indítja. A users.php sikeres belépés után új sessionazonosítót ad és eltárolja a user_id értéket a szerveren. A HTML-oldalak GET users.php kéréssel kérik le a saját profilt. Az URL-ben nincs user_id; a kilepes.html megszünteti a munkamenetet.

## Frontend–backend megállapodás

- GET categories.php: tömb, id és name mezőkkel.
- GET markets.php: tömb; question, description, category_id, category, yes_price, end_date mezőkkel.
- GET price_history.php?id=1: időrendi tömb, yes_price és recorded_at mezőkkel.
- GET users.php: felhasznalo objektum vagy null, session alapján.
- POST users.php: muvelet lehet regisztracio, belepes vagy kilepes. A regisztráció nev, email, jelszo mezőt, a belépés email és jelszo mezőt vár.
- A hibaválasz hiba mezőt tartalmaz.

