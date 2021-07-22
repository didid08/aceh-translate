<?php

/* FILE INI BERFUNGSI UNTUK MEMASUKKAN DATA AWAL KEDALAM TABLE "dictionary" */

namespace Database\Seeders;

use Illuminate\Database\Seeder; // Memanggil package buat menangani seeder (wajib)
use Illuminate\Support\Facades\DB; // Memanggil package DB agar kita dapat memanggil fungsi yang dapat dipakai untuk mengatur database, seperti insert,update,delete,dll. Dalam kasus ini, package ini hanya digunakan buat insert data

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() // RUNNN SEEDER
    {

        $data = json_decode('[
            {	"kategori": "sawah",
                "aceh": "blang",
                "indonesia": "sawah",
                "gambar": "sawah.jpg"
            },
            {	"kategori": "sawah",
                "aceh": "bijèh",
                "indonesia": "benih",
                "gambar": "benih.png"
            },
            {	"kategori": "sawah",
                "aceh": "seumula",
                "indonesia": "menanam",
                "gambar": "menanam.png"
            },
            {	"kategori": "sawah",
                "aceh": "pula",
                "indonesia": "tanam",
                "gambar": "tanam.png"
            },
            {	"kategori": "sawah",
                "aceh": "pula padé",
                "indonesia": "tanam padi",
                "gambar": "tanam-padi.png"
            },
            {	"kategori": "sawah",
                "aceh": "tak ateueng",
                "indonesia": "babat pematang",
                "deskripsi": "membabat pematang menggunakan parang"
            },
            {	"kategori": "sawah",
                "aceh": "catok ateueng",
                "indonesia": "babat pematang",
                "deskripsi": "membabat pematang menggunakan cangkul",
                "gambar": "babat-pematang.png"
            },
            {	"kategori": "sawah",
                "aceh": "meugoe",
                "indonesia": "bertani",
                "gambar": "bertani.png"
            },
            {	"kategori": "sawah",
                "aceh": "timoh",
                "indonesia": "tumbuh",
                "gambar": "tumbuh.png"
            },
            {	"kategori": "sawah",
                "aceh": "leuhu",
                "indonesia": "tumbuh subur",
                "gambar": "tumbuh-subur.png"
            },
            {	"kategori": "sawah",
                "aceh": "seuneulông",
                "indonesia": "bibit padi",
                "deskripsi": "bibit padi yang baru tumbuh",
                "gambar": "bibit-padi.png"
            },
            {	"kategori": "sawah",
                "aceh": "neulông",
                "indonesia": "bibit padi",
                "deskripsi": "bibit padi yang baru tumbuh",
                "gambar": "bibit-padi-2.png"
            },
            {	"kategori": "sawah",
                "aceh": "lheue neulông",
                "indonesia": "tempat penyamaian",
                "deskripsi": "tempat untuk menyemaikan padi sebelum di tanam",
                "gambar": "tempat-penyamaian.png"
            },
            {	"kategori": "sawah",
                "aceh": "tabu bijèh",
                "indonesia": "menyemai bibit padi",
                "gambar": "menyemai-bibit-padi.png"
            },
            {	"kategori": "sawah",
                "aceh": "raleue",
                "indonesia": "menyemai bibit padi",
                "gambar": "menyemai-bibit-padi-2.png"
            },
            {	"kategori": "sawah",
                "aceh": "lheue raleue",
                "indonesia": "bidang pembibitan padi",
                "gambar": "bidang-pembibitan-padi.png"
            },
            {	"kategori": "sawah",
                "aceh": "meu\'ue",
                "indonesia": "membajak",
                "gambar": "membajak.png"
            },
            {	"kategori": "sawah",
                "aceh": "creueh",
                "indonesia": "menggaruk tanah",
                "gambar": "menggaruk-tanah.png"
            },
            {	"kategori": "sawah",
                "aceh": "lhom bijèh",
                "indonesia": "menanam bibit",
                "gambar": "menanam-bibit.png"
            },
            {	"kategori": "sawah",
                "aceh": "lhông",
                "indonesia": "semai bibit",
                "gambar": "semai-bibit.png"
            },
            {	"kategori": "sawah",
                "aceh": "seumè",
                "indonesia": "semai",
                "gambar": "semai.png"
            },
            {	"kategori": "sawah",
                "aceh": "tabu",
                "indonesia": "tabur",
                "gambar": "tabur.png"
            },
            {	"kategori": "sawah",
                "aceh": "böh naleueng",
                "indonesia": "menyiangi rumput",
                "gambar": "menyiangi-rumput.png"
            },
            {	"kategori": "sawah",
                "aceh": "ureueh",
                "indonesia": "menyiangi rumput",
                "gambar": "menyiangi-rumput-2.png"
            },
            {	"kategori": "sawah",
                "aceh": "eumpoe",
                "indonesia": "merumput",
                "gambar": "merumput.png"
            },
            {	"kategori": "sawah",
                "aceh": "meu eumpoe",
                "indonesia": "membersihkan padi dari rumput",
                "gambar": "membersihkan-padi-dari-rumput.png"
            },
            {	"kategori": "sawah",
                "aceh": "raweuet",
                "indonesia": "membuang rumput dari sela sela padi",
                "gambar": "membuang-rumput-dari-sela-sela-padi.png"
            },
            {	"kategori": "sawah",
                "aceh": "koh",
                "indonesia": "potong"
            },
            {	"kategori": "sawah",
                "aceh": "keumeukoh",
                "indonesia": "memotong, panen",
                "deskripsi": "memotong padi yang telah siap untuk di panen"
            },
            {	"kategori": "sawah",
                "aceh": "ceumeulhö",
                "indonesia": "merontokkan padi",
                "deskripsi": "merontokkan padi dari batangnya"
            },
            {	"kategori": "sawah",
                "aceh": "peukrui",
                "indonesia": "menganginkan",
                "deskripsi": "menganginkan padi untuk menghilangkan atau membuang padi yang kosong"
            },
            {	"kategori": "sawah",
                "aceh": "adèe",
                "indonesia": "jemur"
            },
            {	"kategori": "sawah",
                "aceh": "top",
                "indonesia": "tumbuk"
            },
            {	"kategori": "sawah",
                "aceh": "naleueng",
                "indonesia": "rumput"
            },
            {	"kategori": "sawah",
                "aceh": "meunaleueng",
                "indonesia": "berumput"
            },
            {	"kategori": "sawah",
                "aceh": "seukeuem",
                "indonesia": "sekam atau kulit padi yang kasar"
            },
            {	"kategori": "sawah",
                "aceh": "jeundrang",
                "indonesia": "jerami"
            },
            {	"kategori": "sawah",
                "aceh": "jeumpung",
                "indonesia": "sisa padi yang telah dipotong"
            },
            {	"kategori": "sawah",
                "aceh": "pupôk",
                "indonesia": "pupuk"
            },
            {	"kategori": "sawah",
                "aceh": "umöng",
                "indonesia": "tempat untuk menanam padi"
            },
            {	"kategori": "sawah",
                "aceh": "ie peuneuék",
                "indonesia": "irigasi"
            },
            {	"kategori": "sawah",
                "aceh": "lueng ie",
                "indonesia": "saluran air"
            },
            {	"kategori": "sawah",
                "aceh": "ateueng",
                "indonesia": "pematang"
            },
            {	"kategori": "sawah",
                "aceh": "ateueng",
                "indonesia": "tanggul"
            },
            {	"kategori": "sawah",
                "aceh": "ampéh",
                "indonesia": "penahan air",
                "deskripsi": "penahan air biasanya terletak di sawah atau sungai"
            },
            {	"kategori": "sawah",
                "aceh": "pageue",
                "indonesia": "pagar"
            },
            {	"kategori": "sawah",
                "aceh": "jambô",
                "indonesia": "rangkang"
            },
            {	"kategori": "sawah",
                "aceh": "langai",
                "indonesia": "alat untuk membajak sawah"
            },
            {	"kategori": "sawah",
                "aceh": "yôk",
                "indonesia": "alat yang diletakkan di leher kerbau untuk membajak sawah"
            },
            {	"kategori": "sawah",
                "aceh": "catok",
                "indonesia": "cangkul"
            },
            {	"kategori": "sawah",
                "aceh": "cangkôi",
                "indonesia": "cangkul"
            },
            {	"kategori": "sawah",
                "aceh": "tukôi",
                "indonesia": "cangkul kecil"
            },
            {	"kategori": "sawah",
                "aceh": "sadeuep",
                "indonesia": "sabit"
            },
            {	"kategori": "sawah",
                "aceh": "parang",
                "indonesia": "parang"
            },
            {	"kategori": "sawah",
                "aceh": "maw\'ah",
                "indonesia": "bagi hasil"
            },
            {	"kategori": "sawah",
                "aceh": "meu\'ue blang",
                "indonesia": "membajak sawah"
            },
            {	"kategori": "sawah",
                "aceh": "gasai",
                "indonesia": "padi yang telah diptong",
                "deskripsi": "padi yang telah dipotong dan diikat kemudian diletakkan di atas sisa batang padi yang telah di potong"
            },
            {	"kategori": "sawah",
                "aceh": "nibai",
                "indonesia": "padi yang telah diptong",
                "deskripsi": "padi yang telah dipotong dan diikat kemudian diletakkan di atas sisa batang padi yang telah di potong"
            },
            {	"kategori": "sawah",
                "aceh": "phui",
                "indonesia": "tumpukan padi yang telah dipotong dan diletakkan di dalam sawah"
            },
            {	"kategori": "sawah",
                "aceh": "beudeueng",
                "indonesia": "debu padi"
            },
            {	"kategori": "sawah",
                "aceh": "beudeueng",
                "indonesia": "serbuk halus yang berterbangan saat merontokkan padi"
            },
            {	"kategori": "sawah",
                "aceh": "naléh",
                "indonesia": "hitungan padi",
                "deskripsi": "jumlah padi sebanak 16 bambu"
            },
            {	"kategori": "sawah",
                "aceh": "katéng",
                "indonesia": "hitungan padi",
                "deskripsi": "jumlah padi sebanyak 20 bambu"
            },
            {	"kategori": "sawah",
                "aceh": "bléet",
                "indonesia": "hitungan padi",
                "deskripsi": "jumlah padi sebanyak 10 bambu"
            },
            {	"kategori": "sawah",
                "aceh": "arée",
                "indonesia": "tampat takaran padi dalam 1 bambu"
            },
            {	"kategori": "sawah",
                "aceh": "krông",
                "indonesia": "tempat penyimpanan padi"
            },
            {	"kategori": "sawah",
                "aceh": "manah",
                "indonesia": "tempat penyimpanan padi"
            },
            {	"kategori": "sawah",
                "aceh": "jeuengki",
                "indonesia": "alat untuk menumbuk padi"
            },
            {	"kategori": "sawah",
                "aceh": "jeueé",
                "indonesia": "tampi"
            },
            {	"kategori": "sawah",
                "aceh": "leusông",
                "indonesia": "tempat untuk meletakkan padi yang akan ditumbuk"
            },
            {	"kategori": "sawah",
                "aceh": "alèe",
                "indonesia": "alat untuk menumbuk padi"
            },
            {	"kategori": "sawah",
                "aceh": "tudông",
                "indonesia": "topi sawah"
            },
            {	"kategori": "sawah",
                "aceh": "peunganyeuep",
                "indonesia": "orang-orangan sawah"
            },
            {	"kategori": "sawah",
                "aceh": "adèe padè",
                "indonesia": "menjemur padi",
                "audio": "adee padee.mp3"
            },
            {	"kategori": "sawah",
                "aceh": "brèh",
                "indonesia": "beras"
            },
            {	"kategori": "sawah",
                "aceh": "lhôk",
                "indonesia": "kulit padi yang halus"
            },
            {	"kategori": "sawah",
                "aceh": "neukued",
                "indonesia": "beras yang hancur"
            },
            {	"kategori": "sawah",
                "aceh": "tampoe",
                "indonesia": "tampi"
            },
            {	"kategori": "sawah",
                "aceh": "tulô",
                "indonesia": "burung yang memakan padi (hama)"
            },
            {	"kategori": "sawah",
                "aceh": "tika",
                "indonesia": "tempat untuk menjemur padi"
            },
            {	"kategori": "sawah",
                "aceh": "umpang",
                "indonesia": "karung"
            },
            {	"kategori": "sawah",
                "aceh": "keumit padè",
                "indonesia": "menjaga padi"
            },
            {	"kategori": "sawah",
                "aceh": "sigantang",
                "indonesia": "hitungan padi"
            },
            {	"kategori": "sawah",
                "aceh": "siyok",
                "indonesia": "hitungan padi"
            },
            {	"kategori": "sawah",
                "aceh": "peuteungoh padè",
                "indonesia": "mengangkat padi dari dalam sawah"
            },
            {	"kategori": "sawah",
                "aceh": "ceuding",
                "indonesia": "padi yang tumbuh setelah dipotong"
            },
            {	"kategori": "sawah",
                "aceh": "teumabue",
                "indonesia": "menabur biji padi yang  telah bertunas"
            },
            {	"kategori": "sawah",
                "aceh": "padè sroh",
                "indonesia": "padi yang mulai keluar dari batang"
            },
            {	"kategori": "sawah",
                "aceh": "seumprot padè",
                "indonesia": "membersihkan hama padi"
            },
            {	"kategori": "sawah",
                "aceh": "boh baja padè",
                "indonesia": "memupuk padi"
            },
            {	"kategori": "sawah",
                "aceh": "padè meu buleuen peungeuh",
                "indonesia": "padi yang mulai masak setengah batang"
            },
            {	"kategori": "sawah",
                "aceh": "padè bintang hue",
                "indonesia": "padi yang mulai keluar dari batangnya dengan jarang-jarang"
            },
            {	"kategori": "sawah",
                "aceh": "padè jong",
                "indonesia": "padi yang sudah kosong karena dimakan binatang"
            },
            {	"kategori": "sawah",
                "aceh": "puso",
                "indonesia": "gagal panen"
            },
            {	"kategori": "sawah",
                "aceh": "rampagoe",
                "indonesia": "alat untuk memotong 1 batang padi"
            },
            {	"kategori": "sawah",
                "aceh": "siet",
                "indonesia": "memotong atau mengumpulkan padi sisa setelah dipotong"
            },
            {	"kategori": "sawah",
                "aceh": "choe ie",
                "indonesia": "parit untuk membuang air di sawah"
            },
            {	"kategori": "sawah",
                "aceh": "jangka ie",
                "indonesia": "mengukur air di dalam sawah"
            },
            {	"kategori": "sawah",
                "aceh": "sikai",
                "indonesia": "takaran padi 1 muk",
                "deskripsi": "diukur menggunakan batok kalapa"
            },
            {	"kategori": "sawah",
                "aceh": "sigunca",
                "indonesia": "takaran padi sebanyak 200 bambu"
            },
            {	"kategori": "sawah",
                "aceh": "sikuyan",
                "indonesia": "takaran padi sebanyak 2 ton"
            },
            {	"kategori": "sawah",
                "aceh": "saboh mok",
                "indonesia": "takaran padi 1 muk"
            },
            {	"kategori": "sawah",
                "aceh": "wa",
                "indonesia": "terompet ang dibuat dari jerami padi"
            },
            {	"kategori": "sawah",
                "aceh": "lumbông",
                "indonesia": "tempat penyimpanan padi yang lebih besar"
            },
            {	"kategori": "sawah",
                "aceh": "bléut",
                "indonesia": "alat untuk mengangkut padi yang telah di potong"
            },
            {	"kategori": "sawah",
                "aceh": "bajoe",
                "indonesia": "pasak pada aliran air padi"
            },
            {	"kategori": "sawah",
                "aceh": "cak",
                "indonesia": "tanah yang mengumpal setelah dibajak",
                "gambar": "tanah-yang-mengumpal-setelah-dibajak.png"
            },
            {	"kategori": "sawah",
                "aceh": "bana",
                "indonesia": "panyakit pada padi yang ditandai dengan daun berwarna merah"
            },
            {	"kategori": "sawah",
                "aceh": "padé leukat",
                "indonesia": "ketan"
            },
            {	"kategori": "sawah",
                "aceh": "leukat adang",
                "indonesia": "ketan hitam"
            },
            {	"kategori": "sawah",
                "aceh": "padé bit",
                "indonesia": "beras putih"
            },
            {	"kategori": "sawah",
                "aceh": "tadah hujan",
                "indonesia": "musim tanam dengan menunggu curah hujan"
            },
            {	"kategori": "sawah",
                "aceh": "indram bijèh",
                "indonesia": "merendam bibit padi agar bertunas"
            },
            {	"kategori": "sawah",
                "aceh": "proh bijèh padé",
                "indonesia": "memisahkan bibit padi yang tergumpal"
            },
            {	"kategori": "sawah",
                "aceh": "padé buli",
                "indonesia": "padi yang mau berisi"
            },
            {	"kategori": "sawah",
                "aceh": "padé manu",
                "indonesia": "padi yang mau masak"
            },
            {	"kategori": "sawah",
                "aceh": "bijèh kameuming",
                "indonesia": "bibit yang baru muncul tunas"
            },
            {	"kategori": "sawah",
                "aceh": "padé soh",
                "indonesia": "padi kosong"
            },
            {	"kategori": "sawah",
                "aceh": "meuböt",
                "indonesia": "mencabut benih padi padi yang sudah tumbuh"
            },
            {	"kategori": "sawah",
                "aceh": "peugot ateueng",
                "indonesia": "membuat pematang",
                "gambar": "membuat-pematang.png"
            }
        ]', true);

        foreach ($data as $row) {
            DB::table('dictionaries')->insert($row);
        }
    }
}
