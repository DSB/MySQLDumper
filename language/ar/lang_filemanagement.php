<?php
$lang['convert_start']="بداية التحويل";
$lang['convert_title']="تحويل قاعدة البيانات الى صيغة MSD";
$lang['convert_wrong_parameters']="خطأ parameters!  التحويل غير محتمل.";
$lang['fm_uploadfilerequest']="من فضلك اختر ملف.";
$lang['fm_uploadnotallowed1']="هذا النوع من الملفات غير مدعوم.";
$lang['fm_uploadnotallowed2']="الصيغ المدعومه هي: *.gz و *.sql-ملفات";
$lang['fm_uploadmoveerror']="الملف المحدد الذي تم تحديده لا يمكن نقله الى دليل الارسال.";
$lang['fm_uploadfailed']="عملية الارسال فشلت!";
$lang['fm_uploadfileexists']="يوجد ملف بنفس الاسم بالفعل !";
$lang['fm_nofile']="انت لم تقم بإختيار اي ملف!";
$lang['fm_delete1']="الملف ";
$lang['fm_delete2']=" تم الحذف بنجاح.";
$lang['fm_delete3']=" لا يستطيع الحذف!";
$lang['fm_choose_file']="اختر ملف:";
$lang['fm_filesize']="حجم الملف";
$lang['fm_filedate']="تأريخ الملف";
$lang['fm_nofilesfound']="الملف غير موجود.";
$lang['fm_tables']="الجداول";
$lang['fm_records']="السجلات";
$lang['fm_all_bu']="كل النسخ الاحتياطي";
$lang['fm_anz_bu']="النسخ الاحتياطي";
$lang['fm_last_bu']="النسخ الاحتياطي الاخير";
$lang['fm_totalsize']="الحجم الكلي";
$lang['fm_selecttables']="تحديد الجداول";
$lang['fm_comment']="ادخل تعليقا";
$lang['fm_restore']="استعادة";
$lang['fm_alertrestore1']="هل تريد تنفيذ هذاالاجراء على قاعدة البيانات";
$lang['fm_alertrestore2']="استعادة الجداول والسجلات من الملف";
$lang['fm_alertrestore3']=" ?";
$lang['fm_delete']="حذف";
$lang['fm_askdelete1']="هل تريد تنفيذ هذا الاجراء على الملف ";
$lang['fm_askdelete2']=" وحذف الملف فعلا?";
$lang['fm_askdelete3']="هل تريد تمكين الحذف التلقائي وتهيئة قواعد البانات الآن?";
$lang['fm_askdelete4']="هل تريد حذف جميع ملفات النسخ الاحتياطي?";
$lang['fm_askdelete5']="هل تريد حذف جميع ملفات النسخ الاحتياطي مع ";
$lang['fm_askdelete5_2']="_* ?";
$lang['fm_deleteauto']="تمكين الحذف التلقائي يدويا";
$lang['fm_deleteall']="
حذف جميع ملفات النسخ الاحتياطي";
$lang['fm_deleteallfilter']="حذف الكل مع ";
$lang['fm_deleteallfilter2']="_*";
$lang['fm_startdump']="بدء نسخ احتياطي جديد";
$lang['fm_fileupload']="ارسال ملف";
$lang['fm_dbname']="اسم قاعدة البيانات";
$lang['fm_files1']="قاعدة بيانات النسخ الاحتياطي";
$lang['fm_files2']="تراكيب قاعدة البيانات";
$lang['fm_autodel1']="الحذف التلقائي: الملفات التالية تم حذفها لتجاوزها الحد الاقصى المسموح به :";
$lang['delete_file_success']="File \"%s\" was deleted successfully.";
$lang['fm_dumpsettings']="تهيئة Perl Cron في المخطوطه";
$lang['fm_oldbackup']="(غير معروف)";
$lang['fm_restore_header']="استعادة من قاعدة البيانات \"<strong>%s</strong>\"";
$lang['delete_file_error']="Error deleting file \"%s\"!";
$lang['fm_dump_header']="نسخ احتياطي";
$lang['DoCronButton']="تشغيل Perl Cron في المخطوطه";
$lang['DoPerlTest']="فحص وحدات Perl ";
$lang['DoSimpleTest']="فحص Perl";
$lang['perloutput1']="الدخول في  crondump.pl مسموح_عن طريق_التهيئة في الدليل";
$lang['perloutput2']="عنوان المتصفح او المشغل الخارجي لوظائف Cron ";
$lang['perloutput3']="سطر الاوامر في الشل  او علامة التبويب Cron";
$lang['restore_of_tables']="اختر الجداول التي تريد استعادتها";
$lang['converter']="تحويل النسخ الاحتياطي";
$lang['convert_file']="الملف المحول";
$lang['convert_filename']="اسم الملف الوجهة (بدون الامتداد)";
$lang['converting']="تحويل";
$lang['convert_fileread']="قراءة الملف '%s'";
$lang['convert_finished']="التحويل انتهى, '%s' تم التحويل بنجاح.";
$lang['no_msd_backupfile']="النسخ الاحتياطي لمخطوطات اخرى";
$lang['max_upload_size']="الحد الاقصى لحجم الملف";
$lang['max_upload_size_info']="إذا كان ملف النسخ الاحتياطي هو اكبر من الحد المسموح به أعلاه ، يجب عليك ارساله عبر برامج  بروتوكول نقل الملفات اف تي بي إلى دليل \"work/backup\".
بعد ذلك يمكنك تحديد ملف الاستعادة ومشاهدة بداية التقدم. ";
$lang['encoding']="الترميز";
$lang['fm_choose_encoding']="اختر ترميز لملف النسخ الاحتياطي";
$lang['choose_charset']="MySQLDumper لا يمكن الكشف عن الترميز تلقائيالملف النسخ الاحتياطي.
<br>يجب عليك اختيار الاحرف التي تم حفظ النسخ الاحتياطي بها.
<br>اذا واجهت اي مشكلة مع بعض الاحرف في الاستعادة يمكنك تكرار عملية النسخ الاحتياطي واختيار مجموعة اخرى.
<br>حظا موفقا. ;)";


?>