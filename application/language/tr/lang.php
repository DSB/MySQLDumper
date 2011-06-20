<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package       MySQLDumper
 * @subpackage    Language
 * @version       $Rev$
 * @author        $Author$
 */
$lang=array();
$lang['L_ACTION']="İşlem";
$lang['L_ACTIVATED']="etkin";
$lang['L_ACTUALLY_INSERTED_RECORDS']="Şimdiye kadar <b>%s</b> kayıt"
    ." başarılı olarak işlendi.";
$lang['L_ACTUALLY_INSERTED_RECORDS_OF']="Şimdiye kadar <b>%s</b> / <b>%s</b>"
    ." kayıt işlendi.";
$lang['L_ADD']="Add";
$lang['L_ADDED']="eklendi";
$lang['L_ADD_DB_MANUALLY']="Veritabanını elden ekle";
$lang['L_ADD_RECIPIENT']="Add recipient";
$lang['L_ALL']="hepsi";
$lang['L_ANALYZE']="Analyze";
$lang['L_ANALYZING_TABLE']="<br />İşlenen tablo '<b>%s</b>'"
    ." kayıtlar işleniyor.<br /><br />";
$lang['L_ASKDBCOPY']="`%s` ın içeriği `%s` veritabanına"
    ." kopyalansınmı?";
$lang['L_ASKDBDELETE']="`%s` Veritabınını içeriği ile"
    ." birlikte silmek istiyormusun?";
$lang['L_ASKDBEMPTY']="`%s` Veritabanının gerçekten"
    ." boşaltılsınmı?";
$lang['L_ASKDELETEFIELD']="Hücre silinsinmi?";
$lang['L_ASKDELETERECORD']="Kayıt silinsinmi?";
$lang['L_ASKDELETETABLE']="`%s` Tablo silinsinmi?";
$lang['L_ASKTABLEEMPTY']="`%s` Tablo boşaltılsın mı?";
$lang['L_ASKTABLEEMPTYKEYS']="`%s` Tablosu boşaltılıp indexler"
    ." silinsinmi?";
$lang['L_ATTACHED_AS_FILE']="attached as file";
$lang['L_ATTACH_BACKUP']="Yedekleme dosyasını ekle";
$lang['L_AUTHENTICATE']="Login information";
$lang['L_AUTHORIZE']="Authorize";
$lang['L_AUTODELETE']="Otomatik yedekleme silinmesi";
$lang['L_BACK']="geri";
$lang['L_BACKUPFILESANZAHL']="Yedekleme klasöründe bulunan"
    ." dosyalar:";
$lang['L_BACKUPS']="Yedeklemeler";
$lang['L_BACKUP_DBS']="yedeklenecek veritabanları";
$lang['L_BACKUP_TABLE_DONE']="Dumping of table `%s` finished. %s"
    ." records have been saved.";
$lang['L_BACK_TO_OVERVIEW']="Veritabanı listesi";
$lang['L_CALL']="Call";
$lang['L_CANCEL']="İptal";
$lang['L_CANT_CREATE_DIR']="gerekli olan '%s' Klasörü"
    ." oluşturulamadı. Lütfen FTP"
    ." Programınız ile yaratın.";
$lang['L_CHANGE']="değiştir";
$lang['L_CHANGEDIR']="Gidilecek klasör:";
$lang['L_CHANGEDIRERROR']="Klasör değiştirilemedi!";
$lang['L_CHARSET']="Dil Kodlaması";
$lang['L_CHARSETS']="Character Sets";
$lang['L_CHECK']="Kontrolü";
$lang['L_CHECK_DIRS']="Kontrol ediliyor";
$lang['L_CHOOSE_CHARSET']="Maalesef veritabanı yedeğinin hangi"
    ." karakter seti ile kodlandığını"
    ." otomatik olarak bulunmadı<br />Hangi"
    ." karakter setini kullandıysanız onu"
    ." seçip elle vermeniz gerekiyor.Daha"
    ." sonra MYSQLDumper veritabanı serveri"
    ." ile irtibata gecip yedeği yüklemeye"
    ." başlıyacaktır.<br />Eğer yedek"
    ." yüklendikten sonra karakter sorunu"
    ." devam ediyorsa başka bir karakter"
    ." seti seçip tekrar denemeniz"
    ." gerekiyor.<br /> Bol şans ;)";
$lang['L_CHOOSE_DB']="Veritabanı seçimi";
$lang['L_CLEAR_DATABASE']="Veritabanını  boşalt";
$lang['L_CLOSE']="kapat";
$lang['L_COLLATION']="Sıralama";
$lang['L_COMMAND']="Komut";
$lang['L_COMMAND_AFTER_BACKUP']="Yedekden sonraki komut";
$lang['L_COMMAND_BEFORE_BACKUP']="Yedekten önceki komut";
$lang['L_COMMENT']="Yorum";
$lang['L_COMPRESSED']="Sıkıştırılmış (gz)";
$lang['L_CONFBASIC']="Asıl Ayarları";
$lang['L_CONFIG']="Ayar Merkezi";
$lang['L_CONFIGFILE']="Ayar dosyası";
$lang['L_CONFIGFILES']="Ayar dosyaları";
$lang['L_CONFIGURATIONS']="Ayarlar";
$lang['L_CONFIG_AUTODELETE']="Otomatik silme";
$lang['L_CONFIG_CRONPERL']="Perlscript'in Crondump ayarları";
$lang['L_CONFIG_EMAIL']="Email-bildirisi";
$lang['L_CONFIG_FTP']="Yedekleme dosyasının FTP Transferi";
$lang['L_CONFIG_HEADLINE']="Ayar Merkezi";
$lang['L_CONFIG_INTERFACE']="Arayüzü";
$lang['L_CONFIG_LOADED']="Ayarlar \"%s\" başarı ile yüklendi";
$lang['L_CONFIRM_CONFIGFILE_DELETE']="Ayar dosyası %s gerçekten silinsin"
    ." mi ?";
$lang['L_CONFIRM_DELETE_FILE']="Should the file '%s' really be"
    ." deleted?";
$lang['L_CONFIRM_DELETE_TABLES']="Really delete the selected tables?";
$lang['L_CONFIRM_DROP_DATABASES']="Should the selected databases really"
    ." be deleted?<br /><br />Attention: all"
    ." data will be deleted! Maybe you should"
    ." create a backup first.";
$lang['L_CONFIRM_RECIPIENT_DELETE']="Should the recipient \"%s\" really be"
    ." deleted?";
$lang['L_CONFIRM_TRUNCATE_DATABASES']="Should all tables of the selected"
    ." databases really be deleted?<br /><br"
    ." />Attention: all data will be deleted!"
    ." Maybe you want to create a backup"
    ." first.";
$lang['L_CONFIRM_TRUNCATE_TABLES']="Really empty the selected tables?";
$lang['L_CONNECT']="Bağlantı kur";
$lang['L_CONNECTIONPARS']="Bağlantı parametreleri";
$lang['L_CONNECTTOMYSQL']="MySQL ile bağlan";
$lang['L_CONTINUE_MULTIPART_RESTORE']="Continue Multipart-Restore with next"
    ." file '%s'.";
$lang['L_CONVERTED_FILES']="Converted Files";
$lang['L_CONVERTER']="Yedekleme dönüştürücüsü";
$lang['L_CONVERTING']="Dönüştürüm";
$lang['L_CONVERT_FILE']="dönüştürülecek dosya";
$lang['L_CONVERT_FILENAME']="Yeni dosya adı (uzantısız)";
$lang['L_CONVERT_FILEREAD']="Dosya '%s' okunuyor";
$lang['L_CONVERT_FINISHED']="Dönüştürme tamamlandı, '%s'"
    ." oluşturuldu.";
$lang['L_CONVERT_START']="Çeviriyi başlat";
$lang['L_CONVERT_TITLE']="MSD-Formatına çevir";
$lang['L_CONVERT_WRONG_PARAMETERS']="Yanlış Parametre! Çeviri mümkün"
    ." değil.";
