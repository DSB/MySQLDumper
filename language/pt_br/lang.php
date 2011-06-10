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
    'L_ACTION' => "Action",
    'L_ACTIVATED' => "ativado",
    'L_ACTUALLY_INSERTED_RECORDS' => "até agora <b>%s</b> registros foram"
    ." adicionados com sucesso.",
    'L_ACTUALLY_INSERTED_RECORDS_OF' => "Up to now  <b>%s</b> of <b>%s</b>"
    ." registros foram adicionados com"
    ." sucesso.",
    'L_ADD' => "Add",
    'L_ADDED' => "adicionado",
    'L_ADD_DB_MANUALLY' => "Adicionar banco de dados manualmente",
    'L_ADD_RECIPIENT' => "Add recipient",
    'L_ALL' => "todos",
    'L_ANALYZE' => "Analyze",
    'L_ANALYZING_TABLE' => "<br />Agora a tabela '<b>%s</b>' está"
    ." sendo restaurada.<br /><br />",
    'L_ASKDBCOPY' => "Você quer copiar o banco de dados"
    ." `%s` para o banco de dados `%s`?",
    'L_ASKDBDELETE' => "Você quer excluir o banco de dados"
    ." `%s` com seu conteúdo?",
    'L_ASKDBEMPTY' => "Você quer esvaziar o banco de dados"
    ." `%s` ?",
    'L_ASKDELETEFIELD' => "Você quer excluir o campo?",
    'L_ASKDELETERECORD' => "Você tem certeza em apagar este"
    ." registro?",
    'L_ASKDELETETABLE' => "Deve a tabela `%s` ser excluida?",
    'L_ASKTABLEEMPTY' => "Deve a tabela `%s` ser esvaziada?",
    'L_ASKTABLEEMPTYKEYS' => "Deve a tabela `%s` ser esvaziada e os"
    ." índices reiniciados?",
    'L_ATTACHED_AS_FILE' => "attached as file",
    'L_ATTACH_BACKUP' => "Anexar o backup",
    'L_AUTHORIZE' => "Authorize",
    'L_AUTODELETE' => "Excluir backups automaticamente",
    'L_BACK' => "voltar",
    'L_BACKUPFILESANZAHL' => "No diretório de backup há",
    'L_BACKUPS' => "Backups",
    'L_BACKUP_DBS' => "DBs to backup",
    'L_BACKUP_TABLE_DONE' => "Dumping of table `%s` finished. %s"
    ." records have been saved.",
    'L_BACK_TO_OVERVIEW' => "Visão geral do banco de dados",
    'L_BACK_TO_OVERVIEW' => "Visão geral do banco de dados",
    'L_CALL' => "Call",
    'L_CANCEL' => "Cancel",
    'L_CANT_CREATE_DIR' => "Não foi possível criar o diretório"
    ." '%s'. 
Por favor utilize seu programa"
    ." de FTP.",
    'L_CHANGE' => "alterar",
    'L_CHANGEDIR' => "mudar para o diretório",
    'L_CHANGEDIR' => "Mudando para o diretório",
    'L_CHANGEDIRERROR' => "a mudança para o diretório não foi"
    ." possível",
    'L_CHANGEDIRERROR' => "Não pude mudar de diretório!",
    'L_CHARSET' => "Conjunto de caracteres",
    'L_CHECK' => "Verificar",
    'L_CHECK' => "check",
    'L_CHECK_DIRS' => "Verificar meus diretórios",
    'L_CHOOSE_CHARSET' => "MySQLDumper couldn't detect the"
    ." encoding of the backup file"
    ." automatically.
<br />You must choose"
    ." the charset with which this backup was"
    ." saved.
<br />If you discover any"
    ." problems with some characters after"
    ." restoring, you can repeat the"
    ." backup-progress and then choose"
    ." another character set.
