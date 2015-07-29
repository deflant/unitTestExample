<?php

namespace Controller;

class ExampleController
{
    /**
     * Returns one tag of document
     * @param GenericEdito $data
     * @return string
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    private function selectTag($data)
    {
        $tag = $data->getCategory();
        if (count($data->getTags()) == 1) {
            $tag = $data->getTags();
        } elseif (count($data->getTags()) > 1) {
            // Choose a random tag, but this tag cannot be the master tag
            while ($tag == $data->getCategory()) {
                $randNumber = rand(0, count($data->getTags()) - 1);
                $tag = $data->getTags()[$randNumber];
            }
        }
        return $tag;
    }

    /**
     * @param $apiCaller
     * @param $landing
     * @param $tagSlug
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    protected function setFeaturedHandler($apiCaller, $landing, $tagSlug)
    {
        if ($landing != null) {
            return $this->get('listing_content')->getListingContent(
                $apiCaller,
                $this->container->getParameter('editorial_api'),
                [
                    "fl" => "someparameters",
                    "editorial_content_type" => $landing,
                    "locale" => $this->container->getParameter('editorial_locale'),
                ]
            );
        } elseif ($tagSlug != null) {
            return $this->get('listing_content')->getListingContent(
                $apiCaller,
                $this->container->getParameter('editorial_api'),
                [
                    "tag" => $tagSlug,
                    "fl" => "someparameters",
                    "locale" => $this->container->getParameter('editorial_locale'),
                ]
            );
        }

        return null;
    }
}