$lang['L_CREATE']="oluştur";
$lang['L_CREATED']="Created";
$lang['L_CREATEDIRS']="Klasörler oluşturuluyor";
$lang['L_CREATE_AUTOINDEX']="Auto-Index oluştur";
$lang['L_CREATE_CONFIGFILE']="Yeni ayar dosyası oluştur";
$lang['L_CREATE_DATABASE']="Yeni Veritabanı oluştur";
$lang['L_CREATE_TABLE_SAVED']="Definition of table `%s` saved.";
$lang['L_CREDITS']="Künye/Yardım";
$lang['L_CRONSCRIPT']="Cronscript";
$lang['L_CRON_COMMENT']="Not ekle";
$lang['L_CRON_COMPLETELOG']="Çıktıları tamamen raporla";
$lang['L_CRON_EXECPATH']="Perlskript'in veriyolu";
$lang['L_CRON_EXTENDER']="Dosya adı uzantısı";
$lang['L_CRON_PRINTOUT']="Yazı çıktısı";
$lang['L_CSVOPTIONS']="CSV Seçenekleri";
$lang['L_CSV_EOL']="Satırları ayıran";
$lang['L_CSV_ERRORCREATETABLE']="`%s` Tablo oluşturmada hata oluştu!";
$lang['L_CSV_FIELDCOUNT_NOMATCH']="Tablo kayıtlarının sayısı,"
    ." dışalım edilecek bilgilerle"
    ." uyuşmuyor (%d yerine %d).";
$lang['L_CSV_FIELDSENCLOSED']="Hücreleri kapsayan";
$lang['L_CSV_FIELDSEPERATE']="Hücreleri ayırmak için";
$lang['L_CSV_FIELDSESCAPE']="Hücrelerin kaçış harfi";
$lang['L_CSV_FIELDSLINES']="%d hücre tespit edildi, toplam %d"
    ." satır";
$lang['L_CSV_FILEOPEN']="CSV-Dosyasını aç";
$lang['L_CSV_NAMEFIRSTLINE']="Sütun isimlerini ilk satıra yaz";
$lang['L_CSV_NODATA']="Dışalım edilebilecek kayıt"
    ." bulunamadı!";
$lang['L_CSV_NULL']="NULL un yerine kullanılacak";
$lang['L_DATABASES_OF_USER']="Databases of user";
$lang['L_DATABASE_CREATED_FAILED']="The database wasn't created.<br"
    ." />MySQL returns:<br/><br />%s";
$lang['L_DATABASE_CREATED_SUCCESS']="The database '%s' has been created"
    ." successfully.";
$lang['L_DATASIZE']="Veri boyutu";
$lang['L_DATASIZE_INFO']="This is the size of the records - not"
    ." the size of the backup file";
$lang['L_DAY']="Day";
$lang['L_DAYS']="Days";
$lang['L_DB']="Veritabanı";
$lang['L_DBCONNECTION']="Bağlantı Parametreleri";
$lang['L_DBPARAMETER']="Veritabanı-Parametreleri";
$lang['L_DBS']="Veritabanları";
$lang['L_DB_ADAPTER']="DB-Adapter";
$lang['L_DB_BACKUPPARS']="Veritabanları yedekleme ayarları";
$lang['L_DB_DEFAULT']="Default database";
$lang['L_DB_HOST']="Veritabanı sunucusunun adı";
$lang['L_DB_IN_LIST']="'%s' Veritabanı eklenemedi, cünkü"
    ." mevcut.";
$lang['L_DB_NAME']="Veritabanının ismi";
$lang['L_DB_PASS']="Veritabanı şifresi";
$lang['L_DB_SELECT_ERROR']="<br />Hata:<br />Veritabanı seçimi"
    ." '<b>";
$lang['L_DB_SELECT_ERROR2']="</b>' Hata oluştu!";
$lang['L_DB_USER']="Veritabanı kullanıcısı";
$lang['L_DEFAULT_CHARACTER_SET_NAME']="Default character set";
$lang['L_DEFAULT_CHARSET']="standart karakter seti";
$lang['L_DEFAULT_COLLATION_NAME']="Default collation";
$lang['L_DELETE']="Silme";
$lang['L_DELETE_DATABASE']="Veritabanını sil";
$lang['L_DELETE_FILE_ERROR']="Dosya \"%s\" silinemedi!";
$lang['L_DELETE_FILE_SUCCESS']="Dosya \"%s\" başarıyla silindi.";
$lang['L_DELETE_HTACCESS']="Klasör koruması kaldırılsın"
    ." (.htaccess silinecek)";
$lang['L_DESCRIPTION']="Description";
$lang['L_DESELECT_ALL']="hepsini kaldır";
$lang['L_DIR']="Klasör";
$lang['L_DISABLEDFUNCTIONS']="İptal edilmiş fonksiyonlar";
$lang['L_DO']="çalıştır";
$lang['L_DOCRONBUTTON']="Perl-Cronscript'i çalıştır";
$lang['L_DONE']="Tamamlandı!";
$lang['L_DONT_ATTACH_BACKUP']="Yedeği eklemeyin";
$lang['L_DOPERLTEST']="Perl-Modülerini denetle";
$lang['L_DOSIMPLETEST']="Perli denetle";
$lang['L_DOWNLOAD_FILE']="Dosya indir";
$lang['L_DO_NOW']="şimdi çalıştır";
$lang['L_DUMP']="Yedekleme";
$lang['L_DUMP_ENDERGEBNIS']="<b>%s</b> tabloda <b>%s</b> kayıt"
    ." yedeklendi.<br />";
$lang['L_DUMP_FILENAME']="Yedeklenen dosyanın ismi";
$lang['L_DUMP_HEADLINE']="yedekleme oluşturuluyor...";
$lang['L_DUMP_NOTABLES']="`%s` Veritabanında tablo bulunamadı.";
$lang['L_DUMP_OF_DB_FINISHED']="Dumping of database `%s` done";
$lang['L_DURATION']="Duration";
$lang['L_EDIT']="düzenle";
$lang['L_EHRESTORE_CONTINUE']="devam et ve hatasları raporuna ekle";
$lang['L_EHRESTORE_STOP']="Durdur";
$lang['L_EMAIL']="E-mail";
$lang['L_EMAILBODY_ATTACH']="Ekte veritabanıyın yedeklemesi"
    ." bulunuyor.<br />yedeklenen Veritabanı"
    ." `%s`<br /><br /><br />Oluşturulan"
    ." dosya:<br /><br />%s <br /><br"
    ." />Sevgilerler<br /><br"
    ." />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>";
$lang['L_EMAILBODY_FOOTER']="<br /><br /><br />Sevgiler<br /><br"
    ." />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>";
$lang['L_EMAILBODY_MP_ATTACH']="Çok parçalı yedekleme"
    ." oluşturuldu.<br />Dosyalar eklenti"
    ." olarak gönderilmiyor!Dosyalar ayrı"
    ." bir mail ile gönderiliyor!<br"
    ." />Yedeklenen Veritabanı `%s`<br /><br"
    ." /><br />oluşturulan dosyalar:<br"
    ." /><br />%s<br /><br /><br"
    ." />Sevgilerle<br /><br />MySQLDumper<br"
    ." /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>";
$lang['L_EMAILBODY_MP_NOATTACH']="Çok parçalı yedekleme"
    ." oluşturuldu.<br /> Dosyalar eklenti"
    ." olarak gönderilmiyor!<br />yedeklenen"
    ." Veritabanı `%s`<br /><br /><br"
    ." />oluşturulan dosyalar:<br /><br"
    ." />%s<br /><br /><br />Sevgilerle<br"
    ." /><br />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>";
$lang['L_EMAILBODY_NOATTACH']="Yedekleme dosyaları maalesef"
    ." eklenememiştir.<br />yedeklenen"
    ." Veritabanı `%s`<br /><br /><br"
    ." />Oluşturulan Dosyalar:<br /><br"
    ." />%s<br /><br /><br />Sevgilerle<br"
    ." /><br />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>";
$lang['L_EMAILBODY_TOOBIG']="Yedekleme boyutu maximumu boyut olan"
    ." %s aştıgından dolayı eklenti"
    ." olarak gönderilemiyor.<br"
    ." />Yedeklenen Veritabanı `%s`<br /><br"
    ." /><br />oluşturulan dosyalar:<br"
    ." /><br />%s<br /><br /><br"
    ." />Saygılarla<br /><br"
    ." />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>";
