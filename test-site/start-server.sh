#!/bin/bash
# Skrypt do uruchomienia lokalnego serwera testowego

echo "⚠️  OSTRZEŻENIE: Uruchamiasz celowo podatną stronę testową!"
echo "Upewnij się, że używasz tego tylko lokalnie lub na subdomenie testowej."
echo ""
echo "Serwer będzie dostępny pod adresem: http://localhost:8000"
echo "Naciśnij Ctrl+C aby zatrzymać serwer."
echo ""

cd "$(dirname "$0")"
php -S localhost:8000

