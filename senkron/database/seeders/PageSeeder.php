<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Slider;
use App\Models\SliderElement;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //KURUMSAL
        $page = new Page();
        $page->title = 'Kalite Politikamız';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = 96;
        $page->background = 96;
        $page->excerpt = '';
        $page->content = '►   Yasal mevzuatlara, ISO 9001 Kalite Yönetim Sistemi standardına ve ilgili diğer şartlara uygun hareket etmek.<br>
        ►   Tüm çalışanlarımızın gerekli bilgilendirme ve eğitimler yardımıyla kendilerini ve işlerini geliştirmelerini sağlamak.<br>
        ►   Sektörümüzün vermiş olduğu bilinçle, günümüz şartlarında her türlü teknolojiyi kullanarak ürün/hizmet kalitemizi yasal mevzuat şartlarına tam uyum sağlayarak sürekli iyileştirmek.<br>
        ►   Kalite düzeyimizi sürekli yükseltmek için tüm çalışanlarımızın fikirlerini alıp, projelerimize katılımlarını sağlamak.<br>
        ►   Müşteri ile iletişimden başlayarak, işin başından sonuna kadar sınırsız müşteri memnuniyetini ve bunun sürekliliğini sağlamak.<br>
        ►   ISO 9001 Kalite Yönetim Sistemi standardından taviz vermeden hedeflerimizin belirlenmesi, gözden geçirilmesi ve sistemin sürekli iyileştirilmesini sağlamak.';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Tarihçe';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = 'SENKRON; 2004 yılında kurulan, yüksek bilgi birikimine ve geniş tecrübeye sahip  bir şirkettir. Demir Çelik tesislerinde fiilen çalışmış 30 personelimizle birlikte Karabük’te 350m² kapalı alana ve 500m² satış mağazasına sahip şirketimiz, yurtiçi ve yurtdışı proje ve imalat faaliyetlerini sürdürmektedir. Firmamız; Başta Demir Çelik, Çimento  ve Kağıt  sanayi olmak üzere Endüstriyel Elektrik Otomasyon alanlarında anahtar teslimi çözümler üretmek, yerli tasarım ve üretimle Endüstride kullanılacak olan Elektronik Cihazların imalatını yapmak hedefi ile kurulmuştur. Başlıca Çalışma Alanlarımız; Demir Çelik sektöründe kullanılmakta olan DC Motor Sürücüleri, Sıcak Metal Sensörleri, Orta Gerilim ve Alçak Gerilim Dağıtım Panoları, Kompanzasyon Panoları imalat ve montajı. Diğer çalışma alanlarımızdan biri de otomasyon sistemleri için komple çözüm üretmektir. Bu otomasyon sistemleri, küçük konvansiyonel kontrollü panolardan, komple bir fabrikanın otomasyonuna kadar değişen bir yelpazeyi kapsamaktadır.
        Senkron kuruluşundan günümüze kadar fabrika ve entegre tesislerde, komple elektrik altyapısı ve PLC-SCADA Kontrollü Otomasyon sistemlerine kadar birçok projeyi başarıyla tamamlamıştır.Şirketimiz 2011 yılında ihracat alanında Türkiye şirketleri arasında 500 içerisinde bulunarak ve Karabük şirketleri arasında ise üçüncülüğü alarak haklı başarısıyla bölge ve Türkiye sanayisinde yerini kanıtlamıştır. Bu çalışmalarımız kapsamında SENKRON ELEKTRİK olarak Endüstriyel Elektrik Otomasyon alanında anahtar teslim çözümlerle her zaman bölge sanayicimizin yanında ve hizmetinde olmaya devam edeceğiz.';
        $page->translate_columns([]);
        $page->save();

        $page = new Page();
        $page->title = 'Misyon ve Vizyon';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '<h4>MİSYONUMUZ, GELECEK</h4>
        Gelecekteki en büyük birikimimizi, biriktirdiğimiz müşteri portföyü ve imza attığımız projelerle oluşturmak ve sonuç odaklı kaliteli hizmet üretmeye devam ederek sektöründe akla ilk gelen markalardan biri olmaktır.<br><br><br>
        <h4>VİZYONUMUZ, KALİTE</h4>
        Her projemizde aynı hizmet kalitesini sağlamak, üstlendiğimiz projeleri söz verdiğimiz gibi zamanında ve sorunsuz olarak teslim etmek, iş ortaklarımıza her zaman ve her koşulda destek olmak için sınırlarımızı aşmaktır.<br><br><br>
        <h4>HEDEF</h4>
        Doğru ürünü, doğru zaman ve doğru fiyatla sunan, kusursuz hizmet veren, satış sonrasnda ilke edindiği koşulsuz müşteri memnuniyeti ve müşterilerinin yaşam tarzını etkileyen, insana ve çevreye saygılı, çalışanına sürekli yatırım yapan, küresel değeri yüksek ve sürdürülebilir büyüme hızına sahip bir şirket olmaktır.';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Belgelerimiz';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '<img style="width: 50%" src="/uploads/default/Belgelerimiz.jpg">
        <img style="width: 50%" src="/uploads/default/Belgelerimiz (2).jpg">';
        $page->translate_columns([]);
        $page->save();

        $page = new Page();
        $page->title = 'Kalite ve İş Güvenliği';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '<b>Kalite, Çevre ve İş Güvenliği</b><br>
        Ürün ve üretim kalitemizi sürekli arttırarak, makine, teçhizat ve personel kaynaklarımızı sürekli geliştirmek ve iş güvenliğini sağlamak SENKRON’un kalite yönetimi anlayışı içerisindedir.
        Bu anlamda;
        İlk Seferde Hatasız Kaliteli, Güvenli Ürünler ve Hizmetler Üretmek
        Uygun Kalite Yönetim Sistemine Tam Uymak
        Kalite Yönetim Sisteminin Sürekli Gelişmesini Sağlamak
        Müşteri ve Çalışanların Taleplerine En Hızlı Şekilde Cevap Vermek
        Müşteri Memnuniyetini Arttırmak Hedeflerimizdir.<br>
        <b>SENKRON Kalite, ve İş Güvenliği hususunda</b><br>
        ISO 9001   Kalite Yönetim Sistemi,
        OHSAS 18001 İş Güvenliği ve Sağlığı Yönetim Sistemi Sertifikalarına sahiptir.';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Referanslar';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = 101;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '<b><h4>İMALAT VE MONTAJINI YAPTIĞIMIZ PROJELER</h4></b><br>
