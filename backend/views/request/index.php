<div class="request-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (!empty($groupedRequests)) : ?>
        <div class="request-index">
            <?php foreach ($groupedRequests as $dinnerTableId => $requests) : ?>
                <div class="dinner-table">
                    <h3>MESA: <?= $dinnerTableId; ?></h3>
                    <?= $this->render('_gridview', ['data' => $requests, 'isAdmin' => false]); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <?= $this->render('_gridview', ['data' => $dataProvider, 'isAdmin' => true]); ?>
    <?php endif; ?>
</div>
