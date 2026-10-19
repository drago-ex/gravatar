<?php

declare(strict_types=1);

namespace Drago\Gravatar;

use Nette\Application\UI\Presenter;
use Nette\Bridges\ApplicationLatte\DefaultTemplate;
use Nette\Bridges\ApplicationLatte\Template;


/**
 * Passes the Gravatar URL to the presenter template as $gravatar, once an email is set.
 * A typed template class must declare a `public string $gravatar` property.
 */
trait GravatarAdapter
{
	private Gravatar $gravatar;


	public function injectGravatar(Gravatar $gravatar, Presenter $presenter): void
	{
		$this->gravatar = $gravatar;
		$presenter->onRender[] = function () use ($presenter): void {
			$template = $presenter->getTemplate();
			if (!$template instanceof Template || !$this->gravatar->hasEmail()) {
				return;
			}

			$url = $this->gravatar->getGravatar();
			if ($template instanceof DefaultTemplate) {
				$template->setParameters(['gravatar' => $url]);
			} else {
				$template->gravatar = $url;
			}
		};
	}
}
