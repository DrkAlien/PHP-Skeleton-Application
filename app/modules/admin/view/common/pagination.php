<?php
if($this->data->total()) {
    // create the next and prev links with params
    $this->requestParams['page'] = 'page/'.($this->data->currentPage()-1);
    $prevPageUrl = $this->getActionUrl().'/'.implode('/',$this->requestParams);
    $this->requestParams['page'] = 'page/'.($this->data->currentPage()+1);
    $nextPageUrl = $this->getActionUrl().'/'.implode('/',$this->requestParams);
?>
    <p class="m-0 text-muted"><span><?php echo $this->data->total()  ?></span> entries</p>
    <ul class="pagination m-0 ms-auto">

        <?php if($this->data->currentPage() > 1) { ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $prevPageUrl ?>" tabindex="-1" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
                    prev
                </a>
            </li>
        <?php } ?>


        <?php
        // substract & add 3 pages from current page and list the pages
        $pageNrs = 3;
        $firstPage = $this->data->currentPage() - $pageNrs;
        $lastPage = $this->data->currentPage() + $pageNrs;
        for($i = $firstPage; $i<=$lastPage; $i++) {
            if($i <= 0) {continue;}
            $this->requestParams['page'] = 'page/'.$i;
            $active = ($i == $this->data->currentPage())? 'active':'';
            echo '<li class="page-item '.$active.'"><a class="page-link" href="'.$this->getActionUrl().'/'.implode('/',$this->requestParams).'">'.$i.'</a></li>';
            if($i >= $this->data->lastPage()) {break;}
        }
        ?>

        <?php if($this->data->currentPage() < $this->data->lastPage()) { ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo $nextPageUrl ?>">
                    next
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>
                </a>
            </li>
        <?php } ?>

    </ul>
<?php } else { ?>
    <p class="m-0 text-muted"><span>N\A</span> entries</p>
<?php } ?>