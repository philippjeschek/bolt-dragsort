<?php

declare(strict_types=1);

namespace Jeschek\DragSort;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\CacheAwareInterface;
use Bolt\Widget\CacheTrait;
use Bolt\Widget\Injector\AdditionalTarget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\StopwatchAwareInterface;
use Bolt\Widget\StopwatchTrait;
use Bolt\Widget\TwigAwareInterface;

class SortWidget extends BaseWidget implements TwigAwareInterface, CacheAwareInterface, StopwatchAwareInterface
{
    use CacheTrait;
    use StopwatchTrait;

    protected $name = 'DragSort Widget';
    //protected $target = AdditionalTarget::WIDGET_BACK_DASHBOARD_BELOW_HEADER;
    protected $target = AdditionalTarget::AFTER_JS;

    protected $priority = 200;
    protected $template = '@dragsort-widget/injector.html.twig';
    protected $zone = RequestZone::BACKEND;

    protected $cacheDuration = 0;

    public function run(array $params = []): ?string
    {
        $request = $this->getExtension()->getRequest();

        // Only produce output when editing or creating a Record, with GET method.
        if (!in_array($request->get('_route'),
                ['bolt_content_overview', 'bolt_content_new', 'bolt_content_duplicate'], true) ||
            ($this->getExtension()->getRequest()->getMethod() !== 'GET')) {
            return null;
        }

        // Check if contenttype has field "sort"
        if (isset($this->getTwig()->getGlobals()['config']->get('contenttypes')[$request->attributes->all()['contentType']]['fields']['sort'])) {

            //dd($this->getTwig()->getGlobals()['config']->get('contenttypes')[$request->attributes->all()['contentType']]['fields']);

            // record fields
            //dd($this->getTwig()->getGlobals()['config']->get('contenttypes'));


            // get page
            //dd($request->query->get('page'));

            // contenttype
            //dd($request->attributes->all()['contentType']);

            dump($request->get('page'));

            $page = $request->query->get('page');

            $params['options'] = [
                'contentType' => $request->attributes->all()['contentType'],
                'page' => ($page ?? 1)
            ];

            return parent::run($params);
        }

        return null;
    }
}
