Turistička agencija — Laravel aplikacija

Aplikacija za prezentaciju tura/destinacija i osnovni booking/workflow. Sadrži javni web deo, administratorski panel i jednostavan javni API.

🚀 Funkcionalnosti

Javni sajt

Prikaz popularnih destinacija, paketa i blog objava

Detalji destinacije/aranžmana sa galerijom, videima i itinerarom

Pretraga, filtriranje i paginacija listi

Administracija

CRUD nad destinacijama, paketima, itinerarima, medijima

Upravljanje članovima tima

Upravljanje korisnicima i ulogama (npr. admin, user, guest)

Korisnici

Registracija, login, logout, reset lozinke (email)

API (primeri)

GET /api/team?per_page=10 ili per_page=all

(moguće dalje rute: destinacije, paketi, pretraga…)

Dodatno

Upload fajlova (storage), keširanje, sortiranje, TinyMCE/Editor za opise

SEO-friendly slug-ovi

🧰 Tehnologije

PHP ^8.1, Laravel 10/11

MySQL/MariaDB (može i SQLite za razvoj)

Node.js ^18 i NPM (Vite za assete)

Composer

📦 Zahtevi

PHP ekstenzije: openssl, pdo, mbstring, tokenizer, xml, ctype, json, fileinfo

MySQL/MariaDB baza napravljenog naziva (npr. travel_agency)

Mail servis (za reset lozinke) — u razvojnoj fazi može mailhog ili smtp.gmail.com

⚙️ Instalacija (lokalno)
# 1) Kloniranje
git clone https://github.com/USERNAME/REPO.git
cd REPO

# 2) PHP zavisnosti
composer install

# 3) JS zavisnosti
npm install

# 4) .env fajl
cp .env.example .env

# 5) App key
php artisan key:generate

Podesi .env

Otvorite .env i podesite konekciju ka bazi i mail-u:

APP_NAME="Travel Agency"
APP_ENV=local
APP_KEY=base64:GENERISANO
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

# Baza
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_agency
DB_USERNAME=root
DB_PASSWORD=

# Mail (primer za Gmail SMTP ili Mailhog)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=vas.email@gmail.com
MAIL_PASSWORD=lozinka_ili_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@travel-agency.test"
MAIL_FROM_NAME="${APP_NAME}"

Migracije & seed
# 6) Migracije i seederi (kreira osnovne podatke, uloge i demo sadržaj)
php artisan migrate --seed

# 7) Storage symlink (za uploadovane fotografije)
php artisan storage:link


Ako u seed-ovima postoji admin korisnik, tipično kredencijali budu:
email: admin@example.com
 • lozinka: password
(Ako nije tako u tvom projektu, izmeni u database/seeders/... ili kreiraj preko Tinker-a.)

Pokretanje

Uključiti PHP server i Vite:

# Backend
php artisan serve
# Frontend assets (Vite)
npm run dev


Aplikacija je dostupna na: http://127.0.0.1:8000

Produkcijski build (po izboru)
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache

🔌 API – brzi pregled
Članovi tima

GET /api/team?per_page=10 — vraća paginiranu listu

GET /api/team?per_page=all — vraća sve (bez paginacije)

Primer odgovora (422 validacija kod POST-a, ako dodaš kreiranje):

{
  "errors": {
    "slug": ["Slug mora biti jedinstven."],
    "name": ["Naziv je obavezan."]
  }
}


Napomena: U kodu postoji transformacija izlaza — proveri TeamApiController i transform() metodu.

🔐 Uloge i pristup

Admin: Puni pristup admin panelu i svim CRUD operacijama.

Korisnik: Pristup korisničkim funkcijama (profil, rezervacije, komentari… po potrebi).

Gost: Javni deo sajta.

Uloge/permissions obično su seed-ovane (proveri RolesSeeder). Ako treba, možeš dodeliti ručno:

php artisan tinker
>>> $u = \App\Models\User::where('email','admin@example.com')->first();
>>> $u->assignRole('admin');

🧭 Navigacija (ključne rute)

Početna: /

Destinacije (lista): /destinations

Destinacija (detalj): /destination/{slug}

Login/Registracija: /login, /register

Admin dashboard: npr. /admin (zavisi od tvoje rute/middleware-a)

🧑‍💻 Razvojne napomene

Uploadovi se nalaze u storage/app/public i služe se preko public/storage (zato je potreban storage:link).

Slike koje dolaze iz admina često se čuvaju pod public/uploads (ako tako želiš — uskladi sa kontrolerima).

Za TinyMCE/Editor proveri inicijalizaciju u Blade-u (npr. resources/views/...).

🧪 Testovi (opciono)

Ako imaš testove:

php artisan test
# ili
./vendor/bin/phpunit

🩺 Troubleshooting

Blank strana / 500
Očisti keš:

php artisan optimize:clear


Slike se ne prikazuju
Uradi:

php artisan storage:link


i proveri da li putanje idu na asset('storage/...') ili asset('uploads/...') — uskladi sa kontrolerom.

NPM/Vite ne učitava stilove
Pokreni npm run dev ili npm run build i osveži stranu.

Migracije padaju
Proveri kredencijale baze u .env i da li baza postoji.

📄 Licenca

MIT (ili dodaj svoju licencu po potrebi).

✉️ Kontakt

Za pitanja i predloge: putkrozsvet@gmail.com ili otvori Issue u repozitorijumu.