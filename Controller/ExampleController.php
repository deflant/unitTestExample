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
}