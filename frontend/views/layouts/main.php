<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\assets\BackendAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $this->registerCsrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

    <!-- Favicon -->
    <link href="./favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Outros JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <?php

    use yii\helpers\Url;

    // Registering the CSS file in your layout
    $this->registerCssFile(Url::to('@web/css/site.css'));

    // Libraries Stylesheet
    $this->registerCssFile(Url::to('@web/lib/animate/animate.min.css'));
    $this->registerCssFile(Url::to('@web/lib/owlcarousel/assets/owl.carousel.min.css'));
    $this->registerCssFile(Url::to('@web/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css'));

    // Customized Bootstrap Stylesheet
    $this->registerCssFile(Url::to('@web/css/bootstrap.min.css'));

    // Registering the JS file in your layout
    $this->registerJsFile(Url::to('@web/js/main.js'), ['depends' => [\yii\web\JqueryAsset::class]]);

    // JavaScript Libraries
    $this->registerJsFile(Url::to('@web/lib/wow/wow.min.js'));
    $this->registerJsFile(Url::to('@web/lib/easing/easing.min.js'));
    $this->registerJsFile(Url::to('@web/lib/waypoints/waypoints.min.js'));
    $this->registerJsFile(Url::to('@web/lib/counterup/counterup.min.js'));
    $this->registerJsFile(Url::to('@web/lib/owlcarousel/owl.carousel.min.js'));
    $this->registerJsFile(Url::to('@web/lib/tempusdominus/js/moment.min.js'));
    $this->registerJsFile(Url::to('@web/lib/tempusdominus/js/moment-timezone.min.js'));
    $this->registerJsFile(Url::to('@web/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js'));

    ?>

</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Sobre nós', 'url' => ['/site/about']],
            ['label' => 'Reserva', 'url' => ['/site/contact']],
            ['label' => 'Pratos', 'url' => ["/plate"]],
        ];
        if (Yii::$app->user->isGuest)
        {
            $menuItems[] = ['label' => 'Registar', 'url' => ['/site/signup']];
        }
        else
        {
            array_push($menuItems, ['label' => 'Favoritos', 'url' => ["/favorite"]]);

            $userID = Yii::$app->user->getId();
            array_push($menuItems, ['label' => 'Utilizador', 'url' => ["/user/view?id=$userID"]]);
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (Yii::$app->user->isGuest)
        {
            echo Html::tag('div', Html::a('Login', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
        }
        else
        {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout text-decoration-none']
                )
                . Html::endForm();
        }
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
