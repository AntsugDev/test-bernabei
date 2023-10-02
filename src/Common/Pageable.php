<?php

namespace App\Common;

class Pageable
{


    private int $page;
    private int $size;
    private string $order;
    private string $sortBy;

    private array $content;

    public function __construct(int $page, int $size, string $order, string $sortBy, array $content)
    {
        $this->page = $page;
        $this->size = $size;
        $this->order = $order;
        $this->sortBy = $sortBy;
        $this->content = $content;
    }




    private function init()
    {
        return array(
            "content" => [],
            "page" => 0,
            "totalPage" => 0,
            "sortBy" => "",
            "order" => 'DESC',
            "totalElements" => 0
        );
    }


    public function toArray()
    {
        try {
            $array = $this->init();
            $column = array_column($this->content, $this->sortBy);

            if (strcmp(strtoupper($this->order), 'DESC') === 0)
                array_multisort($column, SORT_DESC, $this->content);
            else
                array_multisort($column, SORT_ASC, $this->content);

            $chunk = array_chunk($this->content, $this->size);
            $array['content'] = $chunk[intval($this->page)];
            $array['totalPage'] = count($chunk);
            $array['totalElements'] = count($this->content);
            $array['page'] = $this->page;
            $array['order'] = $this->order;
            $array['sortBy'] = $this->sortBy;
            return $array;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }
}