$lang['L_EMAIL_ADDRESS']="E-Mail-Address";
$lang['L_EMAIL_CC']="CC-Alıcı";
$lang['L_EMAIL_MAXSIZE']="Eklenen dosyanın en yüksek boyutu";
$lang['L_EMAIL_ONLY_ATTACHMENT']="... sadece eklentiler";
$lang['L_EMAIL_RECIPIENT']="Email-Adresi";
$lang['L_EMAIL_SENDER']="Mail gönderenin adı";
$lang['L_EMAIL_START']="Starting to send e-mail";
$lang['L_EMAIL_WAS_SEND']="Email başarıyla gönderildi."
    ." Alıcı:";
$lang['L_EMPTY']="Içeriği boşalt";
$lang['L_EMPTYKEYS']="Boşaltıp indexleri silme";
$lang['L_EMPTYTABLEBEFORE']="Tabloyu önce boşalt";
$lang['L_EMPTY_DB_BEFORE_RESTORE']="Veritabanını dönüştürmeden sil";
$lang['L_ENCODING']="kodlama";
$lang['L_ENCRYPTION_TYPE']="Kodlama türü";
$lang['L_ENGINE']="Engine";
$lang['L_ENTER_DB_INFO']="First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.";
$lang['L_ENTRY']="Kayıt";
$lang['L_ERROR']="Hata";
$lang['L_ERRORHANDLING_RESTORE']="Dönüşümde oluşan hataların"
    ." nasıl işleneceği";
$lang['L_ERROR_CONFIGFILE_NAME']="Dosya ismi \"%s\" izin verilmeyen"
    ." karakter içeriyor";
$lang['L_ERROR_DELETING_CONFIGFILE']="Hata oluştu: Ayar dosyası %s"
    ." silinemedi";
$lang['L_ERROR_LOADING_CONFIGFILE']="Ayar dosyası \"%s\" yüklenemedi";
$lang['L_ERROR_LOG']="Hata-Log'u";
$lang['L_ERROR_MULTIPART_RESTORE']="Multipart-Restore: couldn't finde the"
    ." next file '%s'!";
$lang['L_ESTIMATED_END']="Estimated end";
$lang['L_EXCEL2003']="Excel 2003 ve üstü";
$lang['L_EXISTS']="Exists";
$lang['L_EXPORT']="İhraç";
$lang['L_EXPORTFINISHED']="ihrac tamamlanmıştır";
$lang['L_EXPORTLINES']="<strong>%s</strong> satır ihraç"
    ." edildi";
$lang['L_EXPORTOPTIONS']="İhraç Seçenekleri";
$lang['L_EXTENDEDPARS']="Gelişmiş parametreler";
$lang['L_FADE_IN_OUT']="göster /gizle";
$lang['L_FATAL_ERROR_DUMP']="Hata oluştu: CREATE komutu"
    ." '%s'tablosu '%s' veritabanında"
    ." okunamadı<br />Tabloları"
    ." onarmanızı öneriyoruz.";
$lang['L_FIELDS']="Alanlar";
$lang['L_FIELDS_OF_TABLE']="Tablonun alanları";
$lang['L_FILE']="Dosya";
$lang['L_FILES']="Dosyalar";
$lang['L_FILESIZE']="Dosya boyutu";
$lang['L_FILE_MANAGE']="Yönetim";
$lang['L_FILE_OPEN_ERROR']="Hata: Dosya açılamadı.";
$lang['L_FILE_SAVED_SUCCESSFULLY']="Dosya başarıyla kaydedildi.";
$lang['L_FILE_SAVED_UNSUCCESSFULLY']="Dosya kaydedilemedi!";
$lang['L_FILE_UPLOAD_SUCCESSFULL']="The file '%s' was uploaded"
    ." successfully.";
$lang['L_FILTER_BY']="Filter by";
$lang['L_FM_ALERTRESTORE1']="Veritabanı";
$lang['L_FM_ALERTRESTORE2']="Dosyanın içeriği ile";
$lang['L_FM_ALERTRESTORE3']="dönüştürülsünmü?";
$lang['L_FM_ALL_BU']="Tüm yedeklemeler";
$lang['L_FM_ANZ_BU']="Yedeklemeler";
$lang['L_FM_ASKDELETE1']="Seçilen dosya";
$lang['L_FM_ASKDELETE2']="gerçekten silinsinmi?";
$lang['L_FM_ASKDELETE3']="Otomatik dosya silinmesi belirlenmiş"
    ." ayarlara göre şimdi uygulansınmı?";
$lang['L_FM_ASKDELETE4']="Tüm yedeklemeleri şimdi silmek"
    ." istiyormusun?";
$lang['L_FM_ASKDELETE5']="tüm yedeklemeleri (... ile)";
$lang['L_FM_ASKDELETE5_2']="* özelliğine sahip tüm yedeklemeler"
    ." silinsinmi?";
$lang['L_FM_AUTODEL1']="Otomatik temizleme: Maximim dosya"
    ." sayısı aştığı için silinen"
    ." dosyalar:";
$lang['L_FM_CHOOSE_ENCODING']="alınacak yedeğin karakter setini"
    ." seçin";
$lang['L_FM_COMMENT']="Not ekle";
$lang['L_FM_DELETE']="Seçilen dosyaları sil";
$lang['L_FM_DELETE1']="Dosya";
$lang['L_FM_DELETE2']="silindi.";
$lang['L_FM_DELETE3']="silinemedi!";
$lang['L_FM_DELETEALL']="Hepsini sil";
$lang['L_FM_DELETEALLFILTER']="Sil:";
$lang['L_FM_DELETEAUTO']="Otomatik Dosya Silinmesi";
$lang['L_FM_DUMPSETTINGS']="Yedekleme ayarları";
$lang['L_FM_DUMP_HEADER']="Yedekleme";
$lang['L_FM_FILEDATE']="Tarih";
$lang['L_FM_FILES1']="Veritabanı yedeklemeleri";
$lang['L_FM_FILESIZE']="Dosya boyutu";
$lang['L_FM_FILEUPLOAD']="Dosya yükle";
$lang['L_FM_FREESPACE']="Sunucuda mevcut kullanılabilir hacim";
$lang['L_FM_LAST_BU']="Son yedekleme";
$lang['L_FM_NOFILE']="Dosya seçmediniz!";
$lang['L_FM_NOFILESFOUND']="Dosya bulunamadı.";
$lang['L_FM_RECORDS']="Kayıtlar";
$lang['L_FM_RESTORE']="Dönüştür";
$lang['L_FM_RESTORE_HEADER']="Veritabanı `<strong>%s</strong>`";
$lang['L_FM_SELECTTABLES']="Tablo seçimi";
$lang['L_FM_STARTDUMP']="Yeni yedeklemeyi başlat";
$lang['L_FM_TABLES']="Tablolar";
$lang['L_FM_TOTALSIZE']="Toplam boyut";
$lang['L_FM_UPLOADFAILED']="Yükleme yapılamadı!";
$lang['L_FM_UPLOADFILEEXISTS']="Bu isimde bir dosya zaten bulunmakta!";
$lang['L_FM_UPLOADFILEREQUEST']="Dosya adını giriniz.";
$lang['L_FM_UPLOADMOVEERROR']="Yüklenen dosya yerine sürülemedi.";
$lang['L_FM_UPLOADNOTALLOWED1']="Bu dosya tipi geçerli değil.";
$lang['L_FM_UPLOADNOTALLOWED2']="Geçerli dosya tipleri: *.gz und"
    ." *.sql-Dosyaları";
$lang['L_FOUND_DB']="Bulunan Veritabanı:";
$lang['L_FROMFILE']="Dosyadan";
$lang['L_FROMTEXTBOX']="Metin alanından";
$lang['L_FTP']="FTP";
$lang['L_FTP_ADD_CONNECTION']="Add connection";
$lang['L_FTP_CHOOSE_MODE']="FTP-gönderim şekli";
$lang['L_FTP_CONFIRM_DELETE']="Should this FTP-Connection really be"
    ." deleted?";
$lang['L_FTP_CONNECTION']="FTP-Connection";
$lang['L_FTP_CONNECTION_CLOSED']="FTP-Connection closed";
$lang['L_FTP_CONNECTION_DELETE']="Delete connection";
$lang['L_FTP_CONNECTION_ERROR']="The connection to server '%s' using"
    ." port %s couldn't be established";