►        500.000 TON/YIL KAPASİELİ KONTINU HADDEHANE ANAHTAR TESLİM ELEKTRİK OTOMASYON İŞLERİ İRAN –TABRİZ<br>
►        700.000 TON /YIL KAPASİTELİ HADDEHANE ANAHTAR TESLİM ELEKTRİK OTOMASYON İŞLERİ İRAN-TAHRAN<br>
►        500.000 TON/YIL KAPASİTELİ HADDEHANE ANAHTAR TESLİM ELEKTRİK OTOMASYON İŞLERİ İRAN-TABRİZ<br>
►        YOLBULAN DEMİR SAN.VE TİC. A.Ş. KARABÜK / DC SÜRÜCÜ PANOLARI İMALATI VE MONTAJI<br>
►        ÇELİKOĞLU  SAN. VE TİC. LTD.ŞTİ. KARABÜK /O.S.B. 50.000TON/YIL LAMA VE ASANSÖR RAYI FABRİKASI PROJESİ İMALAT VE MONTAJI<br>
►        TOSYALI DEMİRÇELİK/CEZAYİR PROJESİ DC SÜRÜCÜ PANOLARININ İMALATI VE MONTAJI<br>
►        IŞIK ÇELİK A.Ş./İMALATIMIZ OLAN SICAK METAL SENSÖRLERİ MONTAJI<br>
►        BAŞARAN HADDECİLİK A.Ş./İMALATIMIZ OLAN SICAK METAL SENSÖRLERİ MONTAJI<br>
►        KARDEMİR A.Ş. KÜTÜK TRANSFER RÖLE SİSTEMİ ELEKTRİK OTOMASYON SİSTEMİ YAZILIMI VE DEVREYE ALMA<br>
►        IŞIK ÇELİK A.Ş DC SÜRÜCÜ PANOLARININ REVİZYONU VE OTOMASYON SİSTEMİNE UYGUN HALE GETİRİLMESİ<br>
►        EFLANİ BELEDİYESİ SU ARITMA TESİSİ ELEKTRİK VE OTOMASYON SİSTEMİ MONTAJ-DEVREYE ALMA<br>
►        DETAŞ KARABÜK HASIR ÇELİK FABRİKASI ELEKTRİK MONTAJ İŞLERİ<br>
►        ASİL ÇELİK A.Ş. 450T PRES REVİZYONU PANO İMALATI MONTAJ VE DEVREYE ALMA<br>
►        ERHALLAR DEMİR ÇELİK START-STOP MAKAS SÜRÜCÜ PANELİ İMALATI OTOMASYON VE DEVREYE ALMA<br>
►        ALTER DEMİR ÇELİK TROLLEY BUSBAR SİSTEMİ MONTAJI<br>
►        KİBAR DIŞ TİCARET A.Ş. STOK HOLÜ TROLLEY BUSBAR SİSTEMİ MONTAJI<br>
►        SERHAT HADDECİLİK STOK HOLÜ BUSBAR VE AYDINLATMA İŞLERİ<br>
►       ESSEL SELÜLOZ KAĞIT A.Ş.  ATIK KAĞIT HAMUR HAZIRLAMA TESİSİ ELEKTRİK MONTAJ İŞLERİ<br><br><br>
         <b><h4>TAMAMLANAN MONTAJ İŞLERİ.</h4></b><br>
