<?php

require_once("../bootstrap.php");

class PrivacyGroupsTest extends WebTestCase
{
	public $fixtures=array(
			'privacyGroups'=>'PrivacyGroups',
	);

	protected function setUp()
	{
		$this->setBrowser("*firefox");
		$this->setBrowserUrl("http://localhost/Traceper_WebInterface/");
	}

	public function testCreateGroup()
	{
		$this->open("index-test.php");
		$this->click("id=showLoginWindow");

		// after click the window it loads windows so we need to wait a little
		for ($second = 0; ; $second++) {
			if ($second >= 60) $this->fail("timeout");
			try {
				if ($this->isElementPresent("id=LoginForm_email")) break;
			} catch (Exception $e) {
			}
			sleep(1);
		}

		//$this->waitForElementPresent("id=showLoginWindow");

		$this->type("id=LoginForm_email", "test@traceper.com");
		$this->type("id=LoginForm_password", "12345");
		$this->click("id=yt0");

		$this->click("css=#createGroup > img");
		sleep(3);
		$this->type("id=NewGroupForm_name", "deneme");
		$this->select("id=NewGroupForm_groupType", "label=Arkadaş Grubu");
		$this->type("id=NewGroupForm_description", "deneme");
		$this->click("xpath=(//input[@id='yt0'])[2]");

		$this->click("css=#createGroup > img");
		sleep(3);
		$this->type("id=NewGroupForm_name", "deneme");
		$this->select("id=NewGroupForm_groupType", "label=Arkadaş Grubu");
		$this->type("id=NewGroupForm_description", "deneme");
		$this->click("xpath=(//input[@id='yt0'])[2]");
		$this->click("//button[@type='button']");


		$this->click("css=#createGroup > img");
		sleep(3);
		$this->type("id=NewGroupForm_name", "Test");
		$this->select("id=NewGroupForm_groupType", "label=Personel Grubu");
		$this->type("id=NewGroupForm_description", "Test");
		$this->click("xpath=(//input[@id='yt0'])[2]");

		$this->click("css=#createGroup > img");
		sleep(3);
		$this->type("id=NewGroupForm_name", "Test");
		$this->select("id=NewGroupForm_groupType", "label=Personel Grubu");
		$this->type("id=NewGroupForm_description", "Test");
		$this->click("xpath=(//input[@id='yt0'])[2]");
		$this->click("//button[@type='button']");
	}

	public function testUpdateGroup()
	{
		$this->open("index-test.php");
		$this->click("id=showLoginWindow");

		// after click the window it loads windows so we need to wait a little
		for ($second = 0; ; $second++) {
			if ($second >= 60) $this->fail("timeout");
			try {
				if ($this->isElementPresent("id=LoginForm_email")) break;
			} catch (Exception $e) {
			}
			sleep(1);
		}

		$this->type("id=LoginForm_email", "test@traceper.com");
		$this->type("id=LoginForm_password", "12345");
		$this->click("id=yt0");

		$this->click("id=groupSettingsWindow");
		for ($second = 0; ; $second++) {
			if ($second >= 60) $this->fail("timeout");
			try {
				if ($this->isElementPresent("id=groupSettingsWindow")) break;
			} catch (Exception $e) {
			}
			sleep(1);
		}
	}

	public function testGetGroupList()
	{
		$this->open("index-test.php");
		$this->click("id=showLoginWindow");

		// after click the window it loads windows so we need to wait a little
		for ($second = 0; ; $second++) {
			if ($second >= 60) $this->fail("timeout");
			try {
				if ($this->isElementPresent("id=LoginForm_email")) break;
			} catch (Exception $e) {
			}
			sleep(1);
		}

		$this->type("id=LoginForm_email", "test@traceper.com");
		$this->type("id=LoginForm_password", "12345");
		$this->click("id=yt0");


		$this->click("link=".Yii::t('layout', 'Friend Groups'));
		$this->waitForElementPresent("id=friendGroupsListView");
		$this->verifyTextPresent("Hiçbir grup bulunamadı");

		$this->click("link=".Yii::t('layout', 'Staff Groups'));
		$this->waitForElementPresent("id=staffGroupsListView");
		$this->verifyTextPresent("Hiçbir grup bulunamadı");

	}
}