<br />Good"
    ." luck. ;)",
    'L_CHOOSE_DB' => "Escolher banco de dados",
    'L_CLEAR_DATABASE' => "Limpar banco de dados",
    'L_CLOSE' => "Close",
    'L_COLLATION' => "Collation",
    'L_COMMAND' => "Comando",
    'L_COMMAND' => "Comando",
    'L_COMMAND_AFTER_BACKUP' => "Command after backup",
    'L_COMMAND_BEFORE_BACKUP' => "Command before backup",
    'L_COMMENT' => "Comentário",
    'L_COMPRESSED' => "compactado (gz)",
    'L_CONFBASIC' => "Parâmetros básicos",
    'L_CONFIG' => "Configuração",
    'L_CONFIGFILE' => "Config File",
    'L_CONFIGFILES' => "Configuration Files",
    'L_CONFIGURATIONS' => "Configurations",
    'L_CONFIG_AUTODELETE' => "Autoexcluir",
    'L_CONFIG_CRONPERL' => "Configurações do Crondump para o"
    ." script Perl",
    'L_CONFIG_EMAIL' => "Notificação por email",
    'L_CONFIG_FTP' => "Transferência via FTP do arquivo de"
    ." backup",
    'L_CONFIG_HEADLINE' => "Configuração",
    'L_CONFIG_INTERFACE' => "Interface",
    'L_CONFIG_LOADED' => "Configuration \"%s\" has been imported"
    ." successfully.",
    'L_CONFIRM_CONFIGFILE_DELETE' => "Really delete the configuration file"
    ." %s?",
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
    'L_CONNECT' => "conectar",
    'L_CONNECTIONPARS' => "Parâmetros de conexão",
    'L_CONNECTTOMYSQL' => "Conectar ao MySQL",
    'L_CONTINUE_MULTIPART_RESTORE' => "Continue Multipart-Restore with next"
    ." file '%s'.",
    'L_CONVERTED_FILES' => "Converted Files",
    'L_CONVERTER' => "Conversor de backup",
    'L_CONVERTING' => "Convertendo",
    'L_CONVERT_FILE' => "Arquivo a ser convertido",
    'L_CONVERT_FILENAME' => "Nome do arquivo de destino (sem"
    ." extensão)",
    'L_CONVERT_FILEREAD' => "Ler arquivo '%s'",
    'L_CONVERT_FINISHED' => "Conversão terminada, o arquivo '%s'"
    ." foi gravado com sucesso.",
    'L_CONVERT_START' => "Iniciar a conversão",
    'L_CONVERT_TITLE' => "Converter o dump para o formato MSD",
    'L_CONVERT_WRONG_PARAMETERS' => "Parâmetros incorretos!  A conversão"
    ." não é possível.",
    'L_CREATE' => "Criar",
    'L_CREATEAUTOINDEX' => "Criar um Auto-índice",
    'L_CREATEDIRS' => "Criar diretórios",
    'L_CREATE_CONFIGFILE' => "Create a new configuration file",
    'L_CREATE_DATABASE' => "Criar novo banco de dados",
    'L_CREATE_TABLE_SAVED' => "Definition of table `%s` saved.",
    'L_CREDITS' => "Créditos / Ajuda",
    'L_CRONSCRIPT' => "Cronscript",
    'L_CRON_COMMENT' => "Digitar comentário",
    'L_CRON_COMPLETELOG' => "Registrar todas as saídas",
    'L_CRON_EXECPATH' => "Caminho dos scripts Perl",
    'L_CRON_EXTENDER' => "Extensão do arquivo",
    'L_CRON_PRINTOUT' => "Imprimir a saída na tela.",
    'L_CSVOPTIONS' => "Opções de CSV",
    'L_CSV_EOL' => "Separar linhas com",
    'L_CSV_ERRORCREATETABLE' => "Erro durante a criação da tabela"
    ." `%s` !",
    'L_CSV_FIELDCOUNT_NOMATCH' => "A contagem de campos não confere com"
    ." a dos dados a importar (%d ao invés"
    ." de %d).",
    'L_CSV_FIELDSENCLOSED' => "Campos fechados por",
    'L_CSV_FIELDSEPERATE' => "Campos separados por",
    'L_CSV_FIELDSESCAPE' => "Campos escapados com",
    'L_CSV_FIELDSLINES' => "%d campos reconhecidos, totalizando %d"
    ." linhas",
    'L_CSV_FILEOPEN' => "Abrir arquivo CSV",
    'L_CSV_NAMEFIRSTLINE' => "Nome dos campos na primeira linha",
    'L_CSV_NODATA' => "Nenhum dado encontrado para"
    ." importação!",
    'L_CSV_NULL' => "Substituir NULL com",
    'L_DATASIZE' => "Size of data",
    'L_DATASIZE_INFO' => "This is the size of the records - not"
    ." the size of the backup file",
    'L_DAY' => "Day",
    'L_DAYS' => "Days",
    'L_DB' => "Banco de dados",
    'L_DBCONNECTION' => "Conexão do banco de dados",
    'L_DBPARAMETER' => "Parâmetros do banco de dados",
    'L_DBS' => "Bancos de dados",
    'L_DB_BACKUPPARS' => "Parâmetro de backup do banco de dados",
    'L_DB_HOST' => "Host",
    'L_DB_IN_LIST' => "O banco de dados '%s' não pode ser"
    ." adicionado pois ele já existe",
    'L_DB_PASS' => "Senha",
    'L_DB_SELECT_ERROR' => "<br />Error:<br />Seleção do banco"
    ." de dados <b>",
    'L_DB_SELECT_ERROR2' => "</b> falhou!",
    'L_DB_USER' => "Usuáio",
    'L_DEFAULT_CHARSET' => "Default character set",
    'L_DELETE' => "Excluir",
    'L_DELETE_DATABASE' => "Excluir banco de dados",
    'L_DELETE_FILE_ERROR' => "Error deleting file \"%s\"!",
    'L_DELETE_FILE_SUCCESS' => "File \"%s\" was deleted successfully.",
    'L_DELETE_HTACCESS' => "Remover proteção de diretório"
    ." (apagar .htaccess)",
    'L_DESELECTALL' => "Desselecionar tudo",
    'L_DIR' => "Diretório",
    'L_DISABLEDFUNCTIONS' => "Funções desativadas",
    'L_DISABLEDFUNCTIONS' => "Desativar Funções",
    'L_DO' => "Executar",
    'L_DOCRONBUTTON' => "Executar o script Perl Cron",
    'L_DONE' => "Pronto!",
    'L_DONT_ATTACH_BACKUP' => "Don't attach backup",
    'L_DOPERLTEST' => "Testar módulos Perl",
    'L_DOSIMPLETEST' => "Testar Perl",
    'L_DOWNLOAD_FILE' => "Download file",
    'L_DO_NOW' => "executar agora",
    'L_DUMP' => "Criar backup",
    'L_DUMP_ENDERGEBNIS' => "O arquivo contém <b>%s</b> tabela(s)"
    ." com <b>%s</b> registro(s).<br />",
    'L_DUMP_FILENAME' => "Arquivo de backup",
    'L_DUMP_HEADLINE' => "Criar backup...",
    'L_DUMP_NOTABLES' => "Nenhuma tabela foi encontrada no banco"
    ." de dados `%s`",
    'L_DUMP_OF_DB_FINISHED' => "Dumping of database `%s` done",
    'L_DURATION' => "Duration",
    'L_EDIT' => "editar",
    'L_EHRESTORE_CONTINUE' => "continuar e registrar erros",
    'L_EHRESTORE_STOP' => "parar",
    'L_EMAIL' => "E-Mail",
    'L_EMAILBODY_ATTACH' => "O anexo contém o backup do seu banco"
    ." de dados MySQL.<br />Backup do banco"
    ." de dados `%s`
