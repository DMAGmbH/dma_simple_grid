:: Run easy-coding-standard (ecs) via this batch file inside your IDE e.g. PhpStorm (Windows only)
:: Install inside PhpStorm the  "Batch Script Support" plugin
cd..
cd..
cd..
cd..
cd..
cd..
php vendor\bin\ecs check vendor/dma/dma_simple_grid/src --fix --config vendor/dma/dma_simple_grid/tools/ecs/config.php
php vendor\bin\ecs check vendor/dma/dma_simple_grid/contao --fix --config vendor/dma/dma_simple_grid/tools/ecs/config.php
php vendor\bin\ecs check vendor/dma/dma_simple_grid/config --fix --config vendor/dma/dma_simple_grid/tools/ecs/config.php
php vendor\bin\ecs check vendor/dma/dma_simple_grid/tests --fix --config vendor/dma/dma_simple_grid/tools/ecs/config.php
