# Zadanie rekrutacyjne
Aplikacji Laravel, która pobiera dane z API TMDB, zapisuje je w bazie danych i udostępnia własne REST API z obsługą wielu języków.
Projekt działa w oparciu o 3 kontenery:
- app (rec_movie_app),
- db (rec_movie_db),
- queue (rec_movie_queue).

Aby uruchmoić projekt należy:
1. Pobrać repozytrium.
2. Przejść do katalogu repozytorium.
3. Zbudować i uruchomić kontener `docker compose up -d --build`.
4. Aplikacja uruchomi się pod adresem `http://localhost:8000`.
5. Po pierwszym uruchomieniu należy wykonać migrację. Polecenie `docker compose exec app php artisan migrate`.


Endpointy:
- `http://localhost:8000/import/movie` - pobranie i zapisanie danych o filmach,
- `http://localhost:8000/import/series` - - pobranie i zapisanie danych o serialach,
- `http://localhost:8000/import/genres` - - pobranie i zapisanie danych o gatunkach.

Aby wyświetlić listę filmów, seriali i gatunków należy użyć linku i w Headers (dotyczy Postamana itp.) ustawić dla Accept-Language wartość `pl` lub `en` lub `de` w zależności od języka, w którym chcemy pobrać dane. Jeśli żadna wartość nie zostanie ustawiona to domyślnie dane zostaną pobrane w języku polskim.
- `http://localhost:8000/movie` - lista filmów,
- `http://localhost:8000/series` - lista seriali,
- `http://localhost:8000/genres` - lista gatunków,
