INVENTORY & SALES MANAGEMENT SYSTEM — MWONGOZO (KISWAHILI)
==========================================================

MFUMO HUU UNA NINI?
- Login ya admin
- Dashboard yenye takwimu
- Kuongeza, kuona, kuhariri na kufuta bidhaa
- Categories za bidhaa
- Kusimamia wateja
- Kurekodi mauzo yenye bidhaa zaidi ya moja
- Kupunguza stock kiotomatiki baada ya mauzo kufanikiwa
- Kuzuia mauzo yanayozidi stock iliyopo
- Invoice ya mauzo na print
- Reports za mauzo kwa tarehe na bidhaa zilizouzwa zaidi
- MySQL database na AdminLTE 3.2 dashboard components

MAHITAJI
1. Windows PC
2. XAMPP (Apache + MySQL/MariaDB)
3. Browser kama Chrome
4. Internet ili kupakia AdminLTE/Bootstrap/Font Awesome/Chart.js kutoka CDN.
   PHP pages na business logic ni local; vendor UI assets zinatoka CDN.

NAMNA YA KUFUNGA
1. Extract ZIP.
2. Copy folder lote la Inventory_Sales_System kwenda:
   C:\xampp\htdocs\inventory_sales
   (Folder kuu liwe na index.php, setup.php, login.php, n.k.)
3. Fungua XAMPP Control Panel, Start Apache na MySQL.
4. Fungua browser:
   http://localhost/inventory_sales/setup.php
5. Ukiona Installation completed successfully, bonyeza Go to login.
6. Login ya mwanzo:
   Username: admin
   Password: Admin@123
7. Baada ya kuthibitisha mfumo unafanya kazi, futa/hamisha setup.php kwa usalama.

DATABASE
- Setup page huunda database inventory_sales na tables zake moja kwa moja.
- Kama unapendelea phpMyAdmin: fungua http://localhost/phpmyadmin, chagua Import,
  chagua database/inventory_sales.sql, kisha Go. Ikiwa database tayari ina tables
  za project ya zamani, fanya backup kwanza kabla ya ku-import.
- Config ya MySQL ipo config/database.php. Default ni host 127.0.0.1,
  database inventory_sales, user root, password tupu. Badilisha ikiwa XAMPP yako
  imetumia password tofauti.
- Setup.php ina default host/user/password yake juu ya faili. Badilisha hapo ikiwa
  MySQL yako si root bila password.

KUTUMIA
1. Ingia.
2. Categories: ongeza category kama Electronics.
3. Products: ongeza SKU ya kipekee, jina, bei, stock na reorder level.
4. Customers: ongeza wateja kama unahitaji.
5. Sales: chagua bidhaa, quantity na payment method, kisha Save Sale.
6. Fungua invoice; stock itakuwa imepunguzwa kwenye MySQL.
7. Reports: chagua tarehe ili kuona mauzo ya kipindi hicho.

KUTHIBITISHA DATA INAINGIA MYSQL
1. Rekodi sale au ongeza product kwenye website.
2. Fungua http://localhost/phpmyadmin
3. Chagua inventory_sales.
4. Fungua table products au sales na bonyeza Browse.
5. Angalia rekodi mpya.

MUHIMU
- Huu ni mradi wa mafunzo/demo; kabla ya matumizi ya biashara halisi, ongeza
  password-change/user-management, backups, HTTPS, audit logs, validation zaidi,
  na sera ya usalama ya production.
- Usifungue setup.php kwenye server ya public. Ifute au ihamishe baada ya setup.
- AdminLTE, Bootstrap, Font Awesome, jQuery na Chart.js hupakiwa kupitia CDN; bila
  internet, muonekano wa AdminLTE unaweza kukosekana ingawa PHP/DB local zinaendelea.
- Kama database connection error inaonekana, hakikisha MySQL imewashwa na credentials
  za config/database.php zinaendana na XAMPP yako.
