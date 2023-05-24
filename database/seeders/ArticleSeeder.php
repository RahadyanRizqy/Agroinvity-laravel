<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articleSeed = array(
            'title' => [
                'Pertanian', 
                'Perkebunan',
            ],
            'text' => [
                'Pertanian adalah kegiatan pemanfaatan sumber daya hayati yang dilakukan manusia untuk menghasilkan bahan pangan, bahan baku industri, atau sumber energi, serta untuk mengelola lingkungan hidupnya.[1] Kegiatan pemanfaatan sumber daya hayati yang termasuk dalam pertanian biasa dipahami orang sebagai budidaya tanaman atau bercocok tanam serta pembesaran hewan ternak, meskipun cakupannya dapat pula berupa pemanfaatan mikroorganisme dan bioenzim dalam pengolahan produk lanjutan, seperti pembuatan keju dan tempe, atau sekadar ekstraksi semata, seperti penangkapan ikan atau eksploitasi hutan.

                Bagian terbesar penduduk dunia bermata pencaharian dalam bidang-bidang di lingkup pertanian, namun pertanian hanya menyumbang 4% dari PDB dunia.[2]
                
                Kelompok ilmu-ilmu pertanian mengkaji pertanian dengan dukungan ilmu-ilmu pendukungnya. Karena pertanian selalu terikat dengan ruang dan waktu, ilmu-ilmu pendukung, seperti ilmu tanah, meteorologi, teknik pertanian, biokimia, dan statistika juga dipelajari dalam pertanian. Usaha tani adalah bagian inti dari pertanian karena menyangkut sekumpulan kegiatan yang dilakukan dalam budidaya. "Petani" adalah sebutan bagi mereka yang menyelenggarakan usaha tani, sebagai contoh "petani tembakau" atau "petani ikan". Pelaku budidaya hewan ternak secara khusus disebut sebagai peternak.',

                'Perkebunan adalah segala kegiatan yang mengusahakan tanaman tertentu pada tanah dan/atau media tumbuh lainnya dalam ekosistem yang sesuai; mengolah, dan memasarkan barang dan jasa hasil tanaman tersebut, dengan bantuan ilmu pengetahuan dan teknologi, permodalan serta manajemen untuk mewujudkan kesejahteraan bagi pelaku usaha perkebunan dan masyarakat.[1] Tanaman yang ditanam bukanlah tanaman yang menjadi makanan pokok maupun sayuran untuk membedakannya dengan usaha ladang dan hortikultura sayur mayur dan bunga, meski usaha penanaman pohon buah masih disebut usaha perkebunan. Tanaman yang ditanam umumnya berukuran besar dengan waktu penanaman yang relatif lama, antara kurang dari setahun hingga tahunan.

                Perkebunan dibedakan dari agroforestri dan silvikultur (budidaya hutan) karena sifat intensifnya. Dalam perkebunan pemeliharaan memegang peranan penting; sementara dalam agroforestri dan silvikultur, tanaman cenderung dibiarkan untuk tumbuh sesuai kondisi alam. Karena sifatnya intensif, perkebunan hampir selalu menerapkan cara budidaya monokultur, kecuali untuk komoditas tertentu, seperti lada dan vanili. Penciri sekunder, yang tidak selalu berlaku, adalah adanya instalasi pengolahan atau pengemasan terhadap hasil panen dari lahan perkebunan itu, sebelum produknya dipasarkan. Perkebunan dibedakan dari usaha tani pekarangan terutama karena skala usaha dan pasar produknya.
                
                Ukuran luas perkebunan sangat relatif dan tergantung volume komoditas yang dihasilkan. Namun, suatu perkebunan memerlukan suatu luas minimum untuk menjaga keuntungan melalui sistem produksi yang diterapkannya. Kepemilikan lahan bukan merupakan syarat mutlak dalam perkebunan, sehingga untuk beberapa komoditas berkembang sistem sewa-menyewa lahan atau sistem pembagian usaha, seperti Perkebunan Inti Rakyat (PIR).
                
                Sejarah perkebunan di banyak negara kerap terkait dengan sejarah penjajahan/kolonialisme dan pembentukan suatu negara, termasuk di Indonesia.',
            ]);
        
            for ($i = 0; $i < count($articleSeed['title']); $i++) {
                DB::table('articles')->insert(
                    [
                        'title' => $articleSeed['title'][$i],
                        'text' => $articleSeed['text'][$i],
                        // 'status' => $accountSeed['status'][$i],
                    ]
                );
            }
    }
}
