<?php

declare(strict_types=1);

namespace Jeschek\DragSort\Controller;

use Bolt\Extension\ExtensionController;
use Bolt\Factory\ContentFactory;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller extends ExtensionController
{
    /**
     * @Route("/dragsort", name="dragsort_sort", methods={"POST"})
     */
    public function handleDragSort(Request $request, ContentFactory $contentFactory): JsonResponse
    {
        return $this->handleRequest($request, $contentFactory);
    }

    private function handleRequest(Request $request, ContentFactory $contentFactory)
    {

        $contentType = $request->get('contentType');
        $page = $request->get('page');
        $order = $request->get('order');

        if (!isset($this->getTwig()->getGlobals()['config']->get('contenttypes')[$contentType]['fields']['sort'])) {
            return new JsonResponse([
                'error' => true,
            ], Response::HTTP_NOT_FOUND);
        }

        $perPage = $this->getTwig()->getGlobals()['config']->get('contenttypes')[$contentType]['records_per_page'];

        $sort = 1 + (($page-1)*$perPage);

        $startTimestamp = strtotime('2000-01-01');

        $timestamp = $startTimestamp - (($page-1)*$perPage*3600);

        foreach ($order as $id) {
            $content = $contentFactory->upsert($contentType, [
                'id' => $id
            ]);

            $date = new DateTime();
            $date->setTimestamp($timestamp);

            $content->setCreatedAt($date);

            $content->setFieldValue('sort', $sort);

            $contentFactory->save($content);

            $sort++;

            $timestamp = $timestamp - 3600;
        }

        return new JsonResponse([
            'error' => false,
        ], Response::HTTP_OK);
    }
}