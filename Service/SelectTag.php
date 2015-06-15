<?php

namespace Service;

/**
 * Class SelectTag
 * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
 * @package Service
 */
class SelectTag
{
    private $container;

    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * Returns one tag of document
     * @param $data
     * @return string
     * Created by Thibaut Deflandre <thibaut.deflandre@gmail.com>
     */
    private function selectTag($data)
    {
        $tag = null;
        if ($data != null) {
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
        }

        return $tag;
    }
}