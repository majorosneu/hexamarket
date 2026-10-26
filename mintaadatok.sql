-- Négy szemléltető esemény és kategóriák. Üres táblákba, egyszer futtatandó.
INSERT INTO categories (name) VALUES
('Kriptovaluta'), ('Időjárás'), ('Sport'), ('Technológia');

-- Szemléltető események, kitalált kezdő százalékokkal.
INSERT INTO markets (category_id, title, description, yes_price, end_date) VALUES
(1, 'Eléri a Bitcoin a 150 000 dollárt 2027-ben?', 'IGEN, ha a Coinbase BTC/USD azonnali piacán legalább egy kötés ára eléri a 150 000 dollárt 2027. december 31. 23:59 UTC-ig. Az adminisztrátor a Coinbase adatai alapján ellenőrzi.', 65, '2028-01-01 00:00:00'),
(2, 'Lesz 30 °C Budapesten 2027. július 15-én?', 'IGEN, ha az Open-Meteo Budapest (47.4979, 19.0402) napi maximum-hőmérséklete legalább 30 °C a megadott napon, Europe/Budapest időzónában. A kezdő ár szemléltető adat, nem előrejelzés.', 58, '2027-07-17 00:00:00'),
(3, 'Nyer Magyarország a következő hazai Eb-selejtezőjén?', 'A 2026. november 2. utáni első hazai férfi labdarúgó Eb-selejtező rendes játékideje számít, az UEFA adatai alapján. Döntetlennél NEM. Ha 2027 végéig nincs ilyen mérkőzés, NEM.', 72, '2028-01-01 00:00:00'),
(4, 'Bemutatnak új Apple Vision készüléket 2027-ben?', 'IGEN, ha az Apple Newsroom 2027-ben új Vision hardverterméket jelent be. Szoftverfrissítés vagy új kiegészítő nem számít.', 43, '2028-01-01 00:00:00');

INSERT INTO price_history (market_id, yes_price)
SELECT id, yes_price FROM markets;

