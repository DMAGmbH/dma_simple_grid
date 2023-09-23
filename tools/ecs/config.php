<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;

return static function (ECSConfig $ecsConfig): void {

    if (is_file(__DIR__.'/vendor/contao/easy-coding-standard/config/contao.php')) {
        //.github/workflows/ci.yaml
        $ecsConfig->sets([__DIR__.'/vendor/contao/easy-coding-standard/config/contao.php']);
    } else {
        // local development
        $ecsConfig->sets([__DIR__.'/../../../../../vendor/contao/easy-coding-standard/config/contao.php']);
    }

    $services = $ecsConfig->services();
    $services
        ->set(HeaderCommentFixer::class)
        ->call('configure', [
            [
                'header' => "This file is part of Dma Simple Grid.\n\n(c) Janosch Oltmanns ".date('Y')." <kontakt@janosch-oltmanns.de>\n@license LGPL-3.0+\nFor the full copyright and license information,\nplease view the LICENSE file that was distributed with this source code.\n@link https://github.com/DMAGmbH/dma_simple_grid",
            ],
        ]);

    $ecsConfig->skip([
        '*/contao/dca*',
        MethodChainingIndentationFixer::class => [
            'DependencyInjection/Configuration.php',
        ],
    ]);

    $ecsConfig->parallel();
    $ecsConfig->lineEnding("\n");

    $parameters = $ecsConfig->parameters();
    $parameters->set(Option::CACHE_DIRECTORY, sys_get_temp_dir().'/ecs_default_cache');
};
