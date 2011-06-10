<?php 
if(file_exists("./../../work/config/parameter.php")){
    @include("./../../work/config/parameter.php");
}
@include("./../../inc/functions_global.php");
@include("./../../language/".$config["language"]."/lang.php");
@include("./../../language/".$config["language"]."/lang_help.php");
echo MSDHeader(2);
echo headline($lang['credits']);
?>
<div id="content">
<h3>Bu Proje hakkında</h3>
Bu projenin kurucusu Daniel Schlichtholz'dur.<p>2004 yılında <a href="http://www.mysqldumper.de/board" target="_blank">MySQLDumper panosunu </a>kurdu,
kısa bir süre sonra başkaları tarafından destek gördü ve birçok kişinin katılımları ile yazılım genişletilmeye başlandı. <p>istekleriniz veya önerileriniz için <a href="http://www.mysqldumper.de/board" target="_blank">MySQLDumper-Panosuna</a> katılabilirsiniz.<p>
<br><p><h4>MySQLDumper-Ekibi</h4>

<table><tr><td><img src="../../images/logo.gif" alt="MySQLDumper" width="160" height="42" border="1"></td><td valign="top">
Daniel Schlichtholz - Steffen Kamper<br>
Perlscript: Detlev Richter'in desteği ile<br>
</td></tr></table>
<br>

<h3>MySQLDumper Yardım</h3>


<h4>indirme</h4>
Bu yazılımı MySQLDumper Sitesinden temin edebilirsiniz.<br>
Güncellemeler ve destek için Sitemizi sık sık takip etmenizi tavsiye ederiz.<br>
Site adresi: <a href="http://www.mysqldumper.de" target="_blank">
http://www.mysqldumper.de</a>

<h4>Sistem gerekçeleri</h4>
Mysqldumper her sunucuda çalışır (Windows, Linux, ...) <br>
PHP sürümü >=  4.3.4 GZip-destekli, MySQL (3.23 sürümünden itibaren), JavaScript (aktiv olmak zorunda).

<a href="../../install.php?language=de" target="_top"><h4>Kurulum</h4></a>
Kurulumu çok basittir.
Sıkıştırılmış dosyayı herhangi bir klasör içerisinde açınız.<br>
Açılann dosyaları FTP ile Sunucunuza yükleyiniz. (Örneğin root [sizindomain/]MySQLDumper)<br>
... bitti!<br>
Artık MySQLDumper'i tarayıcınız ile "http://sizindomain/MySQLDumper" adresini girerek açabilirsiniz,<br>
kurulumu tamamlamak için saadece Sistemin sorularını cevaplamanız yeterlidir.<br>
<br><b>ÖNEMLİ:</b><br><i>Sunucunuzda Safemode açık ise, yazılımın klasör oluşturma imkanı yoktur.<br>
Gerekli klasörleri kendiniz oluşturmanız gerekir, MySqlDumper'in çalışabilmesi için belli bir düzende klasörlerin bulunması gerekir.<br>
Bu durumda yazılım kurulumu hata belirterek durduracaktır!<br>
Verilen hataya göre klasörleri oluşturduğunuz taktirde yazılımınız normal bir şekilde işlev görecektir.</i>

<a name="perl"></a><h4>Perlskript kullanımı</h4>
Sunucuların birçoğu Perl Scripleri destekler. <br>
Bu scriptlerin belli bir klasör içerisinde bulunması gerekebilir, klasörün adresi genellikle http://sizindomain/cgi-bin/ dir.
<br>
<br>
Bu durumda yapılması gereken işlemler:<br><br>

1. MySQLDumper'i açtıktan sonra Yedekleme sayfasını açınız ve "Yedekleme Perl" tuşunu tıklayınız. <br>
2. Crondump.pl de kayitli adres absolute_path_of_configdir: in arkasında bulunan kayıdı kopyalayınız. <br>
3. "crondump.pl" Editör ile açınız.<br>
4. Kopyaladığınız adresi absolute_path_of_configdir´in arkasına yapıştırınız (boşluk bırakılmayacak).<br>
5. Crondump.pl i kapatarak kayıt ediniz.<br>
6. Crondump.pl, perltest.pl ve simpletest.pl dosyalarını cgi-bin-klasörüne kopyalayınız (FTP ile Ascii-Modüsünde).<br>
7. Dosyaların haklarını 755 olarak belirleyiniz (CHMOD). <br>
7b. Dosyabitimi cgi olması gerekiyorsa her 3 dosyanın adının değiştiriniz  pl -> cgi. <br>
8. Ayar Merkez, sayfasını açınız.<br>
9. Cronscript e tıklayınız. <br>
10. Perl veriyolunu /cgi-bin/ şeklinde değiştiriniz.<br>
10b. Kullanılan dosyabitimi  seçiniz.<br>
11. Ayarları kayıt ediniz. <br><br>

Ayarlar tamamlanmıştır, Scriptleri yedekleme sayfasından çalıştırabilirsiniz.<br><br>

Perli her klasörden çalıştırma yetkiniz bulunuyorsa:<br><br>

1. MySQLDumper'i açtıktan sonra Yedekleme sayfasını açınız ve "Yedekleme Perl" tuşunu tıklayınız. <br>
2. Crondump.pl de kayitli adres absolute_path_of_configdir: in arkasında bulunan kayıdı kopyalayınız. <br>
3. "crondump.pl" Editör ile açınız. <br>
4. Kopyaladığınız adresi absolute_path_of_configdir´in arkasına yapıştırınız (boşluk bırakılmayacak).<br>
5. Crondump.pl i kapatarak kayıt ediniz.<br>
6. Dosyaların haklarını 755 olarak belirleyiniz (CHMOD). <br>
6b. Dosyabitimi cgi olması gerekiyorsa her 3 dosyanın adının değiştiriniz  pl -> cgi. <br>
(Gerekirse yukarıdaki 10b+11 ci adımları da uygulayınız)<br>
<br>

