# Student Grade Calculator (JSON)

A small PHP page that reads student grades from a JSON file, calculates each student's end-of-term grade, letter grade, grade point and pass status, shows them in a table, and writes the results to another JSON file. There is no database; everything lives in two files. I wrote it as a course assignment. A MySQL version of the same idea is in [database_ile_ogrenci_durumu](https://github.com/manyaksisko35/database_ile_ogrenci_durumu).

## Features

- Reads students from `ogrenciler.json` (school number, name, course, midterm, homework, project and final scores).
- Calculates the end-of-term grade with these weights:

  | Component         | Weight |
  |-------------------|--------|
  | Midterm (`vize`)  | 25%    |
  | Homework (`odev`) | 25%    |
  | Project (`proje`) | 5%     |
  | Final (`final`)   | 45%    |

- Converts the result to a letter grade and grade point:

  | Average (at least) | Letter | Point | Status   |
  |--------------------|--------|-------|----------|
  | 90                 | AA     | 4.00  | Başarılı |
  | 85                 | BA     | 3.50  | Başarılı |
  | 80                 | BB     | 3.00  | Başarılı |
  | 75                 | CB     | 2.50  | Başarılı |
  | 70                 | CC     | 2.00  | Başarılı |
  | 60                 | DC     | 1.50  | Geçer    |
  | 50                 | DD     | 1.00  | Geçer    |
  | below 50           | FF     | 0.00  | Kaldı    |

  (Başarılı = passed, Geçer = passed with a low grade, Kaldı = failed)
- Shows all students in an HTML table; rows with an average of 50 or more are green, the rest are red.
- Every time the page loads, it writes the results to `sonuclar.json` (school number, name, course, end-of-term grade, letter grade, grade point, status).

## Built with

- PHP
- JSON files for input and output
- HTML and CSS

## Getting started

### Requirements

- PHP (no database or extra extensions needed)
- Write permission on the project folder, because the page overwrites `sonuclar.json`

### Run

With PHP's built-in server:

```bash
git clone https://github.com/manyaksisko35/json_ile_ogrenci_durumu.git
cd json_ile_ogrenci_durumu
php -S localhost:8000
```

Then open `http://localhost:8000`.

With XAMPP: copy the folder into `htdocs`, start Apache and open `http://localhost/json_ile_ogrenci_durumu/`.

To use your own data, edit `ogrenciler.json` and reload the page.

## Example

One entry in `ogrenciler.json`:

```json
{
    "okul_no": "25001",
    "ad_soyad": "Ali Yılmaz",
    "ders_adi": "Web Programlama",
    "vize": 70,
    "final": 80,
    "odev": 90,
    "proje": 85
}
```

70 × 0.25 + 90 × 0.25 + 85 × 0.05 + 80 × 0.45 = 80.25, so `sonuclar.json` gets:

```json
{
    "okul_no": "25001",
    "ad_soyad": "Ali Yılmaz",
    "ders_adi": "Web Programlama",
    "donem_sonu_notu": 80.25,
    "harf_notu": "BB",
    "katsayi": "3.00",
    "statu": "Başarılı"
}
```

## Türkçe

Bu proje, öğrenci notlarını `ogrenciler.json` dosyasından okuyan ve dönem sonu notunu hesaplayan basit bir PHP uygulamasıdır. Not; vize %25, ödev %25, proje %5 ve final %45 ağırlıkla hesaplanır, ardından harf notu, katsayı ve statü (Başarılı, Geçer, Kaldı) belirlenir. Sonuçlar tabloda gösterilir ve `sonuclar.json` dosyasına kaydedilir. Veritabanı gerekmez; `php -S localhost:8000` ile çalıştırılabilir.

Made by [Hasan Alp Güngör](https://hasanalpgungor.com/en)
