# Flow2Code - Hubert Sitarski

## 1. Uruchomienie projektu

1. Pobieramy projekt
2. W katalogu `laravel` uruchamiamy `composer install`
3. Kopiujemy `env.example` do `.env` i uzupełniamy plik `.env` o dane bazy danych
4. Używamy komendy `php artisan migrate`
5. Używamy komendy `php artisan db:seed`
6. Uruchamiamy komendę `php artisan storage:link`
7. Uruchamiamy serwer komendą `php artisan serve`
8. Pod adresem `127.0.0.1:8000` znajdziemy API
9. W przypadku wykonywania testów należy użyć komendy `./vendor/bin/phpunit` lub `php artisan test (Laravel 7)`

## 2. Linki

* `GET /api/movies` - lista filmów
* `GET /api/movies/{title}` - szczegóły filmu (wyszukiwanie po tytule)
* `POST /api/movies` - dodawanie filmu
* `PUT /api/movies/{id}` - edycja filmu
* `DELETE /api/movies/{id}` - usunięcie filmu

## 3. Omówienie

Wykonałem projekt, zgodnie z dostarczoną instrukcją. Starałem sie zawrzeć wszystkie elementy, o których była mowa w treści, w możliwie jak najbardziej optymalnej formie.

Aby umożliwić wybór kilku gatunków filmów, utworzyłem osobną tabelę `genres` oraz model `Genre` i za pomocą relacji ManyToMany umożliwiłem dodawanie wielu gatunków do wielu różnych filmów.

Dodałem również dodatkowy endpoint do wyszukiwania po filmie, umieściłem walidację requestów, dodałem skalowanie okładki.

Starałem sie, spełnić wszystkie podpunkty, które otrzymałem w treści zadania.

Serdecznie zapraszam do zapoznania się z projektem :)

## 4. Wybrane, użyte narzedzia

* Laravel
* MySQL
* Intervention/Image (skalowanie obrazków)
* PHPUnit