Windows kullanıcılarının Scriptlerin ilk satırında /cgi-bin/ veriyolunu değiştirmeleri gerekir:<br>
#!/usr/bin/perl -w yerine <br>
#!C:\perl\bin\perl.exe -w yazılacak<br>

<h4>Kullanım</h4><ul>

<h6>Menü</h6>
ışlenecek Veritabanını burada seçeceksiniz.<br>
Bütün işlemler burada beelirlenmiş olan Veritabanına uygulanır.

<h6>Ana Sayfa</h6>
Burada kullandığınız sistem hakkında bilgiler bulabilirsiniz, yüklenmiş
sürümler, Veritabanıları vs..<br>
Veritabnı ismine tıklandığında tabloların listesine ulaşılabilir.
Kayıtsayısı ebat ve son güncelleme bilgilerini burada bulabilirsiniz.

<h6>Ayar Merkezi</h6>
Sistem ayarlarını burada belirleyebilir, yedeklemeden geri dönüştürebilir veya sıfırlayabilirsiniz.
<ul><br>
    <li><a name="conf1"></a><strong>Veritabanları:</strong> Veritabanları Listesi. Aktiv olan Veritabanı <b>kalın</b> yazılmıştır. </li>
    <li><a name="conf2"></a><strong>Tablo ön eki:</strong> Burada belirleyeceğiniz filtre tedeklenecek tablolarda uygulanacaktır
    	 (örneğin: "phpBB_" ile başlayan tablolar). Veritabanının bütün tablolarını yedeklemek istiyorsanın burasını boş bırakınız.</li>
    <li><a name="conf3"></a><strong>Sıkıştırma:</strong> Sıkıştırmayı burada açabilirsiniz. Sıkıştırmayı kullanmanızı tavsiye ederiz.</li>
    <li><a name="conf5"></a><strong>Yedekleme ekli Mail:</strong> Bu Opsyon kullanıldığında, işlemin sonunda gönderilecek mail'e yedekleme dosyası eklenecektir. Sıkıştırmanın aktiv olmasını öneririz !).</li>
    <li><a name="conf6"></a><strong>Email-Adresi:</strong> Mailin ulaştırılacağı adres.</li>
    <li><a name="conf7"></a><strong>Email göndericisi:</strong> gönderilecek mailin kimin adına gönderildiği.</li>
    <li><a name="conf13"></a><strong>FTP-Transferi: </strong>Bu Opsyon kullanıldığında, işlem sonunda yedekleme dosyası FTP ile gönderilir.</li>
    <li><a name="conf14"></a><strong>FTP Sunucusu: </strong>Die FTP sunucusunun adresş (örneğin: ftp.mybackups.de).</li>
    <li><a name="conf15"></a><strong>FTP Sunucu Portu: </strong>FTP-Sunucusunun Portu (Genelde 21).</li>
    <li><a name="conf16"></a><strong>FTP Kulanıcısı: </strong>FTP-kullanıcısının adı. </li>
    <li><a name="conf17"></a><strong>FTP şifresi: </strong>FTP-kullanıcısının  şifresi. </li>
    <li><a name="conf18"></a><strong>FTP yükleme klasörü: </strong>Yedekleme dosyasının yükleneceği klasörün adı. (UYARI: CHMOD ayarlarını göz önünde bulundurunuz).</li>
    <li><a name="conf8"></a><strong>Otomatik dosya silme:</strong> Bu Opsyon kullanıldığında, belirlenecek kurallara göre yedekleme dosyaları silinecektir.</li>
    <li><a name="conf9"></a><strong>Dosya tarihine göre (Gün olarak):</strong> 0 dan büyük bir değer, gün olarak bu değeri aşan yedeklemeleri silecektir.</li>
    <li><a name="conf10"></a><strong>Dosya sayısı:</strong> 0 dan büyük bir değer, bu değeri aşan dosya sayısından fazla olan dosyaları silecektir.</li>
    <li><a name="conf11"></a><strong>Dil:</strong> MySQL Dumperin kullanacağı dili burada belirlersiniz.</li>
    <li><a name="conf12"></a><strong>Cronjob zamandilimi:</strong> Saniye olarak belirlenecek değer, Cronjob için geçerli olan süreyi (eğer yetkiniz varsa) yükseltmeğe değer.</li>
</ul>

<h6>Dosya yönetimi</h6>
Dosya işlemleri burada yapılır
Yedekleme Klasörünüzde bulunan dosyalar listelenir.<br>
işlemlerin uygulanabilmesi için bir dosyanın seçilmiş olması gerekiyor.
<UL>
    <li><strong>Restore:</strong> Burada veritabanı, seçilmiş dosya ile dönüştürülür.</li>
    <li><strong>Delete:</strong> Seçilmiş yedekleme dosyaları silinir.</li>
    <li><strong>Yeni Yedekleme başlat:</strong> Ayarlarda belirlenmiş şartlarla yeni bir yedekleme oluşturulur.</li>
</UL>

<h6>Protokoller</h6>
BUrada protokol dosyalarını görebilir veya silebilirsiniz.
<h6>Künye / Yardım</h6>
bu Sayfa.
</ul>
<h3>Sponsorlarımız</h3>
Sponsorlarımızı <a class="ul" href="http://www.mysqldumper.de/de/index.php?m=7" target="_blank">burada bulabilirsiniz</a><br>
<?php echo MSDFooter();?>