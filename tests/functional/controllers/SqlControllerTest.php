<?php
/**
 * @group Sql
 */
class Msd_Application_Controller_SqlControllerTest
    extends ControllerTestCase
{
    public function testCanShowDatabaseList()
    {
        $this->loginUser();
        $this->dispatch('sql');
        // make sure headline of db list is shown with correct user
        $expected = "Datenbanken des Benutzers 'root'@'localhost'";
        $this->assertQueryContentContains('h2', $expected);
        // make sure we see the "show tables" link for db information_schema
        $expected = base64_encode("information_schema");
        $this->assertXpath("//a[contains(@href, '" . $expected ."')]");
    }

    public function testCanShowTableList()
    {
        $this->loginUser();
        $this->dispatch('sql/show.tables/dbName/bXlzcWw%3D');
        // make sure headline shows the selected database
        $expected = 'Tabellen der Datenbank `mysql`';
        $this->assertQueryContentContains('h2', $expected);
        // make sure we see the detail link for table `mysql`.`db`
        $expected = 'columns_priv';
        $this->assertQueryContentContains('table > tr > td > label', $expected);
    }

    public function testCanShowTableData()
    {
        $this->loginUser();
        $this->dispatch('sql/show.table.data/dbName/bXlzcWw%3D/tableName/dXNlcg%3D%3D');
        // make sure headline shows the selected table
        $expected = 'Datensätze der Tabelle `mysql`.`user`';
        $this->assertQueryContentContains('h2', $expected);
        // make sure user root@localhost is shown
        $expected = 'localhost        ';
        $this->assertQueryContentContains('table > tr > td', $expected);
        $expected = 'root        ';
        $this->assertQueryContentContains('table > tr > td', $expected);
    }

    public function testCanFallbackToShowingDataOfFirstTableOnIncorrectTable()
    {
        $this->loginUser();
        $this->dispatch('sql/show.table.data/dbName/bXlzcWw%3D/tableName/iDontExits');
        // we excpect a fall back to the first found table in db `mysql`
        $expected = 'Datensätze der Tabelle `mysql`.`columns_priv`';
        $this->assertQueryContentContains('h2', $expected);
    }

    public function testCanCreateADatabase()
    {
        $this->loginUser();
        //drop our testDb if it exists
        $db = Msd_Db::getAdapter();
        $db->query('DROP DATABASE IF EXISTS `testDb`');
        $this->request->setMethod('POST');
        $newDbInfo = array(
                        'dbName'         => 'testDb',
                        'dbCharset'      => 'utf8',
                        'dbCollation'    => 'utf8_general_ci'
        );
        $this->request->setPost('newDbInfo', $newDbInfo);
        $this->dispatch('sql/create.database');
        $expected = 'Die Datenbank \'testDb\' wurde erfolgreich erstellt.';
        $this->assertQueryContentContains('div', $expected);

        // retry to create the same database - should fail ;)
        $this->request->setPost('newDbInfo', $newDbInfo);
        $this->dispatch('sql/create.database');
        $expected = 'Die Datenbank wurde nicht erstellt.';
        $this->assertQueryContentContains('div', $expected);

        // clean up
        $db->query('DROP DATABASE IF EXISTS `testDb`');
    }

    public function testCanDropADatabase()
    {
        $this->loginUser();
        //create our testDb if it exists
        $db = Msd_Db::getAdapter();
        $sql = 'CREATE DATABASE `testDb` DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_general_ci';
        $db->query($sql);
        // now let's see if we can drop it
        $this->request->setMethod('POST');
        $this->request->setPost('dbNames', array(base64_encode('testDb')));
        $this->dispatch('sql/drop.database');

        // check action output
        $this->assertQueryContentContains('h4', 'Aktion - Datenbank löschen:');
        $this->assertQueryContentContains('td', 'testDb');
        $this->assertQueryContentContains('td', 'DROP DATABASE `testDb`;');
        // look for the "ok" icon
        $this->assertQueryContentContains('td', '/css/msd/icons/16x16/Apply.png');
    }
}