<?php
return array_merge_recursive(
    include __DIR__.'/instances/clients.config.php',
    include __DIR__.'/instances/translations.config.php',
    include __DIR__.'/instances/user.config.php'
);
