<?php

namespace Plugins\contactform;

use \Typemill\Plugin;

class ContactForm extends Plugin
{
	protected $item;
	protected $originalHtml;
	protected $pluginSettings;
	
    public static function getSubscribedEvents()
    {
		return array(
			'onSessionSegmentsLoaded' 	=> 'onSessionSegmentsLoaded',
			'onOriginalLoaded' 			=> 'onOriginalLoaded',
			'onHtmlLoaded' 				=> 'onHtmlLoaded',
		);
    }

	public function onSessionSegmentsLoaded($segments)
	{
		$this->pluginSettings = $this->getPluginSettings('contactform');
		
		if($this->getPath() == $this->pluginSettings['page'])
		{
			$data = $segments->getData();
			$data[] = $this->pluginSettings['page'];
			$segments->setData($data);
		}
	}
	
	public function onOriginalLoaded($original)
	{		
		if(substr($this->getPath(), 0, strlen($this->pluginSettings['area'])) === $this->pluginSettings['area'])
		{
			# get original html without manipulations
			$this->originalHtml = $original->getHTML();
		}
	}
	
	public function onHtmlLoaded($html)
	{		
		if(substr($this->getPath(), 0, strlen($this->pluginSettings['area'])) === $this->pluginSettings['area'])
		{
			$content = $this->originalHtml;
			
			if($this->getPath() == $this->pluginSettings['page'])
			{
				# add css 
				# $this->addCSS('/textadds/css/textadds.css');

				# get Twig Instance and add the cookieconsent template-folder to the path
				$twig 	= $this->getTwig();
				$loader = $twig->getLoader();
				$loader->addPath(__DIR__ . '/templates');

				# fetch the template and render it with twig
				$contactform = $twig->fetch('/contactform.twig', $this->pluginSettings);
				
				$content = $this->originalHtml . $contactform;
			}
			
			$html->setData($content);
			$html->stopPropagation();			
		}
	}
}