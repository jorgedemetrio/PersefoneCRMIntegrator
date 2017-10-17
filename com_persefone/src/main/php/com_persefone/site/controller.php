<?php

/*------------------------------------------------------------------------
# controller.php - persefone Component
# ------------------------------------------------------------------------
# author    Jorge Demetrio
# copyright Copyright (C) 2015. All Rights Reserved
# license   GNU/GPL Version 3 || later - http://www.gnu.org/licenses/gpl-2.0.html
# website   www.alldreams.com.br
-------------------------------------------------------------------------*/
// No direct access to this file
defined('_JEXEC') || die('Restricted access');
// import Joomla controller library

jimport('joomla.application.component.controller');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.application.component.helper');
jimport( 'joomla.application.module.helper' );
jimport( 'joomla.mail.mail' );
jimport('joomla.log.log');



/**
 * persefone Component Controller
 */
class PersefoneController extends JControllerLegacy{
	
	function display($cachable = false, $urlparams = false) {
		// set default view if not set
		JRequest::setVar ( 'view', JRequest::getCmd ( 'view', 'Persefone' ) );

		// call parent behavior
		parent::display ( $cachable );

		// set view
		$view = strtolower ( JRequest::getVar ( 'view' ) );

	}


	/**
	 * Sitemap content
	 */
	public function sitemapContent(){
		$db = JFactory::getDbo ();
		$query = $db->getQuery ( true );
		$query->select("`id` , id + ':' + alias as slug, catid, language, modified  ")
		->from ('#__content')
		->where ('(' . $db->quoteName ( 'publish_up' ) . '  <= NOW()  || '
				. $db->quoteName ( 'publish_up' ) . ' IS NULL || '
				. $db->quoteName ( 'publish_up' ) . " = '0000-00-00 00:00:00' )" )
				->where ( $db->quoteName ( 'state' ) . ' = 1  ' )
				->order('created DESC')
				->setLimit(50000);
		$db->setQuery ( $query );
		$results = $db->loadObjectList();
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
		foreach ( $results as $result){
			$url = $_SERVER['HTTP_HOST'] . JRoute::_(ContentHelperRoute::getArticleRoute($result->slug, $result->catid, $result->language));
			$xml = $xml . "\t<url>\n";
			$xml = $xml . "\t\t<lastmod>" . JFactory::getDate($result->modified)->format('Y-m-d\TH:i:sP')  . "</lastmod>\n";
			$xml = $xml . "\t\t<changefreq>monthly</changefreq>\n";
			$xml = $xml . "\t\t<priority>0.3</priority>\n";
			$xml = $xml . "\t\t<loc>http://" .  $url . "</loc>\n";
			$xml = $xml . "\t</url>\n";
		}
		$xml = $xml . '</urlset>';
		header('Content-type: application/xml');
		echo($xml);
		exit();
	}
	


    public function sitemapTags(){
            $db = JFactory::getDbo ();
            $query = $db->getQuery ( true );
            $query->select("`id` , path ")
            ->from ('#__tags')
                                ->order('published DESC')
                                ->setLimit(50000);
            $db->setQuery ( $query );
            $results = $db->loadObjectList(); 
            $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
            foreach ( $results as $result){ 
                        $url = $_SERVER['HTTP_HOST'].'/component/tags/tag/' . $result->id  . '-' . $result->path  . '.html';
                        $xml = $xml . "\t<url>\n"; 
                        $xml = $xml . "\t\t<changefreq>monthly</changefreq>\n"; 
                        $xml = $xml . "\t\t<priority>0.3</priority>\n";
                        $xml = $xml . "\t\t<loc>http://" .  $url . "</loc>\n";
                        $xml = $xml . "\t</url>\n";
            }
            $xml = $xml . '</urlset>';
            header('Content-type: application/xml');
            echo($xml);
            exit();
      }

      
      public function sitemapOutros(){
      	$db = JFactory::getDbo ();
      	$query = $db->getQuery ( true );
      	$query->select("`id` , url , prioridade ")
      	->from ('#__mom_dyna_page')
      	->order('data_alteracao DESC')
      	->setLimit(50000);
      	$db->setQuery ( $query );
      	$results = $db->loadObjectList();
      	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
      	foreach ( $results as $result){
      		$url = (strpos( $result->url,$_SERVER['HTTP_HOST'])===false? $_SERVER['HTTP_HOST'] : "" )  . $result->url  ;
      		$xml = $xml . "\t<url>\n";
      		$xml = $xml . "\t\t<changefreq>monthly</changefreq>\n";
      		$xml = $xml . "\t\t<priority>" . $result->prioridade  . "</priority>\n";
      		$xml = $xml . "\t\t<loc>http://" .  $url . "</loc>\n";
      		$xml = $xml . "\t</url>\n";
      	}
      	$xml = $xml . '</urlset>';
      	header('Content-type: application/xml');
      	echo($xml);
      	exit();
      }
	
	/**
	 * Sitemap dos menus
	 */
	function sitemapMenus(){
		$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
		$xml = $xml . '</urlset>';
		header('Content-type: application/xml');
		echo($xml);
		exit();
	}


	
	/**
	 * Carrega a tela de bsuca
	 */
	public function buscar(){
		$q = JRequest::getVar('q');
		JSearchHelper::logSearch($q, 'com_search');
	
		JRequest::setVar ( 'view', 'busca' );
		JRequest::setVar ( 'layout', 'default' );
		parent::display (true, false);
	}


}