$lang['L_FTP_CONNECTION_SUCCESS']="The connection to server '%s' using"
    ." port %s was established successfully";
$lang['L_FTP_DIR']="klasör";
$lang['L_FTP_FILE_TRANSFER_ERROR']="Transfer of file '%s' was faulty";
$lang['L_FTP_FILE_TRANSFER_SUCCESS']="The file '%s' was transferred"
    ." successfully";
$lang['L_FTP_LOGIN_ERROR']="Login as user '%s' was denied";
$lang['L_FTP_LOGIN_SUCCESS']="Login as user '%s' was successfull";
$lang['L_FTP_OK']="Bağlantı başarılı olarak kuruldu.";
$lang['L_FTP_PASS']="Şifre";
$lang['L_FTP_PASSIVE']="passiv bağlantı kullan";
$lang['L_FTP_PASV_ERROR']="Switching to passive mode was"
    ." unsuccessful";
$lang['L_FTP_PASV_SUCCESS']="Switching to passive mode was"
    ." successfull";
$lang['L_FTP_PORT']="Port";
$lang['L_FTP_SEND_TO']="adress <strong>%s</strong><br"
    ." />klasör <strong>%s</strong><br />";
$lang['L_FTP_SERVER']="Sunucu";
$lang['L_FTP_SSL']="Güvenli SSL-FTP-Bağlantısı";
$lang['L_FTP_START']="FTP transferini başlat";
$lang['L_FTP_TIMEOUT']="Bağlantı zaman aşımı";
$lang['L_FTP_TRANSFER']="FTP-Transferi";
$lang['L_FTP_USER']="Kullanıcı";
$lang['L_FTP_USESSL']="Güvenli SSL-bağlantısı kullan";
$lang['L_GENERAL']="Genel";
$lang['L_GZIP']="GZip-Sıkıştırma";
$lang['L_GZIP_COMPRESSION']="GZip-sıkıştırma";
$lang['L_HOME']="Anasayfa";
$lang['L_HOUR']="Hour";
$lang['L_HOURS']="Hours";
$lang['L_HTACC_ACTIVATE_REWRITE_ENGINE']="Rewrite'i aç";
$lang['L_HTACC_ADD_HANDLER']="Handler ekle";
$lang['L_HTACC_CONFIRM_DELETE']="Klasör Koruması şimdi"
    ." oluşturulsunmu?";
$lang['L_HTACC_CONTENT']="Dosyanın içeriği";
$lang['L_HTACC_CREATE']="Klasör koruma oluştur";
$lang['L_HTACC_CREATED']="Klasör Koruması oluşturuldu.";
$lang['L_HTACC_CREATE_ERROR']="Klasör Koruma oluşturulmasında hata"
    ." oluştu!<br />Dosyayı lütfen elden"
    ." oluşturunuz. İçeriği";
$lang['L_HTACC_CRYPT']="Crypt (Linux ve Unix-Sistemi)";
$lang['L_HTACC_DENY_ALLOW']="Yasak / Serbest";
$lang['L_HTACC_DIR_LISTING']="Klasör listesi";
$lang['L_HTACC_EDIT']=".htaccess dosyasını düzenle";
$lang['L_HTACC_ERROR_DOC']="Hata dosyası";
$lang['L_HTACC_EXAMPLES']="Başka örnekler ve belgeler";
$lang['L_HTACC_EXISTS']="Geçerli Klasör Koruma bulundu."
    ." Yenisini oluşturduğunuzda eskisi"
    ." silinecektir!";
$lang['L_HTACC_MAKE_EXECUTABLE']="Çalıştırılır hale getir";
$lang['L_HTACC_MD5']="MD5 (Linux ve Unix-Sistemi)";
$lang['L_HTACC_NO_ENCRYPTION']="Açık (Windows)";
$lang['L_HTACC_NO_USERNAME']="İsim girmediniz!";
$lang['L_HTACC_PROPOSED']="Önemli";
$lang['L_HTACC_REDIRECT']="Yönlendir";
$lang['L_HTACC_SCRIPT_EXEC']="Skript'i çalıştır";
$lang['L_HTACC_SHA1']="SHA (bütün Sistemler)";
$lang['L_HTACC_WARNING']="Dikat .htaccess dosyası tarayıcıyı"
    ." anında etkiler. <br />Yanlış"
    ." ayarlandığında sayfalara"
    ." ulaşamazsınız.";
$lang['L_IMPORT']="Dışalım";
$lang['L_IMPORTIEREN']="Dışalım";
$lang['L_IMPORTOPTIONS']="Dışalım Seçenekleri";
$lang['L_IMPORTSOURCE']="Dışalım kaynağı";
$lang['L_IMPORTTABLE']="Tablosuna dışalım";
$lang['L_IMPORT_NOTABLE']="Yüklenecek tablo seçilmemiş!";
$lang['L_IN']="de";
$lang['L_INDEX_SIZE']="Size of index";
$lang['L_INFO_ACTDB']="Geçerli Veritabanı";
$lang['L_INFO_DATABASES']="Sunucuda bulunan Veritabanları";
$lang['L_INFO_DBEMPTY']="Veritabanı boş!";
$lang['L_INFO_FSOCKOPEN_DISABLED']="Ne yazık ki bu sunucuda PHP"
    ." fsockopen()fonksiyonu açık değil.Bu"
    ." nedenle otomatik olarak Dil"
    ." paketlerini indiremiyorsunuz.Ama Dil"
    ." paketlerini manuel olarak indirip ZIP"
    ." programı ile açıp daha sonra da FTP"
    ." programı ile \"language\" klasörüne"
    ." yükliyebilirsiniz.Yüklediğiniz dil"
    ." paketi menüde görüntülenecek.";
$lang['L_INFO_LASTUPDATE']="Son güncelleme";
$lang['L_INFO_LOCATION']="Bulunduğunuz alan:";
$lang['L_INFO_NODB']="İstenile Veritabanaı bulunamıyor";
$lang['L_INFO_NOPROCESSES']="Çalışır işlem yok";
$lang['L_INFO_NOSTATUS']="durum tespit edilemiyor";
$lang['L_INFO_NOVARS']="Değişkenler bulunmuyor";
$lang['L_INFO_OPTIMIZED']="arındırıldı";
$lang['L_INFO_RECORDS']="Kayıtlar";
$lang['L_INFO_SIZE']="Ebadı";
$lang['L_INFO_SUM']="Topyekün";
$lang['L_INSTALL']="Kurulum";
$lang['L_INSTALLED']="Installed";
$lang['L_INSTALL_DB_DEFAULT']="Use as default database";
$lang['L_INSTALL_HELP_PORT']="(boş = Standart port)";
$lang['L_INSTALL_HELP_SOCKET']="(boş= Standart socket)";
$lang['L_IS_WRITABLE']="Is writable";
$lang['L_KILL_PROCESS']="Stop process";
$lang['L_LANGUAGE']="Dil";
$lang['L_LANGUAGE_NAME']="Türkçe";
$lang['L_LASTBACKUP']="Son yedekleme";
$lang['L_LOAD']="Fabrika Ayarları yükle";
$lang['L_LOAD_DATABASE']="Veritabanlarını tekrar yükle";
$lang['L_LOAD_FILE']="Dosya yükle";
$lang['L_LOG']="Rapor";
$lang['L_LOGFILENOTWRITABLE']="Rapor Dosyasına yazılamıyor!";
$lang['L_LOGFILES']="Log-Dosyaları";
$lang['L_LOGGED_IN']="Logged in";
$lang['L_LOGIN']="Login";
$lang['L_LOGIN_AUTOLOGIN']="Automatic login";
$lang['L_LOGIN_INVALID_USER']="Unknown combination of username and"
    ." password.";
$lang['L_LOGOUT']="Log out";
$lang['L_LOG_CREATED']="Log file created.";
$lang['L_LOG_DELETE']="Raporu sil";
$lang['L_LOG_MAXSIZE']="Maximum size of log files";
$lang['L_LOG_NOT_READABLE']="The log file '%s' does not exist or is"
    ." not readable.";
$lang['L_MAILERROR']="Mail gönderiminde hata oluştu!";
$lang['L_MAILPROGRAM']="Mail programı";
$lang['L_MAXIMUM_LENGTH']="Maximum length";
$lang['L_MAXIMUM_LENGTH_EXPLAIN']="This is the maximum number of bytes"
    ." one character needs, when it is saved"
    ." to disk.";