►        1.250.000 TON/YIL KAPASİTELİ SÜREKLİ DÖKÜM TESİSİ ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        425.000 TON/YIL KAPASİTELİ KİREÇ FABRİKASI ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        CCM SU TESİSLERİ ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        KOK FABRİKALARI İLERİ SOĞUTMA SİSTEMİ ELEKTRİK MONTAJ İŞLERİ<br>
►        KOK FABRİKALARI YENİ TRAFO MERKEZLERİ ELEKTRİK MONTAJ İŞLERİ<br>
►        RAY PROFİL HADDEHANESİ YUVARLAK IZGARASI ELEKTRİK MONTAJ İŞLERİ<br>
►        ÇELİKHANE BEŞ  NUMARALI KONVERTER ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        KANGAL HADDEHANESİ  ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        4 NOLU HAVA AYRIŞTIRMA TESİSİ ELEKTRİK MONTAJ İŞLERİ<br>
►        ŞALT TESİSİ ELEKTRİK MONTAJ İŞLERİ<br>
►        KÜKÜRT GİDERME TESİSİ ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        GAZ TEMİZLEME TESİSİ ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        KÖPRÜLÜ,  SİNTER ve KOK DAİRESEL  RECLAIMER ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        MADEN ÇUKURU ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        SİNTER MEROS TESİSİ ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        SDM-4 SÜREKLİ DÖKÜM FABRİKASI ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        YÜKSEK FIRIN REVARTMANI VE CEVHER HAZIRLAMA TESİSİ ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        1-2-3 NOLU OKSİJEN FABRİKALARININ OG HATLARININ YENİLENMESİ<br>
►        ÇELİKHANE KONVERTER SUBLANCE SİSTEMİ VE CÜRUF SIYIRMA ELEKTRİK OTOMASYON MONTAJ İŞLERİ<br>
►        KABUK SOYMA – LACİVERT HAT TRAFO MERKEZİ ELEKTRİK MONTAJ İŞLERİ-ASİL ÇELİK A.Ş.<br>';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Ticari Bilgilerimiz';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
        <h2>ŞİRKET BİLGİLERİ</h2>
        <b>SENKRON ELEKTRİK İNŞAAT TAAHHÜT OTOMASYON SANAYİ & TİCARET LİMİTED ŞİRKETİ</b><br><br>
        <div class="row">
            <div class="col-4">
                <b>Vergi Dairesi:</b>
             </div>
             <div class="col-8 d-flex justify-content-start">
                KARABÜK
              </div>
              <div class="col-4 mt-2">
                <b>Vergi Numarası:</b>
             </div>
             <div class="col-8 mt-2 d-flex justify-content-start">
               7610508513
              </div>
              <div class="col-4 mt-2">
                <b>Adres :</b>
             </div>
             <div class="col-8 mt-2 d-flex justify-content-start">
               Merkez: Öğlebeli Mahallesi Fetih Caddesi No: 36 Merkez / KARABÜK Şube:Hürriyet Mahallesi İnönü Caddesi No:21 Merkez/KARABÜK
              </div>
               <div class="col-4 mt-2">
                <b>Merkez:</b>
             </div>
             <div class="col-8 mt-2 d-flex justify-content-start">
              Öğlebeli Mahallesi Fetih Caddesi No: 36  KARABÜK
              </div>
              <div class="col-4 mt-2">
                <b>Şube:</b>
             </div>
             <div class="col-8 mt-2 d-flex justify-content-start">
               Hürriyet Mahallesi İnönü Caddesi No:21 KARABÜK
              </div>
                <div class="col-4 mt-2">
                 <b>Ticari Sicil No:</b>
             </div>
             <div class="col-8 mt-2 d-flex justify-content-start">
                6181
              </div>
                <div class="col-4 mt-2">
                <b>Mersis No:</b>
             </div>
             <div class="col-8 mt-2 d-flex justify-content-start">
              0761050851300017
              </div>
        </div>
        <br>
        <br>
        <br>
        <h1>BANKA HESAPLARI</h1>
        <hr style="background: red"><br><br>
        <h4>HALKBANK</h4>
        <b style="color: red">Tl :</b><b>TR79 0001 2009 4760 0010 2602 63</b><br>
        <b style="color: red">USD  :</b><b>TR53 0001 2009 4760 0053 0002 89</b><br>
        <b style="color: red">EURO  :</b><b>TR04 0001 2009 4760 0058 0000 66</b><br><br><br>

        <h4>KUVEYT TÜRK</h4>
        <b style="color: red">Tl :</b><b>TR54 0020 5000 0079 9470 7000 01</b><br>
        <b style="color: red">USD  :</b><b>TR43 0020 5000 0079 9470 7001 02</b><br>
        <b style="color: red">EURO  :</b><b>TR70 0020 5000 0079 9470 7001 01</b><br><br><br>

        <h4>DENİZBANK</h4>
        <b style="color: red">Tl :</b><b>TR84 0013 4000 0072 2331 8000 01</b><br>
        <b style="color: red">USD  :</b><b>TR50 0013 4000 0072 2331 8000 31</b><br>
        <b style="color: red">EURO  :</b><b>TR57 0013 4000 0072 2331 8000 02</b><br>


        ';
        $page->translate_columns([]);
        $page->save();


        //HİZMETLER

        $page = new Page();
        $page->title = 'Proje ve Taahhüt';
        $page->layout = 'full';
        $page->status = 'published';
        $page->image = null;
        $page->slider_id = 2;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = 'Senkron Elektik Otomasyon anahtar teslimi tesis işleri ve müteahhitlik hizmetleri yapmaktadır. Özellikle Demir Çelik sektöründe anahtar teslimi büyük projelere imza atan firmamız aşağıdaki sektörlerde de paket çözümler oluşturmuştur.<br><br><br>
            <b>►</b>Profil Haddehaneleri<br>

            <b>►</b>Çubuk Haddehaneleri<br>

            <b>►</b>Çelikhaneler<br>

            <b>►</b>Çimento ve Kireç Üretim Tesisleri<br>

            <b>►</b>Tekstil<br>

            <b>►</b>Cam Sanayi<br>';
        $page->translate_columns([]);
        $page->save();

        $page = new Page();
        $page->title = 'Montaj ve Devreye Alma';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 3;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '<b>Montaj ve Devreye Alma Hizmetlerimiz</b><br><br><br>
            <p>Firmamız, farklı sektörlerde yapılan sistem çözümlerine montaj, devreye alma, süpervizörlük hizmetleri vermektedir.AG/OG çözümlerine aşağıda belirtilen hizmetler verilmektedir.</p><br><br>
            <b>►</b>Pano Saha Hizmetleri<br>
            <b>►</b>Sistem Tavalama İşleri<br>
            <b>►</b>Sistem Kablaj Hizmetleri<br>
            <b>►</b>Enstrüman, Sensör, Switch Montajları<br>
            <b>►</b>Yazılım ve Sistem Devreye Alma Hizmetleri<br>
            <b>►</b>Müteahhitlik Hizmetleri<br>';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Projeler';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 4;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '<b>SENKRON ELEKTRİK</b>: kurulduğundan bu yana, endüstriyel otomasyonun her noktasında yer almış; Enerji, Kağıt, Demir Çelik, Çimento, Madencilik vb. birçok sanayi kuruluşunda, spesifik otomasyon projelerini başarı ile gerçekleştirmiştir.';
        $page->translate_columns([]);
        $page->save();

        $page = new Page();
        $page->title = 'Ürün Satışı';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 5;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
                <b>Açık Tip Devre Kesiciler (Şalterler):</b> Ağırlıklı olarak sistem başlarında ana kesici olarak kullanılmakla birlikte yüksek koruma ve
        aksesuar seçeneği talep edilen makine ve/veya lokal dağıtım sistemlerinde de tercih edilen devre kesicilerdir.
        Tüm kesicilerde olduğu gibi temel görevleri termik manyetik koruma yapmaktır.
        Talep edilmesi halinde koruma fonksiyonları bu temel fonksiyonlar üzerine ilave edilebilir.
        Üreticiler farklı akım aralıklarında üretim yapsalar da devre akımını kesme kapasiteleri 630 A ile 6300 A aralığında bir skalada kullanılır.
        Kısa devre kesme kapasiteleri ise ortalama 40 kA ila 130 kA aralığındadır. 3 ve 4 kutuplu, çekmeceli ve çekmecesiz üretimleri bulunmaktadır.
        Mikroişlemci koruma ünitesi genel takibi yaparak ayarlanan set değerleri nispetinde milisaniye mertebesinden başlayarak istenen üst değerdeki bir zaman aralığında açma ve
        kapama yapabilmektedir. Aksesuar montajının oldukça fazla kombin edilebildiği bir devre
        kesicidir. Genel olarak aşırı akım, kısa devre, selektif koruma, toprak kaçağına karşı koruma gibi koruma üniteleri mevcuttur.<br><br>

        <b>Kompakt Tip Devre Kesiciler (Şalterler):</b> Kullanımda genellikle açık tip devre kesicilerin sonrasında hattı besleyen kolların, diğer bir ifade ile lokalize sistemlerin beslemelerinde kullanılırlar. Tüm kesicilerde olduğu gibi temel görevleri termik manyetik koruma yapmaktır. Talep edilmesi halinde koruma fonksiyonları bu temel fonksiyonlar üzerine ilave edilebilir. Termik manyetik şalter olarak da ifade edilirler. Üretim skalaları 16 A ila 3200 A aralığında değişir. Kesme kapasiteleri 16 kA ila 150 kA aralığında değişir. Kullanım alanları ve ürün tipleri açık tip şalterlere göre daha geniştir. 1,2,3,4 kutuplu olarak üretimleri mevcuttur. Sabit tip olarak üretimleri yapılır. İhtiyaç halinde çekmeceli tipe dönüştürülebilir. Koruma üniteleri iki tiptir. Elektronik olmayan ve elektronik koruma ünitelerine sahip olabilir. Açık tip şalterlerde olduğu gibi zengin bir aksesuar montaj olanağına sahiptir. Elektronik koruma ünitelerinde aşırı akım, kısa devre, selektif koruma, toprak kaçağına karşı koruma gibi koruma ünite opsiyonları mevcuttur. Mikroişlemci üzerinden açık tip şalterde olduğu gibi set değerleri girilerek istenilen şekilde sisteme özel hale getirilebilir. Açık tip şalterlere göre avantajı aynı akım ve kesme kapasitelerinde daha kompakt yani minimize boyutlara sahip olmaları ve akım aralığının daha geniş olmasıdır. Bununla birlikte mekanik ömürleri açık tip şalterlere göre daha kısadır ve kısa devre darbelerine karşı daha zayıftır.<br><br>

        <b>Kesiciler ve Ayırıcılar:</b> Herhangi bir korumaya ihtiyaç duyulmayan noktalarda kullanılan, sistemin enerjisini kesen veya kaynak yönünü değiştiren devre elemanlarıdır. Kesiciler koruma üniteleri olmaması sebebi ile makul maliyetlidirler. Akım aralıkları 16 A ila 3200 A aralığındadır. Ayırıcılar ise sistemde transferin yapılacağı noktada veya hat kesildikten sonra sistem güvenliğini sağlayan ekipmanlardır. Akım aralığı 40 A ila 3200 A seviyesindedir.<br><br>

        <b>Toprak Kaçak Akım Koruma Rölesi:</b> Temel görevi sistemde var olan toprak kaçağını tespit edip devreyi kesmektir. Fiziksel olarak görüntüsü otomatik sigortalarla aynı olup farklı montaj şekilleriyle otomatik sigortalar ile kombin edilebilirler. 2 ve 4 kutuplu olarak üretimleri mevcuttur. Otomatik sigortalar ile birlikte kullanılan devre elemanlarıdır. İnsan hayatı ve yangına karşı koruma sağlarlar. Pazarda ağırlıklı olarak 30 mA ve 300 mA değerlerindeki kaçak akım seviyeleri var olmakla birlikte farklı mA seviyelerinde de üretimleri mevcuttur. Selektif sisteme uygundur.<br><br>

        <b>Motor Koruma Şalterleri:</b> Motor devrelerinde motorların korunması için tasarlanmış devre kesicileridir. Termik manyetik koruma yapabildikleri gibi sadece manyetik koruma yapan modelleri de bulunmaktadır. 0,1 A’dan 1600 A aralığına kadar geniş bir ürün yelpazesi vardır. Kesme kapasiteleri oldukça yüksektir. 25 kA ila 150 kA aralığında kısa devre koruması yapabilirler. Açma eğrileri demeraj akımlarını sönümlendirebilmektedir. Sadece motor yol verme devrelerinde kullanılır.<br><br>

        <b>Kontaktörler:</b> Kontaktörlerin temel görevi sistemde anahtarlama yapmaktır. Herhangi bir koruma elemanının görevini yerine getirmez. Çok geniş bir yelpazede kullanımı söz konusudur.

        Kumanda elemanı olarak kullanılmakla birlikte önünde bir koruma ünitesi ile besleme elemanı olarak da kullanılmaktadır. Genel olarak 9 A ila 2500 A’da üretimi söz konusudur. Elektromanyetilk prensiple çalışan ekipmanlardır. Motor devrelerinde sıkça kullanılır.

        <b>Elektronik Röle ve Kontaktörler:</b> Elektronik röle ve kontaktörlerin temel işlevi sistemi sürekli izleyerek görevi olan parametrelerde oluşabilecek değişikliklere karşılık sistemi korumaya almaktır. Bunlar farklı parametreler olduğu gibi aynı röle birden çok parametreyi takip edebilir ve sisteme müdahale edebilir. Bu parametrelere gerilim, akım, faz, frekans vb. parametreler örnek olarak verilebilir. Sistemde her zaman yardımcı eleman olarak bulunurlar. Güç devrelerinde kullanılmazlar. Kumanda devre elemanlarıdır.<br><br>

        <b>Buton ve Sinyal Grupları:</b> Sistemdeki temel görevleri kumanda sisteminin işleyişi sırasında oparatörün bilgi sahibi olması, sistemi başlatması, durdurması gibi müdahalelerde bulunması ile birlikte kumanda sisteminin yönetilmesine olanak sağlayan devre elemanlarıdır. Farklı renklerde ve IP koruma seviyelerinde çok geniş bir yelpazede üretimleri ve kullanım alanları mevcuttur.
        ';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Demir Çelik';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 6;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
        SENKRON  Demir Çelik tesisleri için anahtar teslimi elektrik ve otomasyon sistemlerinin tasarım ve tedarikinin yanı sıra mevcut tesislerin modernizasyonu için çözümler sunmaktadır.
        SENKRON çelikhane ve haddehane işletmeleri için gereken tüm orta gerilim ve alçak gerilim elektrik sistemleri ile otomasyon sistemlerinin tasarım , tedarik , imalat , montaj , devreye alma ve satış sonrası hizmetlerini kapsayan geniş bir hizmet portföyüne sahiptir.<br><br><br>

        <h4>Çelikhane ve Haddehane Elektrik ve Otomasyon Uygulamaları</h4><br>
        SENKRON  demir çelik tesisleri için sunduğu hizmetler aşağıdaki tesisleri kapsamakta olup çok sayıda uygulama gerçekleştirilmiştir :<br>
        Toz Toplama Tesisleri (Orta Gerilim Hücreleri, Trafolar, Sürücü Panoları, PLC Panoları ve Yazılımı)
        Sürekli Döküm Makineleri (MCC Panoları, PLC Panoları, Elektromanyetik Karıştırıcı Sistemleri, Otomasyon Yazılımı)
        Su Tesisleri (MCC Panoları, PLC Panoları, Sürücü Panoları, Otomasyon Yazılımı)
        Ray, Profil ve Çubuk Haddehaneleri (MCC Panoları, PLC Panoları, Sürücü Panoları, Otomasyon Yazılımı)
        Saha İşçiliği ve Devreye Alma
        ';
        $page->translate_columns([]);
        $page->save();

        $page = new Page();
        $page->title = 'Çimento';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 7;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
        Çimento sanayi inşaat sektörünün temel taşlarından biri olup ağır sanayi sınıfında yer almaktadır.Bununla birlikte Senkron Çimento Sektörü için anahtar teslim elektrifikasyon işleri yapmaktadır.Çimento üretim proseslerinde komple MCC & PLC Panoların imalatı, Otomasyon HMI ve Scada yazılımları ile tüm enstrümantasyon işlerinide üstlenmektedir.Proses aşamasında kullanılacak her türlü enstrümanlar (Debimetreler, Sıcaklık, Basınç&Fark  Basınç Transmitterleri ve Seviye sensörleri) tarafımızdan otomasyon sistemine entegre edilmektedir.Bu aşamada tüm saha işleri (elektriksel montajlar, kablaj, tavalama gibi) yapılarak ve sistem devreye alınarak anahtar teslimi olarak yapılmaktadır.
        Enerji Ana Dağıtım Panoları
        MCC ve Kumanda Panoları, Softstarter ve Hız Kontrol Panoları
        PLC Panoları
        Enstrümantasyon
        OG Hücre imalatları, OG Kompanzasyon sistemleri
        Proses Otomasyon yazılımı (WinCC  Skada yazılımı, PLC yazılımı)
        Saha desteği (Tavalama, Kablaj, Montaj, devreye alma hizmetleri)
        ';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Kağıt';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 8;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
       SENKRON; bu proseslerde anahtar teslimi elektrik ve otomasyon sistemleri ile MCC, PLC, Dağıtım panoları, imalat, montaj ve devreye alma hizmetleri sunmaktadır.
        ';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Arıtma';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 9;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
       <b>Atıksu Proseslerinde</b><br><br>
       <ul>
       <li>
        Ön ve son çökeltme Sistemleri Elektrifikasyonu,
        </li>
        <li>
        Havalandırma ve Blower Otomasyonu
        </li>
        <li>
        Pompa İstasyonları , Çamur Susuzlaştırma Prosesleri ve Kontrol Sistemleri
        </li>
        <li>
        Çamur yoğunlaştıma Sistemleri
        </li>
        <li>
        Vana Kontrol ve havalandırmalı kum ve yağ tutucu Sistemleri Otomasyonu,
        </li>
        <li>
        Tüm gerekli enstrümanların (Debimetreler, Sıcaklık , Basınç ve Seviye Sensörlerinin temini, montajı ve  Sistem Entegrasyon Otomasyonu
        </li>
        <li>
        Fülakulasyon Havuzu ve Temiz Su terfi istasyon sistemleri Prosesleri için her türlü elektrifikasyon işleri yapılmaktadır
        </li>
        <li>
        MCC Panoları, Hız Kontrol ve Softstarter Panoları
        </li>
        <li>
        Kumanda ve PLC Panoları
        </li>
        <li>
        Scada Sistemleri , Otomasyon yazılımları, devreye alma hizmetleri
        </li>
        <li>
        Saha faaliyetleri (Kablaj, Montaj, Tavalama işleri  ve Servis hizmetleri)
        </li>

</ul>
        ';
        $page->translate_columns([]);
        $page->save();


        $page = new Page();
        $page->title = 'Teknik Dökümanlar';
        $page->layout = 'full';
        $page->status = 'published';
        $page->slider_id = 10;
        $page->image = null;
        $page->background = 100;
        $page->excerpt = '';
        $page->content = '
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar.pdf" target="_blank">Alüminyum Baralarda Sürekli Yüklenme Akımları.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar1.pdf" target="_blank">Bakır Baralarda Sürekli Yüklenme Akımları.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar2.pdf" target="_blank">Kompanzasyonda Kullanılacak Malzemenin Seçim Cetveli.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar3.pdf" target="_blank">3 Fazlı Motorlarda Sigorta Seçimi.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar4.pdf" target="_blank">Kompanzasyon Takip Çizelgesi.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar5.pdf" target="_blank">Elektrik Kazalarının Meydana Gelmesi.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar6.pdf" target="_blank">Elektrik Panoları.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar7.pdf" target="_blank">Trafo Gücüne Göre Devre Kesici Seçimi.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar8.pdf" target="_blank">Trafoların AG. Sigorta, Ana Kablo ve Ölçü Karakteristikleri.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar9.pdf" target="_blank">Arzu Edilen cosØ ye Yükseltmek İçin k Faktörü Cetveli.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar10.pdf" target="_blank">Hermetik Tip Trafo.pdf</a><br><br>
            <a class="text-danger" href="/uploads/file/Teknik Dökümanlar11.pdf" target="_blank">Topraklama Direnci Hesabı.pdf</a><br><br>
        ';
        $page->translate_columns([]);
        $page->save();
    }

}