<br /><br />O seguinte"
    ." arquivo foi criado:<br /><br />%s <br"
    ." /><br />Atenciosamente<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_FOOTER' => "`<br /><br />Atenciosamente<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_ATTACH' => "Um backup Multi-parte foi criado.<br"
    ." />Os arquivos de backup estão"
    ." anexados em emails separados.<br"
    ." />Backup do banco de dados `%s`
<br"
    ." /><br />Os seguintes arquivos foram"
    ." criados:<br /><br />%s <br /><br"
    ." />Atenciosamente<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_MP_NOATTACH' => "Um backup Multi-parte foi criad.<br"
    ." />Os arquivos não estão anexados a"
    ." este email!<br />Backup do banco de"
    ." dados `%s`
<br /><br />Os seguintes"
    ." arquivos foram criados:<br /><br"
    ." />%s
<br /><br />Atenciosamente<br"
    ." /><br />MySQLDumper<br />",
    'L_EMAILBODY_NOATTACH' => "Os arquivos não estão anexados a"
    ." este email!<br />Backup do banco de"
    ." dados `%s`
<br /><br />O seguinte"
    ." arquivo foi criado:<br /><br />%s
<br"
    ." /><br />Atenciosamente<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAILBODY_TOOBIG' => "O arquivo de backup excedeu o tamanho"
    ." máximo de %s e não foi anexado a"
    ." este email.<br />Backup do banco de"
    ." dados `%s`
<br /><br />O seguinte"
    ." arquivo foi criado:<br /><br />%s
<br"
    ." /><br />Atenciosamente<br /><br"
    ." />MySQLDumper<br />",
    'L_EMAIL_ADDRESS' => "E-Mail-Address",
    'L_EMAIL_CC' => "CC-Receiver",
    'L_EMAIL_MAXSIZE' => "Tamanho máximo do anexo",
    'L_EMAIL_ONLY_ATTACHMENT' => "... somente anexos.",
    'L_EMAIL_RECIPIENT' => "Endereço do email",
    'L_EMAIL_SENDER' => "Endereço do remetente do email",
    'L_EMAIL_START' => "Starting to send e-mail",
    'L_EMAIL_WAS_SEND' => "Um email foi enviado com sucesso para",
    'L_EMPTY' => "Esvaziar",
    'L_EMPTYKEYS' => "esvaziar e reiniciar os índices",
    'L_EMPTYTABLEBEFORE' => "Esvaziar a tabela antes",
    'L_EMPTY_DB_BEFORE_RESTORE' => "Excluir tabelas antes de restaurar",
    'L_ENCODING' => "encoding",
    'L_ENCRYPTION_TYPE' => "Tipo de encriptação",
    'L_ENGINE' => "Engine",
    'L_ENTER_DB_INFO' => "First click the button \"Connect to"
    ." MySQL\". Only if no database could be"
    ." detected you need to provide a"
    ." database name here.",
    'L_ENTRY' => "Entrada",
    'L_ERROR' => "Erro",
    'L_ERRORHANDLING_RESTORE' => "Controle de erro durante a"
    ." restauração",
    'L_ERROR_CONFIGFILE_NAME' => "Filename \"%s\" contains invalid"
    ." characters.",
    'L_ERROR_DELETING_CONFIGFILE' => "Error: couldn't delete configuration"
    ." file %s!",
    'L_ERROR_LOADING_CONFIGFILE' => "Couldn't load configfile \"%s\".",
    'L_ERROR_LOG' => "Error Log",
    'L_ERROR_MULTIPART_RESTORE' => "Multipart-Restore: couldn't finde the"
    ." next file '%s'!",
    'L_ESTIMATED_END' => "Estimated end",
    'L_EXCEL2003' => "Excel de 2003",
    'L_EXISTS' => "Exists",
    'L_EXPORT' => "Exportar",
    'L_EXPORTFINISHED' => "Exportação finalizada.",
    'L_EXPORTLINES' => "<strong>%s</strong> linhas exportadas",
    'L_EXPORTOPTIONS' => "Opções de exportação",
    'L_EXTENDEDPARS' => "Parâmetros extendidos",
    'L_FADE_IN_OUT' => "Exibir sim/não",
    'L_FATAL_ERROR_DUMP' => "Fatal error: the CREATE-Statement of"
    ." table '%s' in database '%s' couldn't"
    ." be read!",
    'L_FIELDS' => "campos",
    'L_FIELDS_OF_TABLE' => "Fields of table",
    'L_FILE' => "Arquivo",
    'L_FILES' => "Files",
    'L_FILESIZE' => "Tamanho do arquivo",
    'L_FILE_MANAGE' => "Administração de arquivos",
    'L_FILE_OPEN_ERROR' => "Erro: não pude abrir o arquivo.",
    'L_FILE_SAVED_SUCCESSFULLY' => "The file has been saved successfully.",
    'L_FILE_SAVED_UNSUCCESSFULLY' => "The file couldn't be saved!",
    'L_FILE_UPLOAD_SUCCESSFULL' => "The file '%s' was uploaded"
    ." successfully.",
    'L_FILTER_BY' => "Filter by",
    'L_FM_ALERTRESTORE1' => "Deve o banco de dados",
    'L_FM_ALERTRESTORE2' => "ser restaurado com os rgistros do"
    ." arquivo",
    'L_FM_ALERTRESTORE3' => "?",
    'L_FM_ALL_BU' => "Todos os backups",
    'L_FM_ANZ_BU' => "Backups",
    'L_FM_ASKDELETE1' => "Deve o arquivo",
    'L_FM_ASKDELETE2' => "realmente ser excluido?",
    'L_FM_ASKDELETE3' => "Você deseja que a autoexclusão seja"
    ." executada com as regras configuradas"
    ." agora?",
    'L_FM_ASKDELETE4' => "Você deseja excluir todos os arqruvos"
    ." de backup?",
    'L_FM_ASKDELETE5' => "Você deseja excluir todos os arqruvos"
    ." de backup com",
    'L_FM_ASKDELETE5_2' => "* ?",
    'L_FM_AUTODEL1' => "Autoexclusão: os seguintes arqruivos"
    ." foram excluidos devido ao ajuste de"
    ." número máximo de arquivos:",
    'L_FM_CHOOSE_ENCODING' => "Choose encoding of backup file",
    'L_FM_COMMENT' => "Digitar comentário",
    'L_FM_DBNAME' => "Nome do banco de dados",
    'L_FM_DELETE' => "Excluir",
    'L_FM_DELETE1' => "O arquivo",
    'L_FM_DELETE2' => "foi excluido com sucesso.",
    'L_FM_DELETE3' => "não pode ser excluido!",
    'L_FM_DELETEALL' => "Excluir todos os arqruvos de backup",
    'L_FM_DELETEALLFILTER' => "Excluir todos com",
    'L_FM_DELETEAUTO' => "Executar a autoexclusão manualmente",
    'L_FM_DUMPSETTINGS' => "Configuração do script",
    'L_FM_DUMP_HEADER' => "Backup",
    'L_FM_FILEDATE' => "Data do arquivo",
    'L_FM_FILES1' => "Backups do banco de dados",
    'L_FM_FILESIZE' => "Tamanho do arquivo",
    'L_FM_FILEUPLOAD' => "Enviar arquivo",
    'L_FM_FILEUPLOAD' => "Enviar arquivo",
    'L_FM_FREESPACE' => "Espaço livre no servidor",
    'L_FM_LAST_BU' => "Último backup",
    'L_FM_NOFILE' => "Você não escolheu nenhum arquivo!",
    'L_FM_NOFILESFOUND' => "Nenhum arquivo encontrado.",
    'L_FM_RECORDS' => "Registros",
    'L_FM_RESTORE' => "Restaurar",
    'L_FM_RESTORE_HEADER' => "Restaurar o banco de dados"
    ." `<strong>%s</strong>`",
    'L_FM_SELECTTABLES' => "Selecionar tabelas",
    'L_FM_STARTDUMP' => "Iniciar novo backup",
    'L_FM_TABLES' => "Tabelas",
    'L_FM_TOTALSIZE' => "Tamanho total",
    'L_FM_UPLOADFAILED' => "O envio falhou!",
    'L_FM_UPLOADFILEEXISTS' => "Um arquivo com o mesmo nome já existe"
    ." !",
    'L_FM_UPLOADFILEREQUEST' => "favor escolher um arquivo.",
    'L_FM_UPLOADFILEREQUEST' => "favor escolher um arquivo.",
    'L_FM_UPLOADMOVEERROR' => "Não pude mover os arqruivos"
    ." selecionados para o diretório de"
    ." envio.",
    'L_FM_UPLOADNOTALLOWED1' => "Este tipo de arquivo não é"
    ." suportado.",
    'L_FM_UPLOADNOTALLOWED2' => "Os tipos válidos são: *.gz and"
    ." *.sql-files",
    'L_FOUND_DB' => "bd localizado",
    'L_FROMFILE' => "do arquivo",
    'L_FROMTEXTBOX' => "da caixa de texto",
    'L_FTP' => "FTP",
    'L_FTP_ADD_CONNECTION' => "Add connection",
    'L_FTP_CHOOSE_MODE' => "Modo de Transferência - FTP",
    'L_FTP_CONFIRM_DELETE' => "Should this FTP-Connection really be"
    ." deleted?",
    'L_FTP_CONNECTION' => "FTP-Connection",
    'L_FTP_CONNECTION_CLOSED' => "FTP-Connection closed",
    'L_FTP_CONNECTION_DELETE' => "Delete connection",
    'L_FTP_CONNECTION_ERROR' => "The connection to server '%s' using"
    ." port %s couldn't be established",
    'L_FTP_CONNECTION_SUCCESS' => "The connection to server '%s' using"
    ." port %s was established successfully",
    'L_FTP_DIR' => "Diretório para upload",
    'L_FTP_FILE_TRANSFER_ERROR' => "Transfer of file '%s' was faulty",
    'L_FTP_FILE_TRANSFER_SUCCESS' => "The file '%s' was transferred"
    ." successfully",
    'L_FTP_LOGIN_ERROR' => "Login as user '%s' was denied",
    'L_FTP_LOGIN_SUCCESS' => "Login as user '%s' was successfull",
    'L_FTP_OK' => "os parâmetros de FTP estão ok",
    'L_FTP_OK' => "Conexão bem sucedida.",
    'L_FTP_PASS' => "Senha",
    'L_FTP_PASSIVE' => "usar modo passivo",
    'L_FTP_PASV_ERROR' => "Switching to passive mode was"
    ." unsuccessful",
    'L_FTP_PASV_SUCCESS' => "Switching to passive mode was"
    ." successfull",
    'L_FTP_PORT' => "Porta",
    'L_FTP_SEND_TO' => "to <strong>%s</strong><br /> into"
    ." <strong>%s</strong>",
    'L_FTP_SERVER' => "Servidor",
    'L_FTP_SSL' => "Conexão segura SSL FTP",
    'L_FTP_START' => "Starting FTP transfer",
    'L_FTP_TIMEOUT' => "Timeout da conexão",
    'L_FTP_TRANSFER' => "Transferência via FTP",
    'L_FTP_USER' => "Usuário",
    'L_FTP_USESSL' => "usar conexão SSL",
    'L_GENERAL' => "geral",
    'L_GENERAL' => "Geral",
    'L_GZIP' => "Compressão gzip",
    'L_GZIP_COMPRESSION' => "Compressão gzip",
    'L_HOME' => "Início",
    'L_HOUR' => "Hour",
    'L_HOURS' => "Hours",
    'L_HTACC_ACTIVATE_REWRITE_ENGINE' => "Ativar rewrite",
    'L_HTACC_ADD_HANDLER' => "Adicionar handler",
    'L_HTACC_CONFIRM_DELETE' => "Deve a proteção do diretório ser"
    ." gravada agora ?",
    'L_HTACC_CONTENT' => "Conteúdo do arquivo",
    'L_HTACC_CREATE' => "Criar proteção do diretório",
    'L_HTACC_CREATED' => "A proteção do diretório foi criada.",
    'L_HTACC_CREATE_ERROR' => "Houve um erro durante a criação da"
    ." proteção do diretório !<br />Favor"
    ." criar os 2 arquivos manualmente com o"
    ." seguinte conteúdo",
    'L_HTACC_CRYPT' => "Crypt (Linux e Sistemas Unix)",
    'L_HTACC_DENY_ALLOW' => "Negar / Permitir",
    'L_HTACC_DIR_LISTING' => "Listar Diretórios",
    'L_HTACC_EDIT' => "Editar o .htaccess",
    'L_HTACC_ERROR_DOC' => "Documento de Erro",
    'L_HTACC_EXAMPLES' => "Mais exemplos e documentação",
    'L_HTACC_EXISTS' => "Já existe uma proteção do"
    ." diretório. Se você criar novas, as"
    ." antigas serão sobrescritas !",
    'L_HTACC_MAKE_EXECUTABLE' => "Tornar executável",
    'L_HTACC_MD5' => "MD5 (Linux e Sistemas Unix)",
    'L_HTACC_NO_ENCRYPTION' => "texto plano, sem encriptação"
    ." (Windows)",
    'L_HTACC_NO_USERNAME' => "Você tem que digitar um nome!",
    'L_HTACC_PROPOSED' => "Urgentemente recomendado",
    'L_HTACC_REDIRECT' => "Redirecionar",
    'L_HTACC_SCRIPT_EXEC' => "Executar script",
    'L_HTACC_SHA1' => "SHA1 (all Systems)",
    'L_HTACC_WARNING' => "Atenção! As diretivas do .htaccess"
    ." afetam o comportamento do"
    ." navegador.<br />Com conteúdo"
    ." incorreto, as páginas podem ficar"
    ." inacessíveis.",
    'L_IMPORT' => "Importar configuração",
    'L_IMPORT' => "Importar",
    'L_IMPORTIEREN' => "Importar",
    'L_IMPORTOPTIONS' => "Opções de importação",
    'L_IMPORTSOURCE' => "Fonte da importação",
    'L_IMPORTTABLE' => "Importar para a tabela",
    'L_IMPORT_NOTABLE' => "Nenhuma tabela foi selecionada para"
    ." importação!",
    'L_IN' => "em",
    'L_INFO_ACTDB' => "Banco de dados atual",
    'L_INFO_DATABASES' => "Os seguintes bancos de dados estão no"
    ." seu servidor",
    'L_INFO_DBEMPTY' => "O banco de dados está vazio !",
    'L_INFO_FSOCKOPEN_DISABLED' => "On this server the PHP command"
    ." fsockopen() is disabled by the"
    ." server's configuration. Because of"
    ." this the automatic download of"
    ." language packs is not possible. To"
    ." bypass this, you can download packages"
    ." manually, extract them locally and"
    ." upload them to the directory"
    ." \"language\" of your MySQLDumper"
    ." installation. Afterwards the new"
    ." language pack is available on this"
    ." site.",
    'L_INFO_LASTUPDATE' => "Última atualização",
    'L_INFO_LOCATION' => "Sua localização é",
    'L_INFO_NODB' => "O banco de dados não existe.",
    'L_INFO_NOPROCESSES' => "nenhum processo em execução",
    'L_INFO_NOSTATUS' => "nenhum estado disponível",
    'L_INFO_NOVARS' => "nenhuma variável disponível",
    'L_INFO_OPTIMIZED' => "otimizada",
    'L_INFO_RECORDS' => "Registros",
    'L_INFO_RECORDS' => "registros",
    'L_INFO_SIZE' => "tamanho",
    'L_INFO_SUM' => "Total",
    'L_INSTALL' => "Instalação",
    'L_INSTALL' => "Instalação",
    'L_INSTALLED' => "Installed",
    'L_INSTALL_HELP_PORT' => "(em branco = Porta padrão)",
    'L_INSTALL_HELP_SOCKET' => "(em branco = Socket padrão)",
    'L_IS_WRITABLE' => "Is writable",
    'L_KILL_PROCESS' => "Stop process",
    'L_LANGUAGE' => "Idioma",
    'L_LASTBACKUP' => "Último backup",
    'L_LOAD' => "Usar config. padrão",
    'L_LOAD_DATABASE' => "recarregar bancos de dados",
    'L_LOAD_FILE' => "Load file",
    'L_LOG' => "Log",
    'L_LOGFILENOTWRITABLE' => "Não pude criar o arquivo de log !",
    'L_LOGFILENOTWRITABLE' => "Não pude escrever no arquiuvo de log"
    ." !",
    'L_LOGFILES' => "Logfiles",
    'L_LOG_DELETE' => "excluir log",
    'L_MAILERROR' => "O envio do email falhou!",
    'L_MAILPROGRAM' => "Programa de email",
    'L_MAXSIZE' => "Tamanho máx.",
    'L_MAX_BACKUP_FILES_EACH2' => "Para cada banco de dados",
    'L_MAX_EXECUTION_TIME' => "Max execution time",
    'L_MAX_UPLOAD_SIZE' => "Tamanho máximo do aqruivo",
    'L_MAX_UPLOAD_SIZE' => "Tamanho máximo de arquivo",
    'L_MAX_UPLOAD_SIZE_INFO' => "Se o seu arquivo de dump é maior que"
    ." o limite mencionado acima, você deve"
    ." enviá-lo via FTP para o diretório"
    ." \"work/backup\".
Após fazer isso"
    ." você poderá escolhê-lo novamente"
    ." para iniciar o processo de"
    ." restauração.",
    'L_MEMORY' => "Memory",
    'L_MESSAGE' => "Message",
    'L_MESSAGE_TYPE' => "Message type",
    'L_MINUTE' => "Minute",
    'L_MINUTES' => "Minutes",
    'L_MODE_EASY' => "Easy",
    'L_MODE_EXPERT' => "Expert",
    'L_MSD_INFO' => "Informação do dump MySQL",
    'L_MSD_MODE' => "MySQLDumper-Mode",
    'L_MSD_VERSION' => "MySQLDumper-Version",
    'L_MULTIDUMP' => "Multidump",
    'L_MULTIDUMP_FINISHED' => "Backup do(s) <b>%d</b> banco(s) de"
    ." dados pronto",
    'L_MULTIPART_ACTUAL_PART' => "Actual Part",
    'L_MULTIPART_SIZE' => "tamanho máximo do arquivo",
    'L_MULTI_PART' => "Backup multi-parte",
    'L_MYSQLVARS' => "Variáveis do MySQL",
    'L_MYSQL_CLIENT_VERSION' => "MySQL-Client",
    'L_MYSQL_CONNECTION_ENCODING' => "Standard encoding of MySQL-Server",
    'L_MYSQL_DATA' => "MySQL-Data",
    'L_MYSQL_VERSION' => "MySQL-Version",
    'L_NAME' => "Name",
    'L_NAME' => "Name",
    'L_NEW' => "novo",
    'L_NEWTABLE' => "nova tabela",
    'L_NEXT_AUTO_INCREMENT' => "Next automatic index",
    'L_NEXT_AUTO_INCREMENT_SHORT' => "n. auto index",
    'L_NO' => "não",
    'L_NOFTPPOSSIBLE' => "Você não tem as funções de FTP !",
    'L_NOFTPPOSSIBLE' => "Você não tem alçada para funções"
    ." de FTP !",
    'L_NOFTPPOSSIBLE' => "Você não tem as funções de FTP !",
    'L_NOGZPOSSIBLE' => "Você não tem as funções de"
    ." compressão !",
    'L_NOGZPOSSIBLE' => "Como Zlib não está instalado, você"
    ." não poderá usar as funções do"
    ." GZip!",
    'L_NONE' => "nenhum",
    'L_NOREVERSE' => "Entradas mais antigas primeiro",
    'L_NOTAVAIL' => "<em>não disponível</em>",
    'L_NOTICE' => "Notice",
    'L_NOTICES' => "Notices",
    'L_NOT_ACTIVATED' => "não ativado",
    'L_NOT_SUPPORTED' => "Este backup não suporta esta"
    ." função.",
    'L_NO_DB_FOUND' => "Não pude encontrar nenhuma base de"
    ." dados automaticamente!
Por favor,"
    ." verifique os parâmetros de conexão e"
    ." coloque o nome de seu banco de dados"
    ." manualmente.",
    'L_NO_DB_FOUND_INFO' => "A conexão com o banco de dados foi"
    ." estabelecida com sucesso.<br />
Seus"
    ." dados de usuário são válidos e"
    ." foram aceitos pelo Servidor MySQL.<br"
    ." />
Mas o MySQLDumper não foi capaz de"
    ." encontrar nenhuma base de dados.<br"
    ." />
A detecção automática via script"
    ." é bloqueada em alguns servidores.<br"
    ." />
Você deve colocar seus dados do"
    ." banco de dados manualmente depois de"
    ." terminada a instalação.
Clique em"
    ." \"configurações\" \"Parâmetros de"
    ." Conexão - exibir\" e digite ali o"
    ." nome do banco de dados.",
    'L_NO_DB_SELECTED' => "No database selected.",
    'L_NO_ENTRIES' => "A tabela \"<b>%s</b>\" está vazia e"
    ." não contêm nenhuma entrada.",
    'L_NO_MSD_BACKUPFILE' => "Backups de outros scripts",
    'L_NO_NAME_GIVEN' => "You didn't enter a name.",
    'L_NR_TABLES_OPTIMIZED' => "%s tabelas foram otimizadas.",
    'L_NUMBER_OF_FILES_FORM' => "Excluir pelo número de arquivos",
    'L_OF' => "de",
    'L_OF' => "of",
    'L_OK' => "OK",
    'L_OPTIMIZE' => "Otimizar",
    'L_OPTIMIZE_TABLES' => "Otimizar as tabelas antes do backup",
    'L_OPTIMIZE_TABLE_ERR' => "Error optimizing table `%s`.",
    'L_OPTIMIZE_TABLE_SUCC' => "Optimized table `%s` successfully.",
    'L_OS' => "Operating system",
    'L_PAGE_REFRESHS' => "Pageviews",
    'L_PASS' => "Senha",
    'L_PASSWORD' => "Password",
    'L_PASSWORDS_UNEQUAL' => "As senhas não são idênticas ou são"
    ." nulas !",
    'L_PASSWORD_REPEAT' => "Password (repeat)",
    'L_PASSWORD_STRENGTH' => "Password strength",
    'L_PERLOUTPUT1' => "Entrada no crondump.pl para o"
    ." absolute_path_of_configdir",
    'L_PERLOUTPUT2' => "URL para o navegador ou serviço Cron"
    ." externo",
    'L_PERLOUTPUT3' => "Linha de comando no terminal para o"
    ." Crontab",
    'L_PERL_COMPLETELOG' => "Perl-Complete-Log",
    'L_PERL_LOG' => "Perl-Log",
    'L_PHPBUG' => "Bug em zlib ! Não foi possível"
    ." comprimir!",
    'L_PHPMAIL' => "PHP-Function mail()",
    'L_PHP_EXTENSIONS' => "PHP-Extensions",
    'L_PHP_VERSION' => "PHP-Version",
    'L_POP3_PORT' => "POP3-Port",
    'L_POP3_SERVER' => "POP3-Server",
    'L_PORT' => "Porta",
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
    'L_PREFIX' => "Prefixo",
    'L_PRIMARYKEYS_CHANGED' => "Primary keys changed",
    'L_PRIMARYKEYS_CHANGINGERROR' => "Error changing primary keys",
    'L_PRIMARYKEYS_SAVE' => "Save primary keys",
    'L_PRIMARYKEY_CONFIRMDELETE' => "Really delete primary key?",
    'L_PRIMARYKEY_DELETED' => "Primary key deleted",
    'L_PRIMARYKEY_FIELD' => "Primary key field",
    'L_PRIMARYKEY_NOTFOUND' => "Primary key not found",
    'L_PROCESSKILL1' => "O script tenta abortar o processo",
    'L_PROCESSKILL2' => "para abortar.",
    'L_PROCESSKILL3' => "O script tenta desde",
    'L_PROCESSKILL4' => "sec. abortar o processo",
    'L_PROCESS_ID' => "Process ID",
    'L_PROGRESS_FILE' => "Progress file",
    'L_PROGRESS_OVER_ALL' => "Progresso do todo",
    'L_PROGRESS_OVER_ALL' => "Progresso do todo",
    'L_PROGRESS_TABLE' => "Progresso da tabela",
    'L_PROVIDER' => "Provedor",
    'L_PROZESSE' => "Processos",
    'L_RECHTE' => "Permissões",
    'L_RECORDS' => "Registros",
    'L_RECORDS_INSERTED' => "<b>%s</b> registros inseridos.",
    'L_RECORDS_PER_PAGECALL' => "Records per pagecall",
    'L_REFRESHTIME' => "Refresh time",
    'L_REFRESHTIME_PROCESSLIST' => "Refreshing time of the process list",
    'L_RELOAD' => "Recarregar",
    'L_REMOVE' => "Remove",
    'L_REPAIR' => "Repair",
    'L_RESET' => "Reiniciar",
    'L_RESET_SEARCHWORDS' => "reiniciar pesquisa de palavras",
    'L_RESTORE' => "Restaurar",
    'L_RESTORE_COMPLETE' => "<b>%s</b> tabelas driadas.",
    'L_RESTORE_DB' => "banco de dados '<b>%s</b>' em"
    ." '<b>%s</b>'.",
    'L_RESTORE_DB_COMPLETE_IN' => "Restoring of database '%s' finished in"
    ." %s.",
    'L_RESTORE_OF_TABLES' => "Choose tables to be restored",
    'L_RESTORE_TABLE' => "Restoring of table '%s'",
    'L_RESTORE_TABLES_COMPLETED' => "Até agora <b>%d</b> de <b>%d</b>"
    ." tabelas foram criadas.",
    'L_RESTORE_TABLES_COMPLETED0' => "Até agora <b>%d</b> tabelas foram"
    ." criadas.",
    'L_REVERSE' => "Últimas entradas primeiro",
    'L_SAFEMODEDESC' => "Because PHP is running in safe_mode"
    ." you need to create the following"
    ." directories manually using your"
    ." FTP-Programm:",
    'L_SAVE' => "Salvar",
    'L_SAVEANDCONTINUE' => "Salvar e continuar a instalação",
    'L_SAVE_ERROR' => "Erro - incapaz de salvar"
    ." configuração!",
    'L_SAVE_SUCCESS' => "Configuration was saved succesfully"
    ." into configuration file \"%s\".",
    'L_SAVING_DATA_TO_FILE' => "Saving data of database '%s' to file"
    ." '%s'",
    'L_SAVING_DATA_TO_MULTIPART_FILE' => "Maximum filesize reached: proceeding"
    ." with file '%s'",
    'L_SAVING_DB_FORM' => "Banco de dados",
    'L_SAVING_TABLE' => "Salvando a tabela",
    'L_SEARCH_ACCESS_KEYS' => "Navegação: para frente=ALT+V, para"
    ." trás=ALT+C",
    'L_SEARCH_IN_TABLE' => "Pesquisar na tabela",
    'L_SEARCH_NO_RESULTS' => "A pesquisa por \"<b>%s</b>\" na tabela"
    ." \"<b>%s</b>\" não trouxe nenhum"
    ." resultado!",
    'L_SEARCH_OPTIONS' => "Opções de pesquisa",
    'L_SEARCH_OPTIONS_AND' => "a coluna deve conter todas as palavras"
    ." a pesquisar (E-pesquisar)",
    'L_SEARCH_OPTIONS_CONCAT' => "a linha deve conter todas as palavras"
    ." a pesquisar, mas elas podem estar em"
    ." qualquer coluna (pode levar algum"
    ." tempo)",
    'L_SEARCH_OPTIONS_OR' => "a coluna deve conter uma das palavras"
    ." a pesquisar (OU-pesquisar)",
    'L_SEARCH_RESULTS' => "A pesquisa por \"<b>%s</b>\" na tabela"
    ." \"<b>%s</b>\" levou aos seguintes"
    ." resultados",
    'L_SECOND' => "Second",
    'L_SECONDS' => "Seconds",
    'L_SELECT' => "Select",
    'L_SELECTALL' => "Selecionar tudo",
    'L_SELECTED_FILE' => "Arquivo escolhido",
    'L_SELECT_FILE' => "Select file",
    'L_SELECT_LANGUAGE' => "Select language",
    'L_SENDMAIL' => "Sendmail",
    'L_SENDRESULTASFILE' => "enviar resultado como arquivo",
    'L_SEND_MAIL_FORM' => "Enviar relatório por email",
    'L_SERVER' => "Servidor",
    'L_SERVERCAPTION' => "Exibir servidor",
    'L_SETPRIMARYKEYSFOR' => "Set new primary keys for table",
    'L_SHOWING_ENTRY_X_TO_Y_OF_Z' => "Showing entry %s to %s of %s",
    'L_SHOWRESULT' => "exibir resultado",
    'L_SMTP' => "SMTP",
    'L_SMTP_HOST' => "SMTP-Host",
    'L_SMTP_PORT' => "SMTP-Port",
    'L_SOCKET' => "Socket",
    'L_SPEED' => "Speed",
    'L_SQLBOX' => "SQL-Box",
    'L_SQLBOXHEIGHT' => "Altura da caixa SQL",
    'L_SQLLIB_ACTIVATEBOARD' => "ativar quadro",
    'L_SQLLIB_BOARDS' => "Quadros",
    'L_SQLLIB_DEACTIVATEBOARD' => "desativar quadro",
    'L_SQLLIB_GENERALFUNCTIONS' => "funções gerais",
    'L_SQLLIB_RESETAUTO' => "reiniciar o auto-incremento",
    'L_SQLLIMIT' => "Quantidade de registros por página",
    'L_SQL_ACTIONS' => "Ações",
    'L_SQL_AFTER' => "após",
    'L_SQL_ALLOWDUPS' => "Duplicidade permitida",
    'L_SQL_ATPOSITION' => "inserir na posição",
    'L_SQL_ATTRIBUTES' => "Atributos",
    'L_SQL_BACKDBOVERVIEW' => "Voltar para Visão geral",
    'L_SQL_BEFEHLNEU' => "Novo comando",
    'L_SQL_BEFEHLSAVED1' => "Comando SQL",
    'L_SQL_BEFEHLSAVED2' => "foi adicionada",
    'L_SQL_BEFEHLSAVED3' => "foi salva",
    'L_SQL_BEFEHLSAVED4' => "foi movida acima",
    'L_SQL_BEFEHLSAVED5' => "foi excluida",
    'L_SQL_BROWSER' => "Navegador-SQL",
    'L_SQL_CARDINALITY' => "Cardinalmente",
    'L_SQL_CHANGED' => "foi modificado.",
    'L_SQL_CHANGEFIELD' => "modificar campo",
    'L_SQL_CHOOSEACTION' => "Escolher ação",
    'L_SQL_COLLATENOTMATCH' => "O conjunto de caracteres e"
    ." intercalação não combinam juntos!",
    'L_SQL_COLUMNS' => "Colunas",
    'L_SQL_COMMANDS' => "Comandos SQL",
    'L_SQL_COMMANDS_IN' => "linhas em",
    'L_SQL_COMMANDS_IN2' => "sec. parsed.",
    'L_SQL_COPYDATADB' => "Copiar todo o banco de dados para",
    'L_SQL_COPYSDB' => "Copiar a estrutura do banco de dados",
    'L_SQL_COPYTABLE' => "copiar tabela",
    'L_SQL_CREATED' => "foi criado.",
    'L_SQL_CREATEINDEX' => "criar novo índice",
    'L_SQL_CREATETABLE' => "crair tabela",
    'L_SQL_DATAVIEW' => "Exibir dados",
    'L_SQL_DBCOPY' => "O conteúdo do banco de dados `%s` foi"
    ." copiado no banco de dados `%s`.",
    'L_SQL_DBSCOPY' => "A estrutura do banco de dados `%s` foi"
    ." copiada no banco de dados `%s`.",
    'L_SQL_DELETED' => "foi excluido",
    'L_SQL_DELETEDB' => "Excluir banco de dados",
    'L_SQL_DESTTABLE_EXISTS' => "tabelas de destinação existem !",
    'L_SQL_EDIT' => "editar",
    'L_SQL_EDITFIELD' => "Editar campo",
    'L_SQL_EDIT_TABLESTRUCTURE' => "Edit table structure",
    'L_SQL_EMPTYDB' => "Esvaziar banco de dados",
    'L_SQL_ERROR1' => "Erro na consulta:",
    'L_SQL_ERROR2' => "MySQL diz:",
    'L_SQL_EXEC' => "Executar comando SQL",
    'L_SQL_EXPORT' => "Exportar from banco de dados `%s`",
    'L_SQL_FIELDDELETE1' => "O campo",
    'L_SQL_FIELDNAMENOTVALID' => "Erro: Nenhum nome de campo válido",
    'L_SQL_FIRST' => "primeiro",
    'L_SQL_IMEXPORT' => "Importar-Exportar",
    'L_SQL_IMPORT' => "Importar no banco de dados `%s`",
    'L_SQL_INDEXES' => "Índices",
    'L_SQL_INSERTFIELD' => "inserir campo",
    'L_SQL_INSERTNEWFIELD' => "inserir novo campo",
    'L_SQL_LIBRARY' => "Biblioteca SQL",
    'L_SQL_NAMEDEST_MISSING' => "O nome da destinação está faltando"
    ." !",
    'L_SQL_NEWFIELD' => "Novo campo",
    'L_SQL_NODATA' => "nenhum registro",
    'L_SQL_NODEST_COPY' => "Nenhuma cópia sem destinação !",
    'L_SQL_NOFIELDDELETE' => "A exclusão não é possível porque"
    ." as tabelas devem ter pelo menos um"
    ." campo.",
    'L_SQL_NOTABLESINDB' => "Nenhuma tabela encontrada no banco de"
    ." dados",
    'L_SQL_NOTABLESSELECTED' => "Nenhuma tabela selecionada !",
    'L_SQL_OPENFILE' => "Abrir arquivo SQL",
    'L_SQL_OPENFILE_BUTTON' => "Upload",
    'L_SQL_OUT1' => "Executado",
    'L_SQL_OUT2' => "Comandos",
    'L_SQL_OUT3' => "Haviam",
    'L_SQL_OUT4' => "Comentários",
    'L_SQL_OUT5' => "Devido à saída conter mais de 5000"
    ." linhas ela não será exibida.",
    'L_SQL_OUTPUT' => "Saída SQL",
    'L_SQL_QUERYENTRY' => "A consulta contém",
    'L_SQL_RECORDDELETED' => "O registro foi excluido",
    'L_SQL_RECORDEDIT' => "editar registro",
    'L_SQL_RECORDINSERTED' => "O registro foi adicionado",
    'L_SQL_RECORDNEW' => "novo registro",
    'L_SQL_RECORDUPDATED' => "O registro foi atualizado",
    'L_SQL_RENAMEDB' => "Renomear banco de dados",
    'L_SQL_RENAMEDTO' => "foi renomeado para",
    'L_SQL_SCOPY' => "A estrutura da tabela `%s` foi copiada"
    ." para a tabela `%s`.",
    'L_SQL_SEARCH' => "Pesquisar",
    'L_SQL_SEARCHWORDS' => "Pesquisar palavra(s)",
    'L_SQL_SELECTTABLE' => "selecionar tabela",
    'L_SQL_SHOWDATATABLE' => "Exibir dados da tabela",
    'L_SQL_STRUCTUREDATA' => "Estrutura e dados",
    'L_SQL_STRUCTUREONLY' => "Somente a estrutura",
    'L_SQL_TABLEEMPTIED' => "A tabela `%s` foi excluida.",
    'L_SQL_TABLEEMPTIEDKEYS' => "A tabela `%s` foi excluida e os"
    ." índices reiniciados.",
    'L_SQL_TABLEINDEXES' => "Índices da tabela",
    'L_SQL_TABLENEW' => "Editar tabelas",
    'L_SQL_TABLENOINDEXES' => "Nenhum índices na tabela",
    'L_SQL_TABLENONAME' => "A tabela requer um nome!",
    'L_SQL_TABLESOFDB' => "Tabelas do banco de dados",
    'L_SQL_TABLEVIEW' => "Exibir tabelas",
    'L_SQL_TBLNAMEEMPTY' => "O nome da tabela não pode ser nulo!",
    'L_SQL_TBLPROPSOF' => "Propriedades da tabela",
    'L_SQL_TCOPY' => "A tabela `%s` foi copiada com os dados"
    ." da tabela `%s`.",
    'L_SQL_UPLOADEDFILE' => "arquivo carregado:",
    'L_SQL_VIEW_COMPACT' => "View: compact",
    'L_SQL_VIEW_STANDARD' => "View: standard",
    'L_SQL_VONINS' => "do total",
    'L_SQL_WARNING' => "A execução do comandos SQL pode"
    ." manipular os dados. CUIDADO! Os"
    ." autores não aceitam qualquer"
    ." responsabilidade por danos ou perda de"
    ." dados.",
    'L_SQL_WASCREATED' => "foi criada",
    'L_SQL_WASEMPTIED' => "foi esvaziada",
    'L_STARTDUMP' => "Iniciar backup",
    'L_START_RESTORE_DB_FILE' => "Starting restore of database '%s' from"
    ." file '%s'.",
    'L_START_SQL_SEARCH' => "iniciar pesquisa",
    'L_STATUS' => "Estado",
    'L_STATUS' => "Estado",
    'L_STEP' => "Passo",
    'L_SUCCESS_CONFIGFILE_CREATED' => "Configuration file \"%s\" has"
    ." successfully been created.",
    'L_SUCCESS_DELETING_CONFIGFILE' => "The configuration file \"%s\" has"
    ." successfully been deleted.",
    'L_TABLE' => "Tabela",
    'L_TABLES' => "Tabelas",
    'L_TABLESELECTION' => "Seleção de tabela",
    'L_TABLE_CREATE_SUCC' => "The table '%s' has been created"
    ." successfully.",
    'L_TABLE_TYPE' => "Type",
    'L_TESTCONNECTION' => "Testar conexão",
    'L_THEME' => "Theme",
    'L_TIME' => "Time",
    'L_TIMESTAMP' => "Timestamp",
    'L_TITLE_INDEX' => "Index",
    'L_TITLE_KEY_FULLTEXT' => "Fulltext key",
    'L_TITLE_KEY_PRIMARY' => "Primary key",
    'L_TITLE_KEY_UNIQUE' => "Unique key",
    'L_TITLE_MYSQL_HELP' => "MySQL documentation",
    'L_TITLE_NOKEY' => "No key",
    'L_TITLE_SEARCH' => "Search",
    'L_TITLE_SHOW_DATA' => "Show data",
    'L_TITLE_UPLOAD' => "Upload SQL file",
    'L_TO' => "para",
    'L_TOOLS' => "Ferramentas",
    'L_TOOLS' => "Ferramentas",
    'L_TOOLS_TOOLBOX' => "Selecionar banco de dados / Funções"
    ." de banco de dados / Importar -"
    ." Exportar",
    'L_UNIT_KB' => "KiloByte",
    'L_UNIT_MB' => "MegaByte",
    'L_UNIT_PIXEL' => "Pixel",
    'L_UNKNOWN' => "desconhecido",
    'L_UNKNOWN_SQLCOMMAND' => "comando SQL desconhecido",
    'L_UPDATE' => "Update",
    'L_UPTO' => "até",
    'L_USERNAME' => "Username",
    'L_USE_SSL' => "Use SSL",
    'L_VALUE' => "Valor",
    'L_VERSIONSINFORMATIONEN' => "Versão da informação",
    'L_VIEW' => "exibir",
    'L_VISIT_HOMEPAGE' => "Visit Homepage",
    'L_VOM' => "de",
    'L_WITH' => "com",
    'L_WITHATTACH' => "com anexo",
    'L_WITHOUTATTACH' => "sem anexo",
    'L_WITHPRAEFIX' => "com o prefixo",
    'L_WRONGCONNECTIONPARS' => "Incorreto ou nenhum parâmetro de"
    ." conexão!",
    'L_WRONG_CONNECTIONPARS' => "Os parâmetros de conexão estão"
    ." incorretos !",
    'L_WRONG_RIGHTS' => "O arquivo ou o diretório '%s' não"
    ." tem permissão de escrita para mim.<br"
    ." />
As permissões (chmod) não estão"
    ." configuradas apropriadamente ou não"
    ." há privilégios suficientes para este"
    ." usuário.<br />
Por favor configure"
    ." corretamente as permissões usando o"
    ." programa de FTP.<br />
O arquivo ou"
    ." diretório necessitam de"
    ." configuração para %s.<br />",
    'L_YES' => "sim",
));