$lang['L_MAXSIZE']="en yüksek boyut";
$lang['L_MAX_BACKUP_FILES_EACH2']="Her Veritabanı için";
$lang['L_MAX_EXECUTION_TIME']="Max execution time";
$lang['L_MAX_UPLOAD_SIZE']="maximum Dosya boyutu";
$lang['L_MAX_UPLOAD_SIZE_INFO']="Eğer Yedek dosyanız izin verilen"
    ." boyuttan büyük ise, o zaman FTP ile"
    ." \"work/backup\"-Klasörüne"
    ." yüklemeniz lazım.<br />Daha sonra bu"
    ." dosya Yönetim bölümünde gözüküp"
    ." geri yükleme işlemi için"
    ." kullanılabilir duruma gelicektir.";
$lang['L_MEMORY']="Bellek";
$lang['L_MENU_HIDE']="Hide menu";
$lang['L_MENU_SHOW']="Show menu";
$lang['L_MESSAGE']="Mesaj";
$lang['L_MESSAGE_TYPE']="Message type";
$lang['L_MINUTE']="Dakika";
$lang['L_MINUTES']="Dakika";
$lang['L_MOBILE_OFF']="Off";
$lang['L_MOBILE_ON']="On";
$lang['L_MODE_EASY']="Easy";
$lang['L_MODE_EXPERT']="Expert";
$lang['L_MSD_INFO']="MySQLDumper bilgileri";
$lang['L_MSD_MODE']="MySQLDumper-Mode";
$lang['L_MSD_VERSION']="MySQLDumper-Version";
$lang['L_MULTIDUMP']="Multidump";
$lang['L_MULTIDUMP_FINISHED']="<b>%d</b> Veritabanları yedeklendi";
$lang['L_MULTIPART_ACTUAL_PART']="Actual Part";
$lang['L_MULTIPART_SIZE']="en yüksek dosya boyutu";
$lang['L_MULTI_PART']="Parçalı yedekleme";
$lang['L_MYSQLVARS']="MySQL Değişkenleri";
$lang['L_MYSQL_CLIENT_VERSION']="MySQL-Client";
$lang['L_MYSQL_CONNECTION_ENCODING']="MYSQL Sunucunun sabit karakter seti";
$lang['L_MYSQL_DATA']="MySQL Verileri";
$lang['L_MYSQL_ROUTINE']="Routine";
$lang['L_MYSQL_ROUTINES']="Routinen";
$lang['L_MYSQL_ROUTINES_EXPLAIN']="Stored functions and procedures";
$lang['L_MYSQL_TABLES_EXPLAIN']="Tables have a defined column structure"
    ." in which one can save data (records)."
    ." Each record represents a row in the"
    ." table.";
$lang['L_MYSQL_VERSION']="MySQL-sürümü";
$lang['L_MYSQL_VERSION_TOO_OLD']="We are sorry: the installed"
    ." MySQL-Version %s is too old and can"
    ." not be used together with this version"
    ." of MySQLDumper. Please update your"
    ." MySQL-Version to at least version"
    ." %s.<br />As an alternative you could"
    ." install MySQLDumper version 1.24,"
    ." which is able to work together with"
    ." older MySQL-Versions. But you will"
    ." lose some of the new functions of"
    ." MySQLDumper in that case.<br />";
$lang['L_MYSQL_VIEW']="View";
$lang['L_MYSQL_VIEWS']="Views";
$lang['L_MYSQL_VIEWS_EXPLAIN']="Views show (filtered) recordsets of"
    ." one ore more tables but don't contain"
    ." own records.";
$lang['L_NAME']="İsim";
$lang['L_NEW']="yeni";
$lang['L_NEWTABLE']="yeni tablo";
$lang['L_NEXT_AUTO_INCREMENT']="Next automatic index";
$lang['L_NEXT_AUTO_INCREMENT_SHORT']="Autoindex";
$lang['L_NO']="hayır";
$lang['L_NOFTPPOSSIBLE']="FTP  işlemleri mümkün değil!";
$lang['L_NOGZPOSSIBLE']="Zlib bulunamadığı için"
    ." Sıkıştırma kullanılamaz!";
$lang['L_NONE']="hiç biri";
$lang['L_NOREVERSE']="Eski kayıtlar önce";
$lang['L_NOTAVAIL']="<em>ulaşılamıyor</em>";
$lang['L_NOTHING_TO_DO']="There is nothing to do.";
$lang['L_NOTICE']="Duyuru";
$lang['L_NOTICES']="İpuçlar";
$lang['L_NOT_ACTIVATED']="etkin değil";
$lang['L_NOT_SUPPORTED']="Bu yedekleme istenilen fonksiyonu"
    ." desteklemiyor.";
$lang['L_NO_DB_FOUND']="Veritabanı bulunamadı.<br"
    ." />Bağlantı parametrelerini açarak"
    ." veritabanının adını elden giriniz!";
$lang['L_NO_DB_FOUND_INFO']="Veritabanı sunucusu ile bağlantı"
    ." kuruldu.<br /><br />Bağlantı"
    ." parametreleri doğrulandı,"
    ." kullanıcı ismi ve şifresi kabul"
    ." edildi.<br /><br />Fakat Sunucuda"
    ." Veritabanı bulunamadı.<br /><br"
    ." />Otomatik tanıma sunucunuzda kilitli"
    ." olabilir.<br /><br />Kurulum"
    ." tamamlandıktan sonra lütfen Ayar"
    ." Merkezi sayfasına gidin ve Bağlantı"
    ." parametreleri bölümünde \"göster\""
    ." tıklayınız.<br /><br />Veritabanı"
    ." ile bağlantı kurulabilmesi için"
    ." gereken bilgileri oraya girmeniz"
    ." gerekiyor.";
$lang['L_NO_DB_SELECTED']="No database selected.";
$lang['L_NO_ENTRIES']="\"<b>%s</b>\" isimli Tablo boş ve"
    ." hiçbirşey yazılmamış.";
$lang['L_NO_MSD_BACKUPFILE']="Başka yazılımların dosyaları:";
$lang['L_NO_NAME_GIVEN']="You didn't enter a name.";
$lang['L_NR_OF_RECORDS']="Number of records";
$lang['L_NR_TABLES_OPTIMIZED']="%s Tablo arındırıldı.";
$lang['L_NUMBER_OF_FILES_FORM']="Yedek dosyaların sayısı";
$lang['L_OF']="/";
$lang['L_OK']="tamam";
$lang['L_OPTIMIZE']="Arındır";
$lang['L_OPTIMIZE_TABLES']="Tabloları yedeklemeden arındırma";
$lang['L_OPTIMIZE_TABLE_ERR']="Error optimizing table `%s`.";
$lang['L_OPTIMIZE_TABLE_SUCC']="Optimized table `%s` successfully.";
$lang['L_OS']="İşletim sistemi";
$lang['L_OVERHEAD']="Overhead";
$lang['L_PAGE']="Page";
$lang['L_PAGE_REFRESHS']="Pageviews";
$lang['L_PASS']="Şifre";
$lang['L_PASSWORD']="Şifre";
$lang['L_PASSWORDS_UNEQUAL']="Şifreler birbirini tutmuyor!";
$lang['L_PASSWORD_REPEAT']="Şifre (Tekrarla)";
$lang['L_PASSWORD_STRENGTH']="Şifre güvenirliği";
$lang['L_PERLOUTPUT1']="crondump.pl de kayıtlı adres"
    ." absolute_path_of_configdir";
$lang['L_PERLOUTPUT2']="Tarayıcı veya dışarıdan"
    ." çağrışım ile çalışan Cronjob";
$lang['L_PERLOUTPUT3']="Shell den veya Crontab dan"
    ." çalışması için";
$lang['L_PERL_COMPLETELOG']="Perl-Complete-Log";
$lang['L_PERL_LOG']="Perl-log";
$lang['L_PHPBUG']="zlib de hata var! Sıkıştırma"
    ." kullanılamaz!";
