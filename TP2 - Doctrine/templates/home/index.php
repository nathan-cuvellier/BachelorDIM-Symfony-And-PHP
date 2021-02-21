<h1 class="text-5xl mb-5">Jeux populaires</h1>

<h3>Classement du <b><?= $startDate ?> </b> au <b><?= $now ?></b></h3>

<div class="grid grid-cols-5 gap-4 mt-5">
    <?php foreach ($popularGamesOfWeek as $k => $game) { ?>
        <div class="shadow-lg rounded float-left bg-white dark:bg-gray-800 p-4">
            <div class="flex-row gap-5 flex justify-center items-center">
                <div class=" flex flex-col">
                    <span class="text-gray-600 dark:text-white text-lg font-medium"><?= $game['name'] ?></span>
                    <span class="text-gray-400 text-xs">
                        tendance n°<?= ++$k ?>
                    </span>
                    <span class="text-gray-400 text-xs">
                        <a class="hover:text-gray-600" href="/game/show?id=<?= $game['id'] ?>">
                            <i class="fas fa-eye"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
