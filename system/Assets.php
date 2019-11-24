<?php

namespace Typemill;

class Assets
{
	protected $baseUrl;
	
	public function __construct($baseUrl)
	{
		$this->baseUrl			= $baseUrl;
		$this->JS 				= array();
		$this->CSS 				= array();
		$this->inlineJS			= array();
		$this->inlineCSS		= array();
		$this->editorJS 		= array();
		$this->editorInlineJS 	= array();
		$this->svgSymbols		= array();
	}
	
	public function addCSS($CSS)
	{
		$CSSfile = $this->getFileUrl($CSS);
		
		if($CSSfile)
		{
			$this->CSS[] = '<link rel="stylesheet" href="' . $CSSfile . '" />';
		}
	}
		
	public function addInlineCSS($CSS)
	{
		$this->inlineCSS[] = '<style>' . $CSS . '</style>';
	}
	
	public function addJS($JS)
	{
		$JSfile = $this->getFileUrl($JS);
		
		if($JSfile)
		{
			$this->JS[] = '<script src="' . $JSfile . '"></script>';
		}
	}

	public function addInlineJS($JS)
	{
		$this->inlineJS[] = '<script>' . $JS . '</script>';
	}

	public function activateVue()
	{
		$vueUrl = '<script src="' . $this->baseUrl . '/system/author/js/vue.min.js"></script>';
		if(!in_array($vueUrl, $this->JS))
		{
			$this->JS[] = $vueUrl;
		}
	}

	public function activateAxios()
	{
		$axiosUrl = '<script src="' . $this->baseUrl . '/system/author/js/axios.min.js"></script>';
		if(!in_array($axiosUrl, $this->JS))
		{
			$this->JS[] = $axiosUrl;

			$axios = '<script>const myaxios = axios.create({ baseURL: \'' . $this->baseUrl . '\' });</script>';
			$this->JS[] = $axios;
		}
	}
	
	public function activateTachyons()
	{
		$tachyonsUrl = '<link rel="stylesheet" href="' . $this->baseUrl . '/system/author/css/tachyons.min.css" />';
		if(!in_array($tachyonsUrl, $this->CSS))
		{
			$this->CSS[] = $tachyonsUrl;
		}
	}

	public function addSvgSymbol($symbol)
	{
		$this->svgSymbols[] = $symbol;
	}

	public function renderCSS()
	{
		return implode('', $this->CSS) . implode('', $this->inlineCSS);
	}
	
	public function renderJS()
	{
		return implode('', $this->JS) . implode('', $this->inlineJS);
	}

	public function renderSvg()
	{
		return implode('', $this->svgSymbols);
	}

	# add JS to enhance the blox-editor in author area
	public function addEditorJS($JS)
	{
		$JSfile = $this->getFileUrl($JS);
		
		if($JSfile)
		{
			$this->editorJS[] = '<script src="' . $JSfile . '"></script>';
		}
	}

	public function addEditorInlineJS($JS)
	{
		$this->editorInlineJS[] = '<script>' . $JS . '</script>';
	}

	public function renderEditorJS()
	{
		return implode('', $this->editorJS) . implode('', $this->editorInlineJS);
	}

	/**
	 * Checks, if a string is a valid internal or external ressource like js-file or css-file
	 * @params $path string
	 * @return string or false 
	 */
	public function getFileUrl($path)
	{
		$internalFile = __DIR__ . '/../plugins' . $path;
		
		if(file_exists($internalFile))
		{
			return $this->baseUrl . '/plugins' . $path;
		}
		
		return $path;
		
		if(fopen($path, "r"))
		{
			return $path;
		}
		
		return false;		
	}
}