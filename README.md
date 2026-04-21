# Etkinlik Yönetim Platformu

Kullanıcıların etkinliklere göz atıp kayıt olabildiği, adminlerin etkinlik ve kullanıcı yönetebildiği bir web uygulaması. PHP ve MySQL kullanarak geliştirdim, yerel ortamda XAMPP üzerinde çalışıyor.

PHP tarafında session yönetimi ve rol bazlı yetkilendirmeyi bu projede ilk kez uyguladım. Admin paneli tasarımı ve tablolar arası ilişki kurmak en çok vakit aldığım kısımlar oldu ama sonunda düzgün çalışır hale getirdim.

## Teknolojiler

- PHP
- MySQL
- HTML, CSS
- XAMPP

## Özellikler

- Kullanıcı kayıt ve giriş sistemi
- Session tabanlı oturum yönetimi
- Rol bazlı yetkilendirme: kullanıcı ve admin olmak üzere iki rol var
- Etkinlikleri listeleme ve detay sayfasında inceleme
- Etkinliğe kayıt olma, aynı etkinliğe tekrar kayıt olamama kontrolü
- Admin paneli: etkinlik ekleme ve silme
- Admin paneli: kullanıcıları listeleme, admin atama ve silme

## Kurulum

1. XAMPP indir ve kur
2. Apache ve MySQL servislerini başlat
3. Proje klasörünü `xampp/htdocs/` dizinine koy
4. phpMyAdmin'i aç: `http://localhost/phpmyadmin`
5. `etkinlik_db` adında yeni bir veritabanı oluştur, karakter seti olarak `utf8_turkish_ci` seç
6. Oluşturulan veritabanında SQL sekmesine tıkla, aşağıdaki sorguları çalıştır:

```sql
CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isim VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    sifre VARCHAR(255) NOT NULL,
    rol ENUM('kullanici', 'admin') DEFAULT 'kullanici',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE etkinlikler (
    id INT AUTO_INCREMENT PRIMARY KEY,
    baslik VARCHAR(200) NOT NULL,
    aciklama TEXT,
    tarih DATETIME NOT NULL,
    konum VARCHAR(200),
    kapasite INT DEFAULT 0,
    kullanici_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id)
);

CREATE TABLE kayitlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT,
    etkinlik_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kullanici_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (etkinlik_id) REFERENCES etkinlikler(id)
);
```

7. Tarayıcıda kayıt sayfasını aç ve hesap oluştur:
http://localhost/Etkinlik_Yonetim_Platformu/kayit.php

8. Admin yetkisi almak için phpMyAdmin'de kullanicilar tablosunda kendi kaydını bul, rol alanını admin olarak güncelle.

## Proje Yapısı
Etkinlik_Yonetim_Platformu/
├── admin/
│   ├── index.php
│   ├── etkinlikler.php
│   └── kullanicilar.php
├── assets/
│   └── css/
│       └── style.css
├── includes/
│   ├── baglanti.php
│   ├── session.php
│   └── fonksiyonlar.php
├── index.php
├── giris.php
├── kayit.php
├── cikis.php
├── etkinlikler.php
└── etkinlik_detay.php
