<?php
class Pagination
{
    private $totalItem;
    private $totalItemPage;
    private $totalPage;
    private $currentPage;
    private $pageRange;
    public function __construct($totalItem, $arData)
    {
        echo '<pre>';
        print_r($arData);
        echo '</pre>';
        $this->totalItem     = $totalItem;
        $this->totalItemPage = $arData['totalItemPerPage'];
        $this->totalPage     = ceil($totalItem / $this->totalItemPage);
        $this->pageRange   = $arData['pageRange'];
        $this->currentPage = $arData['currentPage'];
    }

    public function showPagination($link)
    {
        $pagination = '';
        $start = '<li><a href="#">Start</a></li>';
        $prev  = '<li><a href="#">previous</a></li>';
        if($this->totalPage > 1){
            $start 	= '<div class="button2-right off"><div class="start"><span>Start</span></div></div>';
            $prev 	= '<div class="button2-right off"><div class="prev"><span>Pre</span></div></div>';
            if($this->currentPage > 1){
                $start 	= '<div class="button2-right"><div class="start"><a onclick="javascript:changePage(1)" href="#">Start</a></div></div>';
                $prev 	= '<div class="button2-right"><div class="prev"><a onclick="javascript:changePage('.($this->currentPage-1).')" href="#">Previous</a></div></div>';
            }

            $next 	= '<div class="button2-left off"><div class="next"><span>Next</span></div></div>';
            $end 	= '<div class="button2-left off"><div class="end"><span>End</span></div></div>';
            if($this->currentPage < $this->totalPage){
                $next 	= '<div class="button2-left"><div class="next"><a  onclick="javascript:changePage('.($this->currentPage+1).')" href="#">Next</a></div></div>';
                $end 	= '<div class="button2-left"><div class="end"><a onclick="javascript:changePage('.$this->totalPage.')" href="#">End</a></div></div>';
            }
            $pageItem = '';
            if ($this->pageRange < $this->totalPage) {
                if ($this->currentPage == 1) {
                    $startPage = 1;
                    $endPage   = $this->pageRange;
                } else if ($this->currentPage == $this->totalPage) {
                    $startPage = $this->totalPage - $this->pageRange + 1;
                    $endPage   = $this->totalPage;
                } else {
                    if ($this->pageRange % 2 == 0) {
                        $startPage = $this->currentPage - ($this->pageRange + 1 - 1) / 2;
                        $endPage   = $this->currentPage + ($this->pageRange + 1 - 1) / 2;
                    } else {
                        $startPage = $this->currentPage - ($this->pageRange - 1) / 2;
                        $endPage   = $this->currentPage + ($this->pageRange - 1) / 2;
                    }

                    if ($startPage < 1) {
                        $startPage = 1;
                        $endPage   = $endPage + 1;
                    }
                    if ($this->currentPage > 2 && $this->pageRange % 2 == 0) {
                        $endPage = $endPage - 1;
                    }

                    if ($this->pageRange > 6 && $this->pageRange > $endPage) {
                        if ($this->pageRange % 2 == 0) {
                            $endPage += ($this->pageRange - 5) - 2;
                        } else {
                            $endPage += ($this->pageRange - 5) - 1;
                        }
                    }

                    if ($endPage > $this->totalPage) {
                        $endPage   = $this->totalPage;
                        $startPage = $endPage - $this->pageRange + 1;
                    }
                }
            } else {
                $startPage = 1;
                $endPage   = $this->totalPage;
            }

            $listPages = '<div class="button2-left"><div class="page">';
            for($i = $startPage; $i <= $endPage; $i++){
                if($i == $this->currentPage) {
                    $listPages .= '<span>'.$i.'</span>';
                }else{
                    $listPages .= '<a onclick="javascript:changePage('.$i.')" href="#">'.$i.'</a>';
                }
            }
            $listPages .= '</div></div>';
            $endPagination	= '<div class="limit">Page '.$this->currentPage.' of '.$this->totalPage.'</div>';
            $pagination = '<div class="pagination">' . $start . $prev . $listPages . $next . $end . $endPagination . '</div>';
        }
        return $pagination;
    }
}