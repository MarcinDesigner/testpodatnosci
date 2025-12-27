[![Security](https://securityscan.dev/api/ci/badge/MarcinDesigner/testpodatnosci)](https://securityscan.dev)

# ⚠️ OSTRZEŻENIE - CELOWO PODATNA STRONA TESTOWA

**Ta strona została celowo stworzona z podatnościami bezpieczeństwa do testów.**

## Podatności zawarte w tej stronie:

1. **Publiczny plik .env** - zawiera klucze API, hasła, tokeny, connection strings
2. **Publiczne repozytorium .git** - dostęp do historii commitów (.git/config, .git/HEAD, .git/logs)
3. **Brak nagłówków bezpieczeństwa** - brak CSP, HSTS, X-Frame-Options, X-Content-Type-Options
4. **IDOR (Insecure Direct Object Reference)** - brak autoryzacji w `api.php`, dostęp do danych innych użytkowników
5. **Brak rate limiting** - podatne na brute force w `api/login.php`
6. **Niebezpieczny upload** - brak walidacji plików, możliwość RCE przez upload PHP
7. **Podatny CORS** - `Access-Control-Allow-Origin: *` z credentials
8. **Wyeksponowane klucze API w JavaScript** - widoczne w kodzie źródłowym (Stripe, AWS, Algolia, Twitter)
9. **Publiczne source mapy** - `index.js.map` zawiera wrażliwe dane
10. **Wrażliwe pliki backup** - backup.zip, database.db, config.old.json, wp-config.php.bak
11. **phpinfo() w uploads/** - możliwość disclosure informacji o serwerze
12. **XSS (Cross-Site Scripting)** - brak escapowania w `xss-test.php`
13. **SQL Injection** - brak prepared statements w `api/search.php`
14. **Ujawnienie ścieżek w robots.txt** - celowo ujawnione wrażliwe katalogi
15. **Firebase z podatnymi regułami** - anonimowa autentykacja, Firestore rules: `allow read, write: if true`

## Użycie:

**⚠️ NIGDY nie używaj tej strony na produkcji!**

Użyj lokalnie lub na subdomenie testowej, którą później usuniesz.

### Lokalnie z PHP:

```bash
cd test-site
php -S localhost:8000
```

Lub użyj skryptu:

```bash
./start-server.sh
```

### Z Apache/Nginx:

Skopiuj folder `test-site` do katalogu www i skonfiguruj wirtualny host.

## Endpointy do testowania:

- `http://localhost:8000/` - strona główna
- `http://localhost:8000/api.php?id=1` - IDOR vulnerability
- `http://localhost:8000/api/login.php?user=admin&pass=admin` - brak rate limiting
- `http://localhost:8000/api/search.php?q=test` - SQL Injection vulnerability
- `http://localhost:8000/xss-test.php?name=<script>alert('XSS')</script>` - XSS vulnerability
- `http://localhost:8000/upload.php` - niebezpieczny upload
- `http://localhost:8000/uploads/phpinfo.php` - phpinfo disclosure
- `http://localhost:8000/.env` - publiczny plik z danymi wrażliwymi
- `http://localhost:8000/.git/config` - publiczne repozytorium git
- `http://localhost:8000/robots.txt` - ujawnione ścieżki
- `http://localhost:8000/index.js.map` - source map z wrażliwymi danymi

## Po testach:

**⚠️ USUŃ cały katalog test-site po zakończeniu testów!**