$lang['L_PHPMAIL']="PHP-Function mail()";
$lang['L_PHP_EXTENSIONS']="PHP-Eklentileri";
$lang['L_PHP_LOG']="PHP-Log";
$lang['L_PHP_VERSION']="PHP sürümü";
$lang['L_PHP_VERSION_TOO_OLD']="We are sorry: the installed"
    ." PHP-Version is too old. MySQLDumper"
    ." needs a PHP-Version of %s or higher."
    ." This server has a PHP-Version of %s"
    ." which is too old. You need to update"
    ." your PHP-Version before you can"
    ." install and use MySQLDumper. <br />";
$lang['L_POP3_PORT']="POP3-Port";
$lang['L_POP3_SERVER']="POP3-Server";
$lang['L_PORT']="Port";
$lang['L_POSITION_BC']="bottom center";
$lang['L_POSITION_BL']="bottom left";
$lang['L_POSITION_BR']="bottom right";
$lang['L_POSITION_MC']="center center";
$lang['L_POSITION_ML']="middle left";
$lang['L_POSITION_MR']="middle right";
$lang['L_POSITION_NOTIFICATIONS']="Position of notification window";
$lang['L_POSITION_TC']="top center";
$lang['L_POSITION_TL']="top left";
$lang['L_POSITION_TR']="top right";
$lang['L_POSSIBLE_COLLATIONS']="Possible collations";
$lang['L_POSSIBLE_COLLATIONS_EXPLAIN']="These are the possible collations one"
    ." can choose for this character set.<br"
    ." /><br />_cs = case sensitiv<br />_ci ="
    ." case insensitive";
$lang['L_PREFIX']="Eki";
$lang['L_PRIMARYKEYS_CHANGED']="Birincil Anahtar değiştirildi";
$lang['L_PRIMARYKEYS_CHANGINGERROR']="Birincil Anahtar değiştirirken bir"
    ." hata oluştu";
$lang['L_PRIMARYKEYS_SAVE']="Birincil anahtar kaydet";
$lang['L_PRIMARYKEY_CONFIRMDELETE']="Birincil anahtar gerçekten silmek"
    ." istermisin?";
$lang['L_PRIMARYKEY_DELETED']="Birincil Anahtar silindi";
$lang['L_PRIMARYKEY_FIELD']="Anahtar alanı";
$lang['L_PRIMARYKEY_NOTFOUND']="Birincil Anahtar bulunmadı";
$lang['L_PROCESSKILL1']="İşlem";
$lang['L_PROCESSKILL2']="durdurulacağını deneniyor.";
$lang['L_PROCESSKILL3']="Süre:";
$lang['L_PROCESSKILL4']="Saniye, İşlem";
$lang['L_PROCESS_ID']="Process ID";
$lang['L_PROGRESS_FILE']="Progress file";
$lang['L_PROGRESS_OVER_ALL']="Genel işlem durumu";
$lang['L_PROGRESS_TABLE']="Tablo işlem durumu";
$lang['L_PROVIDER']="Hosting Şirketi";
$lang['L_PROZESSE']="İşlemler";
$lang['L_QUERY']="Query";
$lang['L_RECHTE']="Haklar (CHMOD)";
$lang['L_RECORDS']="Kayıtlar";
$lang['L_RECORDS_INSERTED']="<b>%s</b> Kayıtlar işlendi.";
$lang['L_RECORDS_OF_TABLE']="Records of table";
$lang['L_RECORDS_PER_PAGECALL']="Records per pagecall";
$lang['L_REFRESHTIME']="Yenileme zamanı";
$lang['L_REFRESHTIME_PROCESSLIST']="Refreshing time of the process list";
$lang['L_REGISTRATION_DESCRIPTION']="Please enter the administrator account"
    ." now. You will login into MySQLDumper"
    ." with this user. Note the dates now"
    ." given good reason.<br /><br />You can"
    ." choose your username and password"
    ." free. Please make sure to choose the"
    ." safest possible combination of user"
    ." name and password to protect access to"
    ." MySQLDumper against unauthorized"
    ." access best!";
$lang['L_RELOAD']="Güncelle";
$lang['L_REMOVE']="Remove";
$lang['L_REPAIR']="Repair";
$lang['L_RESET']="Sıfırla";
$lang['L_RESET_SEARCHWORDS']="arama sonucunu sil";
$lang['L_RESTORE']="Dönüştürüm";
$lang['L_RESTORE_COMPLETE']="<b>%s</b> Tablolar oluşturuldu.";
$lang['L_RESTORE_DB']="Veritabanı: '<b>%s</b>' Sunucu:"
    ." '<b>%s</b>'.";
$lang['L_RESTORE_DB_COMPLETE_IN']="Restoring of database '%s' finished in"
    ." %s.";
$lang['L_RESTORE_OF_TABLES']="belirli tabloları geri dönüştürme";
$lang['L_RESTORE_TABLE']="Restoring of table '%s'";
$lang['L_RESTORE_TABLES_COMPLETED']="Şimdiye kadar <b>%d</b> / <b>%d</b>"
    ." Tablo oluşturuldu.";
$lang['L_RESTORE_TABLES_COMPLETED0']="Şimdiye kadar <b>%d</b> tablo"
    ." oluşturuldu.";
$lang['L_REVERSE']="Yeni kayıtlar önce";
$lang['L_SAFEMODEDESC']="Bu sunucudaki PHP ayarlarında"
    ." \"safe_mode=on\" tespit edilmiştır,"
    ." bazı klasörleri elden oluşturmanız"
    ." gerekiyor (mesela FTP Client programı"
    ." ile)";
$lang['L_SAVE']="Kaydet";
$lang['L_SAVEANDCONTINUE']="Kaydet ve kurulumu devam et";
$lang['L_SAVE_ERROR']="Ayarlar kayıt edilemedi!";
$lang['L_SAVE_SUCCESS']="Ayarlar başarı ile \"%s\" isimli"
    ." doyaya kaydedildi";
$lang['L_SAVING_DATA_TO_FILE']="Saving data of database '%s' to file"
    ." '%s'";
$lang['L_SAVING_DATA_TO_MULTIPART_FILE']="Maximum filesize reached: proceeding"
    ." with file '%s'";
$lang['L_SAVING_DB_FORM']="Veritabanı";
$lang['L_SAVING_TABLE']="Tablo kaytediliyor";
$lang['L_SEARCH_ACCESS_KEYS']="Çevir: ileri=ALT+V, geri=ALT+C";
$lang['L_SEARCH_IN_TABLE']="Tablonun içinde ara";
$lang['L_SEARCH_NO_RESULTS']="aradığınız \"<b>%s</b>\" kelimesi"
    ." \"<b>%s</b>\" Tablo içersinde"
    ." bulunamadı !";
$lang['L_SEARCH_OPTIONS']="Arama Seçenekleri";
$lang['L_SEARCH_OPTIONS_AND']="Sütunun içinde aranan kelimelerin"
    ." hepsi bulunmalı (VE)";
$lang['L_SEARCH_OPTIONS_CONCAT']="Metin'de bütün aranılan kelimeler"
    ." bir satırda bulunmalıdır, fakat"
    ." aranılan kelimeler değişik"
    ." sütunlarda bulunabilir. (Vakit"
    ." alıcı)";
$lang['L_SEARCH_OPTIONS_OR']="Sütunda en azından bir aranılan"
    ." kelime bulunmalıdır. (VEYA arama)";
$lang['L_SEARCH_RESULTS']="aradığınız \"<b>%s</b>\" kelime"
    ." sonucu \"<b>%s</b>\" Tablo'da bulunan"
    ." sonuçlar";
