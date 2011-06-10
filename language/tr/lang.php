<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
  * http://www.mysqldumper.net
 * 
 * @package       MySQLDumper
 * @subpackage    Languages
 * @version       $Rev$
 * @author        $Author$
 * @lastmodified  $Date$
  */
$lang=array_merge($lang, array(
    'L_ACTION' => "İşlem",
    'L_ACTIVATED' => "etkin",
    'L_ACTUALLY_INSERTED_RECORDS' => "Şimdiye kadar <b>%s</b> kayıt"
    ." başarılı olarak işlendi.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Şimdiye kadar <b>%s</b> / <b>%s</b>"
    ." kayıt işlendi.",
    'L_ADD' => "Add",
    'L_ADDED' => "eklendi",
    'L_ADD_DB_MANUALLY' => "Veritabanını elden ekle",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "hepsi",
    'L_ANALYZE' => "Analyze",
    'L_ANALYZING_TABLE' => "<br />İşlenen tablo '<b>%s</b>'"
    ." kayıtlar işleniyor.<br /><br />",
    'L_ASKDBCOPY' => "`%s` ın içeriği `%s` veritabanına"
    ." kopyalansınmı?",
    'L_ASKDBDELETE' => "`%s` Veritabınını içeriği ile"
    ." birlikte silmek istiyormusun?",
    'L_ASKDBEMPTY' => "`%s` Veritabanının gerçekten"
    ." boşaltılsınmı?",
    'L_ASKDELETEFIELD' => "Hücre silinsinmi?",
    'L_ASKDELETERECORD' => "Kayıt silinsinmi?",
    'L_ASKDELETETABLE' => "`%s` Tablo silinsinmi?",
    'L_ASKTABLEEMPTY' => "`%s` Tablo boşaltılsın mı?",
    'L_ASKTABLEEMPTYKEYS' => "`%s` Tablosu boşaltılıp indexler"
    ." silinsinmi?",
    'L_ATTACHED_AS_FILE' => "attached as file",
    'L_ATTACH_BACKUP' => "Yedekleme dosyasını ekle",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "Otomatik yedekleme silinmesi",
    'L_BACK' => "geri",
    'L_BACKUPFILESANZAHL' => "Yedekleme klasöründe bulunan"
    ." dosyalar:",
    'L_BACKUPS' => "Yedeklemeler",
    'L_BACKUP_DBS' => "yedeklenecek veritabanları",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "Veritabanı listesi",
    'L_BACK_TO_OVERVIEW' => "Veritabanı listesi",
    'L_CALL' => "Call",
    'L_CANCEL' => "İptal",
    'L_CANT_CREATE_DIR' => "gerekli olan '%s' Klasörü"
    ." oluşturulamadı. Lütfen FTP"
    ." Programınız ile yaratın.",
    'L_CHANGE' => "değiştir",
    'L_CHANGEDIR' => "Klasöre geç",
    'L_CHANGEDIR' => "Gidilecek klasör:",
    'L_CHANGEDIRERROR' => "Klasöre geciş mümkün değil",
    'L_CHANGEDIRERROR' => "Klasör değiştirilemedi!",
    'L_CHARSET' => "Dil Kodlaması",
    'L_CHECK' => "Kontrolü",
    'L_CHECK' => "kontrol et",
    'L_CHECK_DIRS' => "Kontrol ediliyor",
    'L_CHOOSE_CHARSET' => "Maalesef veritabanı yedeğinin hangi"
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
    ." gerekiyor.<br /> Bol şans ;)",
    'L_CHOOSE_DB' => "Veritabanı seçimi",
    'L_CLEAR_DATABASE' => "Veritabanını  boşalt",
    'L_CLOSE' => "kapat",
    'L_COLLATION' => "Sıralama",
    'L_COMMAND' => "Komut",
    'L_COMMAND' => "Komut",
    'L_COMMAND_AFTER_BACKUP' => "Yedekden sonraki komut",
    'L_COMMAND_BEFORE_BACKUP' => "Yedekten önceki komut",
    'L_COMMENT' => "Yorum",
    'L_COMPRESSED' => "Sıkıştırılmış (gz)",
    'L_CONFBASIC' => "Asıl Ayarları",
    'L_CONFIG' => "Ayar Merkezi",
    'L_CONFIGFILE' => "Ayar dosyası",
    'L_CONFIGFILES' => "Ayar dosyaları",
    'L_CONFIGURATIONS' => "Ayarlar",
    'L_CONFIG_AUTODELETE' => "Otomatik silme",
    'L_CONFIG_CRONPERL' => "Perlscript'in Crondump ayarları",
    'L_CONFIG_EMAIL' => "Email-bildirisi",
    'L_CONFIG_FTP' => "Yedekleme dosyasının FTP Transferi",
    'L_CONFIG_HEADLINE' => "Ayar Merkezi",
    'L_CONFIG_INTERFACE' => "Arayüzü",
    'L_CONFIG_LOADED' => "Ayarlar \"%s\" başarı ile yüklendi",
    'L_CONFIRM_CONFIGFILE_DELETE' => "Ayar dosyası %s gerçekten silinsin"
    ." mi ?",
    'L_CONFIRM_DELETE_TABLES' => "Really delete the selected tables?",
    'L_CONFIRM_DROP_DATABASES' => "Should the selected databases really"
    ." be deleted?

Attention: all data will"
    ." be deleted! Maybe you should create a"
    ." backup first.",
    'L_CONFIRM_RECIPIENT_DELETE' => "Should the recipient \"%s\" really be"
    ." deleted?",
    'L_CONFIRM_TRUNCATE_DATABASES' => "Should all tables of the selected"
    ." databases really be"
    ." deleted?

Attention: all data will be"
    ." deleted! Maybe you want to create a"
    ." backup first.",
    'L_CONFIRM_TRUNCATE_TABLES' => "Really empty the selected tables?",
    'L_CONNECT' => "Bağlantı kur",
    'L_CONNECTIONPARS' => "Bağlantı parametreleri",
    'L_CONNECTTOMYSQL' => "MySQL ile bağlan",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continue Multipart-Restore with next"
    ." file '%s'.",
    'L_CONVERTED_FILES' => "Converted Files",
    'L_CONVERTER' => "Yedekleme dönüştürücüsü",
    'L_CONVERTING' => "Dönüştürüm",
    'L_CONVERT_FILE' => "dönüştürülecek dosya",
    'L_CONVERT_FILENAME' => "Yeni dosya adı (uzantısız)",
    'L_CONVERT_FILEREAD' => "Dosya '%s' okunuyor",
    'L_CONVERT_FINISHED' => "Dönüştürme tamamlandı, '%s'"
    ." oluşturuldu.",
    'L_CONVERT_START' => "Çeviriyi başlat",
    'L_CONVERT_TITLE' => "MSD-Formatına çevir",
    'L_CONVERT_WRONG_PARAMETERS' => "Yanlış Parametre! Çeviri mümkün"
    ." değil.",
    'L_CREATE' => "oluştur",
    'L_CREATEAUTOINDEX' => "Auto-Index oluştur",
    'L_CREATEDIRS' => "Klasörler oluşturuluyor",
    'L_CREATE_CONFIGFILE' => "Yeni ayar dosyası oluştur",
    'L_CREATE_DATABASE' => "Yeni Veritabanı oluştur",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Künye/Yardım",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Not ekle",
    'L_CRON_COMPLETELOG' => "Çıktıları tamamen raporla",
    'L_CRON_EXECPATH' => "Perlskript'in veriyolu",
    'L_CRON_EXTENDER' => "Dosya adı uzantısı",
    'L_CRON_PRINTOUT' => "Yazı çıktısı",
    'L_CSVOPTIONS' => "CSV Seçenekleri",
    'L_CSV_EOL' => "Satırları ayıran",
    'L_CSV_ERRORCREATETABLE' => "`%s` Tablo oluşturmada hata oluştu!",
    'L_CSV_FIELDCOUNT_NOMATCH' => "Tablo kayıtlarının sayısı,"
    ." dışalım edilecek bilgilerle"
    ." uyuşmuyor (%d yerine %d).",
    'L_CSV_FIELDSENCLOSED' => "Hücreleri kapsayan",
    'L_CSV_FIELDSEPERATE' => "Hücreleri ayırmak için",
    'L_CSV_FIELDSESCAPE' => "Hücrelerin kaçış harfi",
    'L_CSV_FIELDSLINES' => "%d hücre tespit edildi, toplam %d"
    ." satır",
    'L_CSV_FILEOPEN' => "CSV-Dosyasını aç",
    'L_CSV_NAMEFIRSTLINE' => "Sütun isimlerini ilk satıra yaz",
    'L_CSV_NODATA' => "Dışalım edilebilecek kayıt"
    ." bulunamadı!",
    'L_CSV_NULL' => "NULL un yerine kullanılacak",
    'L_DATASIZE' => "Veri boyutu",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "Day",
    'L_DAYS' => "Days",
    'L_DB' => "Veritabanı",
    'L_DBCONNECTION' => "Bağlantı Parametreleri",
    'L_DBPARAMETER' => "Veritabanı-Parametreleri",
    'L_DBS' => "Veritabanları",
    'L_DB_BACKUPPARS' => "Veritabanları yedekleme ayarları",
    'L_DB_HOST' => "Veritabanı sunucusunun adı",
    'L_DB_IN_LIST' => "'%s' Veritabanı eklenemedi, cünkü"
    ." mevcut.",
    'L_DB_PASS' => "Veritabanı şifresi",
    'L_DB_SELECT_ERROR' => "<br />Hata:<br />Veritabanı seçimi"
    ." '<b>",
    'L_DB_SELECT_ERROR2' => "</b>' Hata oluştu!",
    'L_DB_USER' => "Veritabanı kullanıcısı",
    'L_DEFAULT_CHARSET' => "standart karakter seti",
    'L_DELETE' => "Silme",
    'L_DELETE_DATABASE' => "Veritabanını sil",
    'L_DELETE_FILE_ERROR' => "Dosya \"%s\" silinemedi!",
    'L_DELETE_FILE_SUCCESS' => "Dosya \"%s\" başarıyla silindi.",
    'L_DELETE_HTACCESS' => "Klasör koruması kaldırılsın"
    ." (.htaccess silinecek)",
    'L_DESELECTALL' => "hepsini kaldır",
    'L_DIR' => "Klasör",
    'L_DISABLEDFUNCTIONS' => "İptal edilmiş fonksiyonlar",
    'L_DISABLEDFUNCTIONS' => "İptal edilmiş fonksiyonlar",
    'L_DO' => "çalıştır",
    'L_DOCRONBUTTON' => "Perl-Cronscript'i çalıştır",
    'L_DONE' => "Tamamlandı!",
    'L_DONT_ATTACH_BACKUP' => "Yedeği eklemeyin",
    'L_DOPERLTEST' => "Perl-Modülerini denetle",
    'L_DOSIMPLETEST' => "Perli denetle",
    'L_DOWNLOAD_FILE' => "Dosya indir",
    'L_DO_NOW' => "şimdi çalıştır",
    'L_DUMP' => "Yedekleme",
    'L_DUMP_ENDERGEBNIS' => "<b>%s</b> tabloda <b>%s</b> kayıt"
    ." yedeklendi.<br />",
    'L_DUMP_FILENAME' => "Yedeklenen dosyanın ismi",
    'L_DUMP_HEADLINE' => "yedekleme oluşturuluyor...",
    'L_DUMP_NOTABLES' => "`%s` Veritabanında tablo bulunamadı.",
    'L_DUMP_OF_DB_FINISHED' => "Dumping of database `%s` done",
    'L_DURATION' => "Duration",
    'L_EDIT' => "düzenle",
    'L_EHRESTORE_CONTINUE' => "devam et ve hatasları raporuna ekle",
    'L_EHRESTORE_STOP' => "Durdur",
    'L_EMAIL' => "E-mail",
    'L_EMAILBODY_ATTACH' => "Ekte veritabanıyın yedeklemesi"
    ." bulunuyor.<br />yedeklenen Veritabanı"
    ." `%s`
<br /><br />Oluşturulan"
    ." dosya:<br /><br />%s <br /><br"
    ." />Sevgilerler<br /><br"
    ." />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>",
    'L_EMAILBODY_FOOTER' => "<br /><br /><br />Sevgiler<br /><br"
    ." />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>",
    'L_EMAILBODY_MP_ATTACH' => "Çok parçalı yedekleme"
    ." oluşturuldu.<br />Dosyalar eklenti"
    ." olarak gönderilmiyor!Dosyalar ayrı"
    ." bir mail ile gönderiliyor!<br"
    ." />Yedeklenen Veritabanı `%s`
<br"
    ." /><br />oluşturulan dosyalar:<br"
    ." /><br />%s<br /><br /><br"
    ." />Sevgilerle<br /><br />MySQLDumper<br"
    ." /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>",
    'L_EMAILBODY_MP_NOATTACH' => "Çok parçalı yedekleme"
    ." oluşturuldu.<br /> Dosyalar eklenti"
    ." olarak gönderilmiyor!<br />yedeklenen"
    ." Veritabanı `%s`
<br /><br"
    ." />oluşturulan dosyalar:<br /><br"
    ." />%s<br /><br /><br />Sevgilerle<br"
    ." /><br />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>",
    'L_EMAILBODY_NOATTACH' => "Yedekleme dosyaları maalesef"
    ." eklenememiştir.<br />yedeklenen"
    ." Veritabanı `%s`
<br /><br"
    ." />Oluşturulan Dosyalar:<br /><br"
    ." />%s
<br /><br />Sevgilerle<br /><br"
    ." />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>",
    'L_EMAILBODY_TOOBIG' => "Yedekleme boyutu maximumu boyut olan"
    ." %s aştıgından dolayı eklenti"
    ." olarak gönderilemiyor.<br"
    ." />Yedeklenen Veritabanı `%s`
<br"
    ." /><br />oluşturulan dosyalar:<br"
    ." /><br />%s
<br /><br />Saygılarla<br"
    ." /><br />MySQLDumper<br /><a"
    ." href=\"http://www.mysqldumper.de/\">www.mysqldumper.de</a>",
    'L_EMAIL_ADDRESS' => "E-Mail-Address",
    'L_EMAIL_CC' => "CC-Alıcı",
    'L_EMAIL_MAXSIZE' => "Eklenen dosyanın en yüksek boyutu",
    'L_EMAIL_ONLY_ATTACHMENT' => "... sadece eklentiler",
    'L_EMAIL_RECIPIENT' => "Email-Adresi",
    'L_EMAIL_SENDER' => "Mail gönderenin adı",
    'L_EMAIL_START' => "Starting to send e-mail",
    'L_EMAIL_WAS_SEND' => "Email başarıyla gönderildi."
    ." Alıcı:",
    'L_EMPTY' => "Içeriği boşalt",
    'L_EMPTYKEYS' => "Boşaltıp indexleri silme",
    'L_EMPTYTABLEBEFORE' => "Tabloyu önce boşalt",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Veritabanını dönüştürmeden sil",
    'L_ENCODING' => "kodlama",
    'L_ENCRYPTION_TYPE' => "Kodlama türü",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.",
    'L_ENTRY' => "Kayıt",
    'L_ERROR' => "Hata",
    'L_ERRORHANDLING_RESTORE' => "Dönüşümde oluşan hataların"
    ." nasıl işleneceği",
    'L_ERROR_CONFIGFILE_NAME' => "Dosya ismi \"%s\" izin verilmeyen"
    ." karakter içeriyor",
    'L_ERROR_DELETING_CONFIGFILE' => "Hata oluştu: Ayar dosyası %s"
    ." silinemedi",
    'L_ERROR_LOADING_CONFIGFILE' => "Ayar dosyası \"%s\" yüklenemedi",
    'L_ERROR_LOG' => "Hata-Log'u",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Estimated end",
    'L_EXCEL2003' => "Excel 2003 ve üstü",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "İhraç",
    'L_EXPORTFINISHED' => "ihrac tamamlanmıştır",
    'L_EXPORTLINES' => "<strong>%s</strong> satır ihraç"
    ." edildi",
    'L_EXPORTOPTIONS' => "İhraç Seçenekleri",
    'L_EXTENDEDPARS' => "Gelişmiş parametreler",
    'L_FADE_IN_OUT' => "göster /gizle",
    'L_FATAL_ERROR_DUMP' => "Hata oluştu: CREATE komutu"
    ." '%s'tablosu '%s' veritabanında"
    ." okunamadı<br />Tabloları"
    ." onarmanızı öneriyoruz.",
    'L_FIELDS' => "Alanlar",
    'L_FIELDS_OF_TABLE' => "Tablonun alanları",
    'L_FILE' => "Dosya",
    'L_FILES' => "Dosyalar",
    'L_FILESIZE' => "Dosya boyutu",
    'L_FILE_MANAGE' => "Yönetim",
    'L_FILE_OPEN_ERROR' => "Hata: Dosya açılamadı.",
    'L_FILE_SAVED_SUCCESSFULLY' => "Dosya başarıyla kaydedildi.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "Dosya kaydedilemedi!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Filter by",
    'L_FM_ALERTRESTORE1' => "Veritabanı",
    'L_FM_ALERTRESTORE2' => "Dosyanın içeriği ile",
    'L_FM_ALERTRESTORE3' => "dönüştürülsünmü?",
    'L_FM_ALL_BU' => "Tüm yedeklemeler",
    'L_FM_ANZ_BU' => "Yedeklemeler",
    'L_FM_ASKDELETE1' => "Seçilen dosya",
    'L_FM_ASKDELETE2' => "gerçekten silinsinmi?",
    'L_FM_ASKDELETE3' => "Otomatik dosya silinmesi belirlenmiş"
    ." ayarlara göre şimdi uygulansınmı?",
    'L_FM_ASKDELETE4' => "Tüm yedeklemeleri şimdi silmek"
    ." istiyormusun?",
    'L_FM_ASKDELETE5' => "tüm yedeklemeleri (... ile)",
    'L_FM_ASKDELETE5_2' => "* özelliğine sahip tüm yedeklemeler"
    ." silinsinmi?",
    'L_FM_AUTODEL1' => "Otomatik temizleme: Maximim dosya"
    ." sayısı aştığı için silinen"
    ." dosyalar:",
    'L_FM_CHOOSE_ENCODING' => "alınacak yedeğin karakter setini"
    ." seçin",
    'L_FM_COMMENT' => "Not ekle",
    'L_FM_DBNAME' => "Veritabanının ismi",
    'L_FM_DELETE' => "Seçilen dosyaları sil",
    'L_FM_DELETE1' => "Dosya",
    'L_FM_DELETE2' => "silindi.",
    'L_FM_DELETE3' => "silinemedi!",
    'L_FM_DELETEALL' => "Hepsini sil",
    'L_FM_DELETEALLFILTER' => "Sil:",
    'L_FM_DELETEAUTO' => "Otomatik Dosya Silinmesi",
    'L_FM_DUMPSETTINGS' => "Yedekleme ayarları",
    'L_FM_DUMP_HEADER' => "Yedekleme",
    'L_FM_FILEDATE' => "Tarih",
    'L_FM_FILES1' => "Veritabanı yedeklemeleri",
    'L_FM_FILESIZE' => "Dosya boyutu",
    'L_FM_FILEUPLOAD' => "Dosya yükle",
    'L_FM_FILEUPLOAD' => "Dosya yükle",
    'L_FM_FREESPACE' => "Sunucuda mevcut kullanılabilir hacim",
    'L_FM_LAST_BU' => "Son yedekleme",
    'L_FM_NOFILE' => "Dosya seçmediniz!",
    'L_FM_NOFILESFOUND' => "Dosya bulunamadı.",
    'L_FM_RECORDS' => "Kayıtlar",
    'L_FM_RESTORE' => "Dönüştür",
    'L_FM_RESTORE_HEADER' => "Veritabanı `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Tablo seçimi",
    'L_FM_STARTDUMP' => "Yeni yedeklemeyi başlat",
    'L_FM_TABLES' => "Tablolar",
    'L_FM_TOTALSIZE' => "Toplam boyut",
    'L_FM_UPLOADFAILED' => "Yükleme yapılamadı!",
    'L_FM_UPLOADFILEEXISTS' => "Bu isimde bir dosya zaten bulunmakta!",
    'L_FM_UPLOADFILEREQUEST' => "Dosya adını giriniz.",
    'L_FM_UPLOADFILEREQUEST' => "Dosya belirtiniz.",
    'L_FM_UPLOADMOVEERROR' => "Yüklenen dosya yerine sürülemedi.",
    'L_FM_UPLOADNOTALLOWED1' => "Bu dosya tipi geçerli değil.",
    'L_FM_UPLOADNOTALLOWED2' => "Geçerli dosya tipleri: *.gz und"
    ." *.sql-Dosyaları",
    'L_FOUND_DB' => "Bulunan Veritabanı:",
    'L_FROMFILE' => "Dosyadan",
    'L_FROMTEXTBOX' => "Metin alanından",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Add connection",
    'L_FTP_CHOOSE_MODE' => "FTP-gönderim şekli",
    'L_FTP_CONFIRM_DELETE' => "Should this FTP-Connection really be"
    ." deleted?",
    'L_FTP_CONNECTION' => "FTP-Connection",
    'L_FTP_CONNECTION_CLOSED' => "FTP-Connection closed",
    'L_FTP_CONNECTION_DELETE' => "Delete connection",
    'L_FTP_CONNECTION_ERROR' => "The connection to server '%s' using"
    ." port %s couldn't be established",
    'L_FTP_CONNECTION_SUCCESS' => "The connection to server '%s' using"
    ." port %s was established successfully",
    'L_FTP_DIR' => "klasör",
    'L_FTP_FILE_TRANSFER_ERROR' => "Transfer of file '%s' was faulty",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "The file '%s' was transferred"
    ." successfully",
    'L_FTP_LOGIN_ERROR' => "Login as user '%s' was denied",
    'L_FTP_LOGIN_SUCCESS' => "Login as user '%s' was successfull",
    'L_FTP_OK' => "FTP-Ayarları geçerli",
    'L_FTP_OK' => "Bağlantı başarılı olarak kuruldu.",
    'L_FTP_PASS' => "Şifre",
    'L_FTP_PASSIVE' => "passiv bağlantı kullan",
    'L_FTP_PASV_ERROR' => "Switching to passive mode was"
    ." unsuccessful",
    'L_FTP_PASV_SUCCESS' => "Switching to passive mode was"
    ." successfull",
    'L_FTP_PORT' => "Port",
    'L_FTP_SEND_TO' => "adress <strong>%s</strong><br"
    ." />klasör <strong>%s</strong>",
    'L_FTP_SERVER' => "Sunucu",
    'L_FTP_SSL' => "Güvenli SSL-FTP-Bağlantısı",
    'L_FTP_START' => "FTP transferini başlat",
    'L_FTP_TIMEOUT' => "Bağlantı zaman aşımı",
    'L_FTP_TRANSFER' => "FTP-Transferi",
    'L_FTP_USER' => "Kullanıcı",
    'L_FTP_USESSL' => "Güvenli SSL-bağlantısı kullan",
    'L_GENERAL' => "Genel",
    'L_GENERAL' => "Genel",
    'L_GZIP' => "GZip-Sıkıştırma",
    'L_GZIP_COMPRESSION' => "GZip-sıkıştırma",
    'L_HOME' => "Anasayfa",
    'L_HOUR' => "Hour",
    'L_HOURS' => "Hours",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Rewrite'i aç",
    'L_HTACC_ADD_HANDLER' => "Handler ekle",
    'L_HTACC_CONFIRM_DELETE' => "Klasör Koruması şimdi"
    ." oluşturulsunmu?",
    'L_HTACC_CONTENT' => "Dosyanın içeriği",
    'L_HTACC_CREATE' => "Klasör koruma oluştur",
    'L_HTACC_CREATED' => "Klasör Koruması oluşturuldu.",
    'L_HTACC_CREATE_ERROR' => "Klasör Koruma oluşturulmasında hata"
    ." oluştu!<br />Dosyayı lütfen elden"
    ." oluşturunuz. İçeriği",
    'L_HTACC_CRYPT' => "Crypt (Linux ve Unix-Sistemi)",
    'L_HTACC_DENY_ALLOW' => "Yasak / Serbest",
    'L_HTACC_DIR_LISTING' => "Klasör listesi",
    'L_HTACC_EDIT' => ".htaccess dosyasını düzenle",
    'L_HTACC_ERROR_DOC' => "Hata dosyası",
    'L_HTACC_EXAMPLES' => "Başka örnekler ve belgeler",
    'L_HTACC_EXISTS' => "Geçerli Klasör Koruma bulundu."
    ." Yenisini oluşturduğunuzda eskisi"
    ." silinecektir!",
    'L_HTACC_MAKE_EXECUTABLE' => "Çalıştırılır hale getir",
    'L_HTACC_MD5' => "MD5 (Linux ve Unix-Sistemi)",
    'L_HTACC_NO_ENCRYPTION' => "Açık (Windows)",
    'L_HTACC_NO_USERNAME' => "İsim girmediniz!",
    'L_HTACC_PROPOSED' => "Önemli",
    'L_HTACC_REDIRECT' => "Yönlendir",
    'L_HTACC_SCRIPT_EXEC' => "Skript'i çalıştır",
    'L_HTACC_SHA1' => "SHA (bütün Sistemler)",
    'L_HTACC_WARNING' => "Dikat .htaccess dosyası tarayıcıyı"
    ." anında etkiler. <br />Yanlış"
    ." ayarlandığında sayfalara"
    ." ulaşamazsınız.",
    'L_IMPORT' => "Ayarları ithal et",
    'L_IMPORT' => "Dışalım",
    'L_IMPORTIEREN' => "Dışalım",
    'L_IMPORTOPTIONS' => "Dışalım Seçenekleri",
    'L_IMPORTSOURCE' => "Dışalım kaynağı",
    'L_IMPORTTABLE' => "Tablosuna dışalım",
    'L_IMPORT_NOTABLE' => "Yüklenecek tablo seçilmemiş!",
    'L_IN' => "de",
    'L_INFO_ACTDB' => "Geçerli Veritabanı",
    'L_INFO_DATABASES' => "Sunucuda bulunan Veritabanları",
    'L_INFO_DBEMPTY' => "Veritabanı boş!",
    'L_INFO_FSOCKOPEN_DISABLED' => "Ne yazık ki bu sunucuda PHP"
    ." fsockopen()fonksiyonu açık değil.Bu"
    ." nedenle otomatik olarak Dil"
    ." paketlerini indiremiyorsunuz.Ama Dil"
    ." paketlerini manuel olarak indirip ZIP"
    ." programı ile açıp daha sonra da FTP"
    ." programı ile \"language\" klasörüne"
    ." yükliyebilirsiniz.Yüklediğiniz dil"
    ." paketi menüde görüntülenecek.",
    'L_INFO_LASTUPDATE' => "Son güncelleme",
    'L_INFO_LOCATION' => "Bulunduğunuz alan:",
    'L_INFO_NODB' => "İstenile Veritabanaı bulunamıyor",
    'L_INFO_NOPROCESSES' => "Çalışır işlem yok",
    'L_INFO_NOSTATUS' => "durum tespit edilemiyor",
    'L_INFO_NOVARS' => "Değişkenler bulunmuyor",
    'L_INFO_OPTIMIZED' => "arındırıldı",
    'L_INFO_RECORDS' => "Kayıtlar",
    'L_INFO_RECORDS' => "Kayıtlar",
    'L_INFO_SIZE' => "Ebadı",
    'L_INFO_SUM' => "Topyekün",
    'L_INSTALL' => "Kurulum",
    'L_INSTALL' => "Yükleme",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(boş = Standart port)",
    'L_INSTALL_HELP_SOCKET' => "(boş= Standart socket)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Stop process",
    'L_LANGUAGE' => "Dil",
    'L_LASTBACKUP' => "Son yedekleme",
    'L_LOAD' => "Fabrika Ayarları yükle",
    'L_LOAD_DATABASE' => "Veritabanlarını tekrar yükle",
    'L_LOAD_FILE' => "Dosya yükle",
    'L_LOG' => "Rapor",
    'L_LOGFILENOTWRITABLE' => "Rapor Dosyasına yazılamıyor!",
    'L_LOGFILENOTWRITABLE' => "Rapor dosyasına yazılamıyor!",
    'L_LOGFILES' => "Log-Dosyaları",
    'L_LOG_DELETE' => "Raporu sil",
    'L_MAILERROR' => "Mail gönderiminde hata oluştu!",
    'L_MAILPROGRAM' => "Mail programı",
    'L_MAXSIZE' => "en yüksek boyut",
    'L_MAX_BACKUP_FILES_EACH2' => "Her Veritabanı için",
    'L_MAX_EXECUTION_TIME' => "Max execution time",
    'L_MAX_UPLOAD_SIZE' => "Maksimum dosya boyutu",
    'L_MAX_UPLOAD_SIZE' => "maximum Dosya boyutu",
    'L_MAX_UPLOAD_SIZE_INFO' => "Eğer Yedek dosyanız izin verilen"
    ." boyuttan büyük ise, o zaman FTP ile"
    ." \"work/backup\"-Klasörüne"
    ." yüklemeniz lazım.
Daha sonra bu"
    ." dosya Yönetim bölümünde gözüküp"
    ." geri yükleme işlemi için"
    ." kullanılabilir duruma gelicektir.",
    'L_MEMORY' => "Bellek",
    'L_MESSAGE' => "Mesaj",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "Dakika",
    'L_MINUTES' => "Dakika",
    'L_MODE_EASY' => "Easy",
    'L_MODE_EXPERT' => "Expert",
    'L_MSD_INFO' => "MySQLDumper bilgileri",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "MySQLDumper-Version",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "<b>%d</b> Veritabanları yedeklendi",
    'L_MULTIPART_ACTUAL_PART' => "Actual Part",
    'L_MULTIPART_SIZE' => "en yüksek dosya boyutu",
    'L_MULTI_PART' => "Parçalı yedekleme",
    'L_MYSQLVARS' => "MySQL Değişkenleri",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "MYSQL Sunucunun sabit karakter seti",
    'L_MYSQL_DATA' => "MySQL Verileri",
    'L_MYSQL_VERSION' => "MySQL-sürümü",
    'L_NAME' => "İsim",
    'L_NAME' => "İsim",
    'L_NEW' => "yeni",
    'L_NEWTABLE' => "yeni tablo",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "hayır",
    'L_NOFTPPOSSIBLE' => "FTP fonksiyonları kullanılmaz!",
    'L_NOFTPPOSSIBLE' => "FTP  işlemleri mümkün değil!",
    'L_NOFTPPOSSIBLE' => "FTP komutları mevcut değil!",
    'L_NOGZPOSSIBLE' => "Sıkıştırma fonksiyonları"
    ." kullanılmıyor!",
    'L_NOGZPOSSIBLE' => "Zlib bulunamadığı için"
    ." Sıkıştırma kullanılamaz!",
    'L_NONE' => "hiç biri",
    'L_NOREVERSE' => "Eski kayıtlar önce",
    'L_NOTAVAIL' => "<em>ulaşılamıyor</em>",
    'L_NOTICE' => "Duyuru",
    'L_NOTICES' => "İpuçlar",
    'L_NOT_ACTIVATED' => "etkin değil",
    'L_NOT_SUPPORTED' => "Bu yedekleme istenilen fonksiyonu"
    ." desteklemiyor.",
    'L_NO_DB_FOUND' => "Veritabanı bulunamadı.
Bağlantı"
    ." parametrelerini açarak"
    ." veritabanının adını elden giriniz!",
    'L_NO_DB_FOUND_INFO' => "Veritabanı sunucusu ile bağlantı"
    ." kuruldu.<br />
Bağlantı"
    ." parametreleri doğrulandı,"
    ." kullanıcı ismi ve şifresi kabul"
    ." edildi.<br />
Fakat Sunucuda"
    ." Veritabanı bulunamadı.<br"
    ." />
Otomatik tanıma sunucunuzda"
    ." kilitli olabilir.<br />
Kurulum"
    ." tamamlandıktan sonra lütfen Ayar"
    ." Merkezi sayfasına gidin ve Bağlantı"
    ." parametreleri bölümünde \"göster\""
    ." tıklayınız.<br />
Veritabanı ile"
    ." bağlantı kurulabilmesi için gereken"
    ." bilgileri oraya girmeniz gerekiyor.",
    'L_NO_DB_SELECTED' => "No database selected.",
    'L_NO_ENTRIES' => "\"<b>%s</b>\" isimli Tablo boş ve"
    ." hiçbirşey yazılmamış.",
    'L_NO_MSD_BACKUPFILE' => "Başka yazılımların dosyaları:",
    'L_NO_NAME_GIVEN' => "You didn't enter a name.",
    'L_NR_TABLES_OPTIMIZED' => "%s Tablo arındırıldı.",
    'L_NUMBER_OF_FILES_FORM' => "Yedek dosyaların sayısı",
    'L_OF' => "/",
    'L_OF' => "tarihinde",
    'L_OK' => "tamam",
    'L_OPTIMIZE' => "Arındır",
    'L_OPTIMIZE_TABLES' => "Tabloları yedeklemeden arındırma",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "İşletim sistemi",
    'L_PAGE_REFRESHS' => "Pageviews",
    'L_PASS' => "Şifre",
    'L_PASSWORD' => "Şifre",
    'L_PASSWORDS_UNEQUAL' => "Şifreler birbirini tutmuyor!",
    'L_PASSWORD_REPEAT' => "Şifre (Tekrarla)",
    'L_PASSWORD_STRENGTH' => "Şifre güvenirliği",
    'L_PERLOUTPUT1' => "crondump.pl de kayıtlı adres"
    ." absolute_path_of_configdir",
    'L_PERLOUTPUT2' => "Tarayıcı veya dışarıdan"
    ." çağrışım ile çalışan Cronjob",
    'L_PERLOUTPUT3' => "Shell den veya Crontab dan"
    ." çalışması için",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-log",
    'L_PHPBUG' => "zlib de hata var! Sıkıştırma"
    ." kullanılamaz!",
    'L_PHPMAIL' => "PHP-Function mail()",
    'L_PHP_EXTENSIONS' => "PHP-Eklentileri",
    'L_PHP_VERSION' => "PHP sürümü",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Port",
    'L_PORT' => "Port",
    'L_POSITION_BC' => "bottom center",
    'L_POSITION_BL' => "bottom left",
    'L_POSITION_BR' => "bottom right",
    'L_POSITION_MC' => "center center",
    'L_POSITION_ML' => "middle left",
    'L_POSITION_MR' => "middle right",
    'L_POSITION_NOTIFICATIONS' => "Position of notification window",
    'L_POSITION_TC' => "top center",
    'L_POSITION_TL' => "top left",
    'L_POSITION_TR' => "top right",
    'L_PREFIX' => "Eki",
    'L_PRIMARYKEYS_CHANGED' => "Birincil Anahtar değiştirildi",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Birincil Anahtar değiştirirken bir"
    ." hata oluştu",
    'L_PRIMARYKEYS_SAVE' => "Birincil anahtar kaydet",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Birincil anahtar gerçekten silmek"
    ." istermisin?",
    'L_PRIMARYKEY_DELETED' => "Birincil Anahtar silindi",
    'L_PRIMARYKEY_FIELD' => "Anahtar alanı",
    'L_PRIMARYKEY_NOTFOUND' => "Birincil Anahtar bulunmadı",
    'L_PROCESSKILL1' => "İşlem",
    'L_PROCESSKILL2' => "durdurulacağını deneniyor.",
    'L_PROCESSKILL3' => "Süre:",
    'L_PROCESSKILL4' => "Saniye, İşlem",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Genel işlem durumu",
    'L_PROGRESS_OVER_ALL' => "Süreçin tamamı",
    'L_PROGRESS_TABLE' => "Tablo işlem durumu",
    'L_PROVIDER' => "Hosting Şirketi",
    'L_PROZESSE' => "İşlemler",
    'L_RECHTE' => "Haklar (CHMOD)",
    'L_RECORDS' => "Kayıtlar",
    'L_RECORDS_INSERTED' => "<b>%s</b> Kayıtlar işlendi.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Yenileme zamanı",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Güncelle",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "Sıfırla",
    'L_RESET_SEARCHWORDS' => "arama sonucunu sil",
    'L_RESTORE' => "Dönüştürüm",
    'L_RESTORE_COMPLETE' => "<b>%s</b> Tablolar oluşturuldu.",
    'L_RESTORE_DB' => "Veritabanı: '<b>%s</b>' Sunucu:"
    ." '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restoring of database '%s' finished in"
    ." %s.",
    'L_RESTORE_OF_TABLES' => "belirli tabloları geri dönüştürme",
    'L_RESTORE_TABLE' => "Restoring of table '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Şimdiye kadar <b>%d</b> / <b>%d</b>"
    ." Tablo oluşturuldu.",
    'L_RESTORE_TABLES_COMPLETED0' => "Şimdiye kadar <b>%d</b> tablo"
    ." oluşturuldu.",
    'L_REVERSE' => "Yeni kayıtlar önce",
    'L_SAFEMODEDESC' => "Bu sunucudaki PHP ayarlarında"
    ." \"safe_mode=on\" tespit edilmiştır,"
    ." bazı klasörleri elden oluşturmanız"
    ." gerekiyor (mesela FTP Client programı"
    ." ile)",
    'L_SAVE' => "Kaydet",
    'L_SAVEANDCONTINUE' => "Kaydet ve kurulumu devam et",
    'L_SAVE_ERROR' => "Ayarlar kayıt edilemedi!",
    'L_SAVE_SUCCESS' => "Ayarlar başarı ile \"%s\" isimli"
    ." doyaya kaydedildi",
    'L_SAVING_DATA_TO_FILE' => "Saving data of database '%s' to file"
    ." '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximum filesize reached: proceeding"
    ." with file '%s'",
    'L_SAVING_DB_FORM' => "Veritabanı",
    'L_SAVING_TABLE' => "Tablo kaytediliyor",
    'L_SEARCH_ACCESS_KEYS' => "Çevir: ileri=ALT+V, geri=ALT+C",
    'L_SEARCH_IN_TABLE' => "Tablonun içinde ara",
    'L_SEARCH_NO_RESULTS' => "aradığınız \"<b>%s</b>\" kelimesi"
    ." \"<b>%s</b>\" Tablo içersinde"
    ." bulunamadı !",
    'L_SEARCH_OPTIONS' => "Arama Seçenekleri",
    'L_SEARCH_OPTIONS_AND' => "Sütunun içinde aranan kelimelerin"
    ." hepsi bulunmalı (VE)",
    'L_SEARCH_OPTIONS_CONCAT' => "Metin'de bütün aranılan kelimeler"
    ." bir satırda bulunmalıdır, fakat"
    ." aranılan kelimeler değişik"
    ." sütunlarda bulunabilir. (Vakit"
    ." alıcı)",
    'L_SEARCH_OPTIONS_OR' => "Sütunda en azından bir aranılan"
    ." kelime bulunmalıdır. (VEYA arama)",
    'L_SEARCH_RESULTS' => "aradığınız \"<b>%s</b>\" kelime"
    ." sonucu \"<b>%s</b>\" Tablo'da bulunan"
    ." sonuçlar",
    'L_SECOND' => "Second",
    'L_SECONDS' => "Saniye",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "hepsini seç",
    'L_SELECTED_FILE' => "Seçilmiş dosya",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "Sonuçu dosya olarak gönder",
    'L_SEND_MAIL_FORM' => "Email gönder",
    'L_SERVER' => "Sunucu",
    'L_SERVERCAPTION' => "Sunucuyu göster",
    'L_SETPRIMARYKEYSFOR' => "Tablonun yeni birincil anahtar ayarlar",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "Sonuçu göster",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Speed",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "SQL-kutusunun yüksekliği",
    'L_SQLLIB_ACTIVATEBOARD' => "Paneli çalştır",
    'L_SQLLIB_BOARDS' => "Paneller",
    'L_SQLLIB_DEACTIVATEBOARD' => "Paneli durdur",
    'L_SQLLIB_GENERALFUNCTIONS' => "genel fonksiyonlar",
    'L_SQLLIB_RESETAUTO' => "Auto-değeri geri al",
    'L_SQLLIMIT' => "Sayfa başı gösterilecek kayıt"
    ." sayısı",
    'L_SQL_ACTIONS' => "İşlem",
    'L_SQL_AFTER' => "sonra",
    'L_SQL_ALLOWDUPS' => "çift kayıt'a müsaade et",
    'L_SQL_ATPOSITION' => "Posisyona ekle",
    'L_SQL_ATTRIBUTES' => "Attributlar",
    'L_SQL_BACKDBOVERVIEW' => "Veritabanı listesine dön",
    'L_SQL_BEFEHLNEU' => "yeni komut",
    'L_SQL_BEFEHLSAVED1' => "SQL komudu",
    'L_SQL_BEFEHLSAVED2' => "Eklendi",
    'L_SQL_BEFEHLSAVED3' => "Kayıt işlendi",
    'L_SQL_BEFEHLSAVED4' => "üste kaydırıldı",
    'L_SQL_BEFEHLSAVED5' => "silindi",
    'L_SQL_BROWSER' => "SQL-Tarayıcısı",
    'L_SQL_CARDINALITY' => "Kardinality",
    'L_SQL_CHANGED' => "değiştirildi.",
    'L_SQL_CHANGEFIELD' => "alanı işle",
    'L_SQL_CHOOSEACTION' => "İşlem seç",
    'L_SQL_COLLATENOTMATCH' => "Karakter Seti ve Dil birbirine uymuyor"
    ." (collation)!",
    'L_SQL_COLUMNS' => "dizi",
    'L_SQL_COMMANDS' => "SQL Komutları",
    'L_SQL_COMMANDS_IN' => "Dizinler",
    'L_SQL_COMMANDS_IN2' => "saniyede işlendi.",
    'L_SQL_COPYDATADB' => "İçeriği veritabanına kopyala",
    'L_SQL_COPYSDB' => "Yapıyı veritabanına kopyala",
    'L_SQL_COPYTABLE' => "Tabloyu kopyala",
    'L_SQL_CREATED' => "oluşturuldu.",
    'L_SQL_CREATEINDEX' => "yeni index oluştur",
    'L_SQL_CREATETABLE' => "Tablo oluştur",
    'L_SQL_DATAVIEW' => "Veri görüntüsü",
    'L_SQL_DBCOPY' => "`%s` veritabanının içeriği `%s`"
    ." veritabanına kopyalandı.",
    'L_SQL_DBSCOPY' => "`%s`veritabanının yapısı `%s`"
    ." veritabanına kopyalandı.",
    'L_SQL_DELETED' => "silindi.",
    'L_SQL_DELETEDB' => "veritabanını sil",
    'L_SQL_DESTTABLE_EXISTS' => "Hedeflenen tablo zaten var!",
    'L_SQL_EDIT' => "işle",
    'L_SQL_EDITFIELD' => "Alanı işle",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Tablo yapısını düzenle",
    'L_SQL_EMPTYDB' => "veritabanını boşalt",
    'L_SQL_ERROR1' => "Sorguda hata oluştu:",
    'L_SQL_ERROR2' => "MySQL bildirisi:",
    'L_SQL_EXEC' => "SQL komudu çalıştır",
    'L_SQL_EXPORT' => "`%s` Veritabanından ihraç",
    'L_SQL_FIELDDELETE1' => "Hücre",
    'L_SQL_FIELDNAMENOTVALID' => "Hata: alanadı geçersiz",
    'L_SQL_FIRST' => "önce",
    'L_SQL_IMEXPORT' => "Al / ver",
    'L_SQL_IMPORT' => "`%s` Veritabanına dışalım",
    'L_SQL_INDEXES' => "İndeksler",
    'L_SQL_INSERTFIELD' => "Alan ekle",
    'L_SQL_INSERTNEWFIELD' => "Yeni alan ekle",
    'L_SQL_LIBRARY' => "SQL-Kütüphanesi",
    'L_SQL_NAMEDEST_MISSING' => "Gidilecek veritabanının ismi eksik!",
    'L_SQL_NEWFIELD' => "yeni alan",
    'L_SQL_NODATA' => "Kayıt bulunmuyor",
    'L_SQL_NODEST_COPY' => "Hedef belirlenmediği için"
    ." kopyalanamıyor!",
    'L_SQL_NOFIELDDELETE' => "Silinemiyor, bir tabloda en azından"
    ." bir hücre bulunmalı.",
    'L_SQL_NOTABLESINDB' => "Veritabanında tablo bulunmuyor",
    'L_SQL_NOTABLESSELECTED' => "Tablo seçilmedi!",
    'L_SQL_OPENFILE' => "SQL dosyasını aç",
    'L_SQL_OPENFILE_BUTTON' => "yükle",
    'L_SQL_OUT1' => "Toplam",
    'L_SQL_OUT2' => "komut çalıştırıldı",
    'L_SQL_OUT3' => "Toplam",
    'L_SQL_OUT4' => "not sayısı",
    'L_SQL_OUT5' => "Veri 5000 satırı geçtiği için"
    ." gösterilmiyor.",
    'L_SQL_OUTPUT' => "SQL-çıktısı",
    'L_SQL_QUERYENTRY' => "Sorgunun içeriği",
    'L_SQL_RECORDDELETED' => "Kayıt silindi",
    'L_SQL_RECORDEDIT' => "Kayıt işleniyor",
    'L_SQL_RECORDINSERTED' => "Kayıt eklendi",
    'L_SQL_RECORDNEW' => "Kayıt ekle",
    'L_SQL_RECORDUPDATED' => "Kayıt değiştirildi",
    'L_SQL_RENAMEDB' => "veritabanının adını değiştir",
    'L_SQL_RENAMEDTO' => "yeniden adlandırıldı",
    'L_SQL_SCOPY' => "`%s` tabloyapısı `%s` tablosuna"
    ." kopyalandı.",
    'L_SQL_SEARCH' => "Arama",
    'L_SQL_SEARCHWORDS' => "aranan kelime(ler)",
    'L_SQL_SELECTTABLE' => "Tablo seç",
    'L_SQL_SHOWDATATABLE' => "Tablonun verilerini göster",
    'L_SQL_STRUCTUREDATA' => "Yapı ve veriler",
    'L_SQL_STRUCTUREONLY' => "Saadece yapı",
    'L_SQL_TABLEEMPTIED' => "`%s` Tablosu boşaltıldı.",
    'L_SQL_TABLEEMPTIEDKEYS' => "`%s` Tablosu boşaltıldı ve"
    ." indexleri silindi.",
    'L_SQL_TABLEINDEXES' => "Tablo indexleri",
    'L_SQL_TABLENEW' => "Tablolar düzenle",
    'L_SQL_TABLENOINDEXES' => "Tablonun indexi yok",
    'L_SQL_TABLENONAME' => "Tabloya isim vermelisiniz!",
    'L_SQL_TABLESOFDB' => "Veritabanının tabloları",
    'L_SQL_TABLEVIEW' => "Tablo görüntüsü",
    'L_SQL_TBLNAMEEMPTY' => "Tablo isimi verilmemiş!",
    'L_SQL_TBLPROPSOF' => "Tablo özellikleri",
    'L_SQL_TCOPY' => "`%s` Tablosu içeriği ile `%s`"
    ." tablosuna kopyalandı.",
    'L_SQL_UPLOADEDFILE' => "Yüklenen dosya:",
    'L_SQL_VIEW_COMPACT' => "Kompakt görünüm",
    'L_SQL_VIEW_STANDARD' => "Varsayılan görünüm",
    'L_SQL_VONINS' => "/",
    'L_SQL_WARNING' => "SQL emirleriinin işlenmesi"
    ." kayıtlarınıza zarar verebilir!"
    ." Mysqldumper işlemden hiç bir"
    ." yükümlülük kabul etmez.",
    'L_SQL_WASCREATED' => "oluşturuldu",
    'L_SQL_WASEMPTIED' => "boşaltıldı",
    'L_STARTDUMP' => "Yedeklemeyi başlat",
    'L_START_RESTORE_DB_FILE' => "Starting restore of database '%s' from"
    ." file '%s'.",
    'L_START_SQL_SEARCH' => "aramayı başlat",
    'L_STATUS' => "durum",
    'L_STATUS' => "Durum",
    'L_STEP' => "Adım",
    'L_SUCCESS_CONFIGFILE_CREATED' => "\"%s\" isimli ayar dosyası başarı"
    ." ile oluşturuldu",
    'L_SUCCESS_DELETING_CONFIGFILE' => "Ayar dosyası \"%s\" başarıyla"
    ." silindi.",
    'L_TABLE' => "Tablo",
    'L_TABLES' => "Tablolar",
    'L_TABLESELECTION' => "Tablo seçimi",
    'L_TABLE_CREATE_SUCC' => "The table '%s' has been created"
    ." successfully.",
    'L_TABLE_TYPE' => "Tür",
    'L_TESTCONNECTION' => "Bağlantıyı denetle",
    'L_THEME' => "Tema",
    'L_TIME' => "Zaman",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "İndeks",
    'L_TITLE_KEY_FULLTEXT' => "Full Metin Anahtari",
    'L_TITLE_KEY_PRIMARY' => "İndeks",
    'L_TITLE_KEY_UNIQUE' => "Eşsiz Anahtar",
    'L_TITLE_MYSQL_HELP' => "MySQL Klavuzu",
    'L_TITLE_NOKEY' => "Anahtar yok",
    'L_TITLE_SEARCH' => "Ara",
    'L_TITLE_SHOW_DATA' => "Verileri göster",
    'L_TITLE_UPLOAD' => "SQL dosyasını yükle",
    'L_TO' => "e",
    'L_TOOLS' => "Araçlar",
    'L_TOOLS' => "Araçlar",
    'L_TOOLS_TOOLBOX' => "Veritabanı seçimi / Veritabanı"
    ." işlemleri / Al / Ver",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "bilinmeyen",
    'L_UNKNOWN_SQLCOMMAND' => "Tanınmayan SQL komudu:",
    'L_UPDATE' => "Güncelle",
    'L_UPTO' => "kadar",
    'L_USERNAME' => "Kullanıcı",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "İçerik",
    'L_VERSIONSINFORMATIONEN' => "Sürüm Bilgileri",
    'L_VIEW' => "görüntüle",
    'L_VISIT_HOMEPAGE' => "Websayfasını ziyaret edin",
    'L_VOM' => "den",
    'L_WITH' => "ile",
    'L_WITHATTACH' => "eklentili",
    'L_WITHOUTATTACH' => "eklentisiz",
    'L_WITHPRAEFIX' => "Önekli",
    'L_WRONGCONNECTIONPARS' => "Bağlantı parametreleri verilmemiş"
    ." veya hatalı!",
    'L_WRONG_CONNECTIONPARS' => "Bağlantı parametrelerinde sorun var!",
    'L_WRONG_RIGHTS' => "Dosya yada Klasör '%s' yazılamıyor"
    ." !.<br /> Ya yetkili kullanıcı"
    ." değilsiniz yada erişim haklarınız"
    ." kısıtlı (chmod).<br /> Lütfen Ftp"
    ." programınızla gerekli erişim"
    ." haklarını düzenleyin.<br />Dosya /"
    ." Klasör için gerekli erişim hakkı"
    ." %s.<br />",
    'L_YES' => "evet",
));
