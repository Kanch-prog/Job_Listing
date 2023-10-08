<?php
class Pagination {
    private $totalItems;
    private $itemsPerPage;
    private $currentPage;

    public function __construct($totalItems, $itemsPerPage, $currentPage) {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
    }

    public function getTotalPages() {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    public function getOffset() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }
}
?>