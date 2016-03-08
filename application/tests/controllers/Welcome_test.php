<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Welcome_test extends TestCase
{
	
	protected $CI; 	
	public function setUp() 
	{ 	
		$this->CI = &get_instance();
	}
	
	public function testGetAirport() 
	{
		$this->CI->load->model('airport_test');
		$airports = $this->CI->airport_test->getAll();
		$this->assertEquals(1, count($airports));
	}
}
