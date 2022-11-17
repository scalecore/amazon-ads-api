<?php

declare(strict_types=1);

$finder = Symfony\Component\Finder\Finder::create()
                                         ->in(
                                             [
                                                 __DIR__ . '/src',
                                                 __DIR__ . '/tests',
                                             ]
                                         )
                                         ->name('*.php')
                                         ->ignoreDotFiles(true)
                                         ->ignoreVCS(true);

return (new PhpCsFixer\Config())->setRiskyAllowed(true)
                                ->setUsingCache(false)
                                ->setRules(
                                    [
                                        '@Symfony'                            => true,
                                        'concat_space'                        => ['spacing' => 'one'],
                                        'phpdoc_add_missing_param_annotation' => true,
                                        'no_useless_else'                     => true,
                                        'no_useless_return'                   => true,
                                        'combine_consecutive_unsets'          => true,
                                        'general_phpdoc_annotation_remove'    => true,
                                        'phpdoc_to_comment'                   => false,
                                        'not_operator_with_space'             => true,
                                        'yoda_style'                          => false,
                                        'single_line_throw'                   => false,
                                        'binary_operator_spaces'              => [
                                            'operators' => [
                                                '=>' => 'align_single_space_minimal',
                                                '='  => 'align_single_space_minimal',
                                            ],
                                        ],
                                        'blank_line_before_statement' => [
                                            'statements' => ['break', 'continue', 'declare', 'return', 'throw', 'try'],
                                        ],
                                        'method_argument_space' => [
                                            'on_multiline' => 'ensure_fully_multiline',
                                        ],
                                        // Things that are marked as "risky" but included anyway
                                        'strict_comparison'                => true,
                                        'declare_strict_types'             => true,
                                        'blank_line_between_import_groups' => false,
                                    ]
                                )
                                ->setFinder($finder);
