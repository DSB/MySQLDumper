<?php
$lang['dump_headline']="انشاء نسخة احتياطية ...";
$lang['gzip_compression']="GZip ضغط ";
$lang['saving_table']="حفظ الجدول ";
$lang['of']="مغلق";
$lang['actual_table']="الجدول الفعلي";
$lang['progress_table']="وصف متقدم للجدول";
$lang['progress_over_all']="الوصف الشامل ا";
$lang['entry']="ادخال";
$lang['done']="تم!";
$lang['dump_successful']=" تمت الاضافة بنجاح.";
$lang['upto']="رفع الى";
$lang['email_was_send']="البريد الالكتروني ارسل بنجاح الى ";
$lang['back_to_control']="استمر";
$lang['back_to_overview']="تفاصيل عامة لقاعدة البيانات";
$lang['dump_filename']="ملف النسخ الاحتياطي: ";
$lang['withpraefix']="بالبادئة";
$lang['dump_notables']="لم يتم العثور على جداول في قاعدة البيانات `<b>%s</b>` ";
$lang['dump_endergebnis']="محتويات الملف <b>%s</b> مع الجداول <b>%s</b> السجلات.<br>";
$lang['mailerror']="فشل ارسال البريد الالكتروني!";
$lang['emailbody_attach']="المرفق يحتوي على ملف النسخ الاحتياطي لقاعدة البيانات MySQL.<br>نسخ احتياطي لقاعدة البيانات `%s`
<br><br>تم انشاء الملف التالي:<br><br>%s <br><br>حظا موفقا  <br><br>MySQLDumper<br>";
$lang['emailbody_mp_noattach']="تم انشاء النسخ الاحتياطي المتعدد.<br>ملفات النسخ الاحتياطي لا يمكن ارسالها البريد الالكتروني!<br>النسخ الاحتياطي لقاعدة البيانات `%s`
<br><br>الملفات التالية تم انشئت:<br><br>%s
<br><br>حظا موفقا<br><br>MySQLDumper<br>";
$lang['emailbody_mp_attach']="تم انشاء النسخ الاحتياطي المتعدد.<br>فواصل بين ملفات النسخ الاحتياطي عند ارسالها بالبريد الالكتروني.<br>النسخ الاحتياطي لقاعدة البيانات `%s`
<br><br>الملفات التالية انشئت:<br><br>%s <br><br>حظا موفقا<br><br>MySQLDumper<br>";
$lang['emailbody_footer']="`<br><br>حظا موفقا<br><br>MySQLDumper<br>";
$lang['emailbody_toobig']="الحجم الاقصى للملف تجاوز الحد المسموح به %s لا يمكن ارسال المرفقات الى البريد الالكتروني  .<br>النسخ الاحتياطي لقاعدة البيانات  `%s`
<br><br>الملفات التالية انشئت:<br><br>%s
<br><br>حظا موفقا<br><br>MySQLDumper<br>";
$lang['emailbody_noattach']="الملفات لايمكن ارسالها بالبريد الالكتروني!<br>النسخ الاحتياطي لقاعدة البيانات `%s`
<br><br>الملفات التالية انشئت:<br><br>%s
<br><br>حظا موفقا<br><br>MySQLDumper<br>";
$lang['email_only_attachment']=" ... المرفقات فقط.";
$lang['tableselection']="تحديد جدول";
$lang['selectall']="تحديد الكل";
$lang['deselectall']="الغاء تحديد الكل";
$lang['startdump']="بدء النسخ الاحتياطي";
$lang['lastbufrom']="من اخر تحديث";
$lang['not_supported']="النسخ الاحتياطي هذا لا يدعم هذه الوظيفة.";
$lang['multidump']="متعدد dump: النسخ الاحتياطي لـ <b>%d</b> لقاعدة البيانات انتهى.";
$lang['filesendftp']="ارسال الملف عن طريق  via FTP... رجاء كن صبورا. ";
$lang['ftpconnerror']=" لم يتم تأسيسه FTP اتصال مع ! الاتصال مع ";
$lang['ftpconnerror1']=" اسم مستخدم ";
$lang['ftpconnerror2']=" غير ممكن";
$lang['ftpconnerror3']="FTP الارسال فشل! ";
$lang['ftpconnected1']="الربط مع ";
$lang['ftpconnected2']=" مفتوح ";
$lang['ftpconnected3']=" تمت عملية النقل بنجاح";
$lang['nr_tables_selected']="- مع %s اختر الجداول";
$lang['nr_tables_optimized']="<span class=\"small\">%s تم اصلاح وتحسين الجداول.</span>";
$lang['dump_errors']="<p class=\"error\">%s حدثت اخطاء: <a href=\"log.php?r=3\">عرض</a></p>


";
$lang['fatal_error_dump']="خطأ فادح: انشاء - بيانات من الجدول '%s' في قاعدة البيانات '%s' لا يمكن القراءة!<br>
قم بفحص المشاكل في هذا الجدول.


";


?>