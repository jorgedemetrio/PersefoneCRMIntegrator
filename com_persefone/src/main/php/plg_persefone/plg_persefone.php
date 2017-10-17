<?php
// no direct access
defined( '_JEXEC' ) || die;

class plgSystemPersefone extends JPlugin
{
	/**
	 * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
	 * If you want to support 3.0 series you must override the constructor
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Plugin method with the same name as the event will be called automatically.
	 */
	function onAfterRender()
	{
		if(!isset($_SESSION['paginas'])){
			
			
		}
		return true;
	}
}