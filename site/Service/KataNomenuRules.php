<?php

namespace Kata\Component\Kata\Site\Service;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Component\Router\RouterView;

use Joomla\CMS\Component\Router\Rules\RulesInterface;
class KataNomenuRules implements RulesInterface

{
	protected $router;

	public function __construct(RouterView $router)

	{

		$this->router = $router;

	}

	public function preprocess(&$query)

	{

		$test = 'Test';

	}

	public function parse(&$segments, &$vars)

	{

		//with this url: http://localhost/j4x/my-walks/mywalk-n/walk-title.html

		// segments: [[0] => mywalk-n, [1] => walk-title]

		// vars: [[option] => com_kata, [view] => mywalks, [id] => 0]



		$vars['view'] = 'mywalk';

		$vars['id'] = substr($segments[0], strpos($segments[0], '-') + 1);

		array_shift($segments);

		array_shift($segments);

		return;

	}


	public function build(&$query, &$segments)

	{

		// content of $query ($segments is empty or [[0] => mywalk-3])

		// when called by the menu: [[option] => com_kata, [Itemid] => 126]

		// when called by the component: [[option] => com_kata, [view] => mywalk, [id] => 1, [Itemid] => 126]

		// when called from a module: [[option] => com_kata, [view] => mywalks, [format] => html, [Itemid] => 126]

		// when called from breadcrumbs: [[option] => com_kata, [view] => mywalks, [Itemid] => 126]



		// the url should look like this: /site-root/mywalks/walk-n/walk-title.html



		// if the view is not mywalk - the single walk view

		if (!isset($query['view']) || (isset($query['view']) && $query['view'] !== 'mywalk') || isset($query['format']))

		{

			return;

		}

		$segments[] = $query['view'] . '-' . $query['id'];

		$segments[] = $query['slug'];

		unset($query['view']);

		unset($query['id']);

		unset($query['slug']);

	}

}