$lang['L_SECOND']="Second";
$lang['L_SECONDS']="Saniye";
$lang['L_SELECT']="Select";
$lang['L_SELECTED_FILE']="Seçilmiş dosya";
$lang['L_SELECT_ALL']="hepsini seç";
$lang['L_SELECT_FILE']="Select file";
$lang['L_SELECT_LANGUAGE']="Select language";
$lang['L_SENDMAIL']="Sendmail";
$lang['L_SENDRESULTASFILE']="Sonuçu dosya olarak gönder";
$lang['L_SEND_MAIL_FORM']="Email gönder";
$lang['L_SERVER']="Sunucu";
$lang['L_SERVERCAPTION']="Sunucuyu göster";
$lang['L_SETPRIMARYKEYSFOR']="Tablonun yeni birincil anahtar ayarlar";
$lang['L_SHOWING_ENTRY_X_TO_Y_OF_Z']="Showing entry %s to %s of %s";
$lang['L_SHOWRESULT']="Sonuçu göster";
$lang['L_SHOW_TABLES']="Show tables";
$lang['L_SHOW_TOOLTIPS']="Show nicer tooltips";
$lang['L_SMTP']="SMTP";
$lang['L_SMTP_HOST']="SMTP-Host";
$lang['L_SMTP_PORT']="SMTP-Port";
$lang['L_SOCKET']="Socket";
$lang['L_SPEED']="Speed";
$lang['L_SQLBOX']="SQL-Box";
$lang['L_SQLBOXHEIGHT']="SQL-kutusunun yüksekliği";
$lang['L_SQLLIB_ACTIVATEBOARD']="Paneli çalştır";
$lang['L_SQLLIB_BOARDS']="Paneller";
$lang['L_SQLLIB_DEACTIVATEBOARD']="Paneli durdur";
$lang['L_SQLLIB_GENERALFUNCTIONS']="genel fonksiyonlar";
$lang['L_SQLLIB_RESETAUTO']="Auto-değeri geri al";
$lang['L_SQLLIMIT']="Sayfa başı gösterilecek kayıt"
    ." sayısı";
$lang['L_SQL_ACTIONS']="İşlem";
$lang['L_SQL_AFTER']="sonra";
$lang['L_SQL_ALLOWDUPS']="çift kayıt'a müsaade et";
$lang['L_SQL_ATPOSITION']="Posisyona ekle";
$lang['L_SQL_ATTRIBUTES']="Attributlar";
$lang['L_SQL_BACKDBOVERVIEW']="Veritabanı listesine dön";
$lang['L_SQL_BEFEHLNEU']="yeni komut";
$lang['L_SQL_BEFEHLSAVED1']="SQL komudu";
$lang['L_SQL_BEFEHLSAVED2']="Eklendi";
$lang['L_SQL_BEFEHLSAVED3']="Kayıt işlendi";
$lang['L_SQL_BEFEHLSAVED4']="üste kaydırıldı";
$lang['L_SQL_BEFEHLSAVED5']="silindi";
$lang['L_SQL_BROWSER']="SQL-Tarayıcısı";
$lang['L_SQL_CARDINALITY']="Kardinality";
$lang['L_SQL_CHANGED']="değiştirildi.";
$lang['L_SQL_CHANGEFIELD']="alanı işle";
$lang['L_SQL_CHOOSEACTION']="İşlem seç";
$lang['L_SQL_COLLATENOTMATCH']="Karakter Seti ve Dil birbirine uymuyor"
    ." (collation)!";
$lang['L_SQL_COLUMNS']="dizi";
$lang['L_SQL_COMMANDS']="SQL Komutları";
$lang['L_SQL_COMMANDS_IN']="Dizinler";
$lang['L_SQL_COMMANDS_IN2']="saniyede işlendi.";
$lang['L_SQL_COPYDATADB']="İçeriği veritabanına kopyala";
$lang['L_SQL_COPYSDB']="Yapıyı veritabanına kopyala";
$lang['L_SQL_COPYTABLE']="Tabloyu kopyala";
$lang['L_SQL_CREATED']="oluşturuldu.";
$lang['L_SQL_CREATEINDEX']="yeni index oluştur";
$lang['L_SQL_CREATETABLE']="Tablo oluştur";
$lang['L_SQL_DATAVIEW']="Veri görüntüsü";
$lang['L_SQL_DBCOPY']="`%s` veritabanının içeriği `%s`"
    ." veritabanına kopyalandı.";
$lang['L_SQL_DBSCOPY']="`%s`veritabanının yapısı `%s`"
    ." veritabanına kopyalandı.";
$lang['L_SQL_DELETED']="silindi.";
$lang['L_SQL_DESTTABLE_EXISTS']="Hedeflenen tablo zaten var!";
$lang['L_SQL_EDIT']="işle";
$lang['L_SQL_EDITFIELD']="Alanı işle";
$lang['L_SQL_EDIT_TABLESTRUCTURE']="Tablo yapısını düzenle";
$lang['L_SQL_EMPTYDB']="veritabanını boşalt";
$lang['L_SQL_ERROR1']="Sorguda hata oluştu:";
$lang['L_SQL_ERROR2']="MySQL bildirisi:";
$lang['L_SQL_EXEC']="SQL komudu çalıştır";
$lang['L_SQL_EXPORT']="`%s` Veritabanından ihraç";
$lang['L_SQL_FIELDDELETE1']="Hücre";
$lang['L_SQL_FIELDNAMENOTVALID']="Hata: alanadı geçersiz";
$lang['L_SQL_FIRST']="önce";
$lang['L_SQL_IMEXPORT']="Al / ver";
$lang['L_SQL_IMPORT']="`%s` Veritabanına dışalım";
$lang['L_SQL_INCOMPLETE_STATEMENT_DETECTED']="%s: incomplete statement detected.<br"
    ." />Couldn't find closing match for '%s'"
    ." in query:<br />%s";
$lang['L_SQL_INDEXES']="İndeksler";
$lang['L_SQL_INSERTFIELD']="Alan ekle";
$lang['L_SQL_INSERTNEWFIELD']="Yeni alan ekle";
$lang['L_SQL_LIBRARY']="SQL-Kütüphanesi";
$lang['L_SQL_NAMEDEST_MISSING']="Gidilecek veritabanının ismi eksik!";
$lang['L_SQL_NEWFIELD']="yeni alan";
$lang['L_SQL_NODATA']="Kayıt bulunmuyor";
$lang['L_SQL_NODEST_COPY']="Hedef belirlenmediği için"
    ." kopyalanamıyor!";
$lang['L_SQL_NOFIELDDELETE']="Silinemiyor, bir tabloda en azından"
    ." bir hücre bulunmalı.";
$lang['L_SQL_NOTABLESINDB']="Veritabanında tablo bulunmuyor";
$lang['L_SQL_NOTABLESSELECTED']="Tablo seçilmedi!";
$lang['L_SQL_OPENFILE']="SQL dosyasını aç";
$lang['L_SQL_OPENFILE_BUTTON']="yükle";
$lang['L_SQL_OUT1']="Toplam";
$lang['L_SQL_OUT2']="komut çalıştırıldı";
$lang['L_SQL_OUT3']="Toplam";
$lang['L_SQL_OUT4']="not sayısı";
$lang['L_SQL_OUT5']="Veri 5000 satırı geçtiği için"
    ." gösterilmiyor.";
$lang['L_SQL_OUTPUT']="SQL-çıktısı";
$lang['L_SQL_QUERYENTRY']="Sorgunun içeriği";
$lang['L_SQL_RECORDDELETED']="Kayıt silindi";
$lang['L_SQL_RECORDEDIT']="Kayıt işleniyor";
$lang['L_SQL_RECORDINSERTED']="Kayıt eklendi";
$lang['L_SQL_RECORDNEW']="Kayıt ekle";
$lang['L_SQL_RECORDUPDATED']="Kayıt değiştirildi";
$lang['L_SQL_RENAMEDB']="veritabanının adını değiştir";
$lang['L_SQL_RENAMEDTO']="yeniden adlandırıldı";
$lang['L_SQL_SCOPY']="`%s` tabloyapısı `%s` tablosuna"
    ." kopyalandı.";
$lang['L_SQL_SEARCH']="Arama";
$lang['L_SQL_SEARCHWORDS']="aranan kelime(ler)";
$lang['L_SQL_SELECTTABLE']="Tablo seç";
$lang['L_SQL_SERVER']="SQL-Server";
$lang['L_SQL_SHOWDATATABLE']="Tablonun verilerini göster";
$lang['L_SQL_STRUCTUREDATA']="Yapı ve veriler";
$lang['L_SQL_STRUCTUREONLY']="Saadece yapı";
$lang['L_SQL_TABLEEMPTIED']="`%s` Tablosu boşaltıldı.";
$lang['L_SQL_TABLEEMPTIEDKEYS']="`%s` Tablosu boşaltıldı ve"
    ." indexleri silindi.";
