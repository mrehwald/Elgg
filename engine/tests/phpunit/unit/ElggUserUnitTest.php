<?php

/**
 * @group User
 * @group UnitTests
 */
class ElggUserUnitTest extends \Elgg\UnitTestCase {

	public function up() {

	}

	public function down() {

	}

	public function testCanConstructWithoutArguments() {
		$this->assertNotNull(new \ElggUser());
	}

	public function testCanSetNotificationSettings() {

		$obj = $this->getMockBuilder(ElggUser::class)
				->setMethods(['save'])
				->getMock();
		$obj->expects($this->any())
				->method('save')
				->will($this->returnValue(true));

		_elgg_services()->notifications->registerMethod('registered1');
		_elgg_services()->notifications->registerMethod('registered2');

		$obj->setNotificationSetting('registered1', true);
		$obj->setNotificationSetting('registered2', false);
		$obj->setNotificationSetting('unregistered', true);
		
		$user_settings = $obj->getNotificationSettings();
		$this->assertTrue($user_settings['registered1']);
		$this->assertFalse($user_settings['registered2']);
		$this->assertArrayNotHasKey('unregistered', $user_settings);
	}

}
