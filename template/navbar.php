<nav class="navbar fixed-top navbar-expand-lg navbar-style">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="<?= $_cfg['site_logo'] ?>" alt="<?= $_cfg['site_name'] ?> icon" class="rounded" style="width:40px;">
            <?= $_cfg['site_name'] ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbartoggler" aria-controls="navbartoggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbartoggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="bi bi-house-door-fill"></i> Home</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="/backend">Backend <i class="bi bi-gear-fill"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>