$lang['L_SQL_TABLEINDEXES']="Tablo indexleri";
$lang['L_SQL_TABLENEW']="Tablolar düzenle";
$lang['L_SQL_TABLENOINDEXES']="Tablonun indexi yok";
$lang['L_SQL_TABLENONAME']="Tabloya isim vermelisiniz!";
$lang['L_SQL_TABLESOFDB']="Veritabanının tabloları";
$lang['L_SQL_TABLEVIEW']="Tablo görüntüsü";
$lang['L_SQL_TBLNAMEEMPTY']="Tablo isimi verilmemiş!";
$lang['L_SQL_TBLPROPSOF']="Tablo özellikleri";
$lang['L_SQL_TCOPY']="`%s` Tablosu içeriği ile `%s`"
    ." tablosuna kopyalandı.";
$lang['L_SQL_UPLOADEDFILE']="Yüklenen dosya:";
$lang['L_SQL_VIEW_COMPACT']="Kompakt görünüm";
$lang['L_SQL_VIEW_STANDARD']="Varsayılan görünüm";
$lang['L_SQL_VONINS']="/";
$lang['L_SQL_WARNING']="SQL emirleriinin işlenmesi"
    ." kayıtlarınıza zarar verebilir!"
    ." Mysqldumper işlemden hiç bir"
    ." yükümlülük kabul etmez.";
$lang['L_SQL_WASCREATED']="oluşturuldu";
$lang['L_SQL_WASEMPTIED']="boşaltıldı";
$lang['L_STARTDUMP']="Yedeklemeyi başlat";
$lang['L_START_RESTORE_DB_FILE']="Starting restore of database '%s' from"
    ." file '%s'.";
$lang['L_START_SQL_SEARCH']="aramayı başlat";
$lang['L_STATUS']="durum";
$lang['L_STEP']="Adım";
$lang['L_SUCCESS_CONFIGFILE_CREATED']="\"%s\" isimli ayar dosyası başarı"
    ." ile oluşturuldu";
$lang['L_SUCCESS_DELETING_CONFIGFILE']="Ayar dosyası \"%s\" başarıyla"
    ." silindi.";
$lang['L_SUM_TOTAL']="Sum";
$lang['L_TABLE']="Tablo";
$lang['L_TABLENAME']="Table name";
$lang['L_TABLENAME_EXPLAIN']="Table name";
$lang['L_TABLES']="Tablolar";
$lang['L_TABLESELECTION']="Tablo seçimi";
$lang['L_TABLE_CREATE_SUCC']="The table '%s' has been created"
    ." successfully.";
$lang['L_TABLE_TYPE']="Tür";
$lang['L_TESTCONNECTION']="Bağlantıyı denetle";
$lang['L_THEME']="Tema";
$lang['L_TIME']="Zaman";
$lang['L_TIMESTAMP']="Timestamp";
$lang['L_TITLE_INDEX']="İndeks";
$lang['L_TITLE_KEY_FULLTEXT']="Full Metin Anahtari";
$lang['L_TITLE_KEY_PRIMARY']="İndeks";
$lang['L_TITLE_KEY_UNIQUE']="Eşsiz Anahtar";
$lang['L_TITLE_MYSQL_HELP']="MySQL Klavuzu";
$lang['L_TITLE_NOKEY']="Anahtar yok";
$lang['L_TITLE_SEARCH']="Ara";
$lang['L_TITLE_SHOW_DATA']="Verileri göster";
$lang['L_TITLE_UPLOAD']="SQL dosyasını yükle";
$lang['L_TO']="e";
$lang['L_TOOLS']="Araçlar";
$lang['L_TOOLS_TOOLBOX']="Veritabanı seçimi / Veritabanı"
    ." işlemleri / Al / Ver";
$lang['L_TRUNCATE']="Truncate";
$lang['L_TRUNCATE_DATABASE']="Truncate database";
$lang['L_UNIT_KB']="KiloByte";
$lang['L_UNIT_MB']="MegaByte";
$lang['L_UNIT_PIXEL']="Pixel";
$lang['L_UNKNOWN']="bilinmeyen";
$lang['L_UNKNOWN_SQLCOMMAND']="Tanınmayan SQL komudu:";
$lang['L_UPDATE']="Güncelle";
$lang['L_UPDATE_CONNECTION_FAILED']="Update failed because connection to"
    ." server '%s' could not be established.";
$lang['L_UPDATE_ERROR_RESPONSE']="Update failed, server returned: '%s'";
$lang['L_UPTO']="kadar";
$lang['L_USERNAME']="Kullanıcı";
$lang['L_USE_SSL']="Use SSL";
$lang['L_VALUE']="İçerik";
$lang['L_VERSIONSINFORMATIONEN']="Sürüm Bilgileri";
$lang['L_VIEW']="görüntüle";
$lang['L_VISIT_HOMEPAGE']="Websayfasını ziyaret edin";
$lang['L_VOM']="den";
$lang['L_WITH']="ile";
$lang['L_WITHATTACH']="eklentili";
$lang['L_WITHOUTATTACH']="eklentisiz";
$lang['L_WITHPRAEFIX']="Önekli";
$lang['L_WRONGCONNECTIONPARS']="Bağlantı parametreleri verilmemiş"
    ." veya hatalı!";
$lang['L_WRONG_CONNECTIONPARS']="Bağlantı parametrelerinde sorun var!";
$lang['L_WRONG_RIGHTS']="Dosya yada Klasör '%s' yazılamıyor"
    ." !.<br /> Ya yetkili kullanıcı"
    ." değilsiniz yada erişim haklarınız"
    ." kısıtlı (chmod).<br /> Lütfen Ftp"
    ." programınızla gerekli erişim"
    ." haklarını düzenleyin.<br />Dosya /"
    ." Klasör için gerekli erişim hakkı"
    ." %s.<br />";
$lang['L_YES']="evet";
$lang['L_ZEND_FRAMEWORK_VERSION']="Zend Framework Version";
$lang['L_ZEND_ID_ACCESS_NOT_A_DIRECTORY']="The given filename '%value%' isn't a"
    ." directory.";
$lang['L_ZEND_ID_ACCESS_NOT_A_FILE']="The given filename '%value%' isn't a"
    ." file.";
$lang['L_ZEND_ID_ACCESS_NOT_A_LINK']="The given target '%value%' is not a"
    ." link.";
$lang['L_ZEND_ID_ACCESS_NOT_EXECUTABLE']="The file or directory '%value%' isn't"
    ." executable.";
$lang['L_ZEND_ID_ACCESS_NOT_EXISTS']="The file or directory '%value%'"
    ." doesn't exists.";
$lang['L_ZEND_ID_ACCESS_NOT_READABLE']="The file or directory '%value%' isn't"
    ." readable.";
$lang['L_ZEND_ID_ACCESS_NOT_UPLOADED']="The given file '%value%' isn't an"
    ." uploaded file.";
$lang['L_ZEND_ID_ACCESS_NOT_WRITABLE']="The file or directory '%value%' isn't"
    ." writable.";
$lang['L_ZEND_ID_DIGITS_INVALID']="Invalid type given. String, integer or"
    ." float expected.";
$lang['L_ZEND_ID_DIGITS_STRING_EMPTY']="Value is an empty string.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_DOT_ATOM']="The email address can not be matched"
    ." against dot-atom format.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID']="Invalid type given. String expected.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_FORMAT']="The email address format is invalid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_HOSTNAME']="The hostname is invalid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_LOCAL_PART']="The local part of the email address"
    ." (<local-part>@<domain>.<tld>) is"
    ." invalid.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_MX_RECORD']="There is no valid MX record for this"
    ." email address.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_INVALID_SEGMENT']="The hostname is located in a not"
    ." routable network segment. The email"
    ." address can not be resolved from"
    ." public network.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_LENGTH_EXCEEDED']="The email address is too long. The"
    ." maximum length is 320 chars.";
$lang['L_ZEND_ID_EMAIL_ADDRESS_QUOTED_STRING']="The email addess can not be matched"
    ." against quoted-string format.";
$lang['L_ZEND_ID_IS_EMPTY']="Value is required and can't be empty.";
$lang['L_ZEND_ID_MISSING_TOKEN']="No token was provided to match"
    ." against.";
$lang['L_ZEND_ID_NOT_DIGITS']="Only digits are allowed.";
$lang['L_ZEND_ID_NOT_EMPTY_INVALID']="Invalid type given. String, integer,"
    ." float, boolean or array expected.";
$lang['L_ZEND_ID_NOT_SAME']="The two given tokens do not match.";
return $